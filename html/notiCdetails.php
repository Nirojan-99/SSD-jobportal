<?php
include 'config.php';
$photo = $_SESSION['photoP'];
if ($mail == null) {
	header("Location: ../html/loginB.html");
}

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
			<form action="jobview.php">
				<div class="stick">
					<fieldset class="boxH">
						<p class="heading">
							<img src="../photoj/logoWEb.png" class="logo">
							<span class="headingW">We Leads You A Better Life!!</span>
							<span class="searchP">
								<input type="search" name="search" id="searchH" class="searchHP" placeholder="search.." required>
								<label class="iconS" for="subhidden">
									<i class="fa fa-search"></i>
								</label>
								<input type="submit" name="searchM" style="display: none;" id="subhidden">
							</span>
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
				</div>
			</form>
		</header>

		<!-- body section-->
		<div class="cover">
			<img src="../photoj/cover1.jpg" class="coverimg">
			<img src="<?php echo "../photoj/$photo"; ?>" class="userimg" id="userimg" onclick="changeimg();">

			<span class="buttonP">
				<a href="notiC.php"><i class="material-icons noti" style="font-size:36px">notifications</i></a>
				<a href="posted.php"><i class="material-icons fav" style="font-size:36px; color: <?php echo $post; ?>">file_upload</i></a>
				<!-- <span class="logout">
				<button><a href="profileP.php">Back to Profile</a></button>
				<button><a href="editP.php">Edit Profile</a></button>
				<button>Log Out</button>
				</span> -->
				<p class="username" id="username"><?php echo $user; ?></p>
			</span>
		</div>
		<fieldset class="hdd">
			<p class="hd">APPLICANT LIST</p>
		</fieldset>

		<!-- noti section -->

		<?php



		$mail = $_SESSION['mailP'];

		$Applicant = $_POST['mail'];
		$job = $_POST['job'];
		$jobname = $_POST['jobname'];

		$sql = "SELECT * 
        FROM Employee
        WHERE employee_id = ?";

		$stmt = mysqli_prepare($conn, $sql);
		mysqli_stmt_bind_param($stmt, "s", $Applicant);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<fieldset class=\"notif\">
                <p id=\"jobws\">NAME OF APPLICANT : <span class=\"det\">" . $row['employee_name'] . "</span>
                <br>JOB NAME :  <span class=\"det\">" . $jobname . "</span>
                <br>APPLICANT MAIL :  <span class=\"det\">" . $row['mail'] . "</span>
                <br>APPLICANT MOBILE :  <span class=\"det\">" . $row['mobile_number'] . "</span>
                <br>APPLICANT ADDRESS :  <span class=\"det\">" . $row['address'] . "</span>
                <br>APPLICANT GENDER :  <span class=\"det\">" . $row['gender'] . "</span>
                <br>APPLICANT RESUME :  <span class=\"det\">" . $row['resume'] . "</span>
                <form method=\"post\" action=\"approve.php\">
                <input type=\"hidden\" value=\"" . $row['employee_name'] . "\" name=\"name\">
                <input type=\"hidden\" value=\"" . $job . "\" name=\"jobid\">
                <input type=\"hidden\" value=\"" . $row['employee_id'] . "\" name=\"empid\">
                <input type=\"hidden\" value=\"" . $jobname . "\" name=\"jobname\">
                <input type=\"submit\" class=\"notiV\" value=\"Approve Application\"></p>
                </form>
            </fieldset>";
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