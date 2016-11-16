<?php
if(!isset($targetContent)) {
	$targetContent = "include/static/index.php";
}

?><!DOCTYPE html>
<html>
	<head> 
	<title>Checkers</title>
	  <meta charset="utf-8">
	  <link rel="stylesheet" type="text/css" href="css/style.css">
	  <script src="js/library.js"></script>
	</head>
    <body onload="<?php 
    foreach ($JavascriptInit as $initFunction) {
		echo $initFunction."; ";
	}
    ?>">
	<div id="wrapper">
<div id="header">
	<ul>
		<li><FONT COLOR="#FFFFFF"><a href="index.php">Home</a></FONT></li>
		<li><a href="rules.php">Rules</a></li>
		<li><a href="contact.php">Contact us</a></li>
		<li>
			<?php 
				if(!empty($_SESSION['email'])) { ?>
				<a href="logout.php">Logout</a>
				<?php
				} else { ?>
				<a href="login.php">Login</a>
				<?php
				}
				
			?>
		</li>
</ul>
</div>

<div id="divClock">
				<span id="spanClock"></span>
</div>

	<h1 class="title">CHECKERS</h1>
	

	 
	<div id="welcome">
<h2>Players Welcome!</h2>
	</div>
	
	<div id="logo">
				<a href="index.php"><img src="images/logo.jpg" width="80" height="80"></a>
	</div>
  </div>
  
<div id="side">
 <ul>
	<li><FONT COLOR="#FFFFFF"><a href="index.php">View Games</a></FONT></li>
	<li><a href="profile.php">Profile</a></li>
	<li><a href="users.php">Players</a></li>
	<li><a href="register.php">Register</a></li>
</ul>
</div>
 

 <div id="content">
	<?php include_once $targetContent ;?>
</div>
		
<div class="footer">
 <div id="footer">
       <ul>
        	<li><a href="privacy.php">Privacy Statement</a></li>
			<li><a href="contact.php">Contact us</a></li><
        
	<div id="browser">
       	<p>Designed for use with: <a href="http://www.mozilla.com"><img src="images/firefox.png"/></a>
	</div>
      	</ul>
</div>
</div>

</body>
 
</html>