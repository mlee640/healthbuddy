
<!DOCTYPE html>

<!--- Login connection --->
<?php


include "config.php";
 	if (session_status() == PHP_SESSION_NONE) {  // NEED THIS chunk TO PASS THE 'p0x' ID to different pages
    	session_start();
			}

if(isset($_POST['but_submit'])){

    $uname = mysqli_real_escape_string($db,$_POST['txt_uname']);
    $password = mysqli_real_escape_string($db,$_POST['txt_pwd']);


    if ($uname != "" && $password != ""){

        $sql_query = "SELECT count(*) AS cntUser FROM Logins WHERE username='".$uname."' AND password='".$password."'";
        $result = mysqli_query($db,$sql_query);
        $row = mysqli_fetch_array($result);
        $count = $row['cntUser'];
        if($count > 0){
            $_SESSION['uname'] = $uname;
            if ($_SESSION['uname'] == 'admin') {
            	header('Location: admin.php'); }
            else {
            	header('Location: index.php');
            }
        }else{
            echo "Invalid username and password";
        }

    }

}
		//Creates a session to transfer 'p0x' variable to other pages
				if (session_status() == PHP_SESSION_NONE) {
    					session_start();
					} 
				if(isSet($_POST['uname'])) { 
     					$_SESSION['uname'] = $_POST['uname']; 
					}
					?>

<html>
<head><link href="css/projectStyle.css" type = "text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/login.css" />
<script src="https://cdn.jsdelivr.net/npm/less@4.1.1" ></script>
<title>Dashboard</title>
</head>

<body>
	<header>
    <img src="images/siteName.png" width="450" height="100"/>

	</header>
	<nav>
		<a href="login.php">Login</a>
	</nav>
	<br>
	
	<!--- Login Form --->
        
<div class="container">

<form name="f1" action="" method="POST">
	<div id="div_login">

		<h2> Log In </h2>

        <img src="images/profile.png" class = "profile" width="100" height="100" class= "profilepic"/><br><br>


        <label>Username</label>

        <div><input type="text" id ="txt_uname" name="txt_uname" placeholder="Username"></div><br>

        <label>Password</label>

        <div><input type="password" id ="txt_pwd"  name="txt_pwd" placeholder="Password"></div><br> 

        <div><input type="submit" value="Submit" id="but_submit" name="but_submit"/></div>
		</div>
     </form>
</div>
		
<br>	



	
<footer> &copy; Team 3: Miji / Sumedha / Caitlin</footer>




</body>


</html>