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


		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="newP" id="newP">
			<center>
				<div id="newPASS">
					<p class="headingwind">New Password</p>
					<input type="Password" name="passNew" id="passNew" placeholder="New Password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"><br>
					<i class="fas fa-eye" id="passEI2" onclick="showEPN()();" aria-hidden="true"></i>
					<input type="Password" name="pass" id="passNewR" placeholder="Repeat Password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
					<i class="fas fa-eye" id="passEI3" onclick="showEPNR();" aria-hidden="true"></i><br>
					<input type="submit" name="newPass" id="changePass" class="editWB" onclick="passwordE();">
				</div>
			</center>
		</form>

		<?php
		include 'config.php';

		if (isset($_POST["newPass"])) {
			$mail = $_SESSION['mailP'];
			$new = password_hash(htmlspecialchars($_POST['passNew'], ENT_QUOTES, 'UTF-8'), PASSWORD_DEFAULT) ;

			// Check if $mail exists in the employee table
			$sql = "SELECT mail FROM employee WHERE mail = ?";
			$stmt = mysqli_prepare($conn, $sql);
			mysqli_stmt_bind_param($stmt, "s", $mail);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);

			if (mysqli_stmt_num_rows($stmt) > 0) {
				// Update password for employee
				$sql = "UPDATE employee SET password = ? WHERE mail = ?";
				$stmt = mysqli_prepare($conn, $sql);
				mysqli_stmt_bind_param($stmt, "ss", $new, $mail);
				if (mysqli_stmt_execute($stmt)) {
					$_SESSION['mailP'] = $mail;
					$_SESSION['passP'] = $new;
					header("Location: ../html/profileP.php");
					exit();
				}
			} else {
				// Check if $mail exists in the employer table
				$sqll = "SELECT email FROM employer WHERE email = ?";
				$stmt = mysqli_prepare($conn, $sqll);
				mysqli_stmt_bind_param($stmt, "s", $mail);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);

				if (mysqli_stmt_num_rows($stmt) > 0) {
					// Update password for employer
					$sql = "UPDATE employer SET password = ? WHERE email = ?";
					$stmt = mysqli_prepare($conn, $sql);
					mysqli_stmt_bind_param($stmt, "ss", $new, $mail);
					if (mysqli_stmt_execute($stmt)) {
						$_SESSION['mailP'] = $mail;
						$_SESSION['passP'] = $new;
						header("Location: ../html/profileC.php");
						exit();
					}
				}
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
		<a href="#" class="topicon"><i class="fa fa-chevron-circle-up"></i></a>
</body>
</div>
<script type="text/javascript" id="mybtn">
	scrol();
</script>

</body>

</html>