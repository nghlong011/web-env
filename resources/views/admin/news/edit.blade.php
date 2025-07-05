@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Chỉnh sửa tin tức</h1>
            <a href="{{ route('admin.news.index') }}" class="text-gray-600 hover:text-gray-900">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <div x-data="{ activeTab: 'vi' }">
            <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
                @csrf
                @method('PUT')

                <!-- Thông tin chung -->
                <div class="mb-8">
                    <h2 class="text-lg font-medium text-gray-900 mb-6">Thông tin chung</h2>
                    <div class="mb-6">
                        <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Thứ tự</label>
                        <input type="number" name="order" id="order" value="{{ old('order', $news->order) }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                        @error('order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Danh mục</label>
                        <select name="category" id="category" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                            <option value="1" {{ old('category', $news->category) == 1 ? 'selected' : '' }}>{{ __('new.environment') }}</option>
                            <option value="2" {{ old('category', $news->category) == 2 ? 'selected' : '' }}>{{ __('new.project') }}</option>
                            <option value="3" {{ old('category', $news->category) == 3 ? 'selected' : '' }}>{{ __('new.regulation') }}</option>
                            <option value="4" {{ old('category', $news->category) == 4 ? 'selected' : '' }}>{{ __('new.other') }}</option>
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Ngày đăng</label>
                        <input type="date" name="date" id="date" value="{{ old('date', $news->date->format('Y-m-d')) }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                        @error('date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Hình ảnh thumbnail</label>
                        <div class="mt-2 mb-4">
                            <img id="imagePreview" src="{{ $news->image }}" alt="Current image" class="h-32 w-32 object-cover rounded">
                        </div>
                        <input type="file" name="image" id="image" accept="image/*"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200"
                            onchange="previewImage(this)">
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
                        <div class="flex space-x-6">
                            <label class="inline-flex items-center">
                                <input type="radio" name="status" value="1" {{ old('status', $news->status) == 1 ? 'checked' : '' }} 
                                    class="form-radio h-4 w-4 text-[#E6D1A2] focus:ring-[#E6D1A2] border-gray-300">
                                <span class="ml-2 text-gray-700">Hiển thị</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="status" value="0" {{ old('status', $news->status) == 0 ? 'checked' : '' }} 
                                    class="form-radio h-4 w-4 text-[#E6D1A2] focus:ring-[#E6D1A2] border-gray-300">
                                <span class="ml-2 text-gray-700">Ẩn</span>
                            </label>
                        </div>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Tab Navigation -->
                <div class="flex grid grid-cols-2 mb-8">
                    <button type="button"
                        :class="activeTab === 'vi' ? 'text-[#E6D1A2] font-bold border-[#E6D1A2]' : 'text-[#969696]'"
                        class="px-6 py-2 focus:outline-none text-xl uppercase border-b-[1.5px] border-[#969696] cursor-pointer"
                        @click="activeTab = 'vi'">
                        Tiếng Việt
                    </button>
                    <button type="button"
                        :class="activeTab === 'en' ? 'text-[#E6D1A2] font-bold border-[#E6D1A2]' : 'text-[#969696]'"
                        class="px-6 py-2 focus:outline-none text-xl uppercase border-b-[1.5px] border-[#969696] cursor-pointer"
                        @click="activeTab = 'en'">
                        English
                    </button>
                </div>

                <!-- Tiếng Việt -->
                <div x-show="activeTab === 'vi'" class="mb-8">
                    <div class="mb-6">
                        <label for="title_vi" class="block text-sm font-medium text-gray-700 mb-2">Tiêu đề</label>
                        <input type="text" name="title_vi" id="title_vi" value="{{ old('title_vi', $translations['vi']->title ?? '') }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                        @error('title_vi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="description_vi" class="block text-sm font-medium text-gray-700 mb-2">Mô tả ngắn</label>
                        <textarea name="description_vi" id="description_vi" rows="3" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">{{ old('description_vi', $translations['vi']->description) }}</textarea>
                        @error('description_vi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="content_vi" class="block text-sm font-medium text-gray-700 mb-2">Nội dung</label>
                        <textarea name="content_vi" id="content_vi" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">{{ old('content_vi', $translations['vi']->content ?? '') }}</textarea>
                        @error('content_vi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- SEO Section -->
                    <div class="mb-6 border-t pt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">SEO</h3>
                        
                        <div class="mb-4">
                            <label for="slug_vi" class="block text-sm font-medium text-gray-700 mb-2">URL (Slug)</label>
                            <input type="text" name="slug_vi" id="slug_vi" value="{{ old('slug_vi', $translations['vi']->slug ?? '') }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                            @error('slug_vi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="meta_title_vi" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                            <input type="text" name="meta_title_vi" id="meta_title_vi" value="{{ old('meta_title_vi', $translations['vi']->meta_title ?? '') }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                            @error('meta_title_vi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="meta_description_vi" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                            <textarea name="meta_description_vi" id="meta_description_vi" rows="2" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">{{ old('meta_description_vi', $translations['vi']->meta_description ?? '') }}</textarea>
                            @error('meta_description_vi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="meta_keywords_vi" class="block text-sm font-medium text-gray-700 mb-2">Meta Keywords</label>
                            <input type="text" name="meta_keywords_vi" id="meta_keywords_vi" value="{{ old('meta_keywords_vi', $translations['vi']->meta_keywords ?? '') }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                            @error('meta_keywords_vi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Tiếng Anh -->
                <div x-show="activeTab === 'en'" class="mb-8">
                    <div class="mb-6">
                        <label for="title_en" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                        <input type="text" name="title_en" id="title_en" value="{{ old('title_en', $translations['en']->title ?? '') }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                        @error('title_en')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="description_en" class="block text-sm font-medium text-gray-700 mb-2">Short Description</label>
                        <textarea name="description_en" id="description_en" rows="3" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">{{ old('description_en', $translations['en']->description) }}</textarea>
                        @error('description_en')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="content_en" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                        <textarea name="content_en" id="content_en" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">{{ old('content_en', $translations['en']->content ?? '') }}</textarea>
                        @error('content_en')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- SEO Section -->
                    <div class="mb-6 border-t pt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">SEO</h3>
                        
                        <div class="mb-4">
                            <label for="slug_en" class="block text-sm font-medium text-gray-700 mb-2">URL (Slug)</label>
                            <input type="text" name="slug_en" id="slug_en" value="{{ old('slug_en', $translations['en']->slug ?? '') }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                            @error('slug_en')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="meta_title_en" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                            <input type="text" name="meta_title_en" id="meta_title_en" value="{{ old('meta_title_en', $translations['en']->meta_title ?? '') }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                            @error('meta_title_en')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="meta_description_en" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                            <textarea name="meta_description_en" id="meta_description_en" rows="2" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">{{ old('meta_description_en', $translations['en']->meta_description ?? '') }}</textarea>
                            @error('meta_description_en')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="meta_keywords_en" class="block text-sm font-medium text-gray-700 mb-2">Meta Keywords</label>
                            <input type="text" name="meta_keywords_en" id="meta_keywords_en" value="{{ old('meta_keywords_en', $translations['en']->meta_keywords ?? '') }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                            @error('meta_keywords_en')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-[#E6D1A2] hover:bg-[#D4B97A] text-white font-bold py-2 px-6 rounded-lg transition duration-200">
                        Cập nhật tin tức
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // CKEditor 4 cho nội dung tiếng Việt
    CKEDITOR.replace('content_vi', {
        toolbar: [
            { name: 'document', items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates'] },
            { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
            { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt'] },
            '/',
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl'] },
            { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
            { name: 'insert', items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe'] },
            '/',
            { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
            { name: 'colors', items: ['TextColor', 'BGColor'] },
            { name: 'tools', items: ['Maximize', 'ShowBlocks'] }
        ],
        height: 400,
        language: 'vi',
        extraPlugins: 'customupload',
        filebrowserUploadUrl: '{{ route('admin.upload.image') }}',
        filebrowserUploadMethod: 'xhr',
        allowedContent: true,
        extraAllowedContent: 'img[width,height,align,style]',
        removePlugins: 'elementspath,resize'
    });

             // CKEditor 4 cho nội dung tiếng Anh
             CKEDITOR.replace('content_en', {
                 toolbar: [
                     { name: 'document', items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates'] },
                     { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
                     { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt'] },
                     '/',
                     { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },
                     { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl'] },
                     { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
                     { name: 'insert', items: ['Image', 'UploadImage', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe'] },
                     '/',
                     { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
                     { name: 'colors', items: ['TextColor', 'BGColor'] },
                     { name: 'tools', items: ['Maximize', 'ShowBlocks'] }
                 ],
                 height: 400,
                 language: 'en',
                 extraPlugins: 'customupload',
                 filebrowserUploadUrl: '{{ route('admin.upload.image') }}',
                 filebrowserUploadMethod: 'xhr',
                 allowedContent: true,
                 extraAllowedContent: 'img[width,height,align,style]',
                 removePlugins: 'elementspath,resize'
    });

    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeVietnameseTones(str) {
        return str.normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '') // loại bỏ dấu
            .replace(/đ/g, 'd').replace(/Đ/g, 'D');
    }

    function generateSlug(text) {
        return removeVietnameseTones(text)
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '') // chỉ giữ chữ, số, khoảng trắng, dấu gạch ngang
            .replace(/\s+/g, '-')         // thay khoảng trắng bằng dấu gạch ngang
            .replace(/-+/g, '-')           // loại bỏ nhiều dấu gạch ngang liên tiếp
            .replace(/^-+|-+$/g, '');      // loại bỏ dấu gạch ngang ở đầu/cuối
    }

    // Tự động tạo meta description (160 ký tự đầu tiên)
    function generateMetaDescription(text) {
        return text.substring(0, 160).trim();
    }

    // Tự động tạo meta keywords (5 từ khóa đầu tiên)
    function generateMetaKeywords(text) {
        const words = text.toLowerCase().split(/\s+/);
        const uniqueWords = [...new Set(words)];
        return uniqueWords.slice(0, 5).join(', ');
    }

    // Vietnamese
    document.getElementById('title_vi').addEventListener('input', function() {
        const title = this.value;
        document.getElementById('slug_vi').value = generateSlug(title);
        document.getElementById('meta_title_vi').value = title;
    });

    document.getElementById('description_vi').addEventListener('input', function() {
        const description = this.value;
        document.getElementById('meta_description_vi').value = generateMetaDescription(description);
        document.getElementById('meta_keywords_vi').value = generateMetaKeywords(description);
    });

    // English
    document.getElementById('title_en').addEventListener('input', function() {
        const title = this.value;
        document.getElementById('slug_en').value = generateSlug(title);
        document.getElementById('meta_title_en').value = title;
    });

    document.getElementById('description_en').addEventListener('input', function() {
        const description = this.value;
        document.getElementById('meta_description_en').value = generateMetaDescription(description);
        document.getElementById('meta_keywords_en').value = generateMetaKeywords(description);
    });
</script>
@endpush
@endsection 