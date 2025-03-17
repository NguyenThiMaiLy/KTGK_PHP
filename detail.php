<?php
include 'db.php';

$MaSV = $_GET['MaSV'];
$result = $conn->query("SELECT * FROM SinhVien WHERE MaSV='$MaSV'");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center text-primary mb-4">Chi tiết Sinh Viên</h2>
            <div class="row">
                <div class="col-md-4 text-center">
                <img src="<?= htmlspecialchars($row['Hinh']) ?>" class="img-fluid rounded" width="150" alt="Ảnh Sinh Viên">
                </div>
                <div class="col-md-8">
                    <p><strong>Mã SV:</strong> <?= $row['MaSV'] ?></p>
                    <p><strong>Họ Tên:</strong> <?= $row['HoTen'] ?></p>
                    <p><strong>Giới Tính:</strong> <?= $row['GioiTinh'] ?></p>
                    <p><strong>Ngày Sinh:</strong> <?= date("d/m/Y", strtotime($row['NgaySinh'])) ?></p>
                    <p><strong>Ngành Học:</strong> <?= $row['MaNganh'] ?></p>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="index.php" class="btn btn-secondary">Quay lại</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
