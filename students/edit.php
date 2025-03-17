<?php
include "../database/db_connect.php";

$maSV = $_GET['id'] ?? null;
if (!$maSV) die("Lỗi: Không tìm thấy mã sinh viên.");

$sql = "SELECT * FROM SinhVien WHERE MaSV = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $maSV);
$stmt->execute();
$result = $stmt->get_result();
$sinhVien = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hoTen = $_POST['HoTen'];
    $gioiTinh = $_POST['GioiTinh'];
    $ngaySinh = $_POST['NgaySinh'];
    $maNganh = $_POST['MaNganh'];

    $hinh = $sinhVien['Hinh'];
    if (!empty($_FILES['Hinh']['name'])) {
        $target_dir = __DIR__ . "/../uploads/";
        $file_name = time() . "_" . basename($_FILES["Hinh"]["name"]);
        $target_file = $target_dir . $file_name;
        move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file);
        $hinh = "uploads/" . $file_name;
    }

    $sql = "UPDATE SinhVien SET HoTen=?, GioiTinh=?, NgaySinh=?, Hinh=?, MaNganh=? WHERE MaSV=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh, $maSV);

    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật thành công!'); window.location.href='index.php';</script>";
    } else {
        echo "Lỗi cập nhật: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh Sửa Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">✏️ Chỉnh Sửa Sinh Viên</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>Họ Tên:</label>
            <input type="text" name="HoTen" class="form-control" value="<?= $sinhVien['HoTen'] ?>" required>
            <label>Giới Tính:</label>
            <select name="GioiTinh" class="form-control">
                <option value="Nam" <?= $sinhVien['GioiTinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
                <option value="Nữ" <?= $sinhVien['GioiTinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
            </select>
            <label>Ngày Sinh:</label>
            <input type="date" name="NgaySinh" class="form-control" value="<?= $sinhVien['NgaySinh'] ?>" required>
            <label>Hình:</label>
            <input type="file" name="Hinh" class="form-control">
            <img src="../<?= $sinhVien['Hinh'] ?>" width="150">
            <label>Ngành:</label>
            <select name="MaNganh" class="form-control">
                <option value="CNTT" <?= $sinhVien['MaNganh'] == 'CNTT' ? 'selected' : '' ?>>CNTT</option>
                <option value="QTKD" <?= $sinhVien['MaNganh'] == 'QTKD' ? 'selected' : '' ?>>QTKD</option>
            </select>
            <button type="submit" class="btn btn-success w-100 mt-3">Lưu</button>
        </form>
    </div>
</body>
</html>
