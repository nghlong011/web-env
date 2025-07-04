@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Quản lý tài khoản</h1>
    </div>

    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    @if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('admin.users.update-password') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Đổi mật khẩu</h2>
                
                <div class="mb-4">
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu hiện tại</label>
                    <input type="password" name="current_password" id="current_password" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu mới</label>
                    <input type="password" name="new_password" id="new_password" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                    @error('new_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <div class="mt-2 text-sm text-gray-600">
                        <p class="font-medium mb-1">Mật khẩu phải đáp ứng các yêu cầu sau:</p>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Ít nhất 8 ký tự</li>
                            <li>Chứa cả chữ hoa và chữ thường</li>
                            <li>Chứa ít nhất một số</li>
                            <li>Chứa ít nhất một ký tự đặc biệt</li>
                        </ul>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Xác nhận mật khẩu mới</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E6D1A2] focus:border-[#E6D1A2] outline-none transition duration-200">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-[#E6D1A2] text-white px-4 py-2 rounded-md hover:bg-[#D4B87F] transition-colors">
                        Cập nhật mật khẩu
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection 