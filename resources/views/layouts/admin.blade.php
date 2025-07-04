<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- CKEditor 4 -->
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

    <script>
        // CKEditor 4 Upload Adapter
        CKEDITOR.plugins.add('uploadimage', {
            init: function(editor) {
                editor.addCommand('uploadimage', {
                    exec: function(editor) {
                        var input = document.createElement('input');
                        input.type = 'file';
                        input.accept = 'image/*';
                        input.onchange = function() {
                            var file = this.files[0];
                            if (file) {
                                var formData = new FormData();
                                formData.append('upload', file);
                                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

                                var xhr = new XMLHttpRequest();
                                xhr.open('POST', '{{ route('admin.upload.image') }}', true);
                                xhr.onload = function() {
                                    if (xhr.status === 200) {
                                        var response = JSON.parse(xhr.responseText);
                                        if (response.url) {
                                            editor.insertHtml('<img src="' + response.url + '" alt="' + file.name + '" style="max-width:100%;">');
                                        }
                                    }
                                };
                                xhr.send(formData);
                            }
                        };
                        input.click();
                    }
                });

                editor.ui.addButton('UploadImage', {
                    label: 'Upload Image',
                    command: 'uploadimage',
                    toolbar: 'insert'
                });
            }
        });

        // Cấu hình CKEditor 4 cho file upload
        CKEDITOR.editorConfig = function(config) {
            config.filebrowserUploadUrl = '{{ route('admin.upload.image') }}';
            config.filebrowserUploadMethod = 'form';
            config.extraAllowedContent = 'img[width,height,align]';
        };
    </script>
    <style>
        .cke_editor {
            min-height: 300px;
        }
    </style>
    @stack('styles')
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div
            class="bg-gray-800 text-white w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out">
            <a href="#" class="text-white flex items-center space-x-2 px-4">
                <i class="fas fa-home text-2xl"></i>
                <span class="text-2xl font-extrabold">Admin Panel</span>
            </a>
            <nav>
                <a href="{{ route('admin.dashboard') }}"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                </a>
                <a href="{{ route('admin.settings.index') }}"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    <i class="fas fa-cog mr-2"></i>Quản lý trang
                </a>
                <a href="{{ route('admin.partners.index') }}"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    <i class="fas fa-handshake mr-2"></i>Quản lý đối tác
                </a>
                <a href="{{ route('admin.contacts.index') }}"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    <i class="fas fa-envelope mr-2"></i>Quản lý liên hệ
                </a>
                <a href="{{ route('admin.banners.index') }}"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    <i class="fas fa-images mr-2"></i>Quản lý banner
                </a>
                <a href="{{ route('admin.gallery.index') }}"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    <i class="fas fa-photo-video mr-2"></i>Quản lý thư viện
                </a>
                <a href="{{ route('admin.news.index') }}"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    <i class="fas fa-newspaper mr-2"></i>Quản lý tin tức
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    <i class="fas fa-users mr-2"></i>Đổi mật khẩu
                </a>
            </nav>
        </div>

        <!-- Content -->
        <div class="flex-1">
            <!-- Top Navigation -->
            <header class="bg-white shadow-lg">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <button class="text-gray-500 focus:outline-none md:hidden">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                    <div class="flex items-center">
                        <div class="relative">
                            <button class="flex items-center text-gray-500 focus:outline-none"
                                onclick="document.getElementById('logout-form').submit();">
                                <span class="mr-2">{{ Auth::user()->name }}</span>
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.querySelector('.md\\:hidden').addEventListener('click', function() {
            document.querySelector('.bg-gray-800').classList.toggle('-translate-x-full');
        });
    </script>

    @stack('scripts')
</body>

</html>
