<?php
include 'db.php'; // Kết nối database

// Thiết lập số nhân viên trên mỗi trang
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Lấy tổng số nhân viên
$totalQuery = "SELECT COUNT(*) AS total FROM nhanvien";
$totalResult = $conn->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$totalRecords = $totalRow['total'];
$totalPages = ceil($totalRecords / $limit);

// Lấy danh sách nhân viên với phân trang
$sql = "SELECT nhanvien.*, phongban.Ten_Phong FROM nhanvien
        JOIN phongban ON nhanvien.Ma_Phong = phongban.Ma_Phong
        LIMIT $start, $limit";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách Nhân Viên</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        table { width: 80%; margin: 20px auto; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid black; text-align: center; }
        th { background-color: #f4f4f4; }
        .action-links a { margin: 0 5px; text-decoration: none; font-size: 18px; }
        .add-btn { display: block; margin: 20px auto; padding: 10px; background: green; color: white; text-decoration: none; width: 150px; text-align: center; border-radius: 5px; }
        .delete-btn { color: red; }
        .edit-btn { color: blue; }
        .pagination { margin: 20px auto; }
        .pagination a { text-decoration: none; padding: 8px 12px; border: 1px solid #ddd; margin: 2px; }
        .pagination a.active { background: #007bff; color: white; border: 1px solid #007bff; }
        .pagination a:hover { background: #ddd; }
        .gender-icon { width: 30px; height: 30px; }
    </style>
</head>
<body>
    <h2>THÔNG TIN NHÂN VIÊN</h2>
    <table>
        <tr>
            <th>Mã Nhân Viên</th>
            <th>Tên Nhân Viên</th>
            <th>Giới tính</th>
            <th>Nơi Sinh</th>
            <th>Phòng Ban</th>
            <th>Lương</th>
            <th>Hành động</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['Ma_NV'] ?></td>
            <td><?= $row['Ten_NV'] ?></td>
            <td>
            <img src="Gender/<?= ($row['Phai'] == 'NU') ? 'woman.jpg' : 'man.jpg' ?>" class="gender-icon" width="30px" height="30px" alt="<?= ($row['Phai'] == 'NU') ? 'Nữ' : 'Nam' ?>"
            onerror="this.onerror=null; this.src='Gender/default.jpg';">
           
            </td>
            <td><?= $row['Noi_Sinh'] ?></td>
            <td><?= $row['Ten_Phong'] ?></td>
            <td><?= number_format($row['Luong']) ?> VND</td>
            <td class="action-links">
                <a href="edit.php?id=<?= $row['Ma_NV'] ?>" class="edit-btn">✏️ Sửa</a>
                <a href="delete.php?id=<?= $row['Ma_NV'] ?>" class="delete-btn" onclick="return confirm('Bạn có chắc muốn xóa nhân viên này?')">🗑️ Xóa</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>">« Prev</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?= $page + 1 ?>">Next »</a>
        <?php endif; ?>
    </div>

    <a href="add.php" class="add-btn">➕ Thêm Nhân Viên</a>
</body>
</html>
