<?php 
session_start();

// ถ้าไม่ได้ล็อกอิน ให้กลับไปหน้า login
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Edu+NSW+ACT+Cursive:wght@400..700&display=swap" rel="stylesheet">
<style>
body {
  margin: 0;
  height: 100vh;
  display: flex;
  justify-content: center; /* จัดกลางแนวนอน */
  align-items: center;     /* จัดกลางแนวตั้ง */
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: linear-gradient(135deg, #c9dcfeff, #ddccfcff, #f8c8d8ff);
  position: relative;
  overflow: hidden;
  color: #333;
  

  font-family: "Edu NSW ACT Cursive", cursive;
  font-optical-sizing: auto;
  

}

/* ลอย gradient background แบบ smooth */
body::after {
  content: "";
  position: fixed; /* fixed เพื่อไม่กระทบ flex */
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle at center, rgba(255,192,203,0.4), rgba(255,160,122,0.4), rgba(147,112,219,0.4), transparent 70%);
  animation: moveGradient 60s infinite linear; /* ช้าและ smooth */
  z-index: -1;
}

@keyframes moveGradient {
  0% { transform: translate(0, 0) scale(1); }
  25% { transform: translate(10%, 5%) scale(1.05); }
  50% { transform: translate(0%, 10%) scale(1); }
  75% { transform: translate(-10%, 5%) scale(1.05); }
  100% { transform: translate(0, 0) scale(1); }
}

/* กล่อง welcome */
.welcome-box {
  background: rgba(255,255,255,0.15);
  padding: 40px 30px;
  border-radius: 20px;
  box-shadow: 0 12px 30px rgba(0,0,0,0.45);
  backdrop-filter: blur(12px);
  width: 350px;
  text-align: center;
  animation: fadeIn 2s ease;
  position: relative;
  perspective: 800px;
}

/* header gradient */
.welcome-box h1 {
  font-size: 3rem;
  margin-bottom: 15px;
  background: linear-gradient(135deg, #fd91e7ff, #faad97ff, #8fbafdff, #9eddfaff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  display: inline-block;
  text-align: center;
  position: relative;
  transform-style: preserve-3d;
  padding-bottom: 20px;
}

/* emoji ลอยโค้ง 3D รอบ h1 */
.welcome-box h1::after {
  content: "✨";
  position: absolute;
  top: -10px;
  right: -20px;
  font-size: 1.2rem;
  animation: rotateEmoji 3s infinite linear;
}

@keyframes rotateEmoji {
  0% { transform: rotateY(0deg) translateX(20px) rotateY(0deg); }
  25% { transform: rotateY(90deg) translateX(20px) rotateY(-90deg); }
  50% { transform: rotateY(180deg) translateX(20px) rotateY(-180deg); }
  75% { transform: rotateY(270deg) translateX(20px) rotateY(-270deg); }
  100% { transform: rotateY(360deg) translateX(20px) rotateY(-360deg); }
}

/* ข้อความผู้ใช้ */
.welcome-box p {
  font-size: 1rem;
  padding: 15px 15px;
  border-radius: 12px;
  background: linear-gradient(270deg, #ff9a9e, #fad0c4, #a18cd1, #fbc2eb);
  background-size: 800% 800%;
  color: #fff;
  font-weight: 500;
  animation: gradientBG 8s ease infinite;
  box-shadow: 0 4px 12px rgba(255,255,255,0.25), inset 0 2px 4px rgba(0,0,0,0.1);
}

/* Logout button */
.logout-btn {
  margin-top: 20px;
  padding: 12px 25px;
  border: none;
  border-radius: 60px;
  background: linear-gradient(270deg, #ff9a9e, #fad0c4, #a18cd1, #fbc2eb);
  background-size: 800% 800%;
  color: #fff;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  transition: 0.4s;
  box-shadow: 0 6px 18px rgba(61, 61, 61, 0.35);
  animation: gradientBG 8s ease infinite;
}

.logout-btn:hover {
  transform: translateY(-3px) scale(1.03);
  box-shadow:inset 0 6px 6px rgba(72, 71, 71, 0.5);
}

/* gradient animation */
@keyframes gradientBG {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

/* fade in animation */
@keyframes fadeIn {
  from { opacity: 0; transform: scale(0.9); }
  to { opacity: 1; transform: scale(1); }
}
</style>
</head>
<body>
<div class="welcome-box">
    <h1>Welcome</h1>
    <p>ผู้ใช้: <?= htmlspecialchars($_SESSION['username']) ?> (<?= htmlspecialchars($_SESSION['role']) ?>)</p>
    <form method="post" action="logout.php">
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</div>
</body>
</html>
