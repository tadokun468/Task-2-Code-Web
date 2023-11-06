<?php
require 'components/header.php';

// Khởi tạo biến lỗi và thông báo
$error = '';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kết nối đến cơ sở dữ liệu MySQL
    $conn = new mysqli("localhost", "root", "468321", "phpapp");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }

    // Truy vấn người dùng dựa trên tên đăng nhập
    $sql = "SELECT * FROM dangki WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra nếu có người dùng với tên đăng nhập tương ứng
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        // So sánh mật khẩu nhập vào với mật khẩu trong cơ sở dữ liệu
        if ($password == $storedPassword) {
            // Đăng nhập thành công, chuyển hướng đến trang upload
            header("Location: upload.php");
        } else {
            // Mật khẩu không khớp
            $error = "Sai mật khẩu!";
        }
    } else {
        // Không tìm thấy tên đăng nhập
        $error = "Không tìm thấy tên đăng nhập.";
    }

    // Đóng kết nối và statement
    $stmt->close();
    $conn->close();
}
?>

<!-- HTML form -->
<br><br>
<h1>Vui lòng đăng nhập tài khoản</h1> <br>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="mb-3">
        <input name="username" type="text" class="form-control" placeholder = "Tên đăng nhập">
    </div>
    <div class="mb-3">
        <input name="password" type="password" class="form-control" placeholder = "Mật khẩu">
    </div>
    <div class="mb-3">
        <input type="submit" name="login" value = "Đăng nhập" class="btn btn-primary">
    </div>
    <div style="color: red;"><?php echo $error; ?></div>
</form>
