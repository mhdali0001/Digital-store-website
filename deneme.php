
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
<!DOCTYPE html>
<html>
<head>
<style>
body {
  margin: 0;
  font-size: 28px;
  font-family: Arial, Helvetica, sans-serif;
}

.header {
  padding-top : 15px;
}

#navbar {
  overflow: hidden;
  background-color: #333;
	width: 100%;
}

#navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

#navbar a:hover {
  background-color: #ddd;
  color: black;
}

#navbar a.active {
  background-color: #04AA6D;
  color: white;
}

input[type=text] {
  width: 400px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  background-color: white;
  background-position: 10px 10px; 
  background-repeat: no-repeat;
  padding: 12px 20px 12px 40px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
  width:  450px;
}
.searchform{
  float:left;
  width:  400px;
  hight: 50px;
  margin-top: 12px ;
  margin-left : 7%;
}	
#logo{
	width:200px;
	hieght:150px;
	float:left;
	margin-bottom: 20px;
	margin-left : 10%;
}
.left-navbar{
	margin-left:60%;
}
.Loginfoto{
	margin-right : 5%;
	margin-top :15px;
	hieght: 60px;
	width : 60px;
	float:right;
	text-align:center;
	
}

.Loginfoto img{
	width:50px;
	hieght:50px;
	border-radius: 50%;
}
.Loginfoto p{
	font-size:12px;
	margin-top : -5px;
}	



</style>
</head>
<body>

<div id="navbar">
  <a href="#">About Us</a>
  <a href="#">Contact Us</a>
  <a href="#">Privacy policy</a>
  <div class="left-navbar">
  <a  href="#">My Account</a>
  <a  href="#">feedback</a>
  <a  href="#">Shopping Cart</a>
  </div>
</div>
<div class="header">
    <img id="logo" src="logo.png"/>
	<div class="searchform">
		<form class="searchform">
			<input type="text" name="search" placeholder="Search..">
		</form>
	</div>
	<div class="Loginfoto">
		<img src="image/basket.png"/>
		<p>add to cart</p>

	</div>
	<div class="Loginfoto">
		<img src="image/login.png"/>
		<p>Login</p>
	</div>
	<div class="Loginfoto">
		<img src="image/signup.png"/>
		<p>register</p>
	</div>

</div>

<div id="navbar">
  <a class="active" href="#">Home</a>
  <a href="#">Networking</a>
  <a href="#">Computers</a>
  <a href="#">Printers</a>
  <a href="#">honeywell</a>
  <a href="#">Epsone</a>
  <a href="#">Xerox</a>
  <a href="#">Special offers</a>
  <a href="#">All Brands</a>
  <a href="#">Online Services</a>


</div>
  <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Name surname</label>
                <input type="text" name="name" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
			<div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control <?php echo (!empty($Email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Email; ?>">
                <span class="invalid-feedback"><?php echo $Email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    



</body>
</html>