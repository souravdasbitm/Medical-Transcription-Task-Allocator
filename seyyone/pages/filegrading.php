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

/*  echo $_SESSION['id'];
 echo $_SESSION['role']; */


?>
		
		<!-- Page Content -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h5 class="page-header">Grading</h5>
					</div>
					<!-- /.col-lg-12 -->
				</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="panel tabbed-panel panel-primary">
							<div class="panel-heading clearfix">
								<div class="panel-title pull-left"></div>
								<div class="pull-left">
									 <form role="form" action="filegrading.php" method="post">								
     									 		Choose From Date : <input type="text" id="popupDatepicker" name="datefilter" STYLE="background-color: #073F33;" required autocomplete="off"> 
     									        To Date : <input type="text" id="popupDatepicker1" name="datefilter1" STYLE="background-color: #073F33;" required autocomplete="off"> 
     									 <input type="submit" class="btn btn-success" value="Click">
 									 </form>
								</div>
								<div class="panel-title pull-right"></div>
								<div class="pull-left">


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
														<table
															class="table table-striped table-bordered table-hover"
															id="dataTables-example">
															<thead>
																<tr>
																	<th>AudioName</th>
																	<th>Length</th>
																	<th>MTID</th>
																	<th>EDID</th>
																	<th>QCID</th>
																	<th>CLIENT</th>
																	<th>ED Grade</th>
																	<th>QC Grade</th>
																	<th>MT Time</th>
																	<th>ED Time</th>
																	<th>QC Time</th>
																</tr>
															</thead>
															<tbody>                                               
                                                <?php
                                                $mtQry = "SELECT * FROM `syy_task` WHERE ";
                                                
                                                if($_SESSION['role']=="emp"){
                                                    
                                                    if($_POST['datefilter']!=""){
                                                        
                                                        $mtQry.="(DATE_FORMAT(syy_ed_date_done ,'%m/%d/%Y') BETWEEN '".$_POST['datefilter']."' AND '".$_POST['datefilter1']."') and ((syy_curr_mt='".$_SESSION['id']."' OR syy_curr_ed='".$_SESSION['id']."' OR syy_curr_oc='".$_SESSION['id']."')) order by syy_ed_date_done desc";
                                                        
                                                    }else{
                                                        $mtQry.="date(syy_ed_date_done) = (SELECT MAX(date(syy_ed_date_done)) FROM `syy_task`) 
                                                                 and (syy_curr_mt='".$_SESSION['id']."' OR syy_curr_ed='".$_SESSION['id']."' OR syy_curr_oc='".$_SESSION['id']."') order by syy_ed_date_done desc";
                                                    }
                                                    
                                                }else{
                                                    
                                                    
                                                    if($_POST['datefilter']!=""){
                                                        
                                                        $mtQry.="(DATE_FORMAT(syy_ed_date_done ,'%m/%d/%Y') BETWEEN '".$_POST['datefilter']."' AND '".$_POST['datefilter1']."') order by syy_ed_date_done desc";
                                                        
                                                    }else{
                                                        $mtQry.="date(syy_ed_date_done) = (SELECT MAX(date(syy_ed_date_done)) FROM `syy_task`) order by syy_ed_date_done desc";
                                                    }
                                                }

                                                //echo $mtQry;
                                                $row_rr = $db->query($mtQry)->fetchAll();

                                                $i = 1;
                                                foreach ($row_rr as $dataarr) {
                                                    echo "<tr class=\"gradeA\">
                                                    <td>".$dataarr['syy_filename'] . "</td>  
                                                    <td>".$dataarr['syy_length']  ."</td>                                                 
                                                    <td>";
                                                    if ($dataarr['syy_curr_mt']=='777')
                                                    {echo $dataarr['syy_prev_mt'];}
                                                    else {echo $dataarr['syy_curr_mt'];}
                                                    echo "</td><td>";
                                                    if ($dataarr['syy_curr_ed']=='777')
                                                    {echo $dataarr['syy_prev_ed'];}
                                                    else {echo $dataarr['syy_curr_ed'];}

                                                   echo " </td>
                                                    <td class=\"center\">" .$dataarr['syy_curr_oc'] . "</td>
                                                    <td>" .$dataarr['syy_client'] . "</td>
                                                    <td>" .$dataarr['syy_grade'] . "</td>
                                                    <td>" .$dataarr['syy_qc_grade'] . "</td>
                                                    <td>" .$dataarr['syy_mt_date_done'] . "</td>
                                                    <td>" .$dataarr['syy_ed_date_done'] . "</td>
                                                    <td>" .$dataarr['syy_qc_date_done'] . "</td>
                                                </tr>";
                                                    echo "</tr>";
                                                    $i ++;
                                                }

                                                ?>
                                               
                                            </tbody>
														</table>

													</div>
													<!-- /.table-responsive -->

												</div>
												<!-- /.panel-body -->
											</div>
											<!-- /.panel -->
										</div>

									</div>



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
        });
        
        function showDate(date) {
        	alert('The date chosen is ' + date);
        }
    </script>
    
    <script>
	        var tf = new TableFilter('dataTables-example',{
	        base_path: '../js/tablefilter/'
	        });    
	        tf.init();
   </script>
</body>
</html>
