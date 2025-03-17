<?php
session_start();
include "../database/db_connect.php";

// Kiểm tra nếu có POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maSV = $_SESSION['MaSV'] ?? null;
    $maHP = $_POST['MaHP'] ?? null;

    if (!$maSV || !$maHP) {
        die("Lỗi: Không có thông tin sinh viên hoặc học phần.");
    }

    // Kiểm tra xem sinh viên đã đăng ký học phần này chưa
    $check_sql = "SELECT * FROM ChiTietDangKy WHERE MaDK = (SELECT MaDK FROM DangKy WHERE MaSV = ?) AND MaHP = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ss", $maSV, $maHP);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Bạn đã đăng ký học phần này rồi!'); window.location.href='/DangKyHocPhan/index.php';</script>";
        exit();
    }

    // Nếu chưa đăng ký, thêm vào bảng DangKy và ChiTietDangKy
    $insert_sql = "INSERT INTO DangKy (MaSV, NgayDK) VALUES (?, NOW())";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("s", $maSV);
    $stmt->execute();

    $maDK = $conn->insert_id; // Lấy ID của dòng vừa thêm

    $insert_detail_sql = "INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES (?, ?)";
    $stmt = $conn->prepare($insert_detail_sql);
    $stmt->bind_param("is", $maDK, $maHP);
    $stmt->execute();

    echo "<script>alert('Đăng ký học phần thành công!'); window.location.href='/DangKyHocPhan/index.php';</script>";
} else {
    echo "Lỗi: Yêu cầu không hợp lệ.";
}
?>
