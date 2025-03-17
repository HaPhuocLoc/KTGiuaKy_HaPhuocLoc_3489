<?php
include "../database/db_connect.php";

if (!isset($_GET['id'])) {
    echo "Không tìm thấy sinh viên!";
    exit();
}

$maSV = $_GET['id'];
$sql = "SELECT SinhVien.*, NganhHoc.TenNganh FROM SinhVien 
        JOIN NganhHoc ON SinhVien.MaNganh = NganhHoc.MaNganh 
        WHERE MaSV = '$maSV'";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Sinh viên không tồn tại!";
    exit();
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chi tiết Sinh Viên</title>
</head>
<body>
    <h2>Thông tin chi tiết sinh viên</h2>
    <p><strong>Mã SV:</strong> <?= $row['MaSV'] ?></p>
    <p><strong>Họ và Tên:</strong> <?= $row['HoTen'] ?></p>
    <p><strong>Giới Tính:</strong> <?= $row['GioiTinh'] ?></p>
    <p><strong>Ngày Sinh:</strong> <?= $row['NgaySinh'] ?></p>
    <p><strong>Ngành Học:</strong> <?= $row['TenNganh'] ?></p>
    <p><strong>Ảnh:</strong></p>
    <img src="<?= $row['Hinh'] ?>" width="150px" alt="Hình Sinh Viên">

    <br><br>
    <a href="index.php">Quay lại danh sách</a>
</body>
</html>
