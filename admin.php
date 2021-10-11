
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
    <img src="images/siteName.png" width="450" height="100"/>

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
    			
				<?php

				
				foreach ($result as $names) {  
				
				        echo'<tr><td>' . $names['firstName'] . ' ' . $names['surname'] . '</td>';
            			echo '<td>' . $names['id'] . '</td>';
            			echo '<td>' . $names['gender'] . '</td>';
            			echo '<td>' . $names['age'] . '</td>';
            			echo '<td><h4 class "more">See more</h4></td></tr>';
            			echo '<tr>
        						<td colspan="5">
             					<h4>Additional information</h4>

            					<ul>
                				<li>Average Heart Rate:</li>
                				<li>Average Weight:</li>
                				<li>Glasses of Fluids:</li>
            						</ul>
        						</td>
    						</tr>';
				
				} ?>
 
        
    </tbody>

</table>



</body>


</html>