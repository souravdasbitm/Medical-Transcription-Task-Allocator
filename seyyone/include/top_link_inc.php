    <?php
    // include '../configs/conFactory.php';
    session_start();
    // If the user is not logged in redirect to the login page...
    if (! isset($_SESSION['loggedin'])) {
        session_destroy();
        header('Location: ../index.php');
        exit();
    }
    ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="navbar-header">
		<a class="navbar-brand" href="index.php">Seyyone</a>
	</div>

	<button type="button" class="navbar-toggle" data-toggle="collapse"
		data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span>
		<span class="icon-bar"></span> <span class="icon-bar"></span>
	</button>

	<!--  <ul class="nav navbar-nav navbar-left navbar-top-links">
                    <li><a href="#"><i class="fa fa-home fa-fw"></i> Website</a></li>
                </ul> -->

	<ul class="nav navbar-right navbar-top-links">

		<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
			href="#"> <i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['actualname'] ?> <b
				class="caret"></b>
		</a>
			<ul class="dropdown-menu dropdown-user">
				<li><a href="changepassword.php"><i class="fa fa-gear fa-fw"></i> Change Password</a></li>
				<li class="divider"></li>
				<li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
				</li>
			</ul></li>
	</ul>
	<!-- /.navbar-top-links -->