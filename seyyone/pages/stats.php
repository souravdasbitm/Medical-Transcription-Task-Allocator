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
						<h1 class="page-header">Stats</h1>
					</div>
					<!-- /.col-lg-12 -->
				</div>

				<div class="row">
					<div class="col-lg-12">

							<div class="panel panel-default">
								<div class="panel-heading">Client</div>
								<!-- /.panel-heading -->
								<div class="panel-body">
									<div class="demo-container">
										    <div id="chart-container">
       											<canvas id="graphCanvas"></canvas>
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

	<script src="../js/Chart.min.js"></script>
    <script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("chartlinecount.php",
                function (data)
                {
                    console.log(data);
                    var client = [];
                    var linecount = [];

                    for (var i in data) {
                        client.push(data[i].syy_folder);
                        linecount.push(data[i].lc);
                    }

                    var chartdata = {
                        labels: client,
                        datasets: [
                            {
                                label: 'Line Count',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: linecount
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'horizontalBar',
                        data: chartdata,
                        options: {
                            scaleShowValues: true,
                            scales: {
                              yAxes: [{
                                ticks: {
                                    autoSkip: false
                                }
                              }],
                              xAxes: [{
                                ticks: {
                                  
                                  beginAtZero: true
                                }
                              }]
                            }
                          }
                        
                    });
                });
            }
        }
        </script>


</body>
</html>
