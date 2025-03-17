<?php
include "../database/db_connect.php";

$sql = "SELECT * FROM HocPhan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký học phần</title>
</head>
<body>
    <h2>Chọn học phần để đăng ký</h2>
    <form method="POST" action="save.php">
        <select name="MaHP">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <option value="<?= $row['MaHP'] ?>"><?= $row['TenHP'] ?></option>
            <?php } ?>
        </select>
        <input type="submit" value="Đăng ký">
    </form>
</body>
</html>
