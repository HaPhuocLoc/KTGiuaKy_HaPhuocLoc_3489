<?php
session_start();
include "../database/db_connect.php";

if (!isset($_SESSION['MaSV'])) {
    echo "Vui lòng đăng nhập!";
    exit();
}

$maSV = $_SESSION['MaSV'];
$maHP = $_POST['MaHP'];

// Kiểm tra số lượng còn lại
$sql_check = "SELECT SoLuongDuKien FROM HocPhan WHERE MaHP='$maHP'";
$result = $conn->query($sql_check);
$row = $result->fetch_assoc();

if ($row['SoLuongDuKien'] > 0) {
    // Thêm vào bảng DangKy nếu chưa có
    $sql_dangky = "INSERT INTO DangKy (NgayDK, MaSV) VALUES (NOW(), '$maSV')";
    $conn->query($sql_dangky);
    $maDK = $conn->insert_id;

    // Thêm vào bảng ChiTietDangKy
    $sql_chitiet = "INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES ('$maDK', '$maHP')";
    $sql_update_soluong = "UPDATE HocPhan SET SoLuongDuKien = SoLuongDuKien - 1 WHERE MaHP='$maHP'";

    if ($conn->query($sql_chitiet) === TRUE && $conn->query($sql_update_soluong) === TRUE) {
        echo "Đăng ký thành công! Số lượng sinh viên còn lại: " . ($row['SoLuongDuKien'] - 1);
        header("Location: index.php");
    } else {
        echo "Lỗi: " . $conn->error;
    }
} else {
    echo "Học phần này đã đầy, không thể đăng ký!";
}
?>


