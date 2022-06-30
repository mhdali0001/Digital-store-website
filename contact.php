<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $subject = $email = $massege = "";
$name_err = $psubject_err = $email_err = $massege_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["name"]))){
        $name = "Please enter a name.";
    }else{
        // Prepare a select statement
        $name = trim($_POST["name"]);

    }
    
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";     
	}else{
        $email = trim($_POST["email"]);
  
	}
	
    // Validate subject
    if(empty(trim($_POST["subject"]))){
        $subject_err = "Please enter a subject.";     
	}else{
        $subject = trim($_POST["subject"]);
    }
	// Validate subject
	if(empty(trim($_POST["massege"]))){
        $massege_err = "Please enter a massege.";     
	}else{
        $massege = trim($_POST["massege"]);
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($Email_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO contact (name,email, subject , massege) VALUES (?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_name,$param_email, $param_subject, $param_massege);
            
            // Set parameters
            $param_name = $name;
			$param_email = $email;
			$param_subject = $subject;
            $param_massege = $massege;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: index.php");
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

<style>


input[type=text], select, textarea {
  width: 90%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-bottom: 16px;
  resize: vertical;
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
  background-color: #333;
  padding: 20px;
}
#foto{
	background: url(back.jpg);
	width:100%;
	padding: 50px;

}
</style>

<div  id="foto">
	<div class="container">
			<center>
		<h4 style="color:white;">Contact Us</h4>
		</center>
	  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<label for="fname" style="color: white;">Name:</label><br>
		<input type="text" id="fname" name="name" placeholder="Your name.."><br>

		<label for="lname" style="color: white;">Email:</label><br>
		<input type="text" id="lname" name="email" placeholder="Your last Email.."><br>

		<label for="lname" style="color: white;">Subject:</label><br>
		<input type="text" id="lname" name="subject" placeholder="Subject.."><br>


		<label for="subject" style="color: white;">Message:</label><br>
		<textarea id="subject" name="massege" placeholder="Write something.." style="height:200px"></textarea><br>
		<center>
		<input type="submit" value="Submit">
		</center>
	  </form>
	</div>
</div>
<?php 
include("footer.php");
?>
</body>
</html>