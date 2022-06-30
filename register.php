<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $Email = "";
$username_err = $password_err = $Email_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["name"]))){
        $username_err = "Please enter a name.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["name"]))){
        $username_err = "name can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $username = trim($_POST["name"]);

    }
    
    if(empty(trim($_POST["email"]))){
        $Email_err = "Please enter a email.";     
    } elseif(strlen(trim($_POST["email"])) < 8){
        $Email_err = "email must have atleast 6 characters.";
    } else{
		$sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_Email);
            
            // Set parameters
            $param_Email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $Email_err = "This Email is already used.";
                } else{
                    $Email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
		}
	}
	
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
	$datee = date("Y/m/d");
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($Email_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (name,email,password,date) VALUES (?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username,$param_Email, $param_password , $param_datee);
            
            // Set parameters
            $param_username = $username;
			$param_Email = $Email;
			$param_datee = $datee;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
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

input[type=email],input[type=password],input[type=text], select, textarea {
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
    margin-top: 8%;
  background-color: #333;
  padding: 20px;
}
.container img{
	width: 150px;
	margin-top :-100px;
	
}
.container label{
	margin-left :5%;
	
}
#foto{
	background: url(image/sky.jpg);
	width:100%;
	padding: 50px;

}
    </style>
<div id="foto">   
  <div class="container">
        <center>
		<img align="center" src="image/profil.png" class="avatar">
        <h4 style="color: white;">Sign Up</h4>
        <h6 style="color: white;">Please fill this form to create an account.</h6>
		</center>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label style="color: white;">Name-surname:</label><br><br>
                <input type="text" name="name" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
			<div >
                <label style="color: white;">Email:</label><br><br>
                <input type="email" name="email" class="form-control <?php echo (!empty($Email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Email; ?>">
                <span class="invalid-feedback"><?php echo $Email_err; ?></span>
            </div>
            <div>
                <label style="color: white;">Password:</label><br><br>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <center>

			<div>
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <p style="color: white;">Already have an account? <a style="color: white;" href="login.php">Login</a></p>
			</center>

		</form>
    </div>    
</div>

<?php 
include("footer.php");
?>
</body>
</html>