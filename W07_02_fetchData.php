
    <?php 
    require_once 'W07_01_ConnectDB.php';

    $sql = "SELECT * FROM `products`"; //ใช้ query() เพื่อรันคำสั่ง
    

    $result = $conn->query(query: $sql);
    // ตรวจสอบว่ามีผลลัพธ์หรือไม่
    if ($result->rowCount() > 0){
        //echo "<h2>พบข้อมูลในตาราง Product</h2>";
       // $data = $result->fetchAll(PDO::FETCH_NUM);
        //$data = $result->fetchAll(PDO::FETCH_ASSOC);
        //$data = $result->fetchAll(PDO::FETCH_BOTH);
        // แสดงข้อมูล
       // print_r($data);




       //ใช้prepared staement เพื่อป้องกันsql injjection
       //ใช้execute() เพื่อรันคำสั่งsql
       //ใช้fetch() เพื่อไปดึงข้อมูล
       //ใช้fetchAll() เพื่อไปดึงข้อมูลทั้งหมด
       //ใช้rowCount() เพื่อไปนับจำนวนแถว
       //ใช้bindParam() เพื่อ bind parameter
       //ใช้bindValue() เพื่อ bind value
       //ใช้lastInsertId() เพื่อไปดึง id ของแถวที่เพิ่มล่าสุด
       //ใช้beginTransaction() เพื่อเริ่ม transaction
       //ใช้commit() เพื่อ commit transaction
       //ใช้rollBack() เพื่อ rollback transaction
       //ใช้setAttribute() เพื่อ set attribute
       //ใช้getAttribute() เพื่อ get attribute
       
       $stmt = $conn->prepare($sql);
       $stmt->execute();
       $data = $stmt->fetchAll(PDO::FETCH_NUM);

       //echo "<br>";
       // echo "<pre>";
       //print_r($data);
       //echo "</pre>";

//echo"==============================================================================================================================================================================================";
       $stmt = $conn->prepare($sql);
       $stmt->execute();
       $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

       //echo "<br>";
        //echo "<pre>";
       //print_r($data);
       //echo "</pre>";

//echo"==============================================================================================================================================================================================";

        // แสดงผลข้อมูลที่ดึงมาด้วนjson
        header('Content-Type: application/json'); // ระบุ Content-Type เป็น JSON
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); // แปลงข้อมูลใน $arr เป็น JSON และแสดงผล
        
        
    }else{
       // echo "<h2>ไม่พบข้อมูลในตาราง Product</h2>";
    }
    


    
    













    ?>
   

