<!DOCTYPE html>
<html lang="en">
 <?php
require_once '../include/header_inc.php';
include '../configs/conFactory.php';
?>
    <body>

	<div id="wrapper">

<?php

require_once '../include/top_link_inc.php';
require_once '../include/left_link_inc.php';
?>



		<!-- Page Content -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Dashboard</h1>
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<div class="row">
					<div class="col-lg-4">
						<div class="panel panel-default">
							<div class="panel-heading">My Message</div>
							<div class="panel-body"></div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
					</div>
					<!-- /.col-lg-4 -->
					<div class="col-lg-4">
						<div class="panel panel-default">
							<div class="panel-heading">My Today's Priority Item</div>
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>MT</th>
												<th>ED</th>
												<th>QC</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
                                                    <a href=task_details.php?id=<?php echo $_SESSION['id'] ?>#tab-primary-1>
                                                    <?php
                                                    $mtQry = "SELECT * FROM `syy_task` where syy_report_type<>'' and syy_curr_mt='" .
                                                            $_SESSION['id'] . "' and date(syy_upload_date)=(select max(date(syy_upload_date)) from syy_task)";
                                                    $row_rr = $db->query($mtQry)->numRows();
                                                    echo $row_rr;

                                                    ?>
                                                    </a>
                                                    </td>
												<td>
												<a href=task_details.php?id=<?php echo $_SESSION['id'] ?>#tab-primary-2>
                                                 <?php
                                                     $etQry = "SELECT * FROM `syy_task` where syy_report_type<>'' and syy_curr_ed='" .
                                                       $_SESSION['id'] .
                                                       "' and date(syy_upload_date)=(select max(date(syy_upload_date)) from syy_task)";
                                                      $row_rr = $db->query(
                                                      $etQry)->numRows();
                                                      echo $row_rr;

                                                       ?>
                                                    
                                                    </a>
                                                    </td>
												<td>
												<a href=task_details.php?id=<?php echo $_SESSION['id'] ?>#tab-primary-3>
												               <?php
                                                                $otQry = "SELECT * FROM `syy_task` where syy_report_type<>'' and syy_curr_oc='" .
                                                                        $_SESSION['id'] .
                                                                        "' and date(syy_upload_date)=(select max(date(syy_upload_date)) from syy_task)";
                                                                $row_rr = $db->query(
                                                                        $otQry)->numRows();
                                                                echo $row_rr;

                                                                ?>
												</a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
					</div>
					<div class="col-lg-4">
						<div class="panel panel-default">
							<div class="panel-heading">My Performance</div>
							<div class="panel-body"></div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
					</div>
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->

	</div>
	<!-- /#wrapper -->

	<!-- jQuery -->
	<script src="../js/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="../js/bootstrap.min.js"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="../js/metisMenu.min.js"></script>

	<!-- Flot Charts JavaScript -->
	<script src="../js/flot/excanvas.min.js"></script>
	<script src="../js/flot/jquery.flot.js"></script>
	<script src="../js/flot/jquery.flot.pie.js"></script>
	<script src="../js/flot/jquery.flot.resize.js"></script>
	<script src="../js/flot/jquery.flot.time.js"></script>
	<script src="../js/flot/jquery.flot.tooltip.min.js"></script>
	<script src="../js/flot-data.js"></script>


	<!-- Custom Theme JavaScript -->
	<script src="../js/startmin.js"></script>


</body>
</html>
