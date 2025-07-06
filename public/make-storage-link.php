<?php


// Đường dẫn đến thư mục gốc của Laravel
$laravelRoot = dirname(__DIR__);

// Đường dẫn đến storage/app/public
$storagePath = $laravelRoot . '/storage/app/public';

// Đường dẫn đến public/storage
$publicStoragePath = $laravelRoot . '/public/storage';

echo "<h2>Laravel Storage Link Creator</h2>";

// Kiểm tra xem thư mục storage/app/public có tồn tại không
if (!is_dir($storagePath)) {
    echo "<p style='color: red;'>❌ Thư mục storage/app/public không tồn tại!</p>";
    echo "<p>Đường dẫn: " . $storagePath . "</p>";
    exit;
}

echo "<p>✅ Thư mục storage/app/public tồn tại</p>";

// Kiểm tra xem symbolic link đã tồn tại chưa
if (is_link($publicStoragePath)) {
    echo "<p style='color: orange;'>⚠️ Symbolic link đã tồn tại tại public/storage</p>";
    echo "<p>Đường dẫn hiện tại: " . readlink($publicStoragePath) . "</p>";
    
    // Hỏi người dùng có muốn xóa link cũ không
    if (isset($_GET['force']) && $_GET['force'] === '1') {
        if (unlink($publicStoragePath)) {
            echo "<p>✅ Đã xóa symbolic link cũ</p>";
        } else {
            echo "<p style='color: red;'>❌ Không thể xóa symbolic link cũ</p>";
            exit;
        }
    } else {
        echo "<p>Để tạo lại link, truy cập: <a href='?force=1'>Tạo lại Storage Link</a></p>";
        exit;
    }
}

// Tạo symbolic link
if (symlink($storagePath, $publicStoragePath)) {
    echo "<p style='color: green;'>✅ Đã tạo thành công symbolic link!</p>";
    echo "<p>Storage link: " . $publicStoragePath . " → " . $storagePath . "</p>";
    echo "<p>Bây giờ bạn có thể truy cập các file trong storage/app/public thông qua URL: /storage/</p>";
} else {
    echo "<p style='color: red;'>❌ Không thể tạo symbolic link!</p>";
    echo "<p>Lỗi có thể do:</p>";
    echo "<ul>";
    echo "<li>Quyền truy cập không đủ</li>";
    echo "<li>Hệ điều hành không hỗ trợ symbolic link</li>";
    echo "<li>Đường dẫn không hợp lệ</li>";
    echo "</ul>";
}

echo "<hr>";
echo "<p><strong>Thông tin hệ thống:</strong></p>";
echo "<p>OS: " . PHP_OS . "</p>";
echo "<p>PHP Version: " . PHP_VERSION . "</p>";
echo "<p>Web Server: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') . "</p>";

// Kiểm tra quyền ghi
echo "<p><strong>Kiểm tra quyền:</strong></p>";
echo "<p>Thư mục public có thể ghi: " . (is_writable($laravelRoot . '/public') ? '✅ Có' : '❌ Không') . "</p>";
echo "<p>Thư mục storage có thể ghi: " . (is_writable($laravelRoot . '/storage') ? '✅ Có' : '❌ Không') . "</p>";

?> 