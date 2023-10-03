<?php
include 'config.php';
include_once '../libraries/vendor/autoload.php'
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
	<meta http-equiv="Location" content="otpv.php/">
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
		<span>

			<div class="slideshow-container">

				<div class="mySlides fade">
					<div class="numbertext"></div>
					<img src="../photoj/random1.jpg" style="width:300px;height: 650px;" class="slide">
				</div>

				<div class="mySlides fade">
					<div class="numbertext"></div>
					<img src="../photoj/random2.jpg" style="width:300px;height: 650px;" class="slide">
				</div>

				<div class="mySlides fade">
					<div class="numbertext"></div>
					<img src="../photoj/random3.jpg" style="width:300px;height: 650px;" class="slide">
				</div>

				<div class="mySlides fade">
					<div class="numbertext"></div>
					<img src="../photoj/random4.jpg" style="width:300px;height: 650px;" class="slide">
				</div>

				<div class="mySlides fade">
					<div class="numbertext"></div>
					<img src="../photoj/random5.jpg" style="width:300px;height: 650px;" class="slide">
				</div>

				<div class="mySlides fade">
					<div class="numbertext"></div>
					<img src="../photoj/random6.jpg" style="width:300px;height: 650px;" class="slide">
				</div>

				<div class="mySlides fade">
					<div class="numbertext"></div>
					<img src="../photoj/random7.jpg" style="width:300px;height: 650px;" class="slide">
				</div>

			</div>
			<br>


			<script type="text/javascript">
				var slideIndex = 0;
				showSlides();

				function showSlides() {
					var i;
					var slides = document.getElementsByClassName("mySlides");
					for (i = 0; i < slides.length; i++) {
						slides[i].style.display = "none";
					}
					slideIndex++;
					if (slideIndex > slides.length) {
						slideIndex = 1
					}

					slides[slideIndex - 1].style.display = "block";
					setTimeout(showSlides, 2000); // Change image every 2 seconds
				}
			</script>

			<?php
			$clientID = "814232915139-hmg49bh6o5epdcno0kub18ekg1ferci6.apps.googleusercontent.com";
			$secret = "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";

			// Google API Client
			$gclient = new Google_Client();

			$gclient->setClientId($clientID);
			$gclient->setClientSecret($secret);
			$gclient->setRedirectUri('http://localhost:81/event/html/');


			$gclient->addScope('email');
			$gclient->addScope('profile');

			if (isset($_GET['code'])) {
				// Get Token
				$token = $gclient->fetchAccessTokenWithAuthCode($_GET['code']);

				// Check if fetching token did not return any errors
				if (true) {
					// Setting Access token
					$gclient->setAccessToken($token['access_token']);

					// Get Account Profile using Google Service
					$gservice = new Google_Service_Oauth2($gclient);

					// Get User Data
					$udata = $gservice->userinfo->get();

					// Store user data in SQL
					$sql = "INSERT INTO employer (google_id, company_name, email, profile_image) VALUES (?, ?, ?, ?)";
					$stmt = $mysqli->prepare($sql);

					if ($stmt) {
						$stmt->bind_param("ssss", $udata->id, $udata->name, $udata->email, $udata->picture);
						if ($stmt->execute()) {
							// User data stored successfully in the database
							$_SESSION['login_google_id'] = $udata->id;
							$_SESSION['login_name'] = $udata->name;
							$_SESSION['login_email'] = $udata->email;
							$_SESSION['login_picture'] = $udata->picture;
							$_SESSION['ucode'] = $_GET['code'];

							header('location: ./');
							exit;
						} else {
							// Handle the SQL insert error
							echo "Error: " . $stmt->error;
						}

						$stmt->close();
					} else {
						// Handle the SQL statement error
						echo "Error: " . $mysqli->error;
					}
				}
			}

			?>

			<!--end slide show-->
		</span>
		<div class="signup">
			<div class="contain">
				<h1>SIGN UP <span class="heading alignP">as employer</span></h1>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<div>
						<i class="fas fa-building"></i>
						<input type="text" placeholder="Company Name" required name="Cname">
					</div>
					<div>
						<i class="fas fa-user"></i>
						<input type="text" placeholder="Name of CEO" required name="CFname">
					</div>
					<div>
						<i class="fas fa-envelope"></i>
						<input type="mail" placeholder="E-mail" required name="Cmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
					</div>
					<div>
						<i class="fas fa-phone"></i>
						<input type="text" placeholder="Mobile Number" required name="CMnum" pattern="[0-9]{10}">
					</div>
					<div>
						<i class="material-icons">location_on</i>
						<textarea rows="4" cols="52" placeholder="  Address..." name="Caddr"></textarea>
					</div>
					<div>
						<i class="fas fa-key"></i>
						<input type="password" placeholder="Password" id="pw1" required name="Cpass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
					</div>
					<div>
						<i class="fas fa-key"></i>
						<input type="password" placeholder="Confirm Password" id="pw2" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
					</div>
					<p class="classic">Accept our Privacy Policy to SIGN UP</p>
					<input type="submit" id="submit" value="Sign Up    " onclick="passwordchk()" name="employersign" disabled>
					<div>
						<a id="submit" href="<?= $gclient->createAuthUrl() ?>">Signup with Google</a>
					</div>
				</form>
			</div>


		</div>
		<center>
			<fieldset class="termssign">
				<center>
					<p class="heading">Privacy Policy</p>
				</center>
				<p class="naviPARA sentence">This portal only acts as a platform for facilitating employment opportunities in private sector establishments. Vacancies in Government department /public sector undertakings are not notified in this portal.</p>
				<span id="acc"><input type="checkbox" name="check" id="ac" onclick="enable();"><label class="classic" id="ACCEPT" for="ac">ACCEPT PRIVACY POLICY</label></span>
			</fieldset>
		</center>
		<?Php


		if (isset($_POST["employersign"])) {
			$name = htmlspecialchars($_POST['Cname'], ENT_QUOTES, 'UTF-8');
			$fname = htmlspecialchars($_POST['CFname'], ENT_QUOTES, 'UTF-8');
			$mail = htmlspecialchars($_POST['Cmail'], ENT_QUOTES, 'UTF-8');
			$num = htmlspecialchars($_POST['CMnum'], ENT_QUOTES, 'UTF-8');
			$addr = htmlspecialchars($_POST['Caddr'], ENT_QUOTES, 'UTF-8');
			$pass = password_hash(htmlspecialchars($_POST['Cpass'], ENT_QUOTES, 'UTF-8'), PASSWORD_DEFAULT);

			//parameter tampering
			$mail = filter_var($mail, FILTER_VALIDATE_EMAIL);
			$num = preg_replace("/[^0-9]/", "",$num); // Remove non-numeric characters

			$pattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/";
			if (!(preg_match($pattern, $pass))) {
				echo "<script type=\"text/javascript\">
				alert(\"enter strong password!!\");
				</script>";
			}

			$mail = mysqli_real_escape_string($conn, $mail); // Sanitize user input

			// Prepare the SQL statement with a parameter
			$sql = "SELECT * FROM employee WHERE mail LIKE ?";
			$stmt = mysqli_prepare($conn, $sql);

			// Bind the parameter
			mysqli_stmt_bind_param($stmt, "s", $mail);

			// Execute the statement
			mysqli_stmt_execute($stmt);

			// Store the result
			mysqli_stmt_store_result($stmt);

			// Check the number of rows affected
			if (mysqli_stmt_num_rows($stmt) > 0) {
				echo "<script type=\"text/javascript\">
				alert(\"Email address has already been taken!!\");
				</script>";
				$valid = 1;
			}


			// Prepare the SQL statement with a parameter
			$sql = "SELECT * FROM employer WHERE email LIKE ?";
			$stmt = mysqli_prepare($conn, $sql);

			// Bind the parameter
			mysqli_stmt_bind_param($stmt, "s", $mail);

			// Execute the statement
			mysqli_stmt_execute($stmt);

			// Store the result
			mysqli_stmt_store_result($stmt);

			// Check the number of rows affected
			if (mysqli_stmt_num_rows($stmt) > 0) {
				echo "<script type=\"text/javascript\">
							alert(\"Email address has already been taken!!\");
							</script>";
				$valid = 1;
			}

			if ($valid != 1) {
				$_SESSION['mailer'] = $mail;
				$_SESSION['nameC'] = $name;
				$_SESSION['fnameC'] = $fname;
				$_SESSION['mailC'] = $mail;
				$_SESSION['numC'] = $num;
				$_SESSION['addrC'] = $addr;
				$_SESSION['passC'] = $pass;
				$_SESSION['user'] = "employer";

				echo "<script> location.replace(\"../php/mailerS.php\"); </script>";
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