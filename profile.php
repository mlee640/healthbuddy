<!DOCTYPE html>

<?php
include "config.php";

 	if (session_status() == PHP_SESSION_NONE) {  // NEED THIS chunk TO PASS THE 'p0x' ID to different pages
    	session_start();
			} 
			echo $_SESSION['uname'];
		?>

<html>
<head><link href="css/projectStyle.css" type = "text/css" rel="stylesheet">
<link rel="stylesheet/less" type="text/css" href="css/sleepGraph.css" />
<script src="https://cdn.jsdelivr.net/npm/less@4.1.1" ></script>
<title>Dashboard</title>
</head>

<body>
	<header>
    <img src="images/siteName.png" width="450" height="100"/>



	</header>
	<nav>
		<a href="index.php">Dashboard</a>
  		<a href="profile.php">Profile</a>
 	 	<a href="monitoring.php">Monitoring</a>
    <a href="active.php">Summaries</a>
	</nav>
	<br>
	<br>


 <! --- Profile Details (General table)--- >

	<img src="images/profile.png" width="150" height="150" class= "profilepic"/>
	<aside class = "profile">
	<h2>
			<?php
				$query = "SELECT * FROM GeneralData WHERE id = '". $_SESSION['uname'] . "'";
				mysqli_query($db, $query) or die('Error querying database.');
				$result = mysqli_query($db, $query);
				$row = mysqli_fetch_array($result);


	 			echo $row['firstName'] . ' ' . $row['surname'];
	 		?>
		</h2>
		<p>
		<?php
				echo  '<p> <b class = "greenTitle">Age: </b>' . $row['age'] . '</p> ';
				echo  '<p> <b class = "greenTitle">Gender: </b>' . $row['gender'] . '</p> ';
				echo  '<p> <b class = "greenTitle">Height: </b>' . $row['height'] . 'cm</p> ';


		?>
		</p>
	</aside>
	
	<!---- Logout CSS design button---->
	
		<style> 
		input[type=submit] { 
 				background-color: #9fc69f;
  				color: black;
  				font-weight: bold;
  				padding: 14px 20px;
  				margin: 8px 0;
  				border: none;
  				border-radius: 4px;
  				cursor: pointer;
				float: right;
				}

		input[type=submit]:hover {
  				background-color: #45a049;
  				
  				
				}
	 </style>
	 <!---- Logout button---->
	<section>
	 
	 		<?php

				include "config.php";

				// Check user login or not
				if(!isset($_SESSION['uname'])){
    			header('Location: login.php');
				}

				// logout
				if(isset($_POST['but_logout'])){
    			session_destroy();
    			header('Location: login.php');
				}
			?>

        <form method='post' action=""  class ="logout">
            <input type="submit" value="Logout" name="but_logout">
        </form>
        
        
	</section>

</body>



</html>
