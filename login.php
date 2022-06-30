<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: welcome.php?home");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$Email = $password = "";
$Email_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["email"]))){
        $Email_err = "Please enter Email.";
    } else{
        $Email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($Email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id , name ,email , password FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
			

            mysqli_stmt_bind_param($stmt, "s", $param_Email);
            
            // Set parameters
            $param_Email = $Email;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id ,$name, $Email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
							$_SESSION["name"] = $name;
							$_SESSION["email"] = $Email;							
                            
                            // Redirect user to welcome page
                            header("location: welcome.php?home");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid Email .";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
    <?php
       include("navbar-index.php");
    ?>
    <style>
	
* {box-sizing: border-box;}

input[type=email],input[type=password], select, textarea {
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

<div  id="foto">
    <div class="container">
        <center>
		<img align="center" src="profil.png" class="avatar">
        <h4 style="color: white;">Login</h4>
		</center>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div >
                <p style="color: white;">Email:</p>
                <input type="email" name="email" class="form-control <?php echo (!empty($Email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Email; ?>">
                <span><?php echo $Email_err; ?></span>
            </div>    
            <div >
                <p style="color: white;">Password:</p>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span ><?php echo $password_err; ?></span>
            </div>
            <center>

			<div >
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
			<br>
            <a  style="color: white;">Don't have an account? <a style="color: white;" href="register.php">Sign up now</a>.</a>
			</center>

	   </form>
    </div>
</div>
<?php 
include("footer.php");
?>
</body>
</html>