<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loop for Show Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">

    <!-- DataTable CSS -->
    <link href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" rel="stylesheet">
 

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    
    <Style>
        .container{
            max-width: 800px;

        }

    </Style>

</head>
    <body>
    <?php
            $products = [
                ['id'=>1001,'name'=>'apple','price'=>40,'quantity'=>20],
                ['id'=>1002,'name'=>'banana','price'=>25,'quantity'=>30],
                ['id'=>1003,'name'=>'grape','price'=>90,'quantity'=>15],
                ['id'=>1004,'name'=>'orange','price'=>70,'quantity'=>25],
                ['id'=>1005,'name'=>'pineapple','price'=>60,'quantity'=>10],
                ['id'=>1006,'name'=>'mango','price'=>70,'quantity'=>18],
                ['id'=>1007,'name'=>'papaya','price'=>45,'quantity'=>12],
                ['id'=>1008,'name'=>'watermelon','price'=>80,'quantity'=>8],
                ['id'=>1009,'name'=>'kiwi','price'=>100,'quantity'=>5],
                ['id'=>1010,'name'=>'strawberry','price'=>120,'quantity'=>6],
                ['id'=>1011,'name'=>'blueberry','price'=>150,'quantity'=>4],
                ['id'=>1012,'name'=>'peach','price'=>70,'quantity'=>14],
                ['id'=>1013,'name'=>'pear','price'=>65,'quantity'=>11],
                ['id'=>1014,'name'=>'plum','price'=>75,'quantity'=>9],
                ['id'=>1015,'name'=>'dragonfruit','price'=>95,'quantity'=>7],
            ];

    

    // foreach($Products as $product){
    //     echo $product['id']. " สินค้า: ". $product["name"]. " ราคา ". $product["price"]." บาท. จำนวน ".  $product["quantity"]." ชิ้น <br>";
       
    // }

  
    ?>
        <div class="container mt-5">
            <h1>Product List</h1>

            <form action="" method="post" class="mb-3">
                <div>
                    <input type="number" name="price" placeholder="Enter Price" class="form-control mb-2 " >
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>

            <table id="productTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>

                <tbody>

                        <?php

                            // Check if form is submitted
                            if (isset($_POST['price']) && !empty($_POST['price'])) {
                                $filterPrice = $_POST['price'];
                                $filteredProducts = array_filter($products, function($product) use ($filterPrice) {
                                    return $product['price'] == $filterPrice;
                                });

                                $filteredProducts = array_values($filteredProducts);


                            }else{
                                $filteredProducts = $products;
                            };


                            foreach($filteredProducts  as $index=> $product){
                                        
                                echo "<tr>";
                                echo "<td>". ($index+1) . "</td>";
                                echo "<td>". $product['id']. "</td>";
                                echo "<td>". $product["name"]. "</td>";
                                echo "<td>". $product["price"]. "</td>";
                                echo "<td>". $product["quantity"]. "</td>";
                                
                                echo "</tr>";
                            }
                        ?>

                    
                </tbody>
            </table>

            
        </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

    <script>
        let table = new DataTable ('#productTable')
    </script>



    <button type="button" class="btn btn-info text-light mx-5 mt-3">
        <a href="index.php" class="text-light text-decoration-none">Back to Home</a>
    </button>
    
</body>
</html>