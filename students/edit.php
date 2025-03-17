<?php
include "../database/db_connect.php";
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM SinhVien WHERE MaSV='$id'");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hoTen = $_POST['HoTen'];
    $gioiTinh = $_POST['GioiTinh'];
    $ngaySinh = $_POST['NgaySinh'];

    $sql = "UPDATE SinhVien SET HoTen='$hoTen', GioiTinh='$gioiTinh', NgaySinh='$ngaySinh' WHERE MaSV='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Cập nhật thành công!";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
<form method="post">
    Họ Tên: <input type="text" name="HoTen" value="<?= $row['HoTen'] ?>"><br>
    Giới Tính: <input type="text" name="GioiTinh" value="<?= $row['GioiTinh'] ?>"><br>
    Ngày Sinh: <input type="date" name="NgaySinh" value="<?= $row['NgaySinh'] ?>"><br>
    <input type="submit" value="Cập nhật">
</form>
