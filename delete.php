<?php
include 'db.php';

$MaSV = $_GET['MaSV'];
$result = $conn->query("SELECT * FROM SinhVien WHERE MaSV='$MaSV'");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "DELETE FROM SinhVien WHERE MaSV='$MaSV'";
    if ($conn->query($sql)) {
        header("Location: index.php?deleted=success");
        exit();
    } else {
        echo "<div class='alert alert-danger text-center'>Lỗi: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Test1</a>
            <div>
                <a class="nav-link text-white d-inline" href="#">Sinh Viên</a>
                <a class="nav-link text-white d-inline" href="#">Học Phần</a>
                <a class="nav-link text-white d-inline" href="#">Đăng Ký</a>
                <a class="nav-link text-white d-inline" href="#">Đăng Nhập</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center text-danger mb-4">XÓA THÔNG TIN</h2>
        <p class="text-center">Are you sure you want to delete this?</p>
        
        <div class="card p-4 mx-auto" style="max-width: 500px;">
            <p><strong>Họ Tên:</strong> <?= $row['HoTen'] ?></p>
            <p><strong>Giới Tính:</strong> <?= $row['GioiTinh'] ?></p>
            <p><strong>Ngày Sinh:</strong> <?= date("d/m/Y", strtotime($row['NgaySinh'])) ?></p>
            <p><strong>Hình:</strong></p>
            <img src="<?= htmlspecialchars($row['Hinh']) ?>" class="img-fluid rounded" width="150" alt="Ảnh Sinh Viên">
            <p><strong>Mã Ngành:</strong> <?= $row['MaNganh'] ?></p>
            
            <form method="POST" class="text-center mt-3">
                <button type="submit" class="btn btn-danger">Xác nhận xóa</button>
                <a href="index.php" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
