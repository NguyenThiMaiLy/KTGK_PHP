<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST['MaSV'];

    $stmt = $conn->prepare("SELECT * FROM SinhVien WHERE MaSV = ?");
    $stmt->bind_param("s", $MaSV);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['MaSV'] = $MaSV;
        header("Location: index.php");
        exit();
    } else {
        $error = "Mã sinh viên không tồn tại!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
                    <li class="nav-item"><a class="nav-link active" href="login.php">Đăng Nhập</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="text-center">ĐĂNG NHẬP</h2>

        <form action="login.php" method="POST" class="w-50 mx-auto">
            <div class="mb-3">
                <label for="MaSV" class="form-label fw-bold">MaSV</label>
                <input type="text" id="MaSV" name="MaSV" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Đăng Nhập</button>
        </form>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger mt-3 text-center"><?= $error ?></div>
        <?php endif; ?>

        <div class="text-center mt-3">
            <a href="index.php">Back to List</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
