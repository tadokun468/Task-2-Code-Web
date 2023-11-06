<?php
require 'components/header.php';

// Kiểm tra xem người dùng đã nhấn nút "Đăng nhập" hay "Đăng ký" trên biểu mẫu
if(isset($_POST['login'])){
    // Nếu người dùng nhấn nút "Đăng nhập", chuyển hướng đến trang đăng nhập
    header("Location: login.php");
}
else if(isset($_POST['register'])){
    // Nếu người dùng nhấn nút "Đăng ký", chuyển hướng đến trang đăng ký
    header("Location: register.php");
}

?>

<br><br>

<h1 class="text-center p-3" >Đây là Task2 - Code Web</h1> <br>

<!-- Biểu mẫu HTML cho việc chọn "Đăng ký" hoặc "Đăng nhập" -->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="text-center p-3">
        <input type="submit" name="register" value="Đăng kí" class="btn btn-primary">
    </div>
    <br>
    <div class="text-center p-3">
        <input type="submit" name="login" value="Đăng nhập" class="btn btn-primary">
    </div>
</form>

<?php include 'components/footer.php'; ?>
