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
  <a href="index.php?about_us">About Us</a>
  <a href="contact.php">Contact Us</a>
  <a href="index.php?privacy_policy">Privacy policy</a>
  <div class="left-navbar">
  <a  href="login.php">My Account</a>
  <a  href="feedback.php">feedback</a>
  <a  href="login.php">Shopping Cart</a>
  </div>
</div>
<div class="header">
    <img id="logo" src="image/log.jfif"/>
	<div class="searchform">
		<form class="searchform">
			<input type="text" name="search" placeholder="Search..">
		</form>
	</div>
	<div class="Loginfoto">
		<a href="login.php">
		<img src="image/basket.png"/>
		</a>
		<p>add to cart</p>

	</div>
	<div class="Loginfoto">
		<a href="login.php">
		<img src="image/login.png"/>
		</a>
		<p>Login</p>
	</div>
	<div class="Loginfoto">
		<a href="register.php">
		<img src="image/signup.png"/>
		</a>		
		<p>register</p>
	</div>

</div>

<div id="navbar">
  <a class="active" href="index.php?home">Home</a>
  <a href="index.php?networking">Networking</a>
  <a href="index.php?computers">Computers</a>
  <a href="index.php?printers">Printers</a>
  <a href="index.php?honeywell">honeywell</a>
  <a href="index.php?epsone">Epsone</a>
  <a href="index.php?xerox">Xerox</a>
  <a href="index.php?special_offers">Special offers</a>
  <a href="index.php?online_services">Online Services</a>


</div>



</body>
</html>