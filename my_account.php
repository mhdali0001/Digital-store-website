    <?php

// Initialize the session
		session_start();
		 

       include("navbar-welcome.php");
    ?>
    <style>
	
* {box-sizing: border-box;}

input[type=email],input[type=Name],input[type=password], select, textarea {
  width: 75%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-bottom: 16px;
  resize: vertical;
  margin-left:10%;
}

input[type=submit] {
  background-color: rgb(0, 153, 153);
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
input[type=sub] {
  background-color: rgb(0, 153, 153);
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
}
input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  width: 50%;
  margin-left: 25%;
    margin-top: 5%;
  background-color: #333;
  padding: 20px;
}
.container img{
	width: 150px;
	margin-top :-100px;
	
}
.container p{
	margin-left :10%;
	
}
#foto{
	background: url(image/sky.jpg);
	width:100%;
	padding: 50px;

}
    </style>
 <?php 

		include("config.php");

	$user_id = $_SESSION["id"]; 
	$user_name = $_SESSION['name'];
	$user_email = $_SESSION['email'];




?>
<div  id="foto">
    <div class="container">
        <center>
		<img align="center" src="profil.png" class="avatar">
        <h4 style="color: white;">Account : </h4>
		</center>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div >
                <p style="color: white;">Name:</p>
                <input type="Name" name="Name" class="form-control" value="<?php echo $user_name; ?>">
            </div>    
            <div >
                <p style="color: white;">Email:</p>
                <input type="email" name="Email" class="form-control" value="<?php echo $user_email; ?>">
            </div>
            <center>

			<div >
                <input type="submit" class="btn btn-primary" name="update_user" value="Update">

              <a href="reset-password.php">  <input type="sub"  class="btn btn-primary" value="reset Password"></a>
            </div>
			<br>
			</center>

	   </form>
    </div>
</div>
<?php 


	if(isset($_POST['update_user'])){
	

	
	$new_name = $_POST['Name'];
	$new_email = $_POST['Email'];
	
	
	$update_user1 = "update users set name='$new_name' , email='$new_email' where id='$user_id'";

	$run_user1 = mysqli_query($link, $update_user1); 
	
	if($run_user1){
	echo "<script>alert(' user has been updated!')</script>";
	echo "<script>window.open('welcome.php','_self')</script>";
	}
	}

?>

<?php 
include("footer.php");
?>
</body>
</html>