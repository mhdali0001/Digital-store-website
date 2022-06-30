
    <?php
       include("navbar-index.php");
    ?>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untitled</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
<style>

.small-text {
  font-size: 14px;
}
.button {
 background-color: #008CBA;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  width:200px;
}

.d0{
 float: left;
 width:10%;
color: white;
}

.d1{

 float:left;
 width:25%;

}

.d2{
 float: right;
 width:50%;
 margin-top:50px;
}
	
</style>

<div class="big-div">
 <?php 
include("config.php");

if(isset($_GET['product_id'])){

	$product_id = $_GET['product_id']; 
	
	$get_product = "select * from products where id='$product_id'";

	$run_product = mysqli_query($link, $get_product); 
	
	$row_product = mysqli_fetch_array($run_product); 
	
	$product_id = $row_product['id'];
	$product_name = $row_product['product_name'];
	$product_title = $row_product['product_title'];
	$product_price = $row_product['product_price'];
	$product_category = $row_product['product_category'];
	$product_image = $row_product['filename'];

	$product_description = $row_product['product_description'];

}


?>
<div class="d0">  ""  </div>
 
      <div class="d1">
        <img style="width:400px; height: 280px; margin: 50px;" src="<?php echo 'admin/upload/'.$product_image;?>">
      </div>




  <div class="d2">
      <h1><?php echo $product_name;?></h1>
      <p style=" color:grey">$<?php echo $product_price;?></p>
   

      <p class="small-text"><?php echo $product_title;?></p>

   

          <button class="button">Add to cart</button>

<p class="small-text" style="padding:10px;"><?php echo $product_description;?></p>

</div>
</div>

<br><br>
<br><br>
<br><br>
<br><br>
<br><br>

<br><br>
<br><br>

<?php 
include("footer.php");
?>
</body>
</html>