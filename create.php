<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST['MaSV'];
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $Hinh = $_FILES['Hinh']['name'];
    $MaNganh = $_POST['MaNganh'];

    if ($Hinh) {
        move_uploaded_file($_FILES['Hinh']['tmp_name'], "images/" . $Hinh);
    }

    $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) VALUES ('$MaSV', '$HoTen', '$GioiTinh', '$NgaySinh', '$Hinh', '$MaNganh')";
    
    if ($conn->query($sql)) {
        echo "<script>alert('Thêm sinh viên thành công!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Lỗi: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thêm Sinh Viên</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">THÊM SINH VIÊN</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Mã SV</label>
                <input type="text" name="MaSV" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Họ Tên</label>
                <input type="text" name="HoTen" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Giới Tính</label>
                <select name="GioiTinh" class="form-control">
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>
            <div class="form-group">
                <label>Ngày Sinh</label>
                <input type="date" name="NgaySinh" class="form-control">
            </div>
            <div class="form-group">
                <label>Hình</label>
                <input type="file" name="Hinh" class="form-control-file">
            </div>
            <div class="form-group">
                <label>Ngành Học</label>
                <input type="text" name="MaNganh" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
        <a href="index.php" class="btn btn-link mt-3">Quay lại</a>
    </div>
</body>
</html>