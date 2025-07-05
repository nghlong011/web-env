@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Quản lý đối tác</h1>
        <a href="{{ route('admin.partners.create') }}"
            class="bg-[#E6D1A2] text-white px-4 py-2 rounded-md hover:bg-[#d4c091] transition-colors">
            <i class="fas fa-plus mr-2"></i>Thêm đối tác mới
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Logo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thứ tự</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($partners as $partner)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if ($partner->logo)
                        <img src="{{ asset($partner->logo) }}" alt="{{ $partner->translation()?->name ?? 'Partner' }}"
                            class="h-16 w-16 object-contain">
                        @else
                        <span class="text-gray-400">Không có logo</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $partner->sort_order }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $partner->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $partner->status ? 'Hiển thị' : 'Ẩn' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.partners.edit', $partner) }}"
                            class="text-[#E6D1A2] hover:text-[#d4c091] mr-3">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn text-red-600 hover:text-red-900"
                                data-confirm="Bạn có chắc chắn muốn xóa đối tác này?">
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
@endsection 