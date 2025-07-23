<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Calculate </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 0;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;


        }
        .result-box {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-top: 20px;
        }
        .header-blue {
            background-color: #00bfff;
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            border-radius: 5px 5px 0 0;
        }
        .footer-link {
            margin-top: 30px;
        }
        h1 {
            text-align: center;
            padding-top: 20px;
            margin-top: 20px;
            color: #ff80c0;
            
        }
        p {
            text-align: center;
            

        }
        .header-blue {
            width: 50%;
            
            box-shadow: #808080 1px 1px 1px 1px;
            margin: auto;
            margin-top: 10px;
        }
        label {
            font-weight: bold;
        }
        .container {
            padding-bottom: 10px;
        }
        .member{
            
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }
        form{
            text-align: center;
        }
       
        button{
            padding-left: 5px;
        }

       

    </style>
</head>
<body>

    <h1 >PHP Calculate Money</h1>
    <hr>
    <p >กรุณากรอกข้อมูลเพื่อทำการคำนวณยอดเงิน</p>

    <div class="container">
    

       <form action="" method="post" class="text-center mb-4">

            <!-- for price and amount -->
            <div class="row justify-content-center mb-3">
                <div class="col-md-4">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" name="price" id="price" 
                    value="<?php
                            if (isset($_POST['price'])) {
                                echo $_POST['price'];
                            } else {
                                echo '';
                            }
                        ?>"
                        <?php // echo isset($_POST['price']) ? $_POST['price'] : '';?> 
                    class="form-control" placeholder="Enter a Price" required>
                </div>
                <div class="col-md-4">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="text" name="amount" id="amount" 
                    value="<?php echo isset($_POST['amount']) ? $_POST['amount'] : '';?>"
                    class="form-control" placeholder="Enter an Amount" required>
                </div>
            </div>

            <!-- for membership -->

            <div >
                <div >
                    <label class="form-label d-block" for="">membership ?</label>
                    <div  class="form-check form-check-inline">
                        <input type="radio" name="member" id="member1" value="1"
                            <?php
                              echo isset($_POST['member']) && $_POST['member'] == '1' ? 'checked' : '';
                            ?>
                        >
                        <label for="member">Member (10% Discount)</label>
                    </div>
                    <div  class="form-check form-check-inline">
                        <input type="radio" name="member" id="member2" value="0"
                            <?php
                              echo isset($_POST['member']) && $_POST['member'] == '0' ? 'checked' : '';
                            ?>
                            >
                        <label for="member">Not a Member</label>
                    </div>
                </div>
            </div>



            <!-- for submit and reset buttons -->
            <div class="row justify-content-center mb-3">
                <div class="col-md-8">
                    <button type="submit" class="btn btn-primary me-2">Calculate</button>
                    <button type="button" class="btn btn-secondary me-2" onclick="clearAllData()">Reset All</button>
                </div>
            </div>
        </form>

        <!-- แสดงผลลัพธ์ -->
        <div class="card mx-auto mb-3" style="max-width: 500px;">
            <div class="card-header bg-info text-white text-center">
                <h5 class="mb-0">Show Result</h5>
            </div>
            <div class="card-body" id="result">
                <?php
                    // ตรวจสอบว่ามีการส่งข้อมูลผ่าน POST หรือไม่
                    if(isset($_POST['price'])&&isset($_POST['amount'])){
                        $price = $_POST['price'];
                        $amount = $_POST['amount'];

                        // ตรวจสอบว่าราคาและจำนวนเป็นตัวเลขหรือไม่
                        if(is_numeric($price) && is_numeric($amount)){
                            $price = floatval($price);
                            $amount = floatval($amount);
                            $total = $price*$amount; // คำนวณยอดรวม
                            $discount = $total * 0.1; // คำนวณส่วนลด 10%
                            
                            // ตรวจสอบว่ามีการเลือกสมาชิกหรือไม่
                            if(isset($_POST['member'])&&$_POST['member'] == '1'){
                                $total_paid = $total-$discount; // ถ้าเป็นสมาชิกจะหักส่วนลด
                                echo "<ul class='list-group list-group-flush'>";
                                echo "<li class='list-group-item'>ราคาสินค้า: <strong>" . number_format($price,2) . "</strong></li>";
                                echo "<li class='list-group-item'>จำนวนสินค้า: <strong>" . number_format($amount,2) . "</strong></li>";
                                echo "<li class='list-group-item'>ยอดซื้อรวม: <strong>" . number_format($total,2) . "</strong></li>";
                                echo "<li class='list-group-item'>ส่วนลดที่ได้: <strong>" . number_format($discount,2) . "</strong></li>";
                                echo "<li class='list-group-item text-primary'>ยอดที่ต้องจ่ายจริงหลังหักส่วนลด: <strong>" . number_format($total_paid,2) . "</strong></li>";
                                echo "</ul>";
                                
                            }else {
                                $total_paid = $total; // ถ้าเป็นสมาชิกจะหักส่วนลด
                                echo "<ul class='list-group list-group-flush'>";
                                echo "<li class='list-group-item'>ราคาสินค้า: <strong>" . number_format($price,2) . "</strong></li>";
                                echo "<li class='list-group-item'>จำนวนสินค้า: <strong>" . number_format($amount,2) . "</strong></li>";
                                echo "<li class='list-group-item'>ยอดซื้อรวม: <strong>" . number_format($total,2) . "</strong></li>";
                                echo "<li class='list-group-item text-primary'>ยอดที่ต้องจ่ายจริงหลังหักส่วนลด: <strong>" . number_format($total_paid,2) . "</strong></li>";
                                echo "</ul>";

                            }



                        }else{
                            echo "<div class='alert alert-danger text-center text-danger'>Please input valid numeric value for Price and Amount.</div>";
                        }



                    }else{
                        echo "<div class='alert alert-secondary text-center'>Please input Price and Amount.</div>";
                    }
                ?>
            </div>
        </div>

    </div>
    <script>
        function clearAllData() {
            document.getElementById('price').value = '';
            document.getElementById('amount').value = '';
            document.getElementById('member').checked = false;
            document.getElementById('member1').checked = true;
            document.getElementById('amount').value="";
        }
    </script>

    
    <hr>

    <button style="background-color:rgb(188, 246, 246); border: none; border-radius: 5px; padding: 8px; margin: 8px; "
	type="button" onclick="window.location.href='W01_Introphp.php'">
	<a href="index.php" style="color:rgb(128, 147, 255); text-decoration: none; font-size: 16px; font-weight: bold; ">Back to Home</a></button>

</body>
</html>
