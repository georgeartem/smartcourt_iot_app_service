<?php
$dbhost = "db.previousk.com";
$dbuser = "georgeartem";
$dbpass = "Blahblah87";
$dbname = "smartcourt";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if(mysqli_connect_errno()) {
		die("Database connection failed:" . mysqli_connect_error() . "(" . mysqli_connect_errno(). ")");
	}
?>
<?php	
if($_GET["key"]=="smartcourtdata")
{
	$query = "INSERT INTO court_status (locationid, courtid, status)
	VALUES('{$_GET["locationid"]}', '{$_GET["courtid"]}', '{$_GET["status"]}')
	";
	$result = mysqli_query($connection, $query);
	if(!result){
		die("Database query failed.");
	}
}
?>	

<!DOCTYPE HTML>
<html>
<head>

<title>PreviousK | SMART COURT - WRITE TO MySQL by George Artem</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="George Artem: a CV of Poetry & Projects" />
    <meta name="author" content="George Artem">
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="icon" type="image/icon" href="../images/kicon.gif" />
    <link href="../../css/bootstrap.min.css" rel="stylesheet" />    
    <link href="../../style.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/prettyPhoto.css" type="text/css" media="screen" />    
	<link href="../../css/jquery.bxslider.css" rel="stylesheet" />
    <link href="../../css/font-awesome.min.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css' />    
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
   
   <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js'></script>    
    <script src="../../js/jquery.sticky.js"></script>	
    <script src="../../js/styleswitcher.js" type="text/javascript"></script>    
	<script src="../../js/jquery.easing-1.3.pack.js" type="text/javascript"></script>
	<script src="../../js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../../js/jquery.parallax-1.1.3.js" type="text/javascript"></script>
	<script src="../../js/appear.js" type="text/javascript" ></script>
	<script src="../../js/modernizr.js" type="text/javascript"></script>
	<script src="../../js/jquery.prettyPhoto.js" type="text/javascript"></script>
    <script src="../../js/isotope.js" type="text/javascript"></script>
    <script src="../../js/jquery.bxslider.min.js"></script>
    <script src="../../js/jquery.cycle.all.js" type="text/javascript" charset="utf-8"></script>
	<script src="../../js/jquery.maximage.js" type="text/javascript" charset="utf-8"></script>
    <script src="../../js/sscr.js"></script>
    <script src="../../js/skrollr.js"></script>
    <script src="../../js/jquery.jigowatt.js"></script>   
	<script src="../../js/scripts.js" type="text/javascript"></script>
 </head>

<body data-spy="scroll" data-target=".navbar" data-offset="75">
	
<!-- Navigation -->
<div id="navigation" class="navbar navbar-fixed-top">
		<div class="navbar-inner ">
        	<div class="container no-padding">
					<a class="show-menu" data-toggle="collapse" data-target=".nav-collapse">
						<span class="show-menu-bar"></span>
					</a>

					<div id="logo"><a class="external" href="index.html"></a></div>
					<div class="nav-collapse collapse">
					<ul class="nav">
							<li class="menu-1"><a class="colapse-menu1" href="../../index.html">Home</a></li>
							<li class="menu-6"><a class="colapse-menu1" href="../index.html">SMART COURT</a></li>
							<li class="menu-6"><a class="colapse-menu1" href="../../index.html#contact-parallax">Contact</a></li>
							</ul>
						</div>
					</div>
			</div>
	</div>
    <!--/Navigation -->
<!-- Home -->
		<section id="home">
 
			<div class="container">
        
                	<div class="section-title">
				<h1>WRITE COURT DATA</h1>      
 <span class="border"></span>				
			<br/>
				<p> <a href="http://www.previousk.com/smartcourt/api/smartcourtgetdata.php">Get Court Data </a></p>
        <p>Court data is sent here from the devices and inserted into mySQL </p>
<p>Data to be inserted:</p>
<pre>
<?php 
 print_r($_GET); ?>
</pre>
                       
                    
                    </div>
                
               
            
        	</div>

 <footer>
		<div class="container no-padding">
        	
            <a id="back-top"><div id="menu_top"><div id="menu_top_inside"></div></div></a>
            
            <ul class="socials-icons">
                <li><a href="https://www.facebook.com/metacampusllp"><img src="../../images/facebook.png" alt="" /></a></li>
                <li><a href="https://twitter.com/GeorgeArtem"><img src="../../images/twitter.png" alt="" /></a></li>
                <li><a href="https://plus.google.com/116311611803861697621/posts"><img src="../../images/google.png" alt="" /></a></li>
            </ul> 
            
			<p class="copyright">2015 &copy; George Artem. All rights reserved.</p>
            
		</div>
	</footer>
	<!--/Footer -->
</body>
</html>
<?php mysqli_close($connection);?>