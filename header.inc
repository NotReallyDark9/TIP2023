<div class="container text-center px-4">
	<h1><a href="index.php" class="text-white" style="text-decoration: none;">CorpU</a></h1>
	<div class="row nav-links">
		<div class="col-8">
			<ul class="header-links">
				<li class="list-inline-item"><a href="index.php" class="nav-link">Home</a></li>
				<li class="list-inline-item"><a href="about.php" class="nav-link">About Us</a></li>
				<li class="list-inline-item"><a href="jobs.php" class="nav-link">View Jobs</a></li>				
				<li class="list-inline-item"><a href="support.php" class="nav-link">Support</a></li>
				<?php
				if (isset($_SESSION['status']) && $_SESSION['status'] == 'PStaff') {
				echo '<li class="list-inline-item"><a href="manage.php" class="nav-link">Manage</a></li>';
				}
				if (isset($_SESSION['status'])) {
				echo '<li class="list-inline-item"><a href="check.php" class="nav-link">Check</a></li>';
				}
				if (isset($_SESSION['status']) && $_SESSION['status'] == 'PStaff') {
				echo '<li class="list-inline-item"><a href="message.php" class="nav-link">Message</a></li>';
				}
				?>		
			</ul>
		</div>
		<div class="col-4 user-links">
			<ul class="header-links">
				<?php
				if(isset($_SESSION['user_id'])) { // user is logged in
				    $firstname = $_SESSION['firstname'];
				    echo "<li class='list-inline-item'>Welcome $firstname</li>";
				    echo "<li class='list-inline-item'><a href='logout.php' class='nav-link'>Logout</a></li>";
				} else { // user is not logged in
				    echo "<li class='list-inline-item'><a href='login-index.php' class='nav-link'>Login</a></li>";
				    echo "<li class='list-inline-item'><a href='signup.php' class='nav-link'>Signup</a></li>";
				}
				?>