@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Quản lý thông tin chung</h1>
    </div>

    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="{{ route('admin.settings.group', 0) }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Trang chủ</h5>
                <p class="font-normal text-gray-700">Các cài đặt cho trang chủ.</p>
            </a>
            <a href="{{ route('admin.settings.group', 1) }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Trang giới thiệu</h5>
                <p class="font-normal text-gray-700">Các cài đặt cho trang giới thiệu.</p>
            </a>
            <a href="{{ route('admin.settings.group', 2) }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Thông tin chung</h5>
                <p class="font-normal text-gray-700">Các cài đặt chung của trang web.</p>
            </a>
        </div>
    </div>
</div>
@endsection 