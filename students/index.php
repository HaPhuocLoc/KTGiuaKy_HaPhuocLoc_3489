<?php
include "../database/db_connect.php";

$sql = "SELECT * FROM SinhVien";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sinh Viên</title>
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
                    <li class="nav-item"><a class="nav-link" href="../students/index.php">Sinh Viên</a></li>
                    <li class="nav-item"><a class="nav-link" href="../courses/index.php">Học Phần</a></li>
                    <li class="nav-item"><a class="nav-link" href="../registration/index.php">Đăng Ký</a></li>
                    <li class="nav-item"><a class="nav-link" href="../auth/login.php">Đăng Nhập</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Container -->
    <div class="container mt-4">
        <h2 class="mb-4">TRANG SINH VIÊN</h2>
        <a href="create.php" class="btn btn-primary mb-3">+ Add Student</a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Mã SV</th>
                    <th>Họ Tên</th>
                    <th>Giới Tính</th>
                    <th>Ngày Sinh</th>
                    <th>Hình</th>
                    <th>Ngành</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['MaSV'] ?></td>
                    <td><?= $row['HoTen'] ?></td>
                    <td><?= $row['GioiTinh'] ?></td>
                    <td><?= date("d/m/Y", strtotime($row['NgaySinh'])) ?></td>
                    <td><img src="<?= $row['Hinh'] ?>" width="80" height="80" class="rounded"></td>
                    <td><?= $row['MaNganh'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['MaSV'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="detail.php?id=<?= $row['MaSV'] ?>" class="btn btn-info btn-sm">Details</a>
                        <a href="delete.php?id=<?= $row['MaSV'] ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
