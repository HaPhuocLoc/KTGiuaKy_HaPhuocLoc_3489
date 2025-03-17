<?php
session_start();

// Đảm bảo đường dẫn đúng
$base_path = __DIR__; // Đường dẫn thư mục hiện tại
include $base_path . "/database/db_connect.php"; // Gọi file kết nối database

// Kiểm tra kết nối database
if (!$conn) {
    die("Lỗi kết nối database: " . mysqli_connect_error());
}

$maSV = isset($_SESSION['MaSV']) ? $_SESSION['MaSV'] : null;

// Lấy danh sách học phần
$sql = "SELECT * FROM HocPhan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Học Phần</title>
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

    <!-- Container -->
    <div class="container mt-4">
        <h2 class="mb-4">Đăng Ký Học Phần</h2>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Mã HP</th>
                    <th>Tên HP</th>
                    <th>Số tín chỉ</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['MaHP']) ?></td>
                    <td><?= htmlspecialchars($row['TenHP']) ?></td>
                    <td><?= htmlspecialchars($row['SoTinChi']) ?></td>
                    <td>
                        <?php if ($maSV): ?>
                            <form method="POST" action="save.php">
                                <input type="hidden" name="MaHP" value="<?= htmlspecialchars($row['MaHP']) ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Đăng Ký</button>
                            </form>
                        <?php else: ?>
                            <a href="/DangKyHocPhan/auth/login.php" class="btn btn-warning btn-sm">Đăng nhập để đăng ký</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
