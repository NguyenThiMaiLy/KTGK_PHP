<?php
include 'db.php';
$result = $conn->query("SELECT * FROM SinhVien");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .student-img {
            width: 100px;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Test1</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="sinhvien.php">Sinh Viên</a></li>
                    <li class="nav-item"><a class="nav-link" href="hocphan.php">Học Phần</a></li>
                    <li class="nav-item"><a class="nav-link" href="dangky.php">Đăng Kí</a></li>
                    <li class="nav-item"><a class="nav-link" href="dangnhap.php">Đăng Nhập</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="text-center">TRANG SINH VIÊN</h2>

        <a href="create.php" class="btn btn-primary mb-3">Thêm Sinh Viên</a>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>MaSV</th>
                    <th>Họ Tên</th>
                    <th>Giới Tính</th>
                    <th>Ngày Sinh</th>
                    <th>Hình</th>
                    <th>Ngành Học</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['MaSV'] ?></td>
                        <td><?= $row['HoTen'] ?></td>
                        <td><?= $row['GioiTinh'] ?></td>
                        <td><?= date("d/m/Y", strtotime($row['NgaySinh'])) ?></td>
                        <td>
                            <?php 
                            
                            $imagePath = ltrim($row['Hinh'], '/');

                            if (!empty($row['Hinh']) && file_exists($imagePath)): ?>
                                <img src="<?= $imagePath ?>" width="50" class="rounded">
                            <?php else: ?>
                                <img src="Content/images/default.png" width="50" class="rounded" alt="Không có ảnh">
                            <?php endif; ?>
                        </td>

                        <td><?= $row['MaNganh'] ?></td>
                        <td>
                            <a href="edit.php?MaSV=<?= $row['MaSV'] ?>" class="text-primary">Edit</a> |
                            <a href="detail.php?MaSV=<?= $row['MaSV'] ?>" class="text-success">Details</a> |
                            <a href="delete.php?MaSV=<?= $row['MaSV'] ?>" class="text-danger" onclick="return confirm('Xóa sinh viên này?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
