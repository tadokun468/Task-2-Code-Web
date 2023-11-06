<?php  
    require 'components/header.php';

    // Kiểm tra xem người dùng đã nhấn nút "Submit" trên biểu mẫu
    if(isset($_POST['submit'])){
        // Mảng chứa các phần mở rộng file hợp lệ
        $permitted_extentions = ['png', 'jpg', 'jpeg', 'gif'];
        
        // Lấy tên tệp từ biểu mẫu
        $file_name = $_FILES['upload']['name'];

        // Kiểm tra xem người dùng đã chọn một tệp ảnh hay chưa
        if(!empty($_FILES['upload']['name'])){
       
            // Lấy kích thước tệp
            $file_size = $_FILES['upload']['size'];
            
            // Lấy đường dẫn tạm thời của tệp
            $file_tmp_name = $_FILES['upload']['tmp_name'];

            // Tạo tên tệp mới với thời gian và tên gốc
            $generated_file_name = time().'-'.$file_name; 
            
            // Đường dẫn đến thư mục lưu trữ tệp ảnh
            $destination_path = "images/${generated_file_name}";

            // Lấy phần mở rộng của tệp
            $file_extentions = explode('.', $file_name);
            $file_extentions = strtolower(end($file_extentions));

            // Kiểm tra phần mở rộng của tệp có trong danh sách phần mở rộng hợp lệ
            if(in_array($file_extentions, $permitted_extentions)){
                if($file_size <= 1000000){
                    // Tệp hợp lệ, cắt và dán vào thư mục lưu trữ
                    move_uploaded_file($file_tmp_name, $destination_path);
                    $message = '<p style="color:green";>Ảnh đã được thêm vào trang cá nhân</p>';
                }
                else{
                    $message = '<p style="color:red;">File quá lớn</p>';
                }
            }
            else{
                $message = '<p style="color:red;">Định dạng file không hợp lệ</p>';
            }
        }
        else{
            $message = '<p style="color:red;">Chưa có file nào được chọn, vui lòng thử lại</p>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang cá nhân</title>
</head>
<body>
    <h1>Đăng nhập thành công !! <br> Thêm ảnh vào trang cá nhân</h1>

    <!-- Biểu mẫu để người dùng chọn và tải lên tệp ảnh -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        Mời bạn chọn ảnh
        <input type="file" name="upload"> <br>
        <input type="submit" value="Submit" name="submit">   
    </form>

    <?php echo $message ?? '' ; ?>
</body>
</html>
<?php include 'components/footer.php'; ?>
