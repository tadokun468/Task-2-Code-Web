<?php 
    require 'components/header.php';

    // Hiển thị tiêu đề danh sách người dùng
    echo "<h1>Danh sách về người dùng</h1> <br>";

    // Truy vấn SQL để lấy thông tin về người dùng từ cơ sở dữ liệu
    $sql = "SELECT username , password from dangki;";

    // Kiểm tra xem đã thiết lập kết nối đến cơ sở dữ liệu hay chưa
    if($connection != null) {
        try {
            // Chuẩn bị câu lệnh SQL
            $statement = $connection->prepare($sql);
            $statement->execute();

            // Thiết lập chế độ trả về dữ liệu dưới dạng mảng kết hợp (associative array)
            $result = $statement->setFetchMode(PDO::FETCH_ASSOC);

            // Lấy danh sách người dùng
            $Users = $statement->fetchAll();

            // Bắt đầu danh sách người dùng
            echo '<ul class="list-group">';
            foreach($Users as $a_user) {
                $name = $a_user['username'] ?? '';
                $pass = $a_user['password'] ?? '';

                // Hiển thị thông tin người dùng trong danh sách
                echo "<li class='list-group-item'>";
                echo "<p>Username: $name </p>";
                echo "<p>Password: $pass</p>";
                echo "</li>";
            }
            // Kết thúc danh sách người dùng
            echo '</ul>';
        }catch (PDOException $e) {
            // Xử lý lỗi nếu không thể truy vấn dữ liệu
            echo "Cannot query data. Error: " . $e->getMessage();
        }
    }
?>
