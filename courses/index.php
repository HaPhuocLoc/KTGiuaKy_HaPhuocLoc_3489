<?php
include __DIR__ . "/../database/db_connect.php"; // Đảm bảo đường dẫn đúng


// Lấy danh sách học phần từ database
$sql = "SELECT * FROM HocPhan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Học Phần</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #343a40;
            font-weight: bold;
        }
    </style>
</head>
<body>

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
        <div class="table-container">
            <h2 class="text-center">📚 Danh Sách Học Phần</h2>

            <table class="table table-hover table-bordered">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Mã HP</th>
                        <th>Tên HP</th>
                        <th>Số tín chỉ</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['MaHP']) ?></td>
                        <td><?= htmlspecialchars($row['TenHP']) ?></td>
                        <td><?= htmlspecialchars($row['SoTinChi']) ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
