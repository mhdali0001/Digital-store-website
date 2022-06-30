	
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
	width:20%;
  margin: 30px;
  text-align: center;
  font-family: arial;
}

.price {
  color: grey;
  font-size: 18px;
}
.card h3{
	color: #000;
}	
.card h3:hover {
	color: #000;
}	
.card a:link{
	text-decoration: none;

}
.card button {
  border: none;
  outline: 0;
  padding: 15px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 60%;
  font-size: 13px;
}

.card button:hover {
  opacity: 0.7;
}



.divs{
  padding: 15px;
  display: flex;
  flex-flow: row wrap;
}


</style>	
	<div class="divs-top">	
	<div class="divs"> 
<?php 
	include("config.php");
		
	
	$sql = "select * from products where product_category=12";
	$result = $link->query($sql); 
	
	$i = 0;
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()){
			
			$id = $row['id'];
			$product_name = $row['product_name'];
			$filename = 'admin/upload/'.$row['filename'];
			$product_title = $row['product_title'];
			$product_category = $row['product_category'];
			$product_price = $row['product_price'];			
			$product_special = $row['product_special'];
			$product_description = $row['product_description'];
			$i++;

	if($i== 20 ){break;}
	
	?>
  
	<div class="card" >
	  <img src="<?php echo $filename;?>"  alt="" style="width:100%">
	  <a href="details.php?product_id=<?php echo $id;?>"><h3><?php echo $product_name; ?></h3></a>
	  <p class="price"><?php echo $product_price;?> $</p>
	  <a href="add_to_cart.php?product_id=<?php echo $id;?>"><button >Add to Cart</button></a>
	</div>

	<?php } 
	}
	?>
</div>
</div>

<br>
<br>
<br>

