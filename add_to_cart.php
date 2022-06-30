<?php 
include("config.php");

function getIp()
{
    $ip = $_SERVER['REMOTE_ADDR'];
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    return $ip;
}
	$host_id = getIp();
if(isset($_GET['product_id'])){
	$host_id = getIp();
	$products_id = $_GET['product_id']; 

	$insert_product = "insert into addtocart(host_id,products_id)
	values('$host_id','$products_id')";
    $insert_pro = mysqli_query($link, $insert_product);

}


	
?>
<?php 
include("navbar-welcome.php");
?>

<br/>
<center><h1>CART</h1></center>
<table width="55%" align="center"> 

	

	
	<tr align="center"  bgcolor="#4a5c6d">
		<th bgcolor="#4a5c6d">Id</th>
		<th bgcolor="#4a5c6d">products Name</th>
		<th>Image</th>
		<th>products category</th>
		<th>products price</th>
		<th>delete</th>

	</tr>
	<?php 	
	$sqll = "select * from addtocart where host_id='$host_id'";
	$resultl = $link->query($sqll); 
	$count = 0;
	$i = 0;
	if ($resultl->num_rows > 0) {
		while ($row1 = $resultl->fetch_assoc()){
		$produc_id = $row1['products_id'];
		$id = $row1['id'];
		$sql = "select * from products where id=$produc_id";
		$result = $link->query($sql); 
		
		
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()){

			$product_name = $row['product_name'];
			$filename = 'admin/upload/'.$row['filename'];
			$product_category = $row['product_category'];
			$product_price = $row['product_price'];			
			$i++;
			$count += $product_price;
	
	?>
	<tr align="center">
		<td><?php echo $i;?></td>
		<td><?php echo $product_name; ?></td>
		<td><img width="100" src="<?php echo $filename;?>" ></td>
		<td><?php echo $product_category;?></td>
		<td><?php echo $product_price;?></td>		
		<td>
		<a href="add_to_cart_delete.php?delete_product=<?php echo $id;?>"><img src="image/delete.png" width="40" ></a>
		</td>
	</tr>
	<?php 	} 
		}
	}
}
	?>
			<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Total:</td>		
		<td>
			<?php echo $count;?>
		</td>
</table>


 <?php 

	if (isset($_POST['insert_order'])) {
	
    $personal_name = $_POST['namel'];
    $personal_Email = $_POST['Email'];
    $personal_Number = $_POST['Number'];
    $personal_Address = $_POST['Address'];


    $insert_product = "insert into orders(host_id,name,email,number,address) 
    values('$host_id','$personal_name','$personal_Email','$personal_Number','$personal_Address')";

    $insert_pro = mysqli_query($link, $insert_product);
		if($insert_pro){
	echo "<script>alert(' the order is taked!')</script>";
	echo "<script>window.open('welcome.php?home','_self')</script>";
	}

}
?>






 <br><br><br><br>
  <form class="add_item" action=" " method="post" >
                        <table  align="center">
                            <h1>Complete the order:</h1>

							<tr>
                                <td>Name-surname:</td>
                                <td><label>
                                        <input type="text" name="namel" size="60%" />
                                    </label></td>
                            </tr>
							<tr>
                                <td>Email:</td>
                                <td><label>
                                        <input type="email" name="Email" cols="30" rows="5"/>
                                    </label></td>
                            </tr>


                            <tr>
                                <td>Phone Number:</td>
                                <td><label>
                                        <input type="number" name="Number" />
                                    </label></td>
                            </tr>

                            <tr>
                                <td>Address:</td>
                                <td><label>
                                        <textarea name="Address" cols="40" rows="10"></textarea>
                                    </label></td>
                            </tr>


                            <tr>
                                <td colspan="17"><input type="submit" name="insert_order" value=" Send "/></td>
                            </tr>
                        </table>
                    </form>
<?php 
include("footer.php");
?>
</body>
</html>