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
			<?php if($_SESSION['role']=="emp"){?>
				<div class="row">
					<div class="col-lg-12">
					   <?php 
					   $mtQry = "SELECT sum(syy_lc) as mt_c FROM `syy_linecount` WHERE ";
					   $edQry = "SELECT sum(syy_lc) as ed_c FROM `syy_linecount` WHERE ";
					   $qcQry = "SELECT sum(syy_lc) as qc_c FROM `syy_linecount` WHERE ";
					   $imtQry = "SELECT sum(syy_lc) as imt_c FROM `syy_linecount` WHERE ";
					   
					   
					       
					       if($_POST['datefilter']!=""){
					           
					           $mtQry.="(syy_date BETWEEN '".$_POST['datefilter']."' AND '".$_POST['datefilter1']."') and syy_mt='".$_SESSION['id']."' and syy_eid<>'".$_SESSION['id']."'";
					           $edQry.="(syy_date BETWEEN '".$_POST['datefilter']."' AND '".$_POST['datefilter1']."') and syy_eid='".$_SESSION['id']."' and syy_mt<>'".$_SESSION['id']."'";
					           $qcQry.="(syy_date BETWEEN '".$_POST['datefilter']."' AND '".$_POST['datefilter1']."') and syy_ocid='".$_SESSION['id']."'";
					           $imtQry.="(syy_date BETWEEN '".$_POST['datefilter']."' AND '".$_POST['datefilter1']."') and syy_mt='".$_SESSION['id']."' and syy_eid = '".$_SESSION['id']."'";
					           
					           
					       }else{
					           $mtQry.="date_format(str_to_date(syy_date, '%m/%d/%Y'), '%Y%m%d') = (SELECT MAX(date_format(str_to_date(syy_date, '%m/%d/%Y'), '%Y%m%d')) FROM `syy_linecount`) and (syy_mt='".$_SESSION['id']."') and (syy_eid<>'".$_SESSION['id']."')";
					           $edQry.="date_format(str_to_date(syy_date, '%m/%d/%Y'), '%Y%m%d') = (SELECT MAX(date_format(str_to_date(syy_date, '%m/%d/%Y'), '%Y%m%d')) FROM `syy_linecount`) and (syy_eid='".$_SESSION['id']."') and (syy_mt<>'".$_SESSION['id']."')";
					           $qcQry.="date_format(str_to_date(syy_date, '%m/%d/%Y'), '%Y%m%d') = (SELECT MAX(date_format(str_to_date(syy_date, '%m/%d/%Y'), '%Y%m%d')) FROM `syy_linecount`) and (syy_ocid='".$_SESSION['id']."')";
					           $imtQry.="date_format(str_to_date(syy_date, '%m/%d/%Y'), '%Y%m%d') = (SELECT MAX(date_format(str_to_date(syy_date, '%m/%d/%Y'), '%Y%m%d')) FROM `syy_linecount`) and (syy_eid='".$_SESSION['id']."') and (syy_mt='".$_SESSION['id']."')";
					       }
					       
					       $mt_rr = $db->query($mtQry)->fetchAll();
					       $ed_rr = $db->query($edQry)->fetchAll();
					       $qc_rr = $db->query($qcQry)->fetchAll();
					       $imt_rr = $db->query($imtQry)->fetchAll();
					       
					       $mt_tc=($mt_rr[0]['mt_c']!='' ? ($mt_rr[0]['mt_c']) : (0));
					       $ed_tc=($ed_rr[0]['ed_c']!='' ? ($ed_rr[0]['ed_c']) : (0));
					       $qc_tc=($qc_rr[0]['qc_c']!='' ? ($qc_rr[0]['qc_c']) : (0));
					       $imt_tc=($imt_rr[0]['imt_c']!='' ? ($imt_rr[0]['imt_c']) : (0));
					       
					       $tt_tc=($mt_tc+$ed_tc+$qc_tc+$imt_tc);
					       $nt_tc=$imt_tc+(($mt_tc+$ed_tc+$qc_tc)/2)
					       
					       
					   ?>
						<h5 class="page-header">
						MT : <span class="badge badge-secondary"><?php echo ($mt_rr[0]['mt_c']!='' ? ($mt_rr[0]['mt_c']) : (0));?></span>
						ED : <span class="badge badge-secondary"><?php echo ($ed_rr[0]['ed_c']!='' ? ($ed_rr[0]['ed_c']) : (0));?></span>
						QC : <span class="badge badge-secondary"><?php echo ($qc_rr[0]['qc_c']!='' ? ($qc_rr[0]['qc_c']) : (0));?></span>
						IMT : <span class="badge badge-secondary"><?php echo ($imt_rr[0]['imt_c']!='' ? ($imt_rr[0]['imt_c']) : (0));?></span>
						Total Line : <span class="badge badge-secondary"><?php echo $tt_tc;?></span>
						Net Line : <span class="badge badge-secondary"><?php echo $nt_tc;?></span>
						
						
						</h5>
					</div>
					<!-- /.col-lg-12 -->
				</div>
               <?php }else{?>
               		<div class="row">
               		  <div class="col-lg-12">
               		     <h5 class="page-header">
               		     <?php 
               		     $adQry = "SELECT sum(syy_lc) as ad_c FROM `syy_linecount` WHERE ";
               		     
               		     if($_POST['datefilter']!=""){
               		         $adQry.="(syy_date BETWEEN '".$_POST['datefilter']."' AND '".$_POST['datefilter1']."')";
               		     }else{
               		         $adQry.="date_format(str_to_date(syy_date, '%m/%d/%Y'), '%Y%m%d') = (SELECT MAX(date_format(str_to_date(syy_date, '%m/%d/%Y'), '%Y%m%d')) FROM `syy_linecount`)";
               		     }   
               		     
               		     $ad_rr = $db->query($adQry)->fetchAll();
               		     ?>
               		     Total Line Count : <span class="badge badge-secondary"><?php echo $ad_rr[0]['ad_c'];?></span>
               		     
               		     </h5>
               		  </div>
               		</div>
               <?php }?>
				<div class="row">
					<div class="col-lg-12">
						<div class="panel tabbed-panel panel-primary">
							<div class="panel-heading clearfix">
								<div class="panel-title pull-left"></div>
								<div class="pull-left">
									 <form role="form" action="linecount.php" method="post">								
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
																	<th>Folder</th>
																	<th>Line Count</th>
																	<th>Date</th>
																</tr>
															</thead>
															<tbody>                                               
                                                <?php
                                                $mtQry = "SELECT * FROM `syy_linecount` WHERE ";
                                                
                                                if($_SESSION['role']=="emp"){
                                                    
                                                    if($_POST['datefilter']!=""){
                                                        
                                                        $mtQry.="(syy_date BETWEEN '".$_POST['datefilter']."' AND '".$_POST['datefilter1']."') and ((syy_mt='".$_SESSION['id']."' OR syy_eid='".$_SESSION['id']."' OR syy_ocid='".$_SESSION['id']."')) order by date_format(str_to_date(syy_date, '%m/%d/%Y'), '%Y%m%d') DESC";
                                                        
                                                    }else{
                                                        $mtQry.="date_format(str_to_date(syy_date, '%m/%d/%Y'), '%Y%m%d') = (SELECT MAX(date_format(str_to_date(syy_date, '%m/%d/%Y'), '%Y%m%d')) FROM `syy_linecount`) 
                                                                 and (syy_mt='".$_SESSION['id']."' OR syy_eid='".$_SESSION['id']."' OR syy_ocid='".$_SESSION['id']."') order by date_format(str_to_date(syy_date, '%m/%d/%Y'), '%Y%m%d') DESC";
                                                    }
                                                    
                                                }else{
                                                    
                                                    
                                                    if($_POST['datefilter']!=""){
                                                        
                                                        $mtQry.="(syy_date BETWEEN '".$_POST['datefilter']."' AND '".$_POST['datefilter1']."') order by date_format(str_to_date(syy_date, '%m/%d/%Y'), '%Y%m%d') DESC";
                                                        
                                                    }else{
                                                        $mtQry.="date_format(str_to_date(syy_date, '%m/%d/%Y'), '%Y%m%d') = (SELECT MAX(date_format(str_to_date(syy_date, '%m/%d/%Y'), '%Y%m%d')) FROM `syy_linecount`) order by date_format(str_to_date(syy_date, '%m/%d/%Y'), '%Y%m%d') DESC";
                                                    }
                                                }

                                                
                                                $row_rr = $db->query($mtQry)->fetchAll();

                                                $i = 1;
                                                foreach ($row_rr as $dataarr) {
                                                    $expl=explode(":",$dataarr['syy_length']);
                                                    if($expl[0]=="12"){
                                                        $modArr=Array("00",$expl[1],$expl[2]);
                                                        $length=implode(":", $modArr);
                                                    }else{
                                                        $length=$dataarr['syy_length'];
                                                    }
                                                    
                                                    echo "<tr class=\"gradeA\">
                                                    <td>".$dataarr['syy_audioname'] . "</td>  
                                                    <td>".$length."</td>                                                 
                                                    <td>".$dataarr['syy_mt']."</td>
                                                    <td class=\"center\">".$dataarr['syy_eid']."</td>
                                                    <td class=\"center\">" .$dataarr['syy_ocid'] . "</td>
                                                    <td>" .$dataarr['syy_client'] . "</td>
                                                    <td>" .$dataarr['syy_folder'] . "</td>
                                                    <td class=\"center\">" .$dataarr['syy_lc'] . "</td>
                                                    <td class=\"center\">" .$dataarr['syy_date'] . "</td>
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
</body>
</html>
