<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    

  
    $host ='localhost';
    $username ='root';
    $password = '';
    $database = 'online_shop';

      $dns = "mysql:host=$host;dbname=$database";

    try{
          $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // echo "PDO: Connected successfully";
        
      
    }catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }








    ?>

   

    
</body>
</html>