<?php
session_start();
require_once 'config.php';

$login_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username_or_email = trim($_POST['username_or_email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username_or_email, $username_or_email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'member') {
                header('Location: index.php');
            } else {
                header('Location: admin/index.php');
            }
            exit;
        } else {
            $login_error = '❌ รหัสผ่านไม่ถูกต้อง';
        }
    } else {
        $login_error = '❌ ไม่พบชื่อผู้ใช้หรืออีเมลนี้ในระบบ';
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>เข้าสู่ระบบ</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Edu+NSW+ACT+Cursive:wght@400..700&display=swap" rel="stylesheet">
<style>
body {
  margin: 0;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  color: #fff;
  position: relative;
  overflow: hidden;
  font-family: "Edu NSW ACT Cursive", cursive;
  font-optical-sizing: auto;
}

/* พื้นหลัง gradient + ภาพ */
body::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: 
    linear-gradient(135deg, rgba(255,182,193,0.65), rgba(173,216,230,0.65), rgba(221,160,221,0.65)),
    url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1600&q=80');
  background-size: cover;
  background-position: center;
  z-index: -2;
}

body::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 250%;
  height: 250%;
  background: radial-gradient(circle at center, rgba(255,192,203,0.4), rgba(255,160,122,0.4), rgba(147,112,219,0.4), transparent 70%);
  animation: moveGradient 25s infinite linear;
  z-index: -1;
}

@keyframes moveGradient {
  0% { transform: translate(-20%, -20%); }
  50% { transform: translate(0%, 0%); }
  100% { transform: translate(-20%, -20%); }
}

/* ฟอร์ม container */
.login-box {
  background: rgba(255,255,255,0.15);
  padding: 40px 30px;
  border-radius: 20px;
  box-shadow: 0 12px 30px rgba(0,0,0,0.45);
  backdrop-filter: blur(12px);
  width: 350px;
  text-align: center;
  animation: fadeIn 2s ease;
}

@keyframes fadeIn {
  from { opacity: 0; transform: scale(0.9); }
  to { opacity: 1; transform: scale(1); }
}

.login-box h1 {
  margin-bottom: 20px;
  font-size: 2rem;
  font-weight: 700;
  letter-spacing: 1px;
  background: linear-gradient(135deg, #74f7d6ff, #f273dbff, #97bdfbff, #b4e6feff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

/* Floating Label + Placeholder */
.input-group {
  position: relative;
  margin: 15px 0;
  padding-top: 20px;
}

.input-group input {
  width: 75%;
  padding: 16px 20px;
  border: none;
  border-radius: 12px;
  outline: none;
  color: #fff;
  font-size: 1rem;
  text-align: center;
  line-height: 1.4;
  background: linear-gradient(270deg, #ff9a9e, #fad0c4, #a18cd1, #fbc2eb);
  background-size: 800% 800%;
  box-shadow: 0 0 15px rgba(255,192,203,0.3), inset 0 2px 4px rgba(0,0,0,0.1);
  animation: gradientBG 8s ease infinite, glowBG 8s ease infinite;
  transition: 0.4s, box-shadow 0.3s;
}

.input-group input::placeholder {
  color: rgba(255,255,255,0.7);
  opacity: 1;
  text-align: center;
  

}

.input-group input:focus {
  transform: scale(1.03);
  box-shadow: 0 0 25px rgba(255,182,193,0.7), 0 0 30px rgba(255,182,255,0.5), 0 6px 18px rgba(255,255,255,0.35), inset 0 2px 4px rgba(0,0,0,0.15);
}

/* Label */
.input-group label {
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  top: 50%;
  color: rgba(255,255,255,0.7);
  font-size: 1rem;
  font-weight: 600;
  pointer-events: none;
  text-align: center;
  transition: 0.3s ease all;
}

.input-group input:focus + label,

.input-group input:not(:placeholder-shown) + label {

 

  
  border-radius: 5px;
  padding: 0 5px;
  text-align: center;
}

/* Button gradient + glow animation */
.login-btn {
  width: 75%;
  padding: 12px;
  margin-top: 20px;
  border: none;
  border-radius: 60px;
  background: linear-gradient(270deg, #ff9a9e, #fad0c4, #a18cd1, #fbc2eb);
  background-size: 800% 800%;
  color: #fff;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  transition: 0.4s, box-shadow 0.3s;
  box-shadow: 0 0 15px rgba(255,182,193,0.3), 0 6px 18px rgba(0,0,0,0.35);
  animation: gradientBG 8s ease infinite, glowBG 8s ease infinite;
}

.login-btn:hover {
  transform: translateY(-3px) scale(1.03);
  box-shadow: 0 0 35px rgba(255,182,193,0.8), 0 0 40px rgba(255,182,255,0.7), 0 10px 26px rgba(0,0,0,0.5);
}

/* Gradient animation */
@keyframes gradientBG {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

/* Glow animation */
@keyframes glowBG {
  0% { box-shadow: 0 0 15px rgba(255,182,193,0.3); }
  25% { box-shadow: 0 0 20px rgba(255,160,203,0.5); }
  50% { box-shadow: 0 0 25px rgba(255,182,255,0.7); }
  75% { box-shadow: 0 0 20px rgba(255,160,203,0.5); }
  100% { box-shadow: 0 0 15px rgba(255,182,193,0.3); }
}

/* Alert error */
.alert {
  background: rgba(255, 99, 132, 0.25);
  color: #fff;
  padding: 12px;
  border-radius: 12px;
  margin-bottom: 15px;
  font-size: 0.9rem;
}
</style>
</head>
<body>

<div class="login-box">
    <h1>👤 Login</h1>
    <?php if (!empty($login_error)): ?>
        <div class="alert"><?= htmlspecialchars($login_error) ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="input-group">
            <input type="text" name="username_or_email" placeholder="ชื่อผู้ใช้หรืออีเมล" required>
            <label>ชื่อผู้ใช้หรืออีเมล</label>
        </div>
        <div class="input-group">
            <input type="password" name="password" placeholder="รหัสผ่าน" required>
            <label>รหัสผ่าน</label>
        </div>
        <button type="submit" class="login-btn">Sign In</button>
    </form>
</div>

</body>
</html>
