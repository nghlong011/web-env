@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Quản lý tin tức</h1>
        <a href="{{ route('admin.news.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Thêm tin tức mới
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Form lọc -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <form action="{{ route('admin.news.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Trạng thái</label>
                <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Tất cả</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Ẩn</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Danh mục</label>
                <select name="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Tất cả</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ __('new.category.' . $category) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Từ ngày</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Đến ngày</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div class="md:col-span-4 flex justify-end space-x-2">
                <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Lọc
                </button>
                <a href="{{ route('admin.news.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Xóa bộ lọc
                </a>
            </div>
        </form>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hình ảnh</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tiêu đề</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thứ tự</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Danh mục</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày đăng</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($news as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($item->image)
                            <img src="{{ asset($item->image) }}" alt="{{ $item->translations->where('locale', app()->getLocale())->first()->title ?? $item->translations->first()->title }}" 
                                 class="h-16 w-16 object-cover rounded-lg shadow-sm">
                        @else
                            <div class="h-16 w-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $item->translations->where('locale', app()->getLocale())->first()->title ?? $item->translations->first()->title }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="number" class="quick-edit-order w-20 px-2 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ $item->order }}" data-id="{{ $item->id }}" data-original="{{ $item->order }}">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ __('new.category.' . $item->category) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="date" class="quick-edit-date px-2 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ $item->date->format('Y-m-d') }}" data-id="{{ $item->id }}" data-original="{{ $item->date->format('Y-m-d') }}">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $item->status ? 'Hiển thị' : 'Ẩn' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.news.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Sửa</a>
                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn text-red-600 hover:text-red-900"
                                data-confirm="Bạn có chắc chắn muốn xóa tin tức này?">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $news->links() }}
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý quick edit cho order
    document.querySelectorAll('.quick-edit-order').forEach(function(input) {
        input.addEventListener('change', function() {
            saveQuickEdit(input, 'order');
        });
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                saveQuickEdit(input, 'order');
                input.blur();
            } else if (e.key === 'Escape') {
                input.value = input.dataset.original;
                input.blur();
            }
        });
    });
    // Xử lý quick edit cho date
    document.querySelectorAll('.quick-edit-date').forEach(function(input) {
        input.addEventListener('change', function() {
            saveQuickEdit(input, 'date');
        });
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                saveQuickEdit(input, 'date');
                input.blur();
            } else if (e.key === 'Escape') {
                input.value = input.dataset.original;
                input.blur();
            }
        });
    });
    function saveQuickEdit(input, field) {
        const id = input.dataset.id;
        const value = input.value;
        const original = input.dataset.original;
        if (value === original) return;
        fetch(`/admin/news/${id}/quick-update`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                field: field,
                value: value
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                input.dataset.original = value;
                showNotification('Cập nhật thành công!', 'success');
            } else {
                showNotification('Có lỗi xảy ra!', 'error');
            }
        })
        .catch(error => {
            showNotification('Có lỗi xảy ra!', 'error');
        });
    }
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