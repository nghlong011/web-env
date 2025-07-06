import "./bootstrap";
import GLightbox from "glightbox";
import "glightbox/dist/css/glightbox.min.css";

// Biến global để lưu instance GLightbox
window.glightboxGallery = null;
window.GLightbox = GLightbox;

// Hàm khởi tạo GLightbox
function initGLightbox() {
    console.log('Initializing GLightbox...'); // Debug log
    
    // Hủy lightbox cũ nếu có
    if (window.glightboxGallery) {
        window.glightboxGallery.destroy();
    }
    
    // Đợi một chút để DOM được cập nhật hoàn toàn
    setTimeout(() => {
        // Khởi tạo lightbox mới
        window.glightboxGallery = GLightbox({ 
            selector: '.glightbox',
            onOpen: () => {
                // Khi mở lightbox, blur focus khỏi thẻ <a> để tránh cảnh báo accessibility
                setTimeout(() => {
                    const activeElement = document.activeElement;
                    if (activeElement && activeElement.classList.contains('glightbox')) {
                        activeElement.blur();
                    }
                }, 100);
            }
        });
        
        console.log('GLightbox initialized with', document.querySelectorAll('.glightbox').length, 'elements'); // Debug log
    }, 100);
}

// Khởi tạo lần đầu khi trang load
document.addEventListener("DOMContentLoaded", function () {
    initGLightbox();
});

// Sử dụng Livewire hooks thay vì DOM events
if (typeof Livewire !== 'undefined') {
    // Hook khi Livewire load
    Livewire.on('init', () => {
        initGLightbox();
    });
    
    // Hook khi component được cập nhật
    Livewire.hook('message.processed', (message, component) => {
        initGLightbox();
    });
    
    // Hook khi component được navigate
    Livewire.hook('navigate', () => {
        initGLightbox();
    });
}

// Fallback cho các sự kiện DOM
document.addEventListener("livewire:navigated", function() {
    console.log('Livewire navigated event fired'); // Debug log
    initGLightbox();
});

document.addEventListener("livewire:updated", function() {
    console.log('Livewire updated event fired'); // Debug log
    initGLightbox();
});

// Thêm sự kiện cho việc thay đổi tab (nếu có)
document.addEventListener('click', function(e) {
    if (e.target && e.target.matches('button[wire\\:click*="tab"]')) {
        console.log('Tab button clicked'); // Debug log
        setTimeout(() => {
            initGLightbox();
        }, 200);
    }
});
