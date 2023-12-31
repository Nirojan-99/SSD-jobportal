<?php

include 'config.php';

?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<title>Job Jet</title>
	<link rel="stylesheet" type="text/css" href="../css/stylejob.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="../js/scriptjob.js"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body id="total">
	<div class="backL" id="backL">
		<header class="header">
			<div class="stick">
				<fieldset class="boxH">
					<p class="heading">
						<img src="../photoj/logoWEb.png" class="logo">
						<span class="headingW">We Lead You A Better Life!!</span>
						<span id="date" class="date">
							<script type="text/javascript">
								date();
							</script>
						</span>
					</p>
					<span class="buttonTOP">
						<ul class="button1">
							<?php if ($validation == 1) {
								echo "<li><a href=\"profileC.php\" >PROFILE</a></li>";
							} ?>
							<?php if ($validation == 2) {
								echo "<li><a href=\"profileP.php\" >PROFILE</a></li>";
							} ?>
							<li><a href="home.php">HOME</a></li>
							<li><a href="searchlocal.php">LOCAL JOBS</a></li>
							<!-- <li><a href="searchforeign.php">FOREIGN JOBS</a></li> -->
						</ul>
					</span>
				</fieldset>
				<fieldset class="boxM">
					<form action="jobview.php">
						<span class="note">WelCome To Our Page</span>
						<input type="search" name="search" id="searchH" class="searchH" placeholder="search.." required>
						<label class="icon" for="subhidden">
							<i class="fa fa-search"></i>
						</label>
						<input type="submit" name="searchM" style="display: none;" id="subhidden">
						<button class="logIN"><a href="loginC.php">Employer LogIn</a></button>
						<button class="logIN"><a href="loginP.php">Employee LogIn</a></button>
						<a href="loginB.html" class="iconUSER">
							<i class="fa fa-user"></i>
						</a>
				</fieldset>
			</div>
			</form>
		</header>

		<!-- body section-->
		<center>
			<div class="log">
				<form class="signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<h2 class="sign">Sign In As Employee</h2>
					<input type="mail" name="emailP" placeholder="enter email " class="in" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
					<span id="msg" style="color: green; padding: 5px 10px; "></span>
					<input type="password" name="passP" placeholder="enter password" class="in" id="passL" required>
					<i class="fas fa-eye" id="pass" onclick="showPa();" pattern={0-9}[4] aria-hidden="true"></i>
					<a href="resetpass.php" class="linkP">forget password?</a>
					<input type="submit" class="btn" value="Log In" name="employeelog">
					<p>don't have account <a href="signupP.php" class="linkP">CLICK HERE</a></p>
				</form>
			</div>
		</center>

		<?php
		if (isset($_POST["employeelog"])) {
			$email = $_POST['emailP'];
			$userPASSCHK = $_POST['passP'];

			// For verifying admin
			if ($email == "jobjet.admin1999@gmail.com" and $userPASSCHK == "jobjet@1999Sliit") {
				$_SESSION['admin'] = true;
				header("Location: admin.html");
				exit();
			}

			$sql = "SELECT mail, password FROM employee WHERE mail = ?";

			$stmt = mysqli_prepare($conn, $sql);
			mysqli_stmt_bind_param($stmt, "s", $email);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {

					if (password_verify($userPASSCHK, $row['password'])) {//hithushi

						$_SESSION['mailP'] = $email;
						$_SESSION['passP'] = $userPASSCHK;
						$_SESSION['type'] = "employee";
						header("Location: ../html/profileP.php");
						exit();
						
					} else {
						echo "<script type='text/javascript'>
							document.getElementById('msg').innerHTML=\"Incorrect password !!\";
						</script>";
					}
				}
			} else {
				echo "<script type='text/javascript'>
					document.getElementById('msg').innerHTML=\"Invalid email address!!\";
				</script>";
			}
		}


		?>

		<!-- body section/t&c-->
		<span></span>
		<div id="tndcV">
			<h2 class="heading alignP">Terms and Condition<i class="fa fa-close" href="#" onclick="closeS();"> </i></h2>
			<p class="naviPARA sentence">This portal only acts as a platform for facilitating employment opportunities in private sector establishments. Vacancies in Government department /public sector undertakings are not notified in this portal.</p>
		</div>

		<!-- footer section-->
		<fieldset class="footer">
			<div>
				<img src="../photoj/logoWEb.png" class="logo"></th>
				<div class="flow">
					<h4 class="_14">Follow us on</h4>
					<ul class="social-icons">
						<li><a href="https://www.facebook.com/" class="social-icon"> <i class="fab fa-facebook-f"></i></a></li>
						<li><a href="https://twitter.com/?lang=en" class="social-icon"> <i class="fab fa-twitter"></i></a></li>
						<li><a href="https://www.rssinclude.com/login" class="social-icon"> <i class="fa fa-rss"></i></a></li>
						<li><a href="https://www.youtube.com/" class="social-icon"> <i class="fab fa-youtube-square"></i></a></li>
						<li><a href="https://lk.linkedin.com/" class="social-icon"> <i class="fab fa-linkedin-in"></i></a></li>
						<li><a href="https://github.com/login" class="social-icon"> <i class='fab fa-github'></i></a></li>
					</ul>
				</div>

				<div>
					<center>
						<table class="footerLink tabelF">
							<tr>
								<td>
									<ul class="detailsFO ">
										<li class="tableH">Employer</li>
										<li><i class="fas fa-user-alt" id="logoFo"></i><a href="loginC.php" class="linkJ">Log In</a></li>
										<li><i class="fas fa-search" id="logoFo"></i><a href="searchlocal.php" class="linkJ">Search job</a></li>
										<li><i class="fas fa-cloud-upload-alt" id="logoFo"></i><a href="" class="linkJ">post job</a></li>
										<li><a href="" class="linkJ" style="color: #009999">a</a></li>
									</ul>
								</td>
								<td>
									<ul class="detailsFO">
										<li class="tableH">Employee</li>
										<li><i class="fas fa-user-alt" id="logoFo"></i><a href="loginP.php" class="linkJ">Log In</a></li>
										<li><i class="fas fa-search" id="logoFo"></i><a href="searchlocal.php" class="linkJ">Search job</a></li>
										<li><i class="fas fa-file-export" id="logoFo"></i><a href="" class="linkJ">Apply job</a></li>
										<li><a href="" class="linkJ" style="color: #009999">a</a></li>
									</ul>
								</td>
							</tr>
						</table>
					</center>
				</div>
				<div>
					<span>
						<button id="tndc" class="tndc" onclick="tndc();"><a href="#">Terms and Condition</a></button>
						<button class="tndc"><a href="feedback.php"> send feedback </a></button>
						<!--<button id="flow" class="flow" onclick="tndc();">Flow</button>-->
					</span>
					<ul class="detailsF sentence addr">
						<li>
							<address>
								<i class="material-icons" id="logoFo">edit_location</i>
								Galle road,
								Wellavata,
								Colombo 6
							</address>
						</li>
						<li><i class="fas fa-phone-alt" id="logoFo"></i>0778862172</li>
						<li><a href="mailto: project2020sliit@gmail.com" class="linkJ" style="color: #993300 "><i class="material-icons" id="logoFo">mail</i>project2020sliit@gmail.com</a></li>
					</ul>
					<div class="bottom">Copyright 2018 © JOBJET. All Rights Reserved. Designed & Developed by project2020</div>
				</div>

		</fieldset>
		<a href="#" class="topicon"><i class="fa fa-chevron-circle-up" id="mybtn"></i></a>
</body>
</div>
<script type="text/javascript">
	scrol();
</script>

</body>

</html>