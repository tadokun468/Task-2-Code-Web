<?php
require 'components/header.php';

// Khai báo biến lưu thông báo lỗi và thông báo thành công
$error;
$message;

// Kiểm tra xem biểu mẫu đăng ký đã được gửi đi
if (isset($_POST['register'])) {
    // Lấy giá trị tên đăng nhập, mật khẩu, và mật khẩu nhập lại từ form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];

    // Kiểm tra xem mật khẩu và mật khẩu nhập lại có khớp nhau
    if ($password !== $password_repeat) {
        $error = "Mật khẩu và mật khẩu nhập lại không khớp! Vui lòng đăng kí lại";
    } else {
        // Đăng ký thành công, gán thông báo thành công và liên kết đến trang đăng nhập
        $message = "Đăng kí tài khoản thành công <br> Bạn có muốn <a href='login.php'>đăng nhập</a> không?";

        // Tiếp tục xử lý đăng ký
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        // Chuẩn bị câu lệnh SQL để thêm người dùng vào cơ sở dữ liệu
        $sql = "INSERT INTO dangki(username, password) VALUES(?, ?)";
        try {
            // Sử dụng prepared statement để thực hiện truy vấn SQL an toàn
            $statement = $connection->prepare($sql);
            $statement->bindParam(1, $username);
            $statement->bindParam(2, $password);
            $statement->execute();
        } catch (PDOException $e) {
            echo "Không thể thêm người dùng vào database" . $e->getMessage();
        }
    }
}
?>

<br><br>

<h1>Vui lòng đăng kí tài khoản</h1> <br>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="mb-3">
        <input name="username" type="text" class="form-control" placeholder="Tên đăng nhập">
    </div>
    <div class="mb-3">
        <input name = "password" type="password" class="form-control" placeholder="Mật khẩu">
    </div>
    <div class="mb-3">
        <input type="password" name="password_repeat" class="form-control" placeholder="Nhập lại mật khẩu">
    </div>
    <div class="mb-3">
        <input type="submit" name="register" value="Đăng kí" class="btn btn-primary">
    </div>

    <!-- Hiển thị thông báo lỗi nếu có -->
    <div style="color: red;"><?php echo $error ?? ''; ?></div>
    
    <!-- Hiển thị thông báo thành công nếu có -->
    <div style="color: green;"><?php  echo $message ?? ''; ?></div>

    <br>
</form>

<script>
    // Xử lý kiểm tra độ dài mật khẩu trước khi gửi biểu mẫu
    document.querySelector('form').addEventListener('submit', function(event) {
        var passwordInput = document.querySelector('input[name="password"]');
        var passwordValue = passwordInput.value;

        if (passwordValue.length < 8) {
            // Tìm phần tử input[name="password"] để hiển thị thông báo lỗi
            var errorElement = document.querySelector('input[name="password"]');
            errorElement.insertAdjacentHTML('afterend', '<div style="color: red;">Mật khẩu phải có ít nhất 8 ký tự.</div>');
            event.preventDefault(); // Ngăn form được gửi nếu mật khẩu không đủ dài
        } else {
            // Xóa thông báo lỗi nếu mật khẩu hợp lệ
            var errorElement = document.querySelector('input[name="password"]');
            var errorDiv = errorElement.nextElementSibling;
            if (errorDiv && errorDiv.style.color === "red") {
                errorDiv.remove();
            }
        }
    });
</script>

<?php include 'components/footer.php'; ?>
