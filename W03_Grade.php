<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5 text-center">
        <h1>PHP Check Grade A-E From Score</h1>
    </div>
    <hr>
    <p class="text-center">กรุณากรอกคะแนนเพื่อทำการตรวจสอบว่าได้เกรดอะไร</p>
    <form method="post" class="text-center">
        <div class="mb-3 w-50 m-auto">
            <input type="number" class="form-control" id="score" name="score" 
            value="<?php echo isset($_POST['score']) ? $_POST['score'] : ''; ?>" placeholder="Enter a Score" required>
        </div>
        <button type="submit" class="btn btn-info text-light mb-3">Check</button>
        <button type="button" class="btn btn-warning text-light mb-3" onclick="clearGrade()">Reset</button>
    </form>
    
    <div id="grade">
        <?php
        if (isset($_POST['score'])) {
            $get_score = $_POST['score'];
            $score = (int)$get_score;
            
            if($score >= 80) {
                echo "<h3 class='text-success text-center'>Your grade is : A</h3>";
            } else if($score >= 70) {
                echo "<h3 class='text-primary text-center'>Your grade is : B</h3>";
            } else if($score >= 60) {
                echo "<h3 class='text-info text-center'>Your grade is : C</h3>";
            } else if($score >= 50) {
                echo "<h3 class='text-warning text-center'>Your grade is : D</h3>";
            } else {
                echo "<h3 class='text-danger text-center'>Your grade is : E</h3>";
            }
        }
        ?>
    </div>
    <hr>

    <button type="button" class="btn btn-info text-light mx-5 mt-3">
        <a href="index.php" class="text-light text-decoration-none">Back to Home</a>
    </button>
    
    <script>
        // ฟังก์ชันสำหรับล้างผลลัพธ์เกรดและช่องกรอกคะแนน
        function clearGrade() {
            document.getElementById('grade').innerHTML = '';
            document.getElementById('score').value = '';
        }  
    </script>
</body>
</html>