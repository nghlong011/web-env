@extends('layouts.admin')

@section('title', 'Quản lý hình ảnh')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Quản lý hình ảnh</h1>
        <a href="{{ route('admin.gallery.create') }}" class="bg-[#E6D1A2] text-white px-4 py-2 rounded-lg hover:bg-[#D4B97A] transition duration-200">
            Thêm hình ảnh mới
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Form lọc -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <form action="{{ route('admin.gallery.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tìm kiếm</label>
                <input type="text" name="search" value="{{ request('search') }}" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200"
                    placeholder="Nhập tiêu đề...">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Danh mục</label>
                <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                    <option value="">Tất cả</option>
                    <option value="1" {{ request('category') == '1' ? 'selected' : '' }}>Hình ảnh</option>
                    <option value="2" {{ request('category') == '2' ? 'selected' : '' }}>Video</option>
                    <option value="3" {{ request('category') == '3' ? 'selected' : '' }}>Tài liệu</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Trạng thái</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                    <option value="">Tất cả</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Ẩn</option>
                </select>
            </div>

            <div class="flex items-end">
                <button type="submit" class="bg-[#E6D1A2] text-white px-6 py-2 rounded-lg hover:bg-[#D4B97A] transition duration-200">
                    Lọc
                </button>
                <a href="{{ route('admin.gallery.index') }}" class="ml-2 bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-200">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hình ảnh</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tiêu đề (VI)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tiêu đề (EN)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Danh mục</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thứ tự</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($galleries as $gallery)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->translations->where('locale', 'vi')->first()->title ?? '' }}" class="h-20 w-20 object-cover rounded">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $gallery->translations->where('locale', 'vi')->first()->title ?? '' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $gallery->translations->where('locale', 'en')->first()->title ?? '' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($gallery->category == 1)
                                Hình ảnh
                            @elseif($gallery->category == 2)
                                Video
                            @else
                                Tài liệu
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $gallery->order }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $gallery->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $gallery->status ? 'Hiển thị' : 'Ẩn' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.gallery.edit', $gallery) }}" class="text-[#E6D1A2] hover:text-[#D4B97A] mr-3">Sửa</a>
                            <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn text-red-600 hover:text-red-900"
                                    data-confirm="Bạn có chắc chắn muốn xóa hình ảnh này?">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $galleries->links() }}
    </div>
</div>
@endsection 