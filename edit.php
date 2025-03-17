<?php
include 'db.php';

$MaSV = $_GET['MaSV'];
$result = $conn->query("SELECT * FROM SinhVien WHERE MaSV='$MaSV'");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $MaNganh = $_POST['MaNganh'];
    
    // Xử lý upload ảnh
    $Hinh = $row['Hinh']; // Giữ ảnh cũ nếu không có ảnh mới
    if (!empty($_FILES['Hinh']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["Hinh"]["name"]);
        move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file);
        $Hinh = $target_file;
    }

    $sql = "UPDATE SinhVien SET HoTen='$HoTen', GioiTinh='$GioiTinh', NgaySinh='$NgaySinh', MaNganh='$MaNganh', Hinh='$Hinh' WHERE MaSV='$MaSV'";
    if ($conn->query($sql)) {
        header("Location: index.php?updated=success");
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
    <title>Sửa Sinh Viên</title>
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
        <h2 class="text-center">Chỉnh sửa thông tin sinh viên</h2>
        
        <div class="card shadow p-4 mx-auto" style="max-width: 500px;">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3 text-center">
                    <label class="form-label">Hình ảnh:</label><br>
                    <img src="<?= htmlspecialchars($row['Hinh']) ?>" alt="Ảnh Sinh Viên" class="img-thumbnail mb-2" width="150">
                    <input type="file" name="Hinh" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Họ Tên:</label>
                    <input type="text" name="HoTen" class="form-control" value="<?= htmlspecialchars($row['HoTen']) ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Giới Tính:</label>
                    <select name="GioiTinh" class="form-select">
                        <option value="Nam" <?= $row['GioiTinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
                        <option value="Nữ" <?= $row['GioiTinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Ngày Sinh:</label>
                    <input type="date" name="NgaySinh" class="form-control" value="<?= date('Y-m-d', strtotime($row['NgaySinh'])) ?>">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Ngành Học:</label>
                    <input type="text" name="MaNganh" class="form-control" value="<?= $row['MaNganh'] ?>" required>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a href="index.php" class="btn btn-secondary">Quay lại</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
