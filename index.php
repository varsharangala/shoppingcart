<?php
// session
session_start();

require_once ('php/CreateDb.php');
require_once ('./php/comp.php');

//db class
$database=new CreateDb("productdb","producttb");

if(isset($_POST['add'])){
  ///print_r($_POST['product_id']);
  if(isset($_SESSION['cart'])){
      $item_array_id =array_column($_SESSION['cart'],"product_id");

      if(in_array($_POST['product_id'],$item_array_id)){
          echo "<script>alert('product is already added in the cart....!')</script>";
          echo"<script>window.location='index.php'</script>";
      }else{
         $count= count($_SESSION['cart']);
          $item_array=array(
              'product_id'=>$_POST['product_id']
          );
          $_SESSION['cart'][$count]=$item_array;

      }
  }else{
      $item_array=array(
          'product_id'=>$_POST['product_id']
      );
      //create session
      $_SESSION['cart'][0]=$item_array;
      print_r($_SESSION['cart']);

  }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shopping</title>
    <!--awesome font-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" >

    <!--//bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
require_once ("php/header.php");
?>
<div class="container">
    <div class="row text-center py-5">
        <?php
         $result=$database->getData();
         while($row=mysqli_fetch_assoc($result)){
             comp($row['product_name'],$row['product_price'],$row['product_image'],$row['id']);
         }
        ?>

    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>