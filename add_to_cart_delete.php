  <?php 
	include("config.php");
	
	if(isset($_GET['delete_product'])){
	
	$delete_id = $_GET['delete_product'];
	
	$delete_product = "delete from addtocart where id='$delete_id'"; 
	
	$run_delete = mysqli_query($link, $delete_product); 
	
		if($run_delete){
			echo "<script>alert('A product has been deleted!')</script>";
				echo "<script>window.open('add_to_cart.php','_self')</script>";

		}
	
	}
?>