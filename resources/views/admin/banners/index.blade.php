@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Quản lý banner</h1>
        <a href="{{ route('admin.banners.create') }}"
            class="bg-[#E6D1A2] text-white px-4 py-2 rounded-md hover:bg-[#d4c091] transition-colors">
            <i class="fas fa-plus mr-2"></i>Thêm banner mới
        </a>
    </div>

    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hình ảnh</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Đường dẫn</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thứ tự</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($banners as $banner)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if ($banner->img)
                        <img src="{{ asset($banner->img) }}" alt="{{ $banner->title }}"
                            class="h-20 w-32 object-cover rounded">
                        @else
                        <span class="text-gray-400">Không có hình ảnh</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $banner->link }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="number" 
                            value="{{ $banner->order }}" 
                            min="0"
                            class="order-input w-16 px-2 py-1 border border-gray-300 rounded text-center text-sm"
                            data-banner-id="{{ $banner->id }}"
                            data-original-value="{{ $banner->order }}">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $banner->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $banner->active ? 'Hiển thị' : 'Ẩn' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.banners.edit', $banner) }}"
                            class="text-[#E6D1A2] hover:text-[#d4c091] mr-3">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn text-red-600 hover:text-red-900"
                                data-confirm="Bạn có chắc chắn muốn xóa banner này?">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const orderInputs = document.querySelectorAll('.order-input');
    
    orderInputs.forEach(input => {
        input.addEventListener('change', function() {
            const bannerId = this.dataset.bannerId;
            const newOrder = this.value;
            const originalValue = this.dataset.originalValue;
            
            // Nếu giá trị không thay đổi, không làm gì
            if (newOrder === originalValue) {
                return;
            }
            
            // Gửi request cập nhật
            fetch(`/admin/banners/${bannerId}/order`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    order: newOrder
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cập nhật giá trị gốc
                    this.dataset.originalValue = newOrder;
                    
                    // Hiển thị thông báo thành công
                    showNotification('Cập nhật thứ tự thành công!', 'success');
                } else {
                    // Khôi phục giá trị cũ nếu có lỗi
                    this.value = originalValue;
                    showNotification('Có lỗi xảy ra khi cập nhật thứ tự!', 'error');
                }
            })
            .catch(error => {
                // Khôi phục giá trị cũ nếu có lỗi
                this.value = originalValue;
                showNotification('Có lỗi xảy ra khi cập nhật thứ tự!', 'error');
                console.error('Error:', error);
            });
        });
    });
    
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white z-50 ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        }`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
});
</script>
@endsection 