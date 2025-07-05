// CKEditor Upload Handler
(function() {
    'use strict';
    
    // Custom Upload Adapter cho CKEditor 4
    CKEDITOR.plugins.add('customupload', {
        init: function(editor) {
            // Tạo custom upload adapter
            editor.addCommand('uploadimage', {
                exec: function(editor) {
                    var input = document.createElement('input');
                    input.type = 'file';
                    input.accept = 'image/*';
                    input.onchange = function() {
                        var file = this.files[0];
                        if (file) {
                            uploadFile(file, editor);
                        }
                    };
                    input.click();
                }
            });

            editor.ui.addButton('UploadImage', {
                label: 'Upload Image',
                command: 'uploadimage',
                toolbar: 'insert'
            });
        }
    });

    // Hàm upload file
    function uploadFile(file, editor) {
        var formData = new FormData();
        formData.append('upload', file);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', window.location.origin + '/admin/upload/image', true);
        
        // Thêm CSRF token
        var csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (csrfToken) {
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken.getAttribute('content'));
        }
        
        // Thêm header để xác định đây là AJAX request
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.url) {
                        editor.insertHtml('<img src="' + response.url + '" alt="' + file.name + '" style="max-width:100%;">');
                    } else if (response.error) {
                        console.error('Upload error:', response.error.message);
                        showError('Upload failed: ' + response.error.message);
                    }
                } catch (e) {
                    console.error('Upload response parsing error:', e);
                    showError('Upload failed: Invalid response from server');
                }
            } else {
                console.error('Upload failed:', xhr.status, xhr.responseText);
                showError('Upload failed: Server error ' + xhr.status);
            }
        };
        
        xhr.onerror = function() {
            console.error('Upload error');
            showError('Upload failed: Network error');
        };
        
        xhr.send(formData);
    }

    // Hàm hiển thị lỗi
    function showError(message) {
        // Tạo notification element
        var notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
        notification.textContent = message;
        
        // Thêm vào body
        document.body.appendChild(notification);
        
        // Tự động ẩn sau 5 giây
        setTimeout(function() {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 5000);
    }

    // Cấu hình CKEditor 4 cho file upload
    CKEDITOR.editorConfig = function(config) {
        config.extraAllowedContent = 'img[width,height,align,style]';
        
        // Sử dụng AJAX upload thay vì form upload để tránh lỗi cross-origin
        config.filebrowserUploadUrl = window.location.origin + '/admin/upload/image';
        config.filebrowserUploadMethod = 'xhr';
        
        // Thêm cấu hình bảo mật
        config.allowedContent = true;
        config.extraAllowedContent = 'img[width,height,align,style]';
        
        // Tắt một số tính năng có thể gây lỗi
        config.removePlugins = 'elementspath,resize';
        
        // Thêm cấu hình để tránh lỗi cross-origin
        config.filebrowserWindowFeatures = 'location=yes,links=no,scrollbars=yes,toolbar=no,menubar=no,status=no,directories=no,width=800,height=600';
        
        // Tắt một số tính năng có thể gây lỗi bảo mật
        config.removeButtons = 'Save,NewPage,Preview,Print,Templates,Scayt';
    };
})(); 