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
<link href="css/monitoring.css" type = "text/css" rel="stylesheet">
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


   <! --- Sleep Duration Graph (Wellness table)--- >

  			<h2><b>Hours of Sleep</b></h2>	<br>
<section class = 'graph'>

			<br>
			<br>
  			<h4 class = 'title'>This week:</h4>
  				<br>
  				<?php

  			$query = "SELECT q.* FROM (SELECT * FROM Wellness" . $_SESSION['uname'] . " ORDER BY effective_time_frame DESC LIMIT 8) q ORDER BY q.effective_time_frame ASC";
  			mysqli_query($db, $query) or die('Error querying database.');


  			$result = mysqli_query($db, $query);
  			$row = mysqli_fetch_array($result);
  			$days = array("Mon", "Tues", "Wed", "Thurs", "Fri", "Sat", "Sun");
  			$counter = 0;

  			while ($row = mysqli_fetch_array($result)) {
   				echo '<section class="bar-graph bar-graph-vertical bar-graph-two">
    						<div class="bar-one bar-container">
      					<div class="bar" data-percentage ="' .$row['sleep_duration_h'] . '"' . 'style="--bar-value:'.$row['sleep_duration_h']*10 .'%;"></div>
      					<span class="year">' . $days[$counter] . '</span></div>';
    				$counter = $counter + 1;

  					}
  				?>


</section>

			<br>
			<br>

	<p> <i class="arrow right"></i></p>
	<i class="arrow right"></i>


<aside>


<div class = "averages">
<h4><b>Sleep Averages</b></h4>
<br>

  				<?php

  			$query = "SELECT sleep_duration_h FROM Wellness" . $_SESSION['uname'] . " ORDER BY effective_time_frame DESC LIMIT 28";
  			mysqli_query($db, $query) or die('Error querying database.');
  			$result = mysqli_query($db, $query);
  			$row = mysqli_fetch_all($result, MYSQLI_ASSOC);

    			foreach ($row as $key => $value){
      			foreach ($value as $k => $v){
       				 $day += $v;


      				}
   				 }
   				 	$avgMonth = ceil($day / 28);
    				echo '1-Month: ' . $avgMonth .  ' hours<br>';

  			?>
			<br>
			<br>
  				<?php

  			$query = "SELECT sleep_duration_h FROM Wellness" . $_SESSION['uname'] . " ORDER BY effective_time_frame DESC LIMIT 85";
  			mysqli_query($db, $query) or die('Error querying database.');
  			$result = mysqli_query($db, $query);
  			$row = mysqli_fetch_all($result, MYSQLI_ASSOC);

    			foreach ($row as $key => $value){
      			foreach ($value as $k => $v){
       				 $day += $v;


      				}
   				 }
   				 	$avgMonth = ceil($day / 85);
    				echo '3-Month: ' . $avgMonth .  ' hours';

  			?>


</div>
</aside>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br><svg viewbox="0 0 250 20">
  <defs>
    <linearGradient id="gradient" x1="0" x2="0" y1="0" y2="1">
      <stop offset="5%" stop-color="#132D12"/>
      <stop offset="95%" stop-color="#155214"/>
    </linearGradient>
    <pattern id="wave" x="0" y="0" width="120" height="20" patternUnits="userSpaceOnUse">
      <path id="wavePath" d="M-40 9 Q-30 7 -20 9 T0 9 T20 9 T40 9 T60 9 T80 9 T100 9 T120 9 V20 H-40z" mask="url(#mask)" fill="url(#gradient)">
        <animateTransform
            attributeName="transform"
            begin="0s"
            dur="1.5s"
            type="translate"
            from="0,0"
            to="40,0"
            repeatCount="indefinite" />
      </path>
    </pattern>
  </defs>
  <text text-anchor="middle" x="50" y="15" font-size="17" fill="url(#wave)"  fill-opacity="0.6">Fluid Glasses</text>
  <text text-anchor="middle" x="50" y="15" font-size="17" fill="url(#gradient)" fill-opacity="0.4">Fluid Glasses</text>
</svg>


<br>
<br>
<br>
<br>

<div class="container">
       <img class="load" src="https://i.ibb.co/mbpyFZ2/Loader.png" width="35" height="75"  alt="Loading...">
</div>
<div class = 'glasses'>

  				<?php

  			$query = "SELECT glasses_of_fluid FROM Reporting" . $_SESSION['uname'] . " LIMIT 102, 7";
  			mysqli_query($db, $query) or die('Error querying database.');
  			$result = mysqli_query($db, $query);
  			$row = mysqli_fetch_all($result, MYSQLI_ASSOC);

    			foreach ($row as $key => $value){
      			foreach ($value as $k => $v){
       				 $glasses += $v;


      				}
   				 }
    				echo '<b class = "fluids">' . $glasses . '</b>';

  			?>

  			<b class = 'fluids'>Glasses of Fluid</b><br>this week

</div>



<div class = 'glasses2'>
<div class="container2">
       <img class="load" src="https://i.ibb.co/mbpyFZ2/Loader.png" width="35" height="75"  alt="Loading...">
</div>


  				<?php

  			$query = "SELECT glasses_of_fluid FROM Reporting" . $_SESSION['uname'] . " WHERE date LIKE '%/03/2020%'";
  			mysqli_query($db, $query) or die('Error querying database.');
  			$result = mysqli_query($db, $query);
  			$row = mysqli_fetch_all($result, MYSQLI_ASSOC);

    			foreach ($row as $key => $value){
      			foreach ($value as $k => $v){
       				 $glasses += $v;


      				}
   				 }
    				echo '<b class = "fluids">' . $glasses . '</b>';

  			?>

  			<b class = 'fluids'>Glasses of Fluid</b><br>this month

</div>

<div class = 'glasses2'>
<div class="container2">
       <img class="load" src="https://i.ibb.co/mbpyFZ2/Loader.png" width="35" height="75"  alt="Loading...">
</div>


  				<?php

  			$query = "SELECT glasses_of_fluid FROM Reporting" . $_SESSION['uname'] . " WHERE date LIKE '%/2020%'";
  			mysqli_query($db, $query) or die('Error querying database.');
  			$result = mysqli_query($db, $query);
  			$row = mysqli_fetch_all($result, MYSQLI_ASSOC);

    			foreach ($row as $key => $value){
      			foreach ($value as $k => $v){
       				 $glasses += $v;


      				}
   				 }
    				echo '<b class = "fluids">' . $glasses . '</b>';

  			?>

  			<b class = 'fluids'>Glasses of Fluid</b><br>three months



</div>
<section>
  <! --- Sending Email Notification --- >
 <?php

   $sql = "SELECT averageBpm FROM DailyHeart" . $_SESSION['uname']. " ORDER BY id DESC LIMIT 1";
   //make the query and get the result
   $result = mysqli_query($db, $sql);
   //get the row as an array
   $veryActive = mysqli_fetch_all($result, MYSQLI_ASSOC);
   //itterate through array stored in the array
   foreach ($veryActive as $key => $value){
     foreach ($value as $k => $v){
       //add it to the light activity sum
     }
   }

   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\SMTP;
   use PHPMailer\PHPMailer\Exception;

   //Load Composer's autoloader
   require 'vendor/autoload.php';

   //Create an instance; passing `true` enables exceptions
   $mail = new PHPMailer(true);



   if ($v>"20") {
         //Server settings                   //Enable verbose debug output
         $mail->isSMTP();                                            //Send using SMTP
         $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
         $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
         $mail->Username   = 'healthbuddy1001@gmail.com';                     //SMTP username
         $mail->Password   = 'healthbuddy129';                               //SMTP password
         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
         $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

         //Recipients
         $mail->setFrom('healthbuddy1001@gmail.com', 'Health Buddy');
         $mail->addAddress('caitlinkung@gmail.com', 'Joe User');     //Add a recipient

         //Content
         $mail->isHTML(true);                                  //Set email format to HTML
         $mail->Subject = 'WARNING Your Hearth Rate is '. $v.' beats';
         $mail->Body    = 'Get this checked out by your local GP';
         $mail->send();

    }


    ?>

</section>


</body>



</html>
