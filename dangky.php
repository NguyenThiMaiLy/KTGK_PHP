<?php
include 'db.php';
session_start();

if (!isset($_SESSION['MaSV'])) {
    echo "<script>alert('Bạn chưa đăng nhập!'); window.location='login.php';</script>";
    exit();
}

$MaSV = $_SESSION['MaSV'];
$MaHP = $_POST['MaHP'];

// Kiểm tra xem sinh viên đã đăng ký học phần này chưa
$check = "SELECT * FROM dangky WHERE MaSV='$MaSV' AND MaHP='$MaHP'";
$result = $conn->query($check);

if ($result->num_rows > 0) {
    echo "<script>alert('Bạn đã đăng ký học phần này rồi!'); window.location='hocphan.php';</script>";
    exit();
}

// Thêm vào bảng đăng ký
$sql = "INSERT INTO dangky (MaSV, MaHP) VALUES ('$MaSV', '$MaHP')";
if ($conn->query($sql)) {
    echo "<script>alert('Đăng ký thành công!'); window.location='hocphan.php';</script>";
} else {
    echo "<script>alert('Lỗi: " . $conn->error . "');</script>";
}
?>
