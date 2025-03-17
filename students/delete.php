<?php
include "../database/db_connect.php";
$maSV = $_GET['id'];
$conn->query("DELETE FROM SinhVien WHERE MaSV='$maSV'");
header("Location: index.php");
?>

