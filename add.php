<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ma_nv = $_POST["Ma_NV"];
    $ten_nv = $_POST["Ten_NV"];
    $phai = $_POST["Phai"];
    $noi_sinh = $_POST["Noi_Sinh"];
    $ma_phong = $_POST["Ma_Phong"];
    $luong = $_POST["Luong"];

    $sql = "INSERT INTO nhanvien (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong)
            VALUES ('$ma_nv', '$ten_nv', '$phai', '$noi_sinh', '$ma_phong', '$luong')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<form method="POST">
    <input type="text" name="Ma_NV" placeholder="Mã nhân viên" required>
    <input type="text" name="Ten_NV" placeholder="Tên nhân viên" required>
    <select name="Phai">
        <option value="NAM">Nam</option>
        <option value="NU">Nữ</option>
    </select>
    <input type="text" name="Noi_Sinh" placeholder="Nơi sinh" required>
    <input type="text" name="Ma_Phong" placeholder="Mã phòng" required>
    <input type="number" name="Luong" placeholder="Lương" required>
    <button type="submit">Thêm Nhân Viên</button>
</form>
