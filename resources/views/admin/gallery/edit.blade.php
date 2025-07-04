@extends('layouts.admin')

@section('title', 'Chỉnh sửa hình ảnh')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Chỉnh sửa hình ảnh</h1>
        <a href="{{ route('admin.gallery.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-200">
            Quay lại
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Hình ảnh -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Hình ảnh</label>
                    <label class="custom-file-upload">
                        <input type="file" name="image" id="image" accept="image/*"
                            onchange="showFileName(this, 'image-label'); previewImage(this, 'imagePreview')">
                        <span id="image-label">+ Chọn hình ảnh mới</span>
                    </label>
                    <img id="imagePreview" src="{{ $gallery->image }}" alt="{{ $translations['vi']->title }}"
                        class="mt-2 h-32 w-32 object-cover">
                    @error('image')
                        <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Video (chỉ hiện khi chọn category là video) -->
                <div id="video-section" class="col-span-2 {{ $gallery->category == 2 ? '' : 'hidden' }}">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Video</label>
                    <div class="flex space-x-4 mb-2">
                        <label class="inline-flex items-center">
                            <input type="radio" name="video_type" value="upload" {{ old('video_type', $gallery->video_type) == 'upload' ? 'checked' : '' }}
                                onchange="toggleVideoInput()" class="form-radio">
                            <span class="ml-2">Upload video</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="video_type" value="url" {{ old('video_type', $gallery->video_type) == 'url' ? 'checked' : '' }}
                                onchange="toggleVideoInput()" class="form-radio">
                            <span class="ml-2">Gắn link</span>
                        </label>
                    </div>
                    <div id="video-upload-input" class="{{ old('video_type', $gallery->video_type) == 'url' ? 'hidden' : '' }}">
                        <label class="custom-file-upload">
                            <input type="file" name="video_file" id="video_file" accept="video/*"
                                onchange="showFileName(this, 'video-file-label')"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                            <span id="video-file-label">+ Chọn tệp video mới</span>
                        </label>
                        @if($gallery->video_file)
                            <div class="mt-2">
                                <p class="text-sm text-gray-600">Video hiện tại: {{ basename($gallery->video_file) }}</p>
                            </div>
                        @endif
                    </div>
                    <div id="video-url-input" class="{{ old('video_type', $gallery->video_type) == 'upload' || old('category', $gallery->category) == '3' ? 'hidden' : '' }}">
                        <input type="url" name="video_url" value="{{ old('category', $gallery->category) == '3' ? '' : old('video_url', $gallery->video_url) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200"
                            placeholder="Nhập URL video">
                    </div>
                </div>

                <!-- Tài liệu (chỉ hiện khi chọn category là tài liệu) -->
                <div id="document-section" class="col-span-2 {{ $gallery->category == 3 ? '' : 'hidden' }}">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tài liệu PDF</label>
                    <label class="custom-file-upload">
                        <input type="file" name="document_file" id="document_file" accept=".pdf"
                            onchange="showFileName(this, 'document-file-label')"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                        <span id="document-file-label">+ Chọn tệp PDF mới</span>
                    </label>
                    @if($gallery->document_url)
                        <div class="mt-2">
                            <p class="text-sm text-gray-600">Tài liệu hiện tại: {{ basename($gallery->document_url) }}</p>
                        </div>
                    @endif
                    @error('document_file')
                        <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tiêu đề tiếng Việt -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề (Tiếng Việt)</label>
                    <input type="text" name="title_vi" value="{{ old('title_vi', $translations['vi']->title) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                    @error('title_vi')
                        <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tiêu đề tiếng Anh -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề (Tiếng Anh)</label>
                    <input type="text" name="title_en" value="{{ old('title_en', $translations['en']->title) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                    @error('title_en')
                        <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Danh mục -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Danh mục</label>
                    <select name="category"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                        <option value="">Chọn danh mục</option>
                        <option value="1" {{ old('category', $gallery->category) == '1' ? 'selected' : '' }}>Hình ảnh</option>
                        <option value="2" {{ old('category', $gallery->category) == '2' ? 'selected' : '' }}>Video</option>
                        <option value="3" {{ old('category', $gallery->category) == '3' ? 'selected' : '' }}>Tài liệu</option>
                    </select>
                    @error('category')
                        <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Thứ tự -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Thứ tự</label>
                    <input type="number" name="order" value="{{ old('order', $gallery->order) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                    @error('order')
                        <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Trạng thái -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Trạng thái</label>
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input type="radio" name="status" value="1" {{ old('status', $gallery->status) == '1' ? 'checked' : '' }}
                                class="form-radio text-[#E6D1A2]">
                            <span class="ml-2">Hiển thị</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" name="status" value="0" {{ old('status', $gallery->status) == '0' ? 'checked' : '' }}
                                class="form-radio text-[#E6D1A2]">
                            <span class="ml-2">Ẩn</span>
                        </label>
                    </div>
                    @error('status')
                        <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="bg-[#E6D1A2] text-white px-6 py-2 rounded-lg hover:bg-[#D4B97A] transition duration-200">
                    Cập nhật
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function showFileName(input, labelId) {
        const label = document.getElementById(labelId);
        if (input.files && input.files.length > 0) {
            label.textContent = input.files[0].name;
        } else {
            label.textContent = '+ Chọn hình ảnh mới';
        }
    }

    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function toggleVideoInput() {
        const type = document.querySelector('input[name="video_type"]:checked').value;
        const fileInput = document.querySelector('input[name="video_file"]');
        const urlInput = document.querySelector('input[name="video_url"]');

        document.getElementById('video-upload-input').classList.toggle('hidden', type !== 'upload');
        document.getElementById('video-url-input').classList.toggle('hidden', type !== 'url');

        if (type === 'upload') {
            urlInput.value = '';
            urlInput.removeAttribute('required');
            urlInput.setAttribute('disabled', 'disabled');
            fileInput.removeAttribute('disabled');
            fileInput.setAttribute('required', 'required');
        } else {
            fileInput.value = '';
            fileInput.removeAttribute('required');
            fileInput.setAttribute('disabled', 'disabled');
            urlInput.removeAttribute('disabled');
            urlInput.setAttribute('required', 'required');
        }
    }

    // Xử lý hiển thị/ẩn phần video và tài liệu khi thay đổi category
    document.querySelector('select[name="category"]').addEventListener('change', function() {
        const videoSection = document.getElementById('video-section');
        const documentSection = document.getElementById('document-section');
        const videoFileInput = document.querySelector('input[name="video_file"]');
        const videoUrlInput = document.querySelector('input[name="video_url"]');
        const documentFileInput = document.querySelector('input[name="document_file"]');
        
        // Ẩn tất cả các phần và reset các input
        videoSection.classList.add('hidden');
        documentSection.classList.add('hidden');
        videoFileInput.value = '';
        videoUrlInput.value = '';
        documentFileInput.value = '';
        
        // Reset trạng thái của các input
        videoFileInput.removeAttribute('required');
        videoFileInput.removeAttribute('disabled');
        videoUrlInput.removeAttribute('required');
        videoUrlInput.removeAttribute('disabled');
        documentFileInput.removeAttribute('required');
        
        // Hiển thị phần tương ứng với category được chọn
        if (this.value === '2') { // Video
            videoSection.classList.remove('hidden');
            toggleVideoInput();
            document.getElementById('video-url-input').classList.remove('hidden');
        } else if (this.value === '3') { // Tài liệu
            documentSection.classList.remove('hidden');
            documentFileInput.setAttribute('required', 'required');
            // Ẩn và xóa giá trị video_url
            document.getElementById('video-url-input').classList.add('hidden');
            videoUrlInput.value = '';
        } else {
            document.getElementById('video-url-input').classList.remove('hidden');
        }
    });

    // Khởi tạo trạng thái ban đầu
    window.addEventListener('DOMContentLoaded', function() {
        const category = document.querySelector('select[name="category"]').value;
        if (category === '2') {
            toggleVideoInput();
        }
    });
</script>
@endpush

@push('styles')
<style>
    .custom-file-upload {
        display: inline-block;
        padding: 10px 18px;
        background: #E6D1A2;
        color: #fff;
        font-weight: bold;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .custom-file-upload:hover {
        background: #D4B97A;
    }

    .custom-file-upload input[type="file"] {
        display: none;
    }
</style>
@endpush
@endsection 