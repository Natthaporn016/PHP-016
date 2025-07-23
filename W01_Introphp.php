<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
	<style>
		.result{
			color: blueviolet;
		}
		body{
			padding-left: 10px;
		}
		
	</style>
</head>
<body>
	<h1 style="color: brown;">Welcome To php Basic</h1>
	<p>This is a simple PHP application. </p>
	<hr>


    <h1 style="color: brown;">Basic PHP Syntax</h1>

    <pre>
        &lt;?php
        echo "Hello World";
		?&gt;
    </pre>

    <h3 style="color: blueviolet;">Result</h3>
	<hr>

	<div class="result">
		<?php
		echo "<span style='color: orange;'>Hello World</span> <br>";
		print   "<span style='color: pink;'>Natthaporn Tinmaolee</span>  ";
		?>
	</div>
	<hr>

	<h1 style="color: purple;">Basic PHP Syntax</h1>
	
	<pre>
        &lt;?php
        $greeting = "Hello World";
		echo $greeting;
		?&gt;
    </pre>

    <h3 style="color: plum;">Result</h3>
	  
	  
		<?php
			$greeting = "Hello World ";
			echo " <span style='color: orange;'>".$greeting."</span>  ";
		?>
	<hr>

	<h1 style="color:brown;">Integer Variable Example</h1>

	  <?php
	  $age = "20";
	  echo "<span '>My age is ".$age." years old. </span>  <br>";
	  ?>
	<hr>

	

	<h1 style="color:brown;">Calculator width Variable</h1>

	  <?php
	  $num1 = 4;
	  $num2 = 5;
	  $result = $num1+$num2;
	  
	  echo "the sum of $num1 and $num2 is $result";
	  ?>
	<hr>

	<h1 style="color:brown;">คำนวณพื้นที่สามเหลี่ยม</h1>

	  <?php
	  $num1 = "10";
	  $num2 = "5";
	  $result = $num1*$num2/2;
	  echo "พื้นที่สามเหลี่ยมมีขนาด $result ตารางหน่วย";
	  ?>
	<hr>


	<h1 style="color:brown;">คำนวณอายุจากปีเกิด</h1>

	  <?php
	  $thisyear = "2568";
	  $mybrith = "2547";
	  $result = $thisyear-$mybrith;
	  echo "อายุของฉันคือ $result ปี";
	  
	  ?>
	<hr>

	<h1 style="color: darksalmon;">IF-Else</h1>

	  <?php
	  $score = 75;
	  $score2 = 60;
	  if($score>$score2){
		echo "คะแนนสอบคือ $score คะแนน <br>";
		echo "คุณสอบผ่าน";
	  }
	  else{
		echo "คุณสอบไม่ผ่าน";
	  }

	  ?>

	<hr>

	<h1 style="color: brown;">Boolean Variable</h1>
	<!--ตรวจสอบว่าเป็น นักศึกษาหรือไม่-->
	  <?php
	  $student = true;

	  echo "<h3 style='color: indianred;'>คุณเป็นนักศึกษาใช่หรือไม่</h3>";
	  if(!$student){
		echo "ใช่";
	  }
	  else {
		echo "ไม่ใช่";
	  }

	  ?>

	<hr>

	<h1 style="color:brown;">Loop</h1>
	<h2 style="color: palevioletred;">Loop For</h2>
	<h3 style="color: pink;">แสดงตัวเลข 1-10 </h3>

	  <?php

	  
	  for($i=5; $i<=9; $i++){
		echo $i;
	  }
		
			
	  ?>


	  
	<hr>
	
	<h3 style="color: pink;">แสดงผลบวก </h3>

	  <?php

	  $sum=0;
	  for($i=5; $i<=9; $i++){
		$sum +=$i;
		if($i<9){
			echo "$i + ";
		}
		else
		echo "$i = $sum";
		
	  }
	  echo "<br>ผลลัพธ์คือ $sum";
	  
	  ?>


	  
	<hr>

	<h2 style="color: palevioletred;">While</h2>
	<h3 style="color: pink;">สูตรคูณแม่2</h3>

		<?php
		$j=1;
		while($j<=12){
			echo "2 x $j = ".($j*2)."<br>";
			$j++;
		}
		?>

	<hr>

 	<h2 style="color: palevioletred;">ตารางสูตรคูณแม่2</h2>
	<table style='border: 1px solid #ccc; align: center; color: #333;' class="table table-bordered table-striped w-auto m-auto text-center table-hover" >
		<tr style='background-color: #f2f2f2; align-items: center; '>
			<th >ลำดับ</th>
			<th >แม่2</th>
			<th>ผลลัพธ์</th>
		</tr>
		<?php
		$j=1;
		while($j<=12){
			echo "<tr '>";

			echo "<td style='text-align: center;  '> $j</td>";
			echo "<td style='text-align: center;'>2 x $j</td>";
			echo "<td style='text-align: center;'>".($j*2)."</td>";
			echo "</tr>";
			$j++;
		}
		
		?>

		<!-- ======================================================== -->
		<!-- ======================================================== -->
		<!-- ======================================================== -->
		<!-- ======================================================== -->

		
		
    
	

	</table>
	<hr>


	 <!-- ======================================================== -->
    <!-- ======================================================== -->
    <!-- ======================================================== -->
    <!-- ======================================================== -->

    <hr>
    <h2>สร้างตัวแปรอาเรย์ แบบที่ 1: Indexed Array</h2>
    <h5>PHP จะกำหนด index เป็นตัวเลขอัตโนมัติ โดยเริ่มจาก 0</h5>
    <hr>

    <!-- สร้างอาเรย์ของผลไม้ -->          
    <?php
        $fruits = ["Banana","Apple","Cherry"];
    ?>

    <h3>แสดงรายการผลไม้ โดยใช้ index</h3>
    <div style="color:blue; background-color: lightgray; padding: 10px;">
     <?php
        echo $fruits[0] . "<br>";
        echo $fruits[1] . "<br>";
        echo $fruits[2] . "<br>";
     ?>
     </div>
        <br>
<div style="color:red; background-color: lightgray; padding: 10px;">
     <?php
        echo "รายการผลไม้ : <br>";
        echo "ผลไม้ที่ 1 : " .$fruits[0] . "<br>";
        echo "ผลไม้ที่ 2 : " .$fruits[1] . "<br>";
        echo "ผลไม้ที่ 3 : " .$fruits[2] . "<br>";
     ?>
     
     
    </div>
    <br>

          <!-- ======================================================== -->
          <br>
    <h4>แสดงรายการผลไม้ โดยใช้ print readable</h4>
    <div style="color:blue; background-color: lightgray; padding: 10px;">
        <?php
            echo "รายการผลไม้: <br>";
            print_r($fruits); // แสดงผลอาเรย์ทั้งหมด  print readable
            echo "<br>";

        ?>
    </div>

           <!-- ======================================================== -->
           <br>
    <h4>แสดงจำนวนสมาชิกในอาเรย์</h4>
    <div style="color:blue; background-color: lightgray; padding: 10px;">
        <?php
            echo "จำนวนผลไม้: ". count($fruits) . "<br>";
            echo "<br>";

        ?>
    </div>

           <!-- ======================================================== -->
           <br>
    <h4>แสดงรายการผลไม้ โดยใช้ implode เพื่อแปลงอาเรย์เป็นสตริง</h4>
    <div style="color:blue; background-color: lightgray; padding: 10px;">
        <?php
            // แสดงรายการผลไม้และจำนวนสมาชิกในอาเรย์
            // ใช้ implode เพื่อแปลงอาเรย์เป็นสตริง และแสดงผลลัพธ์
            echo "รายการผลไม้: " . implode("- ", $fruits) . "<br>"; // ผลลัพธ์: Apple, Banana, Cherry
            echo "<br>";
        ?>
    </div>

        <!-- ======================================================== -->
        <br>
    <h4>แสดงรายการผลไม้ ใช้คำสั่ง foreach เพื่อวนลูป</h4>
    <div style="color:blue; background-color: lightgray; padding: 10px;">
        <?php
            // ใช้คำสั่ง foreach เพื่อวนลูปค่าใน array ทีละตัว โดยในแต่ละรอบ ตัวแปร $fruit จะเก็บค่าผลไม้ 1 ชนิด
            foreach($fruits as $fruit){
                echo "ผลไม้: $fruit <br>";
            }
     
            echo "<br>";
        ?>
    </div>

        <!-- ======================================================== -->
        <br>
    <h4>แสดงรายการผลไม้ ใช้คำสั่ง foreach เพื่อวนลูป</h4>
    <div style="color:blue; background-color: lightgray; padding: 10px;">
        <?php
            // ใช้คำสั่ง foreach เพื่อวนลูปค่าใน array ทีละตัว โดยในแต่ละรอบ ตัวแปร $fruit จะเก็บค่าผลไม้ 1 ชนิด
            foreach($fruits as $fruit){
               if($fruit == end($fruits)){
                echo "$fruit.";
               }else{
                echo "$fruit,";
               }
            }
     
            echo "<br>";
        ?>
    </div>

       <!-- ======================================================== -->
    <!-- ======================================================== -->
        
    <hr>
        <h2>สร้างตัวแปรอาเรย์ แบบที่ 2: Associative Array</h2>
        <h6>เป็น array ซ้อนกันหลายชุด (Multidimensional array)</h6>
        <h6>แต่ละชุดเป็น associative array ที่ระบุชื่อ key ชัดเจน เช่น "name" และ "price"</h6>
        <h6>ใช้สำหรับเก็บข้อมูลที่มีความสัมพันธ์กัน key => value เช่น รายการสินค้า</h6>


        <?php
            // สร้างอาเรย์ของผลไม้ที่มีชื่อและราคา
            $products = [
                ["name" => "Apple", "price" => 30],
                ["name" => "Banana", "price" => 20],
                ["name" => "Cherry", "price" => 15]
            ];
        ?>

           <!-- ======================================================== -->
    <br>
    <h4>แสดงรายการผลไม้ ใช้คำสั่ง key value</h4>
    <div style="color:blue; background-color: lightgray; padding: 10px;">
        <?php
            // แสดงผลลัพธ์ของการเข้าถึงข้อมูลในอาเรย์
            echo $products[0]["name"] . "<br>";  // Apple
            echo $products[2]["price"] . "<br>"; // 15

    
        ?>
    </div>

   <!-- ======================================================== -->
   <br>
    <h4>แสดงรายการสินค้า ใช้คำสั่ง foreach เพื่อวนลูป</h4>
    <div style="color:blue; background-color: lightgray; padding: 10px;">
        <?php
            $total_price = 0;
            foreach($products as $product){
                echo "สินค้า : $product[name] ราคา $product[price] บาท, <br>";
                 $total_price += $product['price'] ;
                // $total_price = $total_price + $product["price"] ;คำนวนราคารวม
                
            }
            echo "<br>";
            echo "ราคารวมของผลไม้ทั้งหมด $total_price ";
        ?>
    </div>
    
    	

	<button style="background-color: pink ; border: none; border-radius: 10px; padding: 10px; margin: 10px; "
	 type="button" onclick="window.location.href='W01_Introphp.php'">
	 <a href="index.php" style="color: yellow; text-decoration: none; font-size: 20px; font-weight: bold; ">Back to Home</a></button>




    
</body>
</html>