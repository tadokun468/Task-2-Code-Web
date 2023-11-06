<!DOCTYPE html>
<html>
<head>
    <title>Task 2 - Code Web</title>
    <h1>Upload and Read File</h1>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <!-- Form cho việc tải lên file -->
        <input type="file" name="fileToUpload"> <!-- Input cho việc chọn tệp tin -->
        <input type="submit" name="upload" value="Upload and Read"> <!-- Nút tải lên -->
    </form>

    <?php
    if(isset($_POST['upload'])){
        // Kiểm tra xem nút "Upload and Read" đã được nhấn

        if(isset($_FILES['fileToUpload'])){
            // Kiểm tra xem $_FILES có tồn tại

            $file = $_FILES['fileToUpload'];
            $file_path = $file['tmp_name'];
            // Lấy thông tin về file tải lên và đường dẫn tạm thời

            if(file_exists($file_path)){
                // Kiểm tra xem file tải lên có tồn tại

                $file_content = file_get_contents($file_path);
                // Đọc nội dung của file tải lên

                echo "Dữ liệu từ tệp tin tải lên:<br>";
                echo $file_content;
                // Hiển thị nội dung của tệp tin
            } else {
                echo "Không thể đọc tệp tin tải lên.";
                // Thông báo nếu không thể đọc file tải lên
            }
        }
    }
    ?>
</body>
</html>
