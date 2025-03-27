<?php
include 'db.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM nhanvien WHERE Ma_NV='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
