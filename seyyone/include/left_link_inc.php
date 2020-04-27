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
<div class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav navbar-collapse">
		<ul class="nav" id="side-menu">
                    <li><a href="home.php"><i
					class="fa fa-home fa-fw"></i> My Home</a></li>
                            <?php if ($_SESSION['role']=='admin'){?>
                            <li><a href="file_flow.php"><i
					class="fa fa-tachometer"></i> Today's File Flow</a></li>
                            <?php }?>
                             <li><a href="task_details.php"><i
					class="fa fa-table fa-fw"></i> Task List</a></li>
                            <?php if ($_SESSION['role']=='admin'){?>
                             <li><a href="operation.php"><i
					class="fa fa-edit fa-fw"></i> Operation</a></li>
                            <?php }?>
                             <?php if ($_SESSION['role']=='admin'){?>
                             <li><a href="employee.php"><i
					class="fa fa-book fa-fw"></i> Employee List</a></li>
                            <?php }?>
                           <?php if ($_SESSION['role']=='admin'){?>
                             <li><a href="reports.php"><i
					class="fa fa-book fa-fw"></i> Reports</a></li>
                            <?php }?>
                    <li><a href="linecount.php"><i
					class="fa fa-anchor fa-fw"></i> Line Count</a></li>
				    <li><a href="filegrading.php"><i
					class="fa fa-balance-scale fa-fw"></i> File Grading</a></li>
					  
<!--                             <li><a href="leavetable.php"><i -->
<!-- 					class="fa fa-table fa-fw"></i> Leave Table</a></li> -->
                           
                        <?php if ($_SESSION['role']=='admin'){?>
                            <li><a href="stats.php"><i
					class="fa fa-bar-chart-o fa-fw"></i> Statistical Representation </a></li>
                        <?php }?>    
		</ul>
	</div>
	<!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>