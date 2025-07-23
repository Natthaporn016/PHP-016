<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Odd-Even Number</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body{
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <div class="container mt-5 text-center">
        <h1 style="color: palevioletred;">Odd-Even Number Checker</h1>
    </div>
    <hr>
    <p class="text-center">กรุณากรอกตัวเลขเพื่อทำการตรวจสอบเลขคู่เลขคี่</p>
    <form method="post" class="text-center">
        <div class="mb-3 w-50 m-auto">
            <input type="number" class="form-control" id="number" name="number" placeholder="Enter a number" required>
        </div>
        <button type="submit" class="btn btn-info text-light">Check</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $number = $_POST['number'];
        if ($number % 2 == 0) {
            echo "<h3 class='text-warning text-center mt-3'>The number $number is even number.</h3>";
        } else {
            echo "<h3 class='text-danger text-center mt-3'>The number $number is odd number.</h3>";
        }
    }
    ?>

    <hr>
   
    <a href="index.php" class="btn btn-info text-light mt-3 pe-3 mx-3">Back to Home</a>
    
</body>
</html>
