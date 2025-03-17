<?php
include "../database/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maSV = $_POST['MaSV'];
    $hoTen = $_POST['HoTen'];
    $gioiTinh = $_POST['GioiTinh'];
    $ngaySinh = $_POST['NgaySinh'];
    $maNganh = $_POST['MaNganh'];

    // Kiểm tra xem Mã Sinh Viên đã tồn tại chưa
    $check_sql = "SELECT * FROM SinhVien WHERE MaSV = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("s", $maSV);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Lỗi: Mã Sinh Viên đã tồn tại!'); window.history.back();</script>";
        exit();
    }

    // Xử lý upload hình
    $hinh = "uploads/default.jpg"; // Mặc định nếu không có hình
    if (!empty($_FILES['Hinh']['name'])) {
        $target_dir = __DIR__ . "/../uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $file_name = time() . "_" . basename($_FILES["Hinh"]["name"]);
        $target_file = $target_dir . $file_name;
        move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file);
        $hinh = "uploads/" . $file_name;
    }

    // Thêm sinh viên vào database
    $insert_sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("ssssss", $maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh);

    if ($stmt->execute()) {
        echo "<script>alert('Thêm sinh viên thành công!'); window.location.href='index.php';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">➕ Thêm Sinh Viên</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>Mã SV:</label>
            <input type="text" name="MaSV" class="form-control" required>
            <label>Họ Tên:</label>
            <input type="text" name="HoTen" class="form-control" required>
            <label>Giới Tính:</label>
            <select name="GioiTinh" class="form-control">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
            <label>Ngày Sinh:</label>
            <input type="date" name="NgaySinh" class="form-control" required>
            <label>Hình:</label>
            <input type="file" name="Hinh" class="form-control">
            <label>Ngành:</label>
            <select name="MaNganh" class="form-control">
                <option value="CNTT">Công nghệ thông tin</option>
                <option value="QTKD">Quản trị kinh doanh</option>
            </select>
            <button type="submit" class="btn btn-success w-100 mt-3">Lưu</button>
        </form>
    </div>
</body>
</html>
