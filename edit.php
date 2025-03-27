<?php
include 'db.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM nhanvien WHERE Ma_NV='$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ten_nv = $_POST["Ten_NV"];
    $phai = $_POST["Phai"];
    $noi_sinh = $_POST["Noi_Sinh"];
    $ma_phong = $_POST["Ma_Phong"];
    $luong = $_POST["Luong"];

    $sql = "UPDATE nhanvien SET Ten_NV='$ten_nv', Phai='$phai', Noi_Sinh='$noi_sinh',
            Ma_Phong='$ma_phong', Luong='$luong' WHERE Ma_NV='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
<h2>Sửa Nhân Viên</h2>
<form method="POST">
    <input type="text" name="Ten_NV" value="<?= $row['Ten_NV'] ?>" required>
    <select name="Phai">
        <option value="NAM" <?= ($row['Phai'] == 'NAM') ? 'selected' : '' ?>>Nam</option>
        <option value="NU" <?= ($row['Phai'] == 'NU') ? 'selected' : '' ?>>Nữ</option>
    </select>
    <input type="text" name="Noi_Sinh" value="<?= $row['Noi_Sinh'] ?>" required>
    <input type="text" name="Ma_Phong" value="<?= $row['Ma_Phong'] ?>" required>
    <input type="number" name="Luong" value="<?= $row['Luong'] ?>" required>
    <button type="submit">Cập Nhật</button>
</form>
<a href="index.php">🔙 Quay lại</a>