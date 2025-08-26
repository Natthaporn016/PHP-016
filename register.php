<?php
session_start();
require_once 'config.php';

$successMessage = "";
$alertClass = "";
$errors = []; // เก็บ error เป็น array

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // ตรวจสอบว่ากรอกข้อมูลครบหรือไม่
    if (empty($username) || empty($full_name) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = "❌ กรุณากรอกข้อมูลให้ครบทุกช่อง.";
    }

    // ตรวจสอบรูปแบบอีเมล
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "❌ กรุณากรอกอีเมลที่ถูกต้อง.";
    }

    // ตรวจสอบรหัสผ่านตรงกันหรือไม่
    if ($password !== $confirm_password) {
        $errors[] = "❌ กรุณากรอกรหัสผ่านให้ตรงกัน.";
    }

    // ตรวจสอบว่าชื่อผู้ใช้หรืออีเมลซ้ำหรือไม่
    if (empty($errors)) {
        $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username, $email]);

        if ($stmt->rowCount() > 0) {
            $errors[] = "❌ ชื่อผู้ใช้หรืออีเมลนี้ถูกใช้แล้ว กรุณาใช้ชื่อผู้ใช้หรืออีเมลอื่น.";
        }
    }

    // ถ้าไม่มี error ให้บันทึกข้อมูล
    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, full_name, email, password, role)
                VALUES (?, ?, ?, ?, 'member')";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username, $full_name, $email, $hashedPassword]);

        $successMessage = "✅ สมัครสมาชิกสำเร็จ! กรุณาเข้าสู่ระบบ.";
        $alertClass = "success";

        // ส่งไปหน้า login พร้อมแจ้งว่าลงทะเบียนสำเร็จ
        header("Location: login.php?register=success");
        exit;
    } else {
        $alertClass = "danger";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก | Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Edu+NSW+ACT+Cursive:wght@400..700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #8899f8ff;
            --primary-hover: #e17bf8ff;
            --secondary-color: #96e2eeff;
            --accent-color: #ffd6a8;
            --success-color: #a8e6c1;
            --danger-color: #ffbcbcff;
            --warning-color: #ffd6a8;
            --dark-color: #7f94c2ff;
            --light-color: #fafbff;
            --border-radius: 16px;
            --box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #c9dcfeff 0%, #ddccfcff 50%, #f8c8d8ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            perspective: 1000px;
            font-family: "Edu NSW ACT Cursive", cursive;
  font-optical-sizing: auto;
        }

        body::before {
            content: '';
            position: absolute;
            top: 10%;
            left: 10%;
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, #ffcccb, #ffe4b5);
            border-radius: 50%;
            opacity: 0.3;
            animation: float 6s ease-in-out infinite;
            transform-style: preserve-3d;
        }

        body::after {
            content: '';
            position: absolute;
            top: 20%;
            right: 15%;
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, #b3e5fc, #e1f5fe);
            border-radius: 20px;
            opacity: 0.3;
            animation: float 8s ease-in-out infinite reverse;
            transform-style: preserve-3d;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotateX(0deg) rotateY(0deg); }
            25% { transform: translateY(-20px) rotateX(10deg) rotateY(5deg); }
            50% { transform: translateY(-40px) rotateX(0deg) rotateY(10deg); }
            75% { transform: translateY(-20px) rotateX(-10deg) rotateY(5deg); }
        }

        .register-container {
            width: 100%;
            max-width: 520px;
            margin: 0 auto;
            transform-style: preserve-3d;
            display: flex;
            justify-content: center;
            
          
        }

        .register-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.95), rgba(250, 251, 255, 0.9));
            backdrop-filter: blur(25px);
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: var(--border-radius);
            box-shadow: 
                inset 25px 50px -12px rgba(0, 0, 0, 0.15),
                inset 0 0 0 1px rgba(255, 255, 255, 0.3),
                inset 2px 2px 2px rgba(255, 255, 255, 0.6);
            padding: 3rem;
            transition: var(--transition);
            transform-style: preserve-3d;
            position: relative;
            overflow: hidden;
        }

        .register-card::before {
            content: '🛒';
            position: absolute;
            top: -20px;
            right: -20px;
            font-size: 120px;
            opacity: 0.02;
            transform: rotate(15deg);
            z-index: 0;
        }

        .register-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ffcccb, #ffe4b5, #b3e5fc, #e1f5fe);
            border-radius: var(--border-radius) var(--border-radius) 0 0;
        }

        .register-card:hover {
            transform: translateY(-8px) rotateX(2deg) rotateY(1deg);
            box-shadow: 
                inset 2px 2px 2px 2px rgba(65, 65, 65, 0.2),
                inset 4px 2px 2px 2px rgba(255, 255, 255, 0.4),
                inset 2px 2px 2px rgba(255, 255, 255, 0.7);
        }

        .register-header {
            text-align: center;
            margin-bottom: 2.5rem;
            position: relative;
            z-index: 1;
        }

        .register-title {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #99a7f6ff, #b488ffff, #8eebf9ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            transform-style: preserve-3d;
        }

        .register-title i {
            background: linear-gradient(135deg, #9aa9fcff, #b992fcff,#b3e5fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 2rem;
            font-weight: 500;
            
            filter: drop-shadow(0 2px 4px rgba(168, 181, 255, 0.2));
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .register-subtitle {
            color: #9ca3af;
            font-size: 1rem;
            font-weight: 400;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .form-group {
            margin-bottom: 1.75rem;
            position: relative;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.75rem;
            font-size: 1rem;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .form-icon {
            font-size: 1.1rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: drop-shadow(0 1px 2px rgba(168, 181, 255, 0.2));
        }

        .form-control {
            border: 2px solid rgba(229, 231, 235, 0.6);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            font-size: 0.95rem;
            transition: var(--transition);
            background: linear-gradient(145deg, #ffffff, #fafbff);
            box-shadow: 
                inset 0 2px 4px rgba(0, 0, 0, 0.03),
                0 1px 2px rgba(0, 0, 0, 0.03);
            position: relative;
            z-index: 1;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 
                0 0 0 4px rgba(168, 181, 255, 0.1),
                inset 0 2px 4px rgba(0, 0, 0, 0.03),
                0 4px 8px rgba(168, 181, 255, 0.08);
            outline: none;
            transform: translateY(-1px);
        }

        .form-control:hover {
            border-color: #d1d5db;
            transform: translateY(-1px);
            box-shadow: 
                inset 0 2px 4px rgba(0, 0, 0, 0.03),
                0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .btn-register {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 50%, var(--accent-color) 100%);
            border: none;
            border-radius: 12px;
            padding: 1rem 2.5rem;
            font-weight: 700;
            font-size: 1.1rem;
            color: white;
            width: 100%;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            box-shadow: 
                0 8px 16px rgba(168, 181, 255, 0.2),
                0 4px 8px rgba(0, 0, 0, 0.05),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
            transition: left 0.5s;
        }

        .btn-register:hover::before {
            left: 100%;
        }

        .btn-register:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 
                0 12px 24px rgba(168, 181, 255, 0.25),
                0 8px 16px rgba(0, 0, 0, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
            background: linear-gradient(135deg, var(--primary-hover) 0%, #9dd9e8 50%, #f5d19a 100%);
        }

        .btn-register:active {
            transform: translateY(-1px) scale(1.01);
            box-shadow: 
                0 4px 8px rgba(168, 181, 255, 0.2),
                0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .login-link {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid rgba(229, 231, 235, 0.3);
            position: relative;
            font-size: medium;
        }

        .login-link::before {
            content: '🛍️';
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            padding: 0 10px;
            font-size: 1.2rem;
        }

        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            text-shadow: 0 1px 2px rgba(168, 181, 255, 0.05);
        }

        .login-link a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
            transform: translateY(-1px);
            text-shadow: 0 2px 4px rgba(168, 181, 255, 0.1);
        }

        .alert {
            border: none;
            border-radius: 12px;
            padding: 1.25rem;
            margin-bottom: 2rem;
            font-weight: 500;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fff5f5 0%, #ffe8e8 100%);
            color: var(--danger-color);
            border-left: 6px solid var(--danger-color);
            box-shadow: 0 4px 8px rgba(255, 179, 179, 0.15);
        }

        .alert-success {
            background: linear-gradient(135deg, #f0fff4 0%, #e8f5e8 100%);
            color: var(--success-color);
            border-left: 6px solid var(--success-color);
            box-shadow: 0 4px 8px rgba(168, 230, 193, 0.15);
        }
        .register-card1{
            width: 150px;
            height: 300px;
        }

        @media (max-width: 576px) {
            .register-card {
                padding: 2rem;
                margin: 1rem;
            }
            
            .register-title {
                font-size: 1.75rem;
            }
            
            .form-control {
                padding: 0.875rem 1rem;
            }

            .register-card:hover {
                transform: translateY(-4px);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px) rotateX(-10deg);
            }
            to {
                opacity: 1;
                transform: translateY(0) rotateX(0deg);
            }
        }

        .register-card {
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes spin3D {
            0% { transform: rotateY(0deg); }
            100% { transform: rotateY(360deg); }
        }

        .btn-register:disabled {
            opacity: 0.8;
            cursor: not-allowed;
            transform: none;
        }

        .btn-register:disabled i {
            animation: spin3D 1s linear infinite;
        }

        .btn-register:disabled:hover {
            transform: none;
            box-shadow: 0 8px 16px rgba(168, 181, 255, 0.2);
        }

        .form-group:nth-child(odd)::after {
            content: '💳';
            position: absolute;
            top: 0;
            right: -30px;
            font-size: 1.5rem;
            opacity: 0.03;
            animation: float 4s ease-in-out infinite;
        }

        .form-group:nth-child(even)::after {
            content: '🎯';
            position: absolute;
            top: 0;
            right: -30px;
            font-size: 1.5rem;
            opacity: 0.03;
            animation: float 6s ease-in-out infinite reverse;
        }
    </style>
</head>
<body>
    <div class="register-container">
        
            
            <div class="register-card">
                <div class="register-header">
                    <h1 class="register-title">
                        <i class="bi bi-person-plus-fill"></i>
                        Sign-up
                    </h1>
                    <p class="register-subtitle">สร้างบัญชีใหม่เพื่อเริ่มต้นใช้งาน</p>
                </div>
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if (!empty($successMessage)): ?>
                    <div class="alert alert-<?= $alertClass ?> alert-dismissible fade show" role="alert">
                        <?= $successMessage ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <form method="post" id="registerForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username" class="form-label">
                                    <i class="bi bi-person-circle form-icon"></i>
                                    ชื่อผู้ใช้
                                </label>
                                <input
                                    type="text"
                                    name="username"
                                    id="username"
                                    class="form-control"
                                    value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>"
                                    required
                                    placeholder="กรอกชื่อผู้ใช้"
                                >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full_name" class="form-label">
                                    <i class="bi bi-card-text form-icon"></i>
                                    ชื่อ-นามสกุล
                                </label>
                                <input
                                    type="text"
                                    name="full_name"
                                    id="full_name"
                                    class="form-control"
                                    value="<?= isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : '' ?>"
                                    required
                                    placeholder="กรอกชื่อ-นามสกุล"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="bi bi-envelope form-icon"></i>
                            อีเมล
                        </label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control"
                            value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"
                            required
                            placeholder="กรอกอีเมล"
                        >
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="form-label">
                                    <i class="bi bi-lock form-icon"></i>
                                    รหัสผ่าน
                                </label>
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control"
                                    required
                                    placeholder="กรอกรหัสผ่าน"
                                >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="confirm_password" class="form-label">
                                    <i class="bi bi-shield-lock form-icon"></i>
                                    ยืนยันรหัสผ่าน
                                </label>
                                <input
                                    type="password"
                                    name="confirm_password"
                                    id="confirm_password"
                                    class="form-control"
                                    required
                                    placeholder="ยืนยันรหัสผ่าน"
                                >
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn-register">
                        <i class="bi bi-person-plus-fill"></i>
                        Sign-up
                    </button>
                </form>
                <div class="login-link">
                    <span class="text-muted">มีบัญชีแล้ว?</span>
                    <a href="login.php">Login</a>
                </div>
            </div>
        
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.btn-register');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> กำลังสมัครสมาชิก...';
        });

        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');

        function validatePassword() {
            if (password.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity('รหัสผ่านไม่ตรงกัน');
            } else {
                confirmPassword.setCustomValidity('');
            }
        }

        password.addEventListener('change', validatePassword);
        confirmPassword.addEventListener('keyup', validatePassword);

        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                if (alert.classList.contains('alert-success')) {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 300);
                }
            });
        }, 5000);
    </script>
</body>
</html>
