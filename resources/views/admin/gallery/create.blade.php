@extends('layouts.admin')

@section('title', 'Thêm hình ảnh mới')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Thêm hình ảnh mới</h1>
        <a href="{{ route('admin.gallery.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-200">
            Quay lại
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Hình ảnh -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Hình ảnh</label>
                    <label class="custom-file-upload">
                        <input type="file" name="image" id="image" accept="image/*"
                            onchange="showFileName(this, 'image-label'); previewImage(this, 'imagePreview')">
                        <span id="image-label">+ Chọn hình ảnh</span>
                    </label>
                    <img id="imagePreview" src="#" alt="Preview"
                        class="mt-2 h-32 w-32 object-cover hidden">
                    @error('image')
                        <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Video (chỉ hiện khi chọn category là video) -->
                <div id="video-section" class="col-span-2 hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Video</label>
                    <div class="flex space-x-4 mb-2">
                        <label class="inline-flex items-center">
                            <input type="radio" name="video_type" value="upload" checked
                                onchange="toggleVideoInput()" class="form-radio">
                            <span class="ml-2">Upload video</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="video_type" value="url" onchange="toggleVideoInput()"
                                class="form-radio">
                            <span class="ml-2">Gắn link</span>
                        </label>
                    </div>
                    <div id="video-upload-input">
                        <label class="custom-file-upload">
                            <input type="file" name="video_file" id="video_file" accept="video/*"
                                onchange="showFileName(this, 'video-file-label')"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                            <span id="video-file-label">+ Chọn tệp video</span>
                        </label>
                    </div>
                    <div id="video-url-input" class="hidden">
                        <input type="url" name="video_url" value="{{ old('video_url') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200"
                            placeholder="Nhập URL video">
                    </div>
                </div>

                <!-- Tài liệu (chỉ hiện khi chọn category là tài liệu) -->
                <div id="document-section" class="col-span-2 hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tài liệu PDF</label>
                    <label class="custom-file-upload">
                        <input type="file" name="document_file" id="document_file" accept=".pdf"
                            onchange="showFileName(this, 'document-file-label')"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                        <span id="document-file-label">+ Chọn tệp PDF</span>
                    </label>
                    @error('document_file')
                        <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tiêu đề tiếng Việt -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề (Tiếng Việt)</label>
                    <input type="text" name="title_vi" value="{{ old('title_vi') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                    @error('title_vi')
                        <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tiêu đề tiếng Anh -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề (Tiếng Anh)</label>
                    <input type="text" name="title_en" value="{{ old('title_en') }}"
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
                        <option value="1" {{ old('category') == '1' ? 'selected' : '' }}>Hình ảnh</option>
                        <option value="2" {{ old('category') == '2' ? 'selected' : '' }}>Video</option>
                        <option value="3" {{ old('category') == '3' ? 'selected' : '' }}>Tài liệu</option>
                    </select>
                    @error('category')
                        <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Thứ tự -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Thứ tự</label>
                    <input type="number" name="order" value="{{ old('order', 0) }}"
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
                            <input type="radio" name="status" value="1" {{ old('status', '1') == '1' ? 'checked' : '' }}
                                class="form-radio text-[#E6D1A2]">
                            <span class="ml-2">Hiển thị</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" name="status" value="0" {{ old('status') == '0' ? 'checked' : '' }}
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
                    Thêm mới
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
            label.textContent = '+ Chọn hình ảnh';
        }
    }

    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
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
            urlInput.disabled = true;
            fileInput.disabled = false;
        } else {
            fileInput.value = '';
            fileInput.disabled = true;
            urlInput.disabled = false;
        }
    }

    // Xử lý hiển thị/ẩn phần video và tài liệu khi thay đổi category
    document.querySelector('select[name="category"]').addEventListener('change', function() {
        const videoSection = document.getElementById('video-section');
        const documentSection = document.getElementById('document-section');
        
        // Ẩn tất cả các phần
        videoSection.classList.add('hidden');
        documentSection.classList.add('hidden');
        
        // Hiển thị phần tương ứng với category được chọn
        if (this.value === '2') { // Video
            videoSection.classList.remove('hidden');
            toggleVideoInput();
        } else if (this.value === '3') { // Tài liệu
            documentSection.classList.remove('hidden');
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