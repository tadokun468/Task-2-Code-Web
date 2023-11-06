<?php
// PDO - PHP Data Object
// Đây là một đoạn mã PHP sử dụng PDO (PHP Data Object) để kết nối đến cơ sở dữ liệu MySQL.

// Định nghĩa các hằng số cho thông tin kết nối đến cơ sở dữ liệu
define('DATABASE_SERVER', 'localhost');
define('DATABASE_USER', 'root');
define('DATABASE_PASSWORD', '468321');
define('DATABASE_NAME', 'phpapp');

// Khởi tạo biến kết nối
$connection = null;

try {
    // Thử kết nối đến cơ sở dữ liệu bằng PDO
    $connection = new PDO(
        "mysql:host=" . DATABASE_SERVER . ";dbname=" . DATABASE_NAME,
        DATABASE_USER, DATABASE_PASSWORD
    );

    // Thiết lập chế độ xử lý lỗi cho PDO để ném ra các ngoại lệ (exceptions) khi có lỗi
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Hiển thị thông báo khi kết nối thành công
    echo "Connected successfully";
} catch (PDOException $e) {
    // Xử lý ngoại lệ nếu kết nối thất bại và hiển thị thông báo lỗi
    echo "Connection failed: " . $e->getMessage();

    // Đặt lại biến kết nối thành null
    $connection = null;
}
