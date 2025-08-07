<?php 








require_once 'config.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = trim ($_POST['username']);
    $full_name = trim ($_POST['full_name']);
    $email = trim ($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


     $hashedPassword= password_hash($password,PASSWORD_DEFAULT);

         $sql ="INSERT INTO `users` (username, full_name, email, password,role)
         VALUES (?,?,?,?,'admin')";

         $stmt = $conn->prepare($sql);
        
         $stmt->execute([$username,$full_name,$email,$hashedPassword]);
         $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
         

}

   








?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        body{
            align-items: center;
            margin-left: 30px;
            margin-right: 30px;
        }
    </style>
         


</head>
<body>





    <div class="contianer mt-5" >
        <h2></h2>
        <form method="post" class="row g-3">
            <div class="col-md-6">
            <label for="username" class="form-label">ชื่อผู้ใช้</label>
            <input type="text" name="username" id="username" class="form-control"
            required >
            </div>
            <div class="col-md-6">
            <label for="full_name" class="form-label">ชื่อ-นามสกุล</label>
            <input type="text" name="full_name" id="full_name" class="form-control" required >
            </div>
            <div class="col-md-6">
            <label for="email" class="form-label">อีเมล</label>
            <input type="email" name="email" id="email" class="form-control"
            required >
            </div>
            <div class="col-md-6">
            <label for="password" class="form-label">รหัสผ่าน</label>
            <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="col-md-6">
            <label for="confirm_password" class="form-label">เปลี่ยนรหัสผ่าน</label>
            <input type="password" name="confirm_password" id="confirm_password"
            class="form-control" required>
            </div>
            <div class="mt-3">
            <button type="submit" class="btn btn-primary">สมัครสมาชิก</button>
            <a href="login.php" class="btn btn-link">เข้าสู่ระบบ</a>
            </div>
        </form>




    </div>




























 <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

    
</body>
</html>