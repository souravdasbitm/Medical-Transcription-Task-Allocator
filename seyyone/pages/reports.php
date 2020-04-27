<!DOCTYPE html>
<html lang="en">
 <?php
require_once '../include/header_inc.php';
include '../configs/conFactory.php';
include '../class/utils.php';

?>
    <body>

	<div id="wrapper">

<?php

require_once '../include/top_link_inc.php';
require_once '../include/left_link_inc.php';

if ($_GET['id'] != '') {

    $ppid = $_GET['id'];
} else {
    $ppid = $_SESSION['id'];
}

?>
		
		<!-- Page Content -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Reports</h1>
					</div>
					<!-- /.col-lg-12 -->
				</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="panel tabbed-panel panel-primary">
							<div class="panel-heading clearfix">
								<div class="panel-title pull-left"></div>
								<div class="pull-left">
									<ul class="nav nav-tabs">
										<li class="active"><a href="#tab-primary-1" data-toggle="tab">Export
												Client Line Count</a></li>
										<li><a href="#tab-primary-2" data-toggle="tab">Export
												Detail Line Count</a></li>
									</ul>
								</div>
							</div>
							<div class="panel-body">
								<div class="tab-content">
									<div class="tab-pane fade in active" id="tab-primary-1">
										<div class="col-lg-25">
											<div class="panel panel-default">
												<div class="panel-heading"></div>
												<!-- /.panel-heading -->
												<div class="panel-body">
													<div class="table-responsive">

														<div class="col-lg-6">

															<form role="form" action="cleintExport.php" method="post"
																enctype="multipart/form-data">
																<fieldset>
																	<div class="form-group">
																		<label> Date from :</label> <input type="text"
																			id="popupDatepicker" name="dateLine1"
																			autocomplete="off" required > <label> to :</label> <input
																			type="text" id="popupDatepicker1" name="dateLine2"
																			autocomplete="off" required>
																	</div>

																	<!-- Change this to a button or input when using this as a form -->

																	<input type="submit" class="btn btn-success"
																		name="export_line" value="Download">

																</fieldset>
															</form>
														</div>


													</div>
													<!-- /.table-responsive -->

												</div>
												<!-- /.panel-body -->
											</div>
											<!-- /.panel -->
										</div>

									</div>
									<div class="tab-pane fade" id="tab-primary-2">
										<div class="col-lg-25">
											<div class="panel panel-default">
												<div class="panel-heading"></div>
												<!-- /.panel-heading -->
												<div class="panel-body">
													<div class="table-responsive">

														<div class="col-lg-6">

															<form role="form" action="cleintDetail.php" method="post"
																enctype="multipart/form-data">
																<fieldset>
																	<div class="form-group">
																		<label> Date from :</label> <input type="text"
																			id="popupDatepicker3" name="dateLine3"
																			autocomplete="off" required > <label> to :</label> <input
																			type="text" id="popupDatepicker4" name="dateLine4"
																			autocomplete="off" required>
																	</div>

																	<!-- Change this to a button or input when using this as a form -->

																	<input type="submit" class="btn btn-success"
																		name="export_line" value="Download">

																</fieldset>
															</form>
														</div>


													</div>
													<!-- /.table-responsive -->

												</div>
												<!-- /.panel-body -->
											</div>
											<!-- /.panel -->
										</div>

									</div>
								</div>
							</div>
						</div>
						<!-- /.panel -->
					</div>
					<!-- /.col-lg-6 -->

					<!-- /.col-lg-12 -->
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

	<!-- Custom Theme JavaScript -->
	<script src="../js/startmin.js"></script>
	<script src="../js/jquery.plugin.min.js"></script>
	<script src="../js/jquery.datepick.js"></script>
	<script>
        $(function() {
        	$('#popupDatepicker').datepick({  maxDate: new Date() });
        	$('#popupDatepicker1').datepick({  maxDate: new Date() });
        	$('#popupDatepicker3').datepick({  maxDate: new Date() });
        	$('#popupDatepicker4').datepick({  maxDate: new Date() });
        });
        
        function showDate(date) {
        	alert('The date chosen is ' + date);
        }
    </script>

	<script type="text/javascript">
	$(document).ready(function() {
                    
      // Javascript to enable link to tab
            var hash = document.location.hash;
            var prefix = "tab_";
            if (hash) {
            $('.nav-tabs a[href='+hash.replace(prefix,"")+']').tab('show');
            } 
            
            //Change hash for page-reload
            $('.nav-tabs a').on('shown.bs.tab', function (e) {
            window.location.hash = e.target.hash.replace("#", "#" + prefix);
            });
                
         });

	</script>

</body>
</html>
