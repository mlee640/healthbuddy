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
<link rel="stylesheet" type="text/css" href="css/activeMinute.css" />
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
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
	
	<br>
	  <h3><b>Sleep Quality<b></h3>
	<br><br>
	<br>



 <style>  .top { font-size: 25px;} .sleep_quality { float: left; position: relative; margin-right: 50px;} .h5 { color: #0D320D; font-weight: 2000; float: left; font-family: "arial";padding-top: 7px;}</style>
	<section>
		
  	<h5 class ="h5">Week Average <br> Sleep Quality</h5>
  	
	<div class="sleep_quality">
		<div class="container"><img src="images/sleep.png" width="100" height="100"/>
		</div>
		 
		<div class="top"> 	
		 
		<?php
    			$sql = "SELECT sleep_quality FROM Wellness" . $_SESSION['uname'] .  " ORDER BY effective_time_frame DESC LIMIT 7";
    			$result = mysqli_query($db, $sql);
    			$sleepQWeek = mysqli_fetch_all($result, MYSQLI_ASSOC);
    			foreach ($sleepQWeek as $key => $value){
      			foreach ($value as $k => $v){
       				 $sleepQ += $v;
       				 
      				}
   				 }
   				 	$averageSleepQWeek = ceil($sleepQ / 7);
    				echo $averageSleepQWeek;
  					?>

		</div>
		</div>
		<!--Widget showing average 1 MONTH Sleep Quality out of 5-->
		
		  	<h5 class ="h5">1-Month Average <br> Sleep Quality</h5>
  	  	
	<div class="sleep_quality">
		<div class="container"><img src="images/sleep.png" width="100" height="100"/>
		</div>
		 
		<div class="top"> 	
		 
		<?php
    			$sql = "SELECT sleep_quality FROM Wellness" . $_SESSION['uname'] .  " ORDER BY effective_time_frame DESC LIMIT 30";
    			$result = mysqli_query($db, $sql);
    			$sleepQMonth = mysqli_fetch_all($result, MYSQLI_ASSOC);
    			foreach ($sleepQMonth as $key => $value){
      			foreach ($value as $k => $v){
       				 $sleepQ += $v;
       				 $averageSleepQMonth = ceil($sleepQ / 30);
      				}
   				 }
    				echo $averageSleepQMonth;
  					?>

		</div>
		</div>
		<!--Widget showing average 3 MONTH Sleep Quality out of 5-->
		
		<h5 class ="h5">3-Month Average <br> Sleep Quality</h5>
		
			<div class="sleep_quality">
		<div class="container"><img src="images/sleep.png" width="100" height="100"/>
		</div>
		 
		<div class="top"> 	
		 
		<?php
    			$sql = "SELECT sleep_quality FROM Wellness" . $_SESSION['uname'] .  " ORDER BY effective_time_frame DESC LIMIT 90";
    			$result = mysqli_query($db, $sql);
    			$sleepQ3Month = mysqli_fetch_all($result, MYSQLI_ASSOC);
    			foreach ($sleepQ3Month as $key => $value){
      			foreach ($value as $k => $v){
       				 $sleepQ += $v;
       				 $averageSleepQ3Month = ceil($sleepQ / 90);
      				}
   				 }
    				echo $averageSleepQ3Month;
  					?>

		</div>
		
		</div>
		

				<style> .key {
				padding-left: 12px;
				padding-right: 12px;
				padding-bottom: 12px;
				border-style: solid;
				border-width: 2px 2px;
				border-color: #9fc69f;
				border-radius: 30px;
				background-color: #dfecdf;
				margin-top: -50px;
				float: left;
				font-weight: normal;
				font-family: "arial";
				}
		</style>
		
		<aside class = "key">
		
					<h4><b>Key:</b></h4>
		
					<p><b>1-2:</b> below normal</p>
					<p><b>3:</b> normal</p>
					<p><b>4-5:</b> above normal</p>
		
		</aside>
	
	</section>

<section id="firstPage">
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

	  <h3><b>Activity Minutes<b></h3>
<br>
  <?php
    $sql = "SELECT lightActive FROM Active" . $_SESSION['uname'] .  " ORDER BY ID DESC LIMIT 7";
    //make the query and get the result
    $result = mysqli_query($db, $sql);
    //get the row as an array
    $lightActivity = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //itterate through array stored in the array
    foreach ($lightActivity as $key => $value){
      foreach ($value as $k => $v){
        //add it to the light activity sum
        $lightPrint += $v;
      }
    }
  ?>
  
   <div class="card-body">
   
     <div class = "float-right">
       <img src="images/jumpingman.png" width="80" height="80">
     </div>
     <div class= "float-left"
     <h3>
       <span class="activitytime">Light:</span>
       <!--change the bellow number to get a link from our database-->
      <span class="count"><?php echo $lightPrint; ?></span>
     </h3>
     <p>week active minutes<p>
     </div>
   </div>
   <!--finish Widget showing LIGHT activity time-->
   <!--Widget showing MEDIUM activity time-->
   <?php
     $sql = "SELECT moderateActive FROM Active" . $_SESSION['uname'] .  " ORDER BY ID DESC LIMIT 7";
     //make the query and get the result
     $result = mysqli_query($db, $sql);
     //get the row as an array
     $moderateActivity = mysqli_fetch_all($result, MYSQLI_ASSOC);
     //itterate through array stored in the array
     foreach ($moderateActivity as $key => $value){
       foreach ($value as $k => $v){
         //add it to the light activity sum
         $moderatePrint += $v;
       }
     }
   ?>
   <div class="card-body2">
     <div class = "float-right">
       <img src="images/jumpingman.png" width="80" height="80">
     </div>
     <div class= "float-left"
     <h3>
       <span class="activitytime">Middle:</span>
       <!--change the bellow number to get a link from our database-->
      <span class="count"><?php echo $moderatePrint; ?></span>
     </h3>
     <p>week active minutes<p>
     </div>
   </div>
   <!--finish Widget showing MEDIUM activity time-->
   <!--Widget showing HEAVY activity time-->
   <?php
     $sql = "SELECT veryActive FROM Active" . $_SESSION['uname'] .  " ORDER BY ID DESC LIMIT 7";
     //make the query and get the result
     $result = mysqli_query($db, $sql);
     //get the row as an array
     $veryActive = mysqli_fetch_all($result, MYSQLI_ASSOC);
     //itterate through array stored in the array
     foreach ($veryActive as $key => $value){
       foreach ($value as $k => $v){
         //add it to the light activity sum
         $veryPrint += $v;
       }
     }
   ?>
   <div class="card-body3">
     <div class = "float-right">
       <img src="images/jumpingman.png" width="80" height="80">
     </div>
     <div class= "float-left"
     <h3>
       <span class="activitytime">Heavy:</span>
       <!--change the bellow number to get a link from our database-->
      <span class="count"><?php echo $veryPrint; ?></span>
     </h3>
     <p>week active minutes<p>
     </div>
   </div>
   <!--finish Widget showing HEAVY activity time-->

      <! --- active minutes MONTHLY widgets--- >
   <!--Widget showing LIGHT activity time-->

  <?php
    $sql = "SELECT lightActive FROM Active" . $_SESSION['uname'] .  " ORDER BY ID DESC LIMIT 30";
    //make the query and get the result
    $result = mysqli_query($db, $sql);
    //get the row as an array
    $lightActivity = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //itterate through array stored in the array
    foreach ($lightActivity as $key => $value){
      foreach ($value as $k => $v){
        //add it to the light activity sum
        $lightHrPrint += $v;
      }
    }
    $lightHrPrint = floor($lightHrPrint/60)
  ?>

   <div class="card-body">
     <div class = "float-right">
       <img src="images/jumpingman2.png" width="95" height="95">
     </div>
     <div class= "float-left"
     <h3>
       <span class="activitytime">Light:</span>
       <!--change the bellow number to get a link from our database-->
      <span class="count"><?php echo $lightHrPrint; ?></span>
     </h3>
     <p>Hours Active<br>in the past 30 days<p>
     </div>
   </div>
   <!--finish Widget showing LIGHT activity time-->
   <!--Widget showing MEDIUM activity time-->
   <?php
     $sql = "SELECT moderateActive FROM Active" . $_SESSION['uname'] .  " ORDER BY ID DESC LIMIT 30";
     //make the query and get the result
     $result = mysqli_query($db, $sql);
     //get the row as an array
     $moderateActivity = mysqli_fetch_all($result, MYSQLI_ASSOC);
     //itterate through array stored in the array
     foreach ($moderateActivity as $key => $value){
       foreach ($value as $k => $v){
         //add it to the light activity sum
         $moderateHrPrint += $v;
       }
     }
     $moderateHrPrint = floor($moderateHrPrint/60)
   ?>
   <div class="card-body2">
     <div class = "float-right">
       <img src="images/jumpingman2.png" width="95" height="95">
     </div>
     <div class= "float-left"
     <h3>
       <span class="activitytime">Middle:</span>
       <!--change the bellow number to get a link from our database-->
      <span class="count"><?php echo $moderateHrPrint; ?></span>
     </h3>
     <p>Hours Active<br>in the past 30 days<p>
     </div>
   </div>
   <!--finish Widget showing MEDIUM activity time-->
   <!--Widget showing HEAVY activity time-->
   <?php
     $sql = "SELECT veryActive FROM Active" . $_SESSION['uname'] .  " ORDER BY ID DESC LIMIT 30";
     //make the query and get the result
     $result = mysqli_query($db, $sql);
     //get the row as an array
     $veryActive = mysqli_fetch_all($result, MYSQLI_ASSOC);
     //itterate through array stored in the array
     foreach ($veryActive as $key => $value){
       foreach ($value as $k => $v){
         //add it to the light activity sum
         $veryHrPrint += $v;
       }
     }
     $veryHrPrint = floor($veryHrPrint/60)
   ?>
   <div class="card-body3">
     <div class = "float-right">
       <img src="images/jumpingman2.png" width="95" height="95">
     </div>
     <div class= "float-left"
     <h3>
       <span class="activitytime">Heavy:</span>
       <!--change the bellow number to get a link from our database-->
      <span class="count"><?php echo $veryHrPrint; ?></span>
     </h3>
     <p>Hours Active<br>in the past 30 days<p>
     </div>
   </div>
   <!--finish Widget showing HEAVY activity time-->

         <! --- active minutes 3 MONTHLY widgets--- >
      <!--Widget showing LIGHT activity time-->

     <?php
       $sql = "SELECT lightActive FROM Active" . $_SESSION['uname'] .  " ORDER BY ID DESC LIMIT 90";
       //make the query and get the result
       $result = mysqli_query($db, $sql);
       //get the row as an array
       $lightActivity = mysqli_fetch_all($result, MYSQLI_ASSOC);
       //itterate through array stored in the array
       foreach ($lightActivity as $key => $value){
         foreach ($value as $k => $v){
           //add it to the light activity sum
           $lightThreePrint += $v;
         }
       }
       $lightThreePrint = floor($lightThreePrint/60)
     ?>

      <div class="card-body">
        <div class = "float-right">
          <img src="images/jumpingman3.png" width="95" height="95">
        </div>
        <div class= "float-left"
        <h3>
          <span class="activitytime">Light:</span>
          <!--change the bellow number to get a link from our database-->
         <span class="count"><?php echo $lightThreePrint; ?></span>
        </h3>
        <p>Hours Active<br>in the past 90 days<p>
        </div>
      </div>
      <!--finish Widget showing LIGHT activity time-->
      <!--Widget showing MEDIUM activity time-->
      <?php
        $sql = "SELECT moderateActive FROM Active" . $_SESSION['uname'] .  " ORDER BY ID DESC LIMIT 90";
        //make the query and get the result
        $result = mysqli_query($db, $sql);
        //get the row as an array
        $moderateActivity = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //itterate through array stored in the array
        foreach ($moderateActivity as $key => $value){
          foreach ($value as $k => $v){
            //add it to the light activity sum
            $moderateThreePrint += $v;
          }
        }
        $moderateThreePrint = floor($moderateThreePrint/60)
      ?>
      <div class="card-body2">
        <div class = "float-right">
          <img src="images/jumpingman3.png" width="95" height="95">
        </div>
        <div class= "float-left"
        <h3>
          <span class="activitytime">Middle:</span>
          <!--change the bellow number to get a link from our database-->
         <span class="count"><?php echo $moderateThreePrint; ?></span>
        </h3>
        <p>Hours Active<br>in the past 90 days<p>
        </div>
      </div>
      <!--finish Widget showing MEDIUM activity time-->
      <!--Widget showing HEAVY activity time-->
      <?php
        $sql = "SELECT veryActive FROM Active" . $_SESSION['uname'] .  " ORDER BY ID DESC LIMIT 90";
        //make the query and get the result
        $result = mysqli_query($db, $sql);
        //get the row as an array
        $veryActive = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //itterate through array stored in the array
        foreach ($veryActive as $key => $value){
          foreach ($value as $k => $v){
            //add it to the light activity sum
            $veryThreePrint += $v;
          }
        }
        $veryThreePrint = floor($veryThreePrint/60)
      ?>
      <div class="card-body3">
        <div class = "float-right">
          <img src="images/jumpingman3.png" width="95" height="95">
        </div>
        <div class= "float-left"
        <h3>
          <span class="activitytime">Heavy:</span>
          <!--change the bellow number to get a link from our database-->
         <span class="count"><?php echo $veryThreePrint; ?></span>
        </h3>
        <p>Hours Active<br>in the past 90 days<p>
        </div>
      </div>
      <!--finish Widget showing HEAVY activity time-->
   <!--add the java thingy to animate it to do the number counting-->
   <script type="text/javascript">
   $('.count').each(function(){
     $(this).prop('Counter',0).animate({
       Counter: $(this).text()
     }, {
       duration:4000,
       easing:'swing',
       step: function(now){
         $(this).text(Math.ceil(now));
       }
     });
   });
   </script>


 </section>

</body>


</html>
