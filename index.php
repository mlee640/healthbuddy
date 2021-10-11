<!DOCTYPE html>

<?php
include "config.php";
 	if (session_status() == PHP_SESSION_NONE) {  // NEED THIS chunk TO PASS THE 'p0x' ID to different pages
    	session_start();
			}
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


   <! --- Personalised Hello (General table)--- >

  		<h2 class ="welcome">
  			<?php
  				$query = "SELECT * FROM GeneralData WHERE id = '". $_SESSION['uname'] . "'";
  				mysqli_query($db, $query) or die('Error querying database.');
  				$result = mysqli_query($db, $query);
  				$row = mysqli_fetch_array($result);


  	 			echo 'Hello, ' . $row['firstName'] . ". Here are today's summaries!";
  	 		?>
  		</h2>
		<br>

	<! --- Steps --- >
		<div>
    		<section class = "step">
    			<br>
    			<h3>
      		<?php
          		$query = "SELECT * FROM GeneralData WHERE id = '". $_SESSION['uname'] . "'";
         			mysqli_query($db, $query) or die('Error querying database.');
          		$result = mysqli_query($db, $query);
          		$row = mysqli_fetch_array($result);

          		echo 'Good Job, ' . $row['firstName'] . '!' . '<br>';
      		?>
			<?php
				$query = "SELECT calories, ROW_NUMBER() over (PARTITION BY 'dateTime' ORDER BY 'dateTime') As num FROM Caloriesp01 Order By num DESC";
					mysqli_query($db, $query) or die('Error querying database.');
				$result = mysqli_query($db, $query);
				$row = mysqli_fetch_array($result);
				$x = 10000;
				$z = $x-$row['calories'];

				echo 'You are ' . $z . ' steps away from your goal steps!'
			?>
    			</h3>
    			<div class="fadein"><img src="images/robot.png" width="160" height="150"/></div>

    	</section>
		</div>

	<! --- Active Minutes (Activep01 table)--- >
	<div>
	<section class="sleephour">
		<br>
  	<head>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {

			var data = google.visualization.arrayToDataTable([
			['Active Status', 'Minutes'],
			['Light',     155],
			['Moderate',      23],
			['Very',  44],
			]);

			var options = {
			title: 'Active Minutes',
			titleFontSize: 15,
			colors: ['#6DD189', '#46A697', '#0D6B5D'],
			width: 550,
			height: 300,
			backgroundColor: {
				fill: 'none',
				fillOpacity: 0
			},
			chartArea: {width: 350, height: 260},
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart'));

			chart.draw(data, options);
		}
		</script>
	</head>
	<body>
		<div id="piechart" style="width: 400px; height: 220px;"></div>
	</body>
	</section>
	</div>

	<! --- Heart Rate (DailyHeartp01 table) --- >
	<div>
	<section class = "heartbeat">
	<br>
	<h3>Average Heart Rate</h3>
	<div class="human-heart">
		<div class="container"><img src="images/heart2.png" class="human-heart" alt="human heart" width="100" height="100"/>
		</div>
		<div class="top"> 	<?php
			$query = "SELECT averageBpm, ROW_NUMBER() over (PARTITION BY 'dateTime' ORDER BY 'dateTime') As num FROM DailyHeartp01 Order By num DESC";
			mysqli_query($db, $query) or die('Error querying database.');
			$result = mysqli_query($db, $query);
			$row = mysqli_fetch_array($result);

			 echo $row['averageBpm'] . ' bpm'; ?>
		</div>
		</div>
		<h4>Max Heart Rate: <a><?php
			$query = "SELECT maxBpm, ROW_NUMBER() over (PARTITION BY 'dateTime' ORDER BY 'dateTime') As num FROM DailyHeartp01 Order By num DESC";
			mysqli_query($db, $query) or die('Error querying database.');
			$result = mysqli_query($db, $query);
			$row = mysqli_fetch_array($result);

			 echo $row['maxBpm']; ?></a></h4>
  
		<h4>Min Heart Rate: <a><?php
			$query = "SELECT minBpm, ROW_NUMBER() over (PARTITION BY 'dateTime' ORDER BY 'dateTime') As num FROM DailyHeartp01 Order By num DESC";
			mysqli_query($db, $query) or die('Error querying database.');
			$result = mysqli_query($db, $query);
			$row = mysqli_fetch_array($result);

			 echo $row['minBpm']; ?></a></h4>
  	</section>
    </div>

	<! --- Daily Calories (Caloriesp01 table) --->
	<div>
	<section class = "calory">
		<br>
		<h3>Calories</h3>
			<div class="caloriesicon">
				<div class="calories"><img src="images/calories.png" width="100" height="100"/>
				</div>
				<div class="top"> 	<?php
					$query = "SELECT calories, ROW_NUMBER() over (PARTITION BY 'dateTime' ORDER BY 'dateTime') As num FROM Caloriesp01 Order By num DESC";
					mysqli_query($db, $query) or die('Error querying database.');
					$result = mysqli_query($db, $query);
					$row = mysqli_fetch_array($result);

					echo $row['calories'] . ' '; ?>
				</div>
				<br>
				<br>
	</section>
	</div>

	<! --- Daily Distance (Distancep01 table) --->
	<div>
	<section class = "calory">
		<br>
		<h3>Distance</h3>
			<div class="distanceicon">
				<div class="calories"><img src="images/distance.png" width="100" height="100"/>
				</div>
				<div class="top"> 	<?php
					$query = "SELECT distance, ROW_NUMBER() over (PARTITION BY 'dateTime' ORDER BY 'dateTime') As num FROM Distancep01 Order By num DESC";
					mysqli_query($db, $query) or die('Error querying database.');
					$result = mysqli_query($db, $query);
					$row = mysqli_fetch_array($result);

					echo $row['distance'] . ' km'; ?>
				</div>
				<br>
				<br>
	</section>
	</div>

	<! --- Sleep Stages Graph (Sleepp01 table) --->
	<div>
	<section class = "sleepstages">
		<head>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
			google.charts.load("current", {packages:["corechart"]});
			google.charts.setOnLoadCallback(drawChart);
			function drawChart() {
				var data = google.visualization.arrayToDataTable([
					["Stages", "Minutes", { role: "style" } ],
					["Awake", 36, "#C0F5B8"],
					["REM", 67, "#8AD67E"],
					["Light", 234, "#6EAB65"],
					["Deep", 44, "#4D7847"]
				]);

				var view = new google.visualization.DataView(data);
				view.setColumns([0, 1,
							{ calc: "stringify",
								sourceColumn: 1,
								type: "string",
								role: "annotation" },
							2]);

				var options = {
					title: "Sleep Stages in Minutes",
					titleFontSize: 15,
					width: 600,
					height: 230,
					bar: {groupWidth: "75%"},
					legend: { position: "none" },
					chartArea: {
					backgroundColor: {
						fill: 'none',
						fillOpacity: 0
					},
					},
					backgroundColor: {
					fill: 'none',
					fillOpacity: 0
					},
				};
				var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
				chart.draw(view, options);
				}
		</script>
		</head>
		<body>
			<div id="barchart_values" style="width: 500px; height: 200px;"></div>
		</body>
	</section>
	</div>



<br>
<footer> &copy; Team 3: Miji / Sumedha / Caitlin</footer>

</body>


</html>
