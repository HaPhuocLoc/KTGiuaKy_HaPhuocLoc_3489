<?php
session_start();
include "../database/db_connect.php";

if (!isset($_SESSION['MaSV'])) {
    echo "Vui lòng đăng nhập!";
    exit();
}

$maSV = $_SESSION['MaSV'];
$maHP = $_GET['maHP'];

$sql = "DELETE FROM ChiTietDangKy 
        WHERE MaHP = '$maHP' 
        AND MaDK IN (SELECT MaDK FROM DangKy WHERE MaSV = '$maSV')";

if ($conn->query($sql) === TRUE) {
    echo "Xóa học phần thành công!";
    header("Location: index.php");
} else {
    echo "Lỗi: " . $conn->error;
}
?>
