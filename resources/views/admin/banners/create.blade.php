@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Thêm banner mới</h1>
            <a href="{{ route('admin.banners.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Quay lại
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Thông tin chung</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="img" class="block text-sm font-medium text-gray-700 mb-2">Hình ảnh* (Tỷ lệ phù hợp 22:9)</label>
                            <input type="file" name="img" id="img" accept="image/*"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#E6D1A2]">
                            @error('img')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="link" class="block text-sm font-medium text-gray-700 mb-2">Đường dẫn</label>
                            <input type="text" name="link" id="link" value="{{ old('link') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#E6D1A2]">
                            @error('link')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Thứ tự</label>
                            <input type="number" name="order" id="order" value="{{ old('order') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#E6D1A2]">
                            @error('order')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
                            <div class="flex items-center">
                                <input type="checkbox" name="active" id="active" value="1" checked
                                    class="h-4 w-4 text-[#E6D1A2] focus:ring-[#E6D1A2] border-gray-300 rounded">
                                <label for="active" class="ml-2 block text-sm text-gray-900">Hiển thị</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-[#E6D1A2] text-white px-6 py-2 rounded-md hover:bg-[#d4c091] transition-colors">
                        <i class="fas fa-save mr-2"></i>Lưu
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            // Preview hình ảnh
            document.getElementById('img').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.createElement('img');
                        preview.src = e.target.result;
                        preview.className = 'mt-2 h-32 w-48 object-cover rounded';
                        const container = document.getElementById('img').parentElement;
                        const existingPreview = container.querySelector('img');
                        if (existingPreview) {
                            container.removeChild(existingPreview);
                        }
                        container.appendChild(preview);
                    }
                    reader.readAsDataURL(file);
                }
            });
        </script>
    @endpush
@endsection
