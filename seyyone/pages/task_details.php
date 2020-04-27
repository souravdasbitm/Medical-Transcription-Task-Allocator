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

if(isset($_POST['mtpost'])){
    if($_POST['currmtid']==$_POST['curredid']){
        $mt_up="update syy_task set syy_status='2' ,syy_grade='D', syy_mt_date_done='".date('Y-m-d H:i:s')."' where syy_task_id=".$_POST['mttask'];
    }else{
        $mt_up="update syy_task set syy_status='".$_POST['mtval']."' , syy_mt_date_done='".date('Y-m-d H:i:s')."' where syy_task_id=".$_POST['mttask'];
    }

    
    $db->query($mt_up);

}

if(isset($_POST['edpost'])){
    $ed_up="update syy_task set syy_grade='".$_POST['grading']."', syy_status='".$_POST['edval']."' , syy_ed_date_done='".date('Y-m-d H:i:s')."' where syy_task_id=".$_POST['edtask'];
    $db->query($ed_up);
    //$yyy=$_POST['edtask'];
   

}

if(isset($_POST['qcpost'])){
    $qc_up="update syy_task set syy_qc_grade='".$_POST['grading']."', syy_status='".$_POST['qcval']."' , syy_qc_date_done='".date('Y-m-d H:i:s')."' where syy_task_id=".$_POST['qctask'];
    $db->query($qc_up);
    //$yyy=$_POST['edtask'];
    
    
}
?>
		
		<!-- Page Content -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="page-header">
                          <div class="pull-left">
                          <h4>File List</h4>
                          </div>
                          <div class="pull-right">
                          <p>
                          <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Today's Progress
                          </a>
                        </p>
                        <?php 
                        $mtLen="SELECT sum(TIME_TO_SEC(syy_length)) as summt FROM `syy_task` where syy_curr_mt='".$ppid ."'  and syy_upload_date=(SELECT max(syy_upload_date) from `syy_task`)";
                        $mtfLen="SELECT sum(TIME_TO_SEC(syy_length)) as summt FROM `syy_task` where syy_curr_mt='".$ppid ."' and syy_status in ('1','2','3')  and syy_upload_date=(SELECT max(syy_upload_date) from `syy_task`)";
                        $mtLenFetch=$db->query($mtLen)->fetchAll();
                        $mtLenFetch2=$db->query($mtfLen)->fetchAll();
                        $mtftime = timeformat($mtLenFetch[0]['summt']);
                        $mtftime2 = timeformat($mtLenFetch2[0]['summt']);
                       
                        $pmtTime=$mtLenFetch[0]['summt']-$mtLenFetch2[0]['summt'];
                        $pmtTime1=timeformat($pmtTime);
                        
                        $edLen="SELECT sum(TIME_TO_SEC(syy_length)) as summt FROM `syy_task` where syy_curr_ed='".$ppid ."'  and syy_upload_date=(SELECT max(syy_upload_date) from `syy_task`)";
                        $edfLen="SELECT sum(TIME_TO_SEC(syy_length)) as summt FROM `syy_task` where syy_curr_ed='".$ppid ."' and syy_status in ('2','3')  and syy_upload_date=(SELECT max(syy_upload_date) from `syy_task`)";
                        $edLenFetch=$db->query($edLen)->fetchAll();
                        $edLenFetch2=$db->query($edfLen)->fetchAll();
                        $edftime = timeformat($edLenFetch[0]['summt']);
                        $edftime2 = timeformat($edLenFetch2[0]['summt']);
                        
                        $pedTime=$edLenFetch[0]['summt']-$edLenFetch2[0]['summt'];
                        $pedTime1=timeformat($pedTime);
                        
                        $qcLen="SELECT sum(TIME_TO_SEC(syy_length)) as summt FROM `syy_task` where syy_curr_oc='".$ppid ."'  and syy_upload_date=(SELECT max(syy_upload_date) from `syy_task`)";
                        $qcfLen="SELECT sum(TIME_TO_SEC(syy_length)) as summt FROM `syy_task` where syy_curr_oc='".$ppid ."' and syy_status='3'  and syy_upload_date=(SELECT max(syy_upload_date) from `syy_task`)";
                        $qcLenFetch=$db->query($qcLen)->fetchAll();
                        $qcLenFetch2=$db->query($qcfLen)->fetchAll();
                        $qcftime = timeformat($qcLenFetch[0]['summt']);
                        $qcftime2 = timeformat($qcLenFetch2[0]['summt']);
                        
                        $pqcTime=$qcLenFetch[0]['summt']-$qcLenFetch2[0]['summt'];
                        $pqcTime1=timeformat($pqcTime);
                        
                        ?>
                        <div class="collapse" id="collapseExample">
                          <div class="card card-body">
                            <table class="table">
                             <thead>
                                <tr>
                                  <th scope="col">Length</th>
                                  <th scope="col">Total</th>
                                  <th scope="col">Finished</th> 
                                  <th scope="col">Pending</th>                                 
                                </tr>
                              </thead>
                                  <tbody>
                                    <tr>
                                      <th scope="row">MT</th>
                                      <td><span class="label label-primary"><?php  echo $mtftime[0] . ':' . $mtftime[1] . ':' . $mtftime[2];?></span></td>
                                      <td><span class="label label-success"><?php  echo $mtftime2[0] . ':' . $mtftime2[1] . ':' . $mtftime2[2];?></span></td>
                                      <td><span class="label label-danger"><?php  echo $pmtTime1[0] . ':' . $pmtTime1[1] . ':' . $pmtTime1[2];?></span></td>
                                    </tr>
                                    <tr>
                                      <th scope="row">ED</th>
                                      <td><span class="label label-primary"><?php  echo $edftime[0] . ':' . $edftime[1] . ':' . $edftime[2];?></span></td>
                                      <td><span class="label label-success"><?php  echo $edftime2[0] . ':' . $edftime2[1] . ':' . $edftime2[2];?></span></td>
                                      <td><span class="label label-danger"><?php  echo $pedTime1[0] . ':' . $pedTime1[1] . ':' . $pedTime1[2];?></span></td>
                                    </tr>
                                    <tr>
                                      <th scope="row">QC</th>
                                      <td><span class="label label-primary"><?php  echo $qcftime[0] . ':' . $qcftime[1] . ':' . $qcftime[2];?></span></td>
                                      <td><span class="label label-success"><?php  echo $qcftime2[0] . ':' . $qcftime2[1] . ':' . $qcftime2[2];?></span></td>
                                      <td><span class="label label-danger"><?php  echo $pqcTime1[0] . ':' . $pqcTime1[1] . ':' . $pqcTime1[2];?></span></td>
                                    </tr>
                                  </tbody>
                               </table>
                          </div>
                        </div>
                          </div>
                          <div class="clearfix"></div>
                        </div>
					</div>
					<!-- /.col-lg-12 -->
				</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="panel tabbed-panel panel-primary">
							<div class="panel-heading clearfix">
								<div class="panel-title pull-left"></div>
								<div class="pull-right">
									<ul class="nav nav-tabs" id="myTab">
										<li class="active"><a href="#tab-primary-1" data-toggle="tab">MT</a></li>
										<li><a href="#tab-primary-2" data-toggle="tab">ED</a></li>
										<li><a href="#tab-primary-3" data-toggle="tab">QC</a></li>
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
																	<th>SNO</th>
																	<th>FLE</th>
																	<th>FILENAME</th>
																	<th>LENGTH</th>
																	<th>MT</th>
																	<th>ED</th>
																	<th>QC</th>
																	<th>CLIENT</th>
																	<th>FOLDER</th>
																	<th>MIN</th>
																	<th>DIC_NAME</th>
																	<th>FILE STATUS</th>
																	<th>SH</th>
																	<th>PRI</th>
																	<th>OMT</th>
																	<th>OED</th>
																</tr>
															</thead>
															<tbody>                                               
                                                <?php
                                                $mtQry = "SELECT * FROM `syy_task` where syy_curr_mt='".$ppid ."'"; 
                                               
                                                if($_GET[date]!=''){
                                                    
                                                    $mtQry.=" and syy_upload_date='".$_GET[date]."'";
                                                    
                                                }else {
                                                    
                                                    $mtQry.=" and syy_upload_date=(SELECT max(syy_upload_date) from `syy_task`)";
                                                }
                                                
                                                $row_rr = $db->query($mtQry)->fetchAll();

                                                $i = 1;
                                                foreach ($row_rr as $dataarr) {
                                                    echo "<tr class=\"gradeA\">                                                  
                                                    <td>" . $i . "</td>
                                                    <td class=\"center\">?</td>
                                                    <td class=\"center\">" .
                                                            $dataarr['syy_filename'] . "</td>
                                                    <td>" .
                                                            $dataarr['syy_length'] . "</td>
                                                    <td>" .
                                                            $dataarr['syy_curr_mt'] . "</td>
                                                    <td>" .
                                                            $dataarr['syy_curr_ed'] . "</td>
                                                    <td class=\"center\">" .
                                                            $dataarr['syy_curr_oc'] . "</td>
                                                    <td class=\"center\">" .
                                                            $dataarr['syy_client'] . "</td>
                                                    <td>" .
                                                            $dataarr['syy_folder'] . "</td>
                                                    <td>" .
                                                            $dataarr['syy_min'] . "</td>
                                                    <td>".$dataarr['syy_split_order']."</td>
                                                    <td class=\"center\">";
                                                            if($dataarr['syy_status']=='1' || $dataarr['syy_status']=='2' || $dataarr['syy_status']=='3'){
                                                                echo "<input type=\"submit\" name=\"mtpost\" class=\"btn btn-success btn-xs\" value=\"MT Uploaded\">";
                                                                
                                                            }else{
                                                                echo "<form role=\"form\" action=\"task_details.php\" method=\"post\" enctype=\"multipart/form-data\">
                                                                         <input type=\"hidden\" value=\"1\" name=\"mtval\">
                                                                         <input type=\"hidden\" value=\"".$dataarr['syy_task_id']."\" name=\"mttask\">
                                                                         <input type=\"hidden\" value=\"".$dataarr['syy_curr_mt']."\" name=\"currmtid\">  
                                                                         <input type=\"hidden\" value=\"".$dataarr['syy_curr_ed']."\" name=\"curredid\">                                        
                                                                         <input type=\"submit\" name=\"mtpost\" class=\"btn btn-primary btn-xs\" value=\"MT Upload\">
                                                                     </form>";
                                                            }
                                                    echo "</td>
                                                    <td class=\"center\">?</td>
                                                    <td>" .
                                                            $dataarr['syy_report_type'] . "</td>
                                                    <td>" .
                                                            $dataarr['syy_prev_mt'] . "</td>
                                                    <td>" .
                                                            $dataarr['syy_prev_ed'] . "</td>
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
									<div class="tab-pane fade" id="tab-primary-2">
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
																	<th>GRADE</th>
																	<th>FILE STATUS</th>
																	<th>SNO</th>
																	<th>FLE</th>
																	<th>FILENAME</th>
																	<th>LENGTH</th>
																	<th>MT</th>
																	<th>ED</th>
																	<th>QC</th>
																	<th>CLIENT</th>
																	<th>FOLDER</th>
																	<th>MIN</th>
																	<th>DIC_NAME</th>																	
																	<th>SH</th>
																	<th>PRI</th>
																	<th>OMT</th>
																	<th>OED</th>
																</tr>
															</thead>
															<tbody>                                               
                                               <?php
                                            $edQry="SELECT * FROM `syy_task` where syy_curr_ed='".$ppid."'";
                                            
                                            if($_GET[date]!=''){
                                                
                                                $edQry.=" and syy_upload_date='".$_GET[date]."'";
                                                
                                            }else {
                                                
                                                $edQry.=" and syy_upload_date=(SELECT max(syy_upload_date) from `syy_task`)";
                                            }
                                            
                                            $row_rr = $db->query($edQry)->fetchAll();

                                            $i = 1;
                                            foreach ($row_rr as $dataarr) {
                                                echo "<tr class=\"gradeA\">";
                                                if($dataarr['syy_status']=='1' || ($dataarr['syy_curr_mt']=='777' && $dataarr['syy_status']!='2')){
                                                    echo "<form role=\"form\" action=\"task_details.php\" method=\"post\" enctype=\"multipart/form-data\">
                                                                       <td>
                                                                         <select name=\"grading\" required>
                                                                            <option selected>Select</option>
                                                                            <option value=\"A\">A</option>
                                                                            <option value=\"B\">B</option>
                                                                            <option value=\"C\">C</option>
                                                                            <option value=\"D\">D</option>
                                                                            <option value=\"F\">F</option>
                                                                            <option value=\"Z\">Z</option>
                                                                        </select>
                                                                       </td>
                                                                      <td>
                                                                         <input type=\"hidden\" value=\"2\" name=\"edval\">
                                                                         <input type=\"hidden\" value=\"".$dataarr['syy_task_id']."\" name=\"edtask\">
                                                                         <input type=\"submit\" name=\"edpost\" class=\"btn btn-primary btn-xs\" value=\"ED Upload\">
                                                                     </form></td>";
                                                }else if($dataarr['syy_status']=='2'){
                                                    echo "<td>".$dataarr['syy_grade']."</td><td><button type=\"button\" name=\"edpost\" class=\"btn btn-success btn-xs\">ED Uploaded</button></td>";
                                                }else{
                                                    echo "<td></td><td><button type=\"button\" name=\"edpost\" class=\"btn btn-warning btn-xs\">MT Pending</button></td>";
                                                }
                                                echo "<td>" . $i . "</td>
                                                    <td class=\"center\">?</td>
                                                    <td class=\"center\">" .
                                                        $dataarr['syy_filename'] . "</td>
                                                    <td>" .
                                                        $dataarr['syy_length'] . "</td>
                                                    <td>" .
                                                        $dataarr['syy_curr_mt'] . "</td>
                                                    <td>" .
                                                        $dataarr['syy_curr_ed'] . "</td>
                                                    <td class=\"center\">" .
                                                        $dataarr['syy_curr_oc'] . "</td>
                                                    <td class=\"center\">" .
                                                        $dataarr['syy_client'] . "</td>
                                                    <td>" .
                                                        $dataarr['syy_folder'] . "</td>
                                                    <td>" .
                                                        $dataarr['syy_min'] . "</td>
                                                    <td>".$dataarr['syy_split_order']."</td>                                                    
                                                    <td class=\"center\">?</td>
                                                    <td>" .
                                                        $dataarr['syy_report_type'] . "</td>
                                                    <td>" .
                                                        $dataarr['syy_prev_mt'] . "</td>
                                                    <td>" .
                                                        $dataarr['syy_prev_ed'] . "</td>
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
																	<th>GRADE</th>
																	<th>FILE STATUS</th>
																	<th>SNO</th>
																	<th>FLE</th>
																	<th>FILENAME</th>
																	<th>LENGTH</th>
																	<th>MT</th>
																	<th>ED</th>
																	<th>QC</th>
																	<th>CLIENT</th>
																	<th>FOLDER</th>
																	<th>MIN</th>
																	<th>DIC_NAME</th>
																	<th>SH</th>
																	<th>PRI</th>
																	<th>OMT</th>
																	<th>OED</th>
																</tr>
															</thead>
															<tbody>                                               
                                                <?php
                                                $qcQry="SELECT * FROM `syy_task` where syy_curr_oc='".$ppid."'";
                                                
                                                if($_GET[date]!=''){
                                                    
                                                    $qcQry.=" and syy_upload_date='".$_GET[date]."'";
                                                    
                                                }else {
                                                    
                                                    $qcQry.=" and syy_upload_date=(SELECT max(syy_upload_date) from `syy_task`)";
                                                }
                                                $row_rr = $db->query($qcQry)->fetchAll();

                                                $i = 1;
                                                foreach ($row_rr as $dataarr) {
                                                echo "<tr class=\"gradeA\">";
                                                if($dataarr['syy_status']=='2' || ($dataarr['syy_curr_ed']=='777' && $dataarr['syy_status']!='3')){
                                                    echo "<form role=\"form\" action=\"task_details.php\" method=\"post\" enctype=\"multipart/form-data\">
                                                                       <td>
                                                                         <select name=\"grading\" required>
                                                                            <option selected>Select</option>
                                                                            <option value=\"A\">A</option>
                                                                            <option value=\"B\">B</option>
                                                                            <option value=\"C\">C</option>
                                                                            <option value=\"D\">D</option>
                                                                            <option value=\"F\">F</option>
                                                                            <option value=\"Z\">Z</option>
                                                                        </select>
                                                                       </td>
                                                                      <td>
                                                                         <input type=\"hidden\" value=\"3\" name=\"qcval\">
                                                                         <input type=\"hidden\" value=\"".$dataarr['syy_task_id']."\" name=\"qctask\">
                                                                         <input type=\"submit\" name=\"qcpost\" class=\"btn btn-primary btn-xs\" value=\"QC Upload\">
                                                                     </form></td>";
                                                }else if($dataarr['syy_status']=='3'){
                                                    echo "<td>".$dataarr['syy_qc_grade']."</td><td><button type=\"button\" name=\"edpost\" class=\"btn btn-success btn-xs\">QC Uploaded</button></td>";
                                                }else{
                                                    echo "<td></td><td><button type=\"button\" name=\"edpost\" class=\"btn btn-warning btn-xs\">ED Pending</button></td>";
                                                }
                                                echo "<td>"  . $i ."</td>
                                                    <td class=\"center\">?</td>
                                                    <td class=\"center\">" .
                                                            $dataarr['syy_filename'] .
                                                            "</td>
                                                    <td>" .
                                                            $dataarr['syy_length'] .
                                                            "</td>
                                                    <td>" .
                                                            $dataarr['syy_curr_mt'] .
                                                            "</td>
                                                    <td>" .
                                                            $dataarr['syy_curr_ed'] .
                                                            "</td>
                                                    <td class=\"center\">" .
                                                            $dataarr['syy_curr_oc'] .
                                                            "</td>
                                                    <td class=\"center\">" .
                                                            $dataarr['syy_client'] .
                                                            "</td>
                                                    <td>" .
                                                            $dataarr['syy_folder'] .
                                                            "</td>
                                                    <td>" .
                                                            $dataarr['syy_min'] .
                                                            "</td>
                                                    <td>".$dataarr['syy_split_order']."</td>                                                   
                                                    <td class=\"center\">?</td>
                                                    <td>" .
                                                            $dataarr['syy_report_type'] .
                                                            "</td>
                                                    <td>" .
                                                            $dataarr['syy_prev_mt'] .
                                                            "</td>
                                                    <td>" .
                                                            $dataarr['syy_prev_ed'] . "</td>
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
