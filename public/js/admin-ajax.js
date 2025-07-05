// Admin AJAX Delete Handler
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý xóa với AJAX
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-btn') || e.target.closest('.delete-btn')) {
            e.preventDefault();
            
            const deleteBtn = e.target.classList.contains('delete-btn') ? e.target : e.target.closest('.delete-btn');
            const form = deleteBtn.closest('form');
            const confirmMessage = deleteBtn.getAttribute('data-confirm') || 'Bạn có chắc chắn muốn xóa mục này?';
            
            if (confirm(confirmMessage)) {
                // Thêm loading state
                const originalText = deleteBtn.innerHTML;
                deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang xóa...';
                deleteBtn.disabled = true;
                
                // Lấy CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                // Thực hiện AJAX request
                fetch(form.action, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Hiển thị thông báo thành công
                        showNotification(data.message, 'success');
                        
                        // Xóa row khỏi bảng
                        const row = form.closest('tr');
                        if (row) {
                            row.style.transition = 'opacity 0.3s ease';
                            row.style.opacity = '0';
                            setTimeout(() => {
                                row.remove();
                                
                                // Kiểm tra nếu bảng trống
                                const tbody = row.closest('tbody');
                                if (tbody && tbody.children.length === 0) {
                                    const table = tbody.closest('table');
                                    const container = table.closest('.container');
                                    container.innerHTML = '<div class="text-center py-8 text-gray-500">Không có dữ liệu nào.</div>';
                                }
                            }, 300);
                        }
                    } else {
                        showNotification('Có lỗi xảy ra khi xóa.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Có lỗi xảy ra khi xóa.', 'error');
                })
                .finally(() => {
                    // Khôi phục trạng thái ban đầu
                    deleteBtn.innerHTML = originalText;
                    deleteBtn.disabled = false;
                });
            }
        }
    });
});

// Hàm hiển thị thông báo
function showNotification(message, type = 'success') {
    // Tạo element thông báo
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-2"></i>
            <span>${message}</span>
            <button class="ml-4 text-white hover:text-gray-200" onclick="this.parentElement.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    // Thêm vào body
    document.body.appendChild(notification);
    
    // Hiển thị với animation
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    // Tự động ẩn sau 5 giây
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 300);
    }, 5000);
} 