@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Thống kê tin tức -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-500 bg-opacity-10">
                        <i class="fas fa-newspaper text-blue-500 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500">Tổng số tin tức</p>
                        <p class="text-2xl font-semibold">{{ $totalNews }}</p>
                    </div>
                </div>
            </div>

            <!-- Thống kê người dùng -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-500 bg-opacity-10">
                        <i class="fas fa-users text-green-500 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500">Tổng số người dùng</p>
                        <p class="text-2xl font-semibold">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>

            <!-- Thống kê khác -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-500 bg-opacity-10">
                        <i class="fas fa-chart-line text-purple-500 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500">Lượt truy cập hôm nay</p>
                        <p class="text-2xl font-semibold">0</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tin tức mới nhất -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">Tin tức mới nhất</h2>
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tiêu đề</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày đăng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($latestNews as $news)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $news->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $news->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Đã đăng
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
