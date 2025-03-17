<?php
session_start();
include "../database/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maSV = $_POST['MaSV'];

    $sql = "SELECT * FROM SinhVien WHERE MaSV='$maSV'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['MaSV'] = $maSV;
        header("Location: ../index.php");
        exit();
    } else {
        $error = "Mã sinh viên không hợp lệ!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Test1</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/DangKyHocPhan/students/index.php">Sinh Viên</a></li>
                    <li class="nav-item"><a class="nav-link" href="/DangKyHocPhan/courses/index.php">Học Phần</a></li>
                    <li class="nav-item"><a class="nav-link" href="/DangKyHocPhan/registration/index.php">Đăng Ký</a></li>
                    <li class="nav-item"><a class="nav-link" href="/DangKyHocPhan/auth/login.php">Đăng Nhập</a></li>
                    <li class="nav-item"><a class="nav-link" href="/DangKyHocPhan/students/create.php">Thêm Sinh Viên</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center">ĐĂNG NHẬP</h2>

        <?php if(isset($error)) { ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php } ?>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Mã SV</label>
                <input type="text" name="MaSV" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Đăng Nhập</button>
        </form>

        <br>
        <a href="../students/index.php">Back to List</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
