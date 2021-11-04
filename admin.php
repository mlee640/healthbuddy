
<!DOCTYPE html>

<!--- Login connection --->
<?php


include "config.php";
 	if (session_status() == PHP_SESSION_NONE) {  // NEED THIS chunk TO PASS THE 'p0x' ID to different pages
    	session_start();
			}
?>

<html>
<head><link href="css/admin.css" type = "text/css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
   <script type="text/javascript">
   
$(document).ready(function(){
            $("#report tr:odd").addClass("odd");
            $("#report tr:not(.odd)").hide();
            $("#report tr:first-child").show();
            
            $("#report tr.odd").click(function(){
                $(this).next("tr").toggle();
                $(this).find(".arrow").toggleClass("up");
            });
            //$("#report").jExpand();
        });
   </script>

<title>Dashboard</title>
</head>

<body>
	<header>
    <img src="images/clinician.png" width="450" height="100"/>

	</header>
	<nav>
		<a href="admin.php">Patients</a>
		<a href="login.php" class = 'logout'>Logout</a>&#x2192;
	</nav>
	<br>
	        
	        <h2> Welcome to the Clinician's Patient Dashboard.</h2>	
<br>
<br>

			<?php
				$query = "SELECT * FROM GeneralData";
				mysqli_query($db, $query) or die('Error querying database.');
				$result = mysqli_query($db, $query);
				$row = mysqli_fetch_array($result);

	 		?>

	 		
<section class = 'patients'>
<table class="styled-table" id='report'>
    <thead>
        <tr>
            <th>Patient Name</th>
            <th>ID</th>
            <th>Gender</th>
            <th>Age</th>
            <th>More Information</th>
        </tr>
    </thead>
    <tbody>
    	
        						<style>.alerts {color: #8C0B0B;} </style>		
				<?php


				$count = 1;
				foreach ($result as $names) { 
				 
				
				        echo'<tr><td>' . $names['firstName'] . ' ' . $names['surname'] . '</td>';
            			echo '<td>' . $names['id'] . '</td>';
            			echo '<td>' . $names['gender'] . '</td>';
            			echo '<td>' . $names['age'] . '</td>';
            			echo '<td><h4 class "more">See more</h4></td></tr>';
            			
            			
            			$query = "SELECT averageBpm FROM DailyHeartp0" . $count . " ORDER BY id DESC LIMIT 1";
       					$result1 = mysqli_query($db,$query);
        				$row1 = mysqli_fetch_array($result1);
        				
        				$query1 = "SELECT ROUND(AVG(weight), 0) AS weight FROM Reportingp0" . $count . " WHERE weight != 'NULL' ";
       					$result2 = mysqli_query($db,$query1);
        				$row2 = mysqli_fetch_array($result2);
        				
        				$query2 = "SELECT ROUND(AVG(glasses_of_fluid), 0) AS glasses FROM Reportingp0" . $count . "";
       					$result3 = mysqli_query($db,$query2);
        				$row3 = mysqli_fetch_array($result3);
        				
        				$query3 = "SELECT ROUND(AVG(minutesSleep),0) AS minSleep FROM Sleepp0" . $count . " ";
       					$result4 = mysqli_query($db,$query3);
        				$row4 = mysqli_fetch_array($result4);
        				
        				$query4 = "SELECT ROUND(AVG(minutesAwake),0) AS minAwake FROM Sleepp0" . $count . " ";
       					$result5 = mysqli_query($db,$query4);
        				$row5 = mysqli_fetch_array($result5);
        				        				
        				        				
        				$query5 = "SELECT startTime FROM Sleepp0" . $count . "  ORDER BY id DESC LIMIT 1";
       					$result6 = mysqli_query($db,$query5);
        				$row6 = mysqli_fetch_array($result6);
        				
        				$query6 = "SELECT endTime FROM Sleepp0" . $count . "  ORDER BY id DESC LIMIT 1";
       					$result7 = mysqli_query($db,$query6);
        				$row7 = mysqli_fetch_array($result7);        	
        				
        				$query7 = "SELECT minBpm FROM DailyHeartp0" . $count . " ORDER BY id LIMIT 1";
       					$result8 = mysqli_query($db,$query7);
        				$row8 = mysqli_fetch_array($result8);  
        				
         				   if ($row8['minBpm'] < 50) {
        						$bpm = '<b>< 50</b>';
        								}         				
   							else {
   								$bpm = 'Normal';
   							}
   							
   						if ($row3['glasses'] < 8) {
        						$g = '<b>< 8 fluids</b>';
        								}         				
   							else {
   								$g = 'Normal';
   							}
   						 if ($row4['minSleep'] < 480) {
        						$s = '<b>< 8 hours</b>';
        								}         				
   							else {
   								$s = 'Normal';
   							}
        				
        				
            			echo '<tr>
        						<td colspan="3">
             					<h4>General information</h4>

            					<ul>
                				<li>Average Heart Rate: ' . $row1['averageBpm'] . ' bpm</li>
                				<li>Average Weight: ' . $row2['weight'] . ' kg</li>
                				<li>Average Glasses of Fluids: ' . $row3['glasses'] . ' </li>
            						</ul>
            						<br>
 
            					<h4>Sleep information</h4>
            					
            					<ul>
                				<li>Average Minutes Awake: ' . $row4['minSleep'] . ' minutes</li>
                				<li>Average Minutes Asleep: ' . $row5['minAwake'] . ' minutes</li>
                				<li>Sleep Start: ' . $row6['startTime'] . ' </li>
                				<li>Sleep End: ' . $row7['endTime'] . ' </li>
            					</ul>
            					
        						</td>
        						<td colspan="2">
        						<h4 class="alerts">Alerts</h4>
        						<li> Min. bpm:  ' . $bpm . '</li>
        						<li> Fluids: ' . $g . '</li>
        						<li> Sleep hours: ' . $s . '</li>

            					</ul>
        						</td>
    						</tr>';
						$count += 1;
				} ?>
 
        
    </tbody>

</table>



</body>


</html>
