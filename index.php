<?php 
    //ob_start();
    include("./inc/db_connect.php");

    session_start();
    if (isset($_SESSION['username'])){

        $username = $_SESSION['username'];

    }
    else {
        
        $username = '';
    }


    if(isset($_GET['error'])){
        $error_login = "failed_login";
    }

    if(isset($_POST['submit'])){

        $realusername = mysqli_real_escape_string($db_connect, $_POST['username']);
	
        $password = mysqli_real_escape_string($db_connect, $_POST['password']);
        
        $check_details = mysqli_query($db_connect, "SELECT username FROM users WHERE username = '$realusername' ");
        $check_details_row = mysqli_num_rows($check_details);

        if($check_details_row == 1){

            while($row = mysqli_fetch_array($check_details)){
                $usernamenew = $row['username'];
            }

            $loginpassword = md5($password);

            $sql = mysqli_query($db_connect, "SELECT id FROM users WHERE username = '$usernamenew' AND password = '$password' LIMIT 1 ");
             $sqlcount = mysqli_num_rows($sql);
           
            if ($sqlcount == 1){
                echo json_encode(array("response"=>"Success"));
			  
                $_SESSION["username"] = $realusername;
				echo "<script type='text/javascript'>alert('Login Success!');window.location.href = 'employee_details.php'</script>";

            } else {
               echo "<script type='text/javascript'>alert('Login Failed!');</script>";
            }
        } 
    

    }


?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> Employee Record</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link href="css/font-awesome.min.css" type="text/css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    </head>
 <body id="loginPage">
 	<div class="login_wrapper clearfix">
 		<div class="logo_login">
             <h1> EMPLOYEE RECORD SYSTEM </h2>
 		</div>
        <?php
            if(isset($_GET['error'])){
                if($error_login == "failed_login"){?>

                    <div class="LogResponse2">Please Login in first</div>

                <?php }
                }
            ?>
        <div class="LogResponse"></div>
 		<div class="login_wrapper_inner">
 			<form id="loginForm" class="clearfix" method="post" action="">
	 			<div class="input-box">
	 				<input type="text" class="inputField username" name="username" placeholder="username">
	 				<div class="error usernameerror"></div>
	 			</div>
	 			<div class="input-box">
	 				<input  type="password" class="inputField password" name="password" placeholder="password">
	 				<div class="error passworderror"></div>
	 			</div>

	 			<div class="input-box">
	 				<button  type="submit" name="submit" class="submitField sign_in">Login in</button>
	 			</div>
	 		</form>
 		</div>
 	</div>
 <div class="body_overlay"></div>
 
  <script type="text/javascript" src="./js/global.js"></script>
 </body>
 </html>