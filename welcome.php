    <?php

// Initialize the session
		session_start();
		 
		// Check if the user is logged in, if not then redirect him to login page
		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
			header("location: login.php");
			exit;
		}
       include("navbar-welcome.php");
    ?>


	<div >
	 <?php
			if (isset($_GET['home'])){
				include("home.php");

			}else if (isset($_GET['networking'])){
				include("networking.php");

			}else if (isset($_GET['computers'])){
				include("computers.php");

			}else if (isset($_GET['honeywell'])){
				include("honeywell.php");
			
			}else if (isset($_GET['printers'])){
				include("printers.php");

			}else if (isset($_GET['xerox'])){
				include("xerox.php");

			}else if (isset($_GET['epsone'])){
				include("epsone.php");

			}else if (isset($_GET['special_offers'])){
				include("special_offers.php");
			
			}else if (isset($_GET['all_brands'])){
				include("all_brands.php");
			
			}else if (isset($_GET['online_services'])){
				include("online_services.php");
			
			}else if (isset($_GET['add_to_cart'])){
				include("add_to_cart.php");
			
			}else if (isset($_GET['about_us'])){
				include("about_us.php");
			
			}else if (isset($_GET['privacy_policy'])){
				include("privacy_policy.php");
			
			}else if (isset($_GET['logout'])){
				include("logout.php");

			}else if (isset($_GET['details'])){
				include("details.php");
			}else{include("home.php");}
			include("footer.php");

    ?>
	
</div>

</body>
</html>