<?php
$host = "localhost";
$user = "root"; // Mặc định của XAMPP
$pass = ""; // Nếu có mật khẩu MySQL thì nhập vào đây
$dbname = "ql-nhansu";

// Kết nối
$conn = new mysqli($host, $user, $pass, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Số nhân viên trên mỗi trang
$limit = 5;

// Xác định trang hiện tại (nếu không có, mặc định là trang 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Lấy dữ liệu nhân viên theo trang
$sql = "SELECT * FROM nhanvien LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);

// Đếm tổng số nhân viên
$total_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM nhanvien");
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];

// Tính tổng số trang
$total_pages = ceil($total_records / $limit);
?>
<?php
include 'db.php'; // Kết nối database

$username = 'admin';
$password = password_hash('123456', PASSWORD_DEFAULT); // Mã hóa mật khẩu
$email = 'admin@example.com';
$role = 'admin';

$sql = "INSERT INTO users (username, password, email, role) VALUES ('$username', '$password', '$email', '$role')";

if ($conn->query($sql) === TRUE) {
    echo "Tài khoản admin đã được tạo!";
} else {
    echo "Lỗi: " . $conn->error;
}
?>

?>
