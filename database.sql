-- Tạo bảng "dangki" để lưu trữ thông tin đăng ký người dùng
CREATE TABLE dangki (
    id INTEGER PRIMARY KEY AUTO_INCREMENT, 
    
    username VARCHAR(100) NOT NULL, 

    password VARCHAR(100) NOT NULL, 
   
    date DATETIME
   
);
