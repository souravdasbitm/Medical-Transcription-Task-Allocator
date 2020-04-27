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

if($_GET['uid']!=''){
    
    $db->query("DELETE FROM `syy_employee` WHERE `syy_assign_id`='".$_GET['uid']."'");
    header('Location: employee.php');
    
}

?>
		
		<!-- Page Content -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header"></h1>
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
										<li class="active"><a href="#tab-primary-1" data-toggle="tab">Employee
												List</a></li>
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
														<table
															class="table table-striped table-bordered table-hover"
															id="dataTables-example">
															<thead>
																<tr>
																	<th>Name</th>
																	<th>ID</th>
																	<th>Role</th>
																	<th>Birth Date</th>
																	<th>Actual Birth Date</th>
																	<th>Phone Number</th>
																	<th>User Name</th>
																	<th>Password</th>
																	<th>Operation</th>
																</tr>
															</thead>
															<tbody>                                               
                                                <?php
                                                $mtQry = "SELECT * FROM `syy_employee` order by syy_assign_id asc";
                                                $row_rr = $db->query($mtQry)->fetchAll();

                                                $i = 1;
                                                foreach ($row_rr as $dataarr) {
                                                    
                                                    $returnRow="SELECT * FROM `syy_task` 
                                                    WHERE (`syy_curr_mt`='".$dataarr['syy_assign_id']."' 
                                                    or `syy_curr_ed`='".$dataarr['syy_assign_id']."' 
                                                    or `syy_curr_oc`='".$dataarr['syy_assign_id']."')";
                                                    
                                                    $rowNum=$db->query($returnRow)->numRows();
                                                                                                        
                                                    if($dataarr['syy_username']!='admin' &&  $rowNum ==0){
                                                        
                                                        $dltbutton="<button type=\"button\" class=\"btn btn-primary btn-xs\">Delete</button>";
                                                    }else{
                                                        $dltbutton="";
                                                    }
                                                    
                                                    echo "<tr class=\"gradeA\">
                                                    <td>".$dataarr['syy_first_name'] . "</td>                                                   
                                                    <td>".$dataarr['syy_assign_id']  ."</td>
                                                    <td class=\"center\">".$dataarr['syy_given_role']."</td>
                                                    <td class=\"center\">" .$dataarr['syy_o_birthday'] . "</td>
                                                    <td>" .$dataarr['syy_a_birthday'] . "</td>
                                                    <td>" .$dataarr['syy_phone'] . "</td>
                                                    <td class=\"center\">" .$dataarr['syy_username'] . "</td>
                                                    <td class=\"center\">" .$dataarr['syy_password'] . "</td>
                                                    <td class=\"center\"><a href=\"employee.php?uid=".$dataarr['syy_assign_id']."\"".$dltbutton."</a></td>
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
