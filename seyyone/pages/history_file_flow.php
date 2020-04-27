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

?>
		<!-- Page Content -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Todays File Flow || 
							<?php

    $ttlen = $db->query(
            'select sum(TIME_TO_SEC(syy_length)) as ttlen from syy_task')->fetchAll();
    $tttime = timeformat($ttlen[0]['ttlen']);
    echo "Total Length = " . $tttime[0] . ':' . $tttime[1] . ':' . $tttime[2];
    ?>
						</h1>
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
										<li class="active"><a href="#tab-primary-1" data-toggle="tab">MT</a></li>
										<li><a href="#tab-primary-2" data-toggle="tab">ED</a></li>
										<li><a href="#tab-primary-3" data-toggle="tab">QC</a></li>
									</ul>
								</div>
							</div>
							<div class="panel-body">
								<div class="tab-content">
									<div class="tab-pane fade in active" id="tab-primary-1">

										<div class="col-lg-12">
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
																	<th>Details</th>
																	<th>MT Id</th>
																	<th>Name</th>
																	<th>Total Length</th>
																	<th>Finished Length</th>
																	<th>Remaining Length</th>
																	<th>Total Count</th>
																	<th>Finish Count</th>
																	<th>Remain Count</th>
																	<th>Performance</th>
																</tr>
															</thead>
															<tbody>                                               
                                                <?php
                                                $mtqery="SELECT a.syy_curr_mt as mtid ,syy_upload_date, count(*) as total_count ,SEC_TO_TIME(sum(TIME_TO_SEC(syy_length))) as total_time,sum(TIME_TO_SEC(syy_length)) as ttimesec FROM `syy_task` a GROUP BY syy_curr_mt,syy_upload_date HAVING DATE(a.syy_upload_date)=(SELECT max(DATE(syy_upload_date)) from `syy_task`)";
                                                $row_rr = $db->query($mtqery)->fetchAll();
                                                foreach ($row_rr as $dataarr) {
                                                    echo "<tr class=\"gradeA\">";
                                                    // echo $dataarr['syy_role']
                                                    // . '<br>';
                                                    echo "
                                                    <td>
                                                        
                                                         <a href=\"task_details.php?id= ".
                                                            $dataarr['mtid'] .
                                                            "#tab-primary-1\">
                                                            Info
                                                         </a>
                                                       
                                                     </td>
                                                    <td>" .
                                                            $dataarr['mtid'] .
                                                            "</td>";

                                                    $mtqu = "select syy_first_name from  syy_employee where 	syy_assign_id='" .
                                                            $dataarr['mtid'] .
                                                            "'";
                                                    // echo $mtqu;

                                                    $mtqun = $db->query($mtqu)->fetchAll();
                                                    //
                                                    echo "<td>" .
                                                            $mtqun[0]['syy_first_name'] .
                                                            "</td>";
                                                    $fquery = "select SEC_TO_TIME(sum(TIME_TO_SEC(syy_length))) as finish_len,count(*) as fin_c , sum(TIME_TO_SEC(syy_length)) as ftime FROM `syy_task` where syy_curr_mt='" .
                                                            $dataarr['mtid'] .
                                                            "' and syy_status in ('q','c')";
                                                    $flen = $db->query($fquery)->fetchAll();
                                                    echo "
                                                    <td class=\"center\">";

                                                    $rtime = timeformat(
                                                            $dataarr['ttimesec']);
                                                    echo $rtime[0] . ':' .
                                                            $rtime[1] . ':' .
                                                            $rtime[2];

                                                    echo "</td>";
                                                    echo "<td>";

                                                    $rtime = timeformat(
                                                            $flen[0]['ftime']);
                                                    echo $rtime[0] . ':' .
                                                            $rtime[1] . ':' .
                                                            $rtime[2];
                                                    echo "</td>";

                                                    echo "<td class=\"center\">";
                                                    $rtime = timeformat(
                                                            ($dataarr['ttimesec'] -
                                                            $flen[0]['ftime']));
                                                    echo $rtime[0] . ':' .
                                                            $rtime[1] . ':' .
                                                            $rtime[2];

                                                    echo "</td>
                                                    <td>" .
                                                            $dataarr['total_count'] . "</td>
                                                    <td>" . $flen[0]['fin_c'] . "</td>
                                                    <td>" .
                                                            ($dataarr['total_count'] -
                                                            $flen[0]['fin_c']) .
                                                            "</td>
                                                    <td class=\"center\">

                                                        <div class=\"progress\">
                                                          <div class=\"progress-bar progress-bar-success\" role=\"progressbar\" style=\"width:" . round(
                                                                    (($flen[0]['fin_c']) *
                                                                    100) /
                                                                    $dataarr['total_count'],
                                                                    0) . "%\">
                                                            " . round(
                                                                    (($flen[0]['fin_c']) *
                                                                    100) /
                                                                    $dataarr['total_count'],
                                                                    0) .
                                                            "%
                                                          </div>
                                                          <div class=\"progress-bar progress-bar-warning\" role=\"progressbar\" style=\"width:" . (100 - round(
                                                                    (($flen[0]['fin_c']) *
                                                                    100) /
                                                                    $dataarr['total_count'],
                                                                    0)) . "%\">
                                                            " . (100 - round(
                                                                    (($flen[0]['fin_c']) *
                                                                    100) /
                                                                    $dataarr['total_count'],
                                                                    0)) . "%
                                                          </div>
                                                        </div>
                                                 
                                                    </td>
                                                                                 
                                                    ";
                                                    echo "</tr>";
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
									<div class="tab-pane fade" id="tab-primary-2">
										<div class="col-lg-12">
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
																	<th>Details</th>
																	<th>ED Id</th>
																	<th>Name</th>
																	<th>Total Length</th>
																	<th>Finished Length</th>
																	<th>Remaining Length</th>
																	<th>Total Count</th>
																	<th>Finish Count</th>
																	<th>Remain Count</th>
																	<th>Performance</th>
																</tr>
															</thead>
															<tbody>                                               
                                                <?php
                                                $edquery="SELECT a.syy_curr_ed as edid ,syy_upload_date, count(*) as total_count ,SEC_TO_TIME(sum(TIME_TO_SEC(syy_length))) as total_time,sum(TIME_TO_SEC(syy_length)) as ttimesec FROM `syy_task` a GROUP BY syy_curr_ed,syy_upload_date HAVING DATE(a.syy_upload_date)=(SELECT max(DATE(syy_upload_date)) from `syy_task`)";
                                                $row_rr = $db->query($edquery)->fetchAll();
                                                foreach ($row_rr as $dataarr) {
                                                    echo "<tr class=\"gradeA\">";
                                                    // echo $dataarr['syy_role']
                                                    // . '<br>';
                                                    echo "
                                                    <td>
                                                         <a href=\"task_details.php?id=" .
                                                            $dataarr['edid'] . "#tab-primary-2\">
                                                            Info
                                                         </a>
                                                     </td>
                                                    <td>" . $dataarr['edid'] ."</td>";
                                                            $etqu="select syy_first_name from  syy_employee where 	syy_assign_id='". $dataarr['edid']."'";
                                                            //echo $mtqu;
                                                            
                                                            $etqun = $db->query($etqu)->fetchAll();
                                                            echo "<td>".$etqun[0]['syy_first_name']."</td>";
                                                    $fquery = "select SEC_TO_TIME(sum(TIME_TO_SEC(syy_length))) as finish_len,count(*) as fin_c , sum(TIME_TO_SEC(syy_length)) as ftime FROM `syy_task` where syy_curr_ed='" .
                                                            $dataarr['edid'] .
                                                            "' and syy_status in ('c')";
                                                    $flen = $db->query($fquery)->fetchAll();
                                                    echo "
                                                    <td class=\"center\">";

                                                    $rtime = timeformat(
                                                            $dataarr['ttimesec']);
                                                    echo $rtime[0] . ':' .
                                                            $rtime[1] . ':' .
                                                            $rtime[2];

                                                    echo "</td>";
                                                    echo "<td>";

                                                    $rtime = timeformat(
                                                            $flen[0]['ftime']);
                                                    echo $rtime[0] . ':' .
                                                            $rtime[1] . ':' .
                                                            $rtime[2];
                                                    echo "</td>";

                                                    echo "<td class=\"center\">";
                                                    $rtime = timeformat(
                                                            ($dataarr['ttimesec'] -
                                                            $flen[0]['ftime']));
                                                    echo $rtime[0] . ':' .
                                                            $rtime[1] . ':' .
                                                            $rtime[2];

                                                    echo "</td>
                                                    <td>" .
                                                            $dataarr['total_count'] . "</td>
                                                    <td>" . $flen[0]['fin_c'] . "</td>
                                                    <td>" .
                                                            ($dataarr['total_count'] -
                                                            $flen[0]['fin_c']) .
                                                            "</td>

                                                    <td class=\"center\">
                                                        <div class=\"progress\">
                                                          <div class=\"progress-bar progress-bar-success\" role=\"progressbar\" style=\"width:" . round(
                                                                    (($flen[0]['fin_c']) *
                                                                    100) /
                                                                    $dataarr['total_count'],
                                                                    0) . "%\">
                                                            " . round(
                                                                    (($flen[0]['fin_c']) *
                                                                    100) /
                                                                    $dataarr['total_count'],
                                                                    0) .
                                                            "%
                                                          </div>
                                                          <div class=\"progress-bar progress-bar-warning\" role=\"progressbar\" style=\"width:" . (100 - round(
                                                                    (($flen[0]['fin_c']) *
                                                                    100) /
                                                                    $dataarr['total_count'],
                                                                    0)) . "%\">
                                                            " . (100 - round(
                                                                    (($flen[0]['fin_c']) *
                                                                    100) /
                                                                    $dataarr['total_count'],
                                                                    0)) . "%
                                                          </div>
                                                        </div>
                                                     </td>
                                                                                 
                                                    ";
                                                    echo "</tr>";
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
									<div class="tab-pane fade" id="tab-primary-3">
										<div class="col-lg-12">
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
																	<th>Details</th>
																	<th>OC Id</th>
																	<th>Name</th>
																	<th>Total Length</th>
																	<th>Finished Length</th>
																	<th>Remaining Length</th>
																	<th>Total Count</th>
																	<th>Finish Count</th>
																	<th>Remain Count</th>
																	<th>Performance</th>
																</tr>
															</thead>
															<tbody>                                               
                                                <?php
                                                $ocquery="SELECT a.syy_curr_oc as edid ,syy_upload_date, count(*) as total_count ,SEC_TO_TIME(sum(TIME_TO_SEC(syy_length))) as total_time,sum(TIME_TO_SEC(syy_length)) as ttimesec FROM `syy_task` a GROUP BY syy_curr_oc,syy_upload_date HAVING DATE(a.syy_upload_date)=(SELECT max(DATE(syy_upload_date)) from `syy_task`)";
                                                $row_rr = $db->query($ocquery)->fetchAll();
                                                foreach ($row_rr as $dataarr) {
                                                    echo "<tr class=\"gradeA\">";
                                                    // echo $dataarr['syy_role']
                                                    // . '<br>';
                                                    echo "
                                                    <td> <a href=\"task_details.php?id=" .
                                                            $dataarr['edid'] . "#tab-primary-3\">
                                                            Info
                                                         </a></td>
                                                    <td>" . $dataarr['edid'] . "</td>";
                                                            $otqu="select syy_first_name from  syy_employee where 	syy_assign_id='". $dataarr['edid']."'";
                                                            //echo $mtqu;
                                                            
                                                            $otqun = $db->query($otqu)->fetchAll();
                                                            echo"<td>".$otqun[0]['syy_first_name']."</td>";
                                                    $fquery = "select SEC_TO_TIME(sum(TIME_TO_SEC(syy_length))) as finish_len,count(*) as fin_c , sum(TIME_TO_SEC(syy_length)) as ftime FROM `syy_task` where syy_curr_oc='" .
                                                            $dataarr['edid'] .
                                                            "' and syy_status in ('c')";
                                                    $flen = $db->query($fquery)->fetchAll();
                                                    echo "
                                                    <td class=\"center\">";

                                                    $rtime = timeformat(
                                                            $dataarr['ttimesec']);
                                                    echo $rtime[0] . ':' .
                                                            $rtime[1] . ':' .
                                                            $rtime[2];

                                                    echo "</td>";
                                                    echo "<td>";

                                                    $rtime = timeformat(
                                                            $flen[0]['ftime']);
                                                    echo $rtime[0] . ':' .
                                                            $rtime[1] . ':' .
                                                            $rtime[2];
                                                    echo "</td>";

                                                    echo "<td class=\"center\">";
                                                    $rtime = timeformat(
                                                            ($dataarr['ttimesec'] -
                                                            $flen[0]['ftime']));
                                                    echo $rtime[0] . ':' .
                                                            $rtime[1] . ':' .
                                                            $rtime[2];

                                                    echo "</td>
                                                    <td>" .
                                                            $dataarr['total_count'] . "</td>
                                                    <td>" . $flen[0]['fin_c'] . "</td>
                                                    <td>" .
                                                            ($dataarr['total_count'] -
                                                            $flen[0]['fin_c']) .
                                                            "</td>

                                                    <td class=\"center\">
                                                        <div class=\"progress\">
                                                          <div class=\"progress-bar progress-bar-success\" role=\"progressbar\" style=\"width:" . round(
                                                                    (($flen[0]['fin_c']) *
                                                                    100) /
                                                                    $dataarr['total_count'],
                                                                    0) . "%\">
                                                            " . round(
                                                                    (($flen[0]['fin_c']) *
                                                                    100) /
                                                                    $dataarr['total_count'],
                                                                    0) .
                                                            "%
                                                          </div>
                                                          <div class=\"progress-bar progress-bar-warning\" role=\"progressbar\" style=\"width:" . (100 - round(
                                                                    (($flen[0]['fin_c']) *
                                                                    100) /
                                                                    $dataarr['total_count'],
                                                                    0)) . "%\">
                                                            " . (100 - round(
                                                                    (($flen[0]['fin_c']) *
                                                                    100) /
                                                                    $dataarr['total_count'],
                                                                    0)) . "%
                                                          </div>
                                                        </div>
                                                     </td>
                                                                                 
                                                    ";
                                                    echo "</tr>";
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
	if (location.hash) {
		  $('a[href=\'' + location.hash + '\']').tab('show');
		}
		var activeTab = localStorage.getItem('activeTab');
		if (activeTab) {
		  $('a[href="' + activeTab + '"]').tab('show');
		}

		$('body').on('click', 'a[data-toggle=\'tab\']', function (e) {
		  e.preventDefault()
		  var tab_name = this.getAttribute('href')
		  if (history.pushState) {
		    history.pushState(null, null, tab_name)
		  }
		  else {
		    location.hash = tab_name
		  }
		  localStorage.setItem('activeTab', tab_name)

		  $(this).tab('show');
		  return false;
		});
		$(window).on('popstate', function () {
		  var anchor = location.hash ||
		    $('a[data-toggle=\'tab\']').first().attr('href');
		  $('a[href=\'' + anchor + '\']').tab('show');
		});
	</script>


</body>
</html>
