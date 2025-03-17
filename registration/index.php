<?php
session_start();
include __DIR__ . "/../database/db_connect.php"; // Kết nối database

$maSV = isset($_SESSION['MaSV']) ? $_SESSION['MaSV'] : null;

// Lấy danh sách học phần đã đăng ký của sinh viên
$sql = "SELECT HP.MaHP, HP.TenHP, HP.SoTinChi 
        FROM ChiTietDangKy CTDK
        JOIN HocPhan HP ON CTDK.MaHP = HP.MaHP
        JOIN DangKy DK ON CTDK.MaDK = DK.MaDK
        WHERE DK.MaSV = '$maSV'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Học Phần Đã Đăng Ký</title>
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
        <div class="table-container">
            <h2 class="text-center">📚 Học Phần Đã Đăng Ký</h2>

            <?php if ($result->num_rows > 0): ?>
                <table class="table table-hover table-bordered">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Mã HP</th>
                            <th>Tên HP</th>
                            <th>Số tín chỉ</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?= htmlspecialchars($row['MaHP']) ?></td>
                            <td><?= htmlspecialchars($row['TenHP']) ?></td>
                            <td><?= htmlspecialchars($row['SoTinChi']) ?></td>
                            <td>
                                <form method="POST" action="delete.php">
                                    <input type="hidden" name="MaHP" value="<?= htmlspecialchars($row['MaHP']) ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <a href="delete_all.php" class="btn btn-outline-danger mt-3">🗑 Xóa tất cả học phần</a>
            <?php else: ?>
                <p class="text-center text-muted">Bạn chưa đăng ký học phần nào.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
