@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Chỉnh sửa thông tin chung</h1>
        <button type="button" onclick="window.history.back()"
            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>Quay lại
        </button>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('admin.settings.update', $setting) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Thông tin chung</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Ảnh</label>
                        @if ($setting->image_path)
                        <img src="{{ asset($setting->image_path) }}" alt="{{ $setting->translation('vi')->name }}"
                            class="h-32 w-32 object-cover rounded mb-2">
                        @endif
                        <input type="file" name="image" id="image" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#E6D1A2]">
                        @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
                        <div class="flex items-center">
                            <input type="checkbox" name="active" id="active" value="1"
                                {{ $setting->active ? 'checked' : '' }}
                                class="h-4 w-4 text-[#E6D1A2] focus:ring-[#E6D1A2] border-gray-300 rounded">
                            <label for="active" class="ml-2 block text-sm text-gray-900">Hiển thị</label>
                        </div>
                    </div>
                </div>
            </div>

            @if ($setting->key !== 'logo')
            <div class="mb-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Nội dung tiếng Việt</h2>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="vi_name" class="block text-sm font-medium text-gray-700 mb-2">Tên</label>
                        <input type="text" name="vi_name" id="vi_name"
                            value="{{ old('vi_name', $setting->translation('vi')->name) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#E6D1A2]"
                            required>
                        @if ($errors->has('vi_name'))
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('vi_name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="vi_description" class="block text-sm font-medium text-gray-700 mb-2">Mô tả</label>
                        <textarea name="vi_description" id="vi_description" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#E6D1A2]"
                            required>{{ old('vi_description', $setting->translation('vi')->description) }}</textarea>
                        @if ($errors->has('vi_description'))
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('vi_description') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Nội dung tiếng Anh</h2>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="en_name" class="block text-sm font-medium text-gray-700 mb-2">Tên</label>
                        <input type="text" name="en_name" id="en_name"
                            value="{{ old('en_name', $setting->translation('en')->name) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#E6D1A2]"
                            required>
                        @if ($errors->has('en_name'))
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('en_name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="en_description" class="block text-sm font-medium text-gray-700 mb-2">Mô tả</label>
                        <textarea name="en_description" id="en_description" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#E6D1A2]"
                            required>{{ old('en_description', $setting->translation('en')->description) }}</textarea>
                        @if ($errors->has('en_description'))
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('en_description') }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-[#E6D1A2] text-white px-6 py-2 rounded-md hover:bg-[#d4c091] transition-colors">
                    <i class="fas fa-save mr-2"></i>Lưu thay đổi
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Preview image
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.createElement('img');
                preview.src = e.target.result;
                preview.className = 'mt-2 h-32 w-32 object-cover rounded';
                const container = document.getElementById('image').parentElement;
                let existingPreview = container.querySelector('img');
                if(e.target.result) {
                    if (existingPreview) {
                        existingPreview.src = e.target.result;
                    } else {
                         existingPreview = document.createElement('img');
                         existingPreview.src = e.target.result;
                         existingPreview.className = 'h-32 w-32 object-cover rounded mb-2';
                         container.insertBefore(existingPreview, document.getElementById('image'));
                    }
                }
            }
            reader.readAsDataURL(file);
        }
    });

    @if ($setting->key !== 'logo')
    // CKEditor 4 cho description tiếng Việt
    CKEDITOR.replace('vi_description', {
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
        height: 300,
        language: 'vi',
        extraPlugins: 'customupload',
        filebrowserUploadUrl: '{{ route('admin.upload.image') }}',
        filebrowserUploadMethod: 'form'
    });

    // CKEditor 4 cho description tiếng Anh
    CKEDITOR.replace('en_description', {
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
        height: 300,
        language: 'en',
        extraPlugins: 'customupload',
        filebrowserUploadUrl: '{{ route('admin.upload.image') }}',
        filebrowserUploadMethod: 'form'
    });
    @endif
</script>
@endpush
@endsection 