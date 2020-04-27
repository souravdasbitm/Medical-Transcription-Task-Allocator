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
						<h1 class="page-header">Operation</h1>
					</div>
					<!-- /.col-lg-12 -->
				</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="panel tabbed-panel panel-primary">
							<div class="panel-heading clearfix">
								<div class="panel-title pull-left"></div>
								<div class="pull-right">
									<ul class="nav nav-tabs">
										<li class="active"><a href="#tab-primary-1" data-toggle="tab">Upload
												Task</a></li>
										<li><a href="#tab-primary-2" data-toggle="tab">Upload Line
												Count</a></li>
										<li><a href="#tab-primary-3" data-toggle="tab">Add New
												Employee</a></li>
										<li><a href="#tab-primary-4" data-toggle="tab">Reset Upload</a></li>
										<li><a href="#tab-primary-5" data-toggle="tab">Delete File</a></li>
										<li><a href="#tab-primary-6" data-toggle="tab">Delete Line Count</a></li>
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
															<form role="form" action="excelUpload.php" method="post" enctype="multipart/form-data">
																<fieldset>
																	<div class="form-group">
																		<label>Task Allocation File input <?php echo $_GET['msg']?></label> <input type="file" name="taskfile" required="true">
																	</div>

																	<!-- Change this to a button or input when using this as a form -->

																	<button type="submit"
																		class="btn btn-lg btn-success btn-block">Upload</button>

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
															<form role="form" action="lineUpload.php" method="post" enctype="multipart/form-data">
																<fieldset>
																	<div class="form-group">
																		<label>Line Count File input <?php echo $_GET['msg1']?></label> <input type="file" name="linefile" required="true">
																	</div>

																	<!-- Change this to a button or input when using this as a form -->

																	<button type="submit"
																		class="btn btn-lg btn-success btn-block">Upload</button>

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
									<div class="tab-pane fade" id="tab-primary-3">
										<div class="col-lg-12">
											<div class="panel panel-default">
												<div class="panel-heading"></div>
												<!-- /.panel-heading -->
												<div class="panel-body">
													<div class="table-responsive">
														<div class="col-lg-25">
															<h1>Add New Employee</h1>
															<form role="form" action="addemployee.php" method="post" enctype="multipart/form-data">
																<div class="form-group">
																	<label> Name*</label> <input class="form-control" name="name" required>
																</div>
																
																<div class="form-group">
																	<label> Phone</label> <input class="form-control" name="phone">
																</div>
																<div class="form-group">
																	<label> Employee ID / Username *</label> <input class="form-control" name="empid" required>
																</div>
																<div class="form-group">
																	<label> Role</label> <input class="form-control" name="role" required>
																</div>
																<div class="form-group">
																	<label> Birth Date (DD-MM-YYYY)</label> <input class="form-control" name="bdate">
																</div>
																<div class="form-group">
																	<label> Actual Birth Date (DD-MM-YYYY)</label> <input class="form-control" name="abdate">
																</div>
																<div class="form-group">
																	<label> Password*</label> <input class="form-control"  name="pass" required>
																</div>
																<button type="submit" class="btn btn-default">Submit</button>
																<button type="reset" class="btn btn-default">Reset</button>
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
									
						<div class="tab-pane fade" id="tab-primary-4">
										<div class="col-lg-12">
											<div class="panel panel-default">
												<div class="panel-heading"></div>
												<!-- /.panel-heading -->
												<div class="panel-body">
													<div class="table-responsive">
														<div class="col-lg-25">
															<form role="form" action="deleteRecords.php" method="post" enctype="multipart/form-data" onSubmit="if(!confirm('Please confirm you want to delete the records?')){return false;}">
																<div class="form-group">
																<label> Date</label> <input type="text" id="popupDatepicker" name="resetdate"  required autocomplete="off">
																<label><?php echo $_GET['msg']?></label>
																</div>																
																<button type="submit" class="btn btn-default">Submit</button>
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
									<div class="tab-pane fade" id="tab-primary-5">
										<div class="col-lg-12">
											<div class="panel panel-default">
												<div class="panel-heading"></div>
												<!-- /.panel-heading -->
												<div class="panel-body">
													<div class="table-responsive">
														<div class="col-lg-25">
															<form role="form" action="deleteRecords.php" method="post" enctype="multipart/form-data" onSubmit="if(!confirm('Please confirm you want to delete the record?')){return false;}">
																<div class="form-group">
																<label> File Name <?php echo $_GET['msg']?></label> <input type="text" class="form-control" name="deleteFile"  required autocomplete="off">																
																</div>																
																<button type="submit" class="btn btn-default">Submit</button>
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
						           <div class="tab-pane fade" id="tab-primary-6">
										<div class="col-lg-12">
											<div class="panel panel-default">
												<div class="panel-heading"></div>
												<!-- /.panel-heading -->
												<div class="panel-body">
													<div class="table-responsive">
														<div class="col-lg-25">
															<form role="form" action="deleteLineCount.php" method="post" enctype="multipart/form-data" onSubmit="if(!confirm('Please confirm you want to delete the records?')){return false;}">
																<div class="form-group">
																<label> Date from :</label> <input type="text" id="popupDatepicker1" name="resetlc"  required autocomplete="off">
																<label> to :</label> <input type="text" id="popupDatepicker2" name="resetlc1"  required autocomplete="off">
																<label><?php echo $_GET['msg']?></label>
																</div>																
																<button type="submit" class="btn btn-default">Submit</button>
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
        	$('#popupDatepicker2').datepick({  maxDate: new Date() });
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
