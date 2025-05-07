<?php 
session_start();
include('include/con.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<title>
		Dashboard
	</title>
	<!--     Fonts and icons     -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<!-- Nucleo Icons -->
	<link href="assets/css/nucleo-icons.css" rel="stylesheet" />
	<link href="assets/css/nucleo-svg.css" rel="stylesheet" />
	<!-- Font Awesome Icons -->
	<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
	<link href="assets/css/nucleo-svg.css" rel="stylesheet" />
	<!-- CSS Files -->
	<link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.8" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

	
	<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.3.1/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">


	<style>
		.chartAreaWrapper {
			width: 1500px;
		}
	</style>
</head>

<body class="g-sidenav-show  bg-gray-100">
	<?php
    include('include/side-navbar.php');
    
        $q = mysqli_query($con, "SELECT COUNT(beda) as 'bedaCnt' FROM master");
    $r = mysqli_fetch_assoc($q);
    $bedaCnt = $r['bedaCnt'];
    
    $q = mysqli_query($con, "SELECT COUNT(DISTINCT(familyId)) as 'familyCnt', COUNT(memberId) as 'memberCnt' FROM `familyDetails`");
    $r = mysqli_fetch_assoc($q);
    $familyCnt = $r['familyCnt'];
    $memberCnt = $r['memberCnt'];
    
    ?>
	<main class="main-content position-relative border-radius-lg ">
		<div class="container-fluid">

			<div class="row">
				<div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
					<div class="card">
						<div class="card-body p-3">
							<div class="row">
								<div class="col-8">
									<div class="numbers">
										<p class="text-sm mb-0 text-capitalize font-weight-bold"># Beda</p>
										<h5 class="font-weight-bolder mb-0">
											<?php echo $bedaCnt; ?>
										</h5>
									</div>
								</div>
								<div class="col-4 text-end">
									<div
										class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
										<i class="fa-solid fa-building text-lg opacity-10" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
					<div class="card">
						<div class="card-body p-3">
							<div class="row">
								<div class="col-8">
									<div class="numbers">
										<p class="text-sm mb-0 text-capitalize font-weight-bold"># Family</p>
										<h5 class="font-weight-bolder mb-0">
											<?php echo $familyCnt ?>
										</h5>
									</div>
								</div>
								<div class="col-4 text-end">
									<div
										class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
										<i class="fa-solid fa-users text-lg opacity-10" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
					<div class="card">
						<div class="card-body p-3">
							<div class="row">
								<div class="col-8">
									<div class="numbers">
										<p class="text-sm mb-0 text-capitalize font-weight-bold"># Member</p>
										<h5 class="font-weight-bolder mb-0">
											<?php echo $memberCnt; ?>
										</h5>
									</div>
								</div>
								<div class="col-4 text-end">
									<div
										class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
										<i class="fa-solid fa-user text-lg opacity-10" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-7 my-4">
					<div class="card z-index-2">
						<div class="card-header p-3 pb-0">
						    <h6>Beda Over Entries</h6>
						</div>
						<div class="card-body p-3">
							<div class="chart">
								<div class="chartAreaWrapper">
									<canvas id="line-chart-gradient" class="chart-canvas" height="300"
										style="/*display: block; box-sizing: border-box; height: 300px; width: 563px;*/"
										width="1500"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="col-md-5 my-4">
					<div class="card z-index-2">
						<div class="card-header p-3 pb-0">
						    <h6>Operator Over Entries</h6>
						</div>
						<div class="card-body p-3">
							<div class="chart">
								<div class="chartAreaWrapper">
									<canvas id="bar-chart" class="chart-canvas" height="300"
										style="/*display: block; box-sizing: border-box; height: 300px; width: 563px;*/"
										width="1500"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row my-4">
				<div class="col-lg-6 col-md-6 mb-md-0 mb-4 ">
					<div class="card">
						<div class="card-header pb-0">
							<h6>Beda Wise </h6>
							<p class="text-sm mb-0">
								<!--<i class="fa fa-check text-info" aria-hidden="true"></i>-->
								<!--<span class="font-weight-bold ms-1">30 done</span> this month-->
							</p>
						</div>
						<div class="card-body p-0 pb-2">
							<div class="table-responsive">
								<table class="table align-items-center dataTables" id="beda-wise-table">
									<thead>
										<tr>
											<th class="text-uppercase text-xs font-weight-bolder ">Beda</th>
											<th class="text-uppercase text-center text-xs font-weight-bolder  ps-2">#
												Family</th>
											<th class="text-center text-uppercase  text-xs font-weight-bolder "># Member
											</th>
										</tr>
									</thead>
									<tbody>
										<?php
                                        $bedaWiseArray = array();
                                        $q = mysqli_query($con, "SELECT DISTINCT(master.beda), COUNT(familyDetails.memberId) as 'memberCnt', COUNT(DISTINCT(familyDetails.familyId)) as 'familyCnt' FROM master LEFT JOIN familyDetails ON master.beda = familyDetails.beda GROUP BY master.beda ORDER BY COUNT(familyDetails.memberId) DESC;");
                                        while($r = mysqli_fetch_assoc($q)){
                                            $beda = $r['beda'];
                                            $memberCnt = $r['memberCnt'];
                                            $familyCnt = $r['familyCnt'];
                                            
                                            $bedaWiseArray[] = array(
                                                "beda" => $beda, 
                                                "memberCnt" => $memberCnt, 
                                                "familyCnt" =>$familyCnt
                                                );
                                                
                                                $sqlQuery1 = "SELECT name, aadharNo, caste, dob FROM familyDetails WHERE familyHead  = '';";
                                                $sqlQuery2 = "SELECT name, aadharNo, caste, dob FROM familyDetails WHERE 1 ";
                                                
                                        ?>
										<tr>
											<td>
												<?php echo $beda ?>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold">
													<a href="parameter-report-details?q=<?php echo base64_encode($sqlQuery1)."&beda=".$beda; ?>"><?php echo $familyCnt ?></a>
												</span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold">
													<a href="parameter-report-details?q=<?php echo base64_encode($sqlQuery2)."&beda=".$beda ?>"><?php echo $memberCnt ?></a>
												</span>
											</td>
										</tr>
										<?php 
                                        }
                                        ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-6 col-md-6 mb-md-0 mb-4">
					<div class="card">
						<div class="card-header pb-0">
							<h6>Operator Wise</h6>
							<p class="text-sm mb-0">
								<!--<i class="fa fa-check text-info" aria-hidden="true"></i>-->
								<!--<span class="font-weight-bold ms-1">30 done</span> this month-->
							</p>
						</div>
						<div class="card-body p-0 pb-2">
							<div class="table-responsive">
								<table class="table align-items-center dataTables" id="operator-wise-table">
									<thead>
										<tr>
											<th class="text-uppercase text-xs font-weight-bolder ">Operator</th>
											<th class="text-uppercase text-center text-xs font-weight-bolder "># Beda
											</th>
											<th class="text-uppercase text-center text-xs font-weight-bolder  ps-2">#
												Family</th>
											<th class="text-center text-uppercase  text-xs font-weight-bolder "># Member
											</th>
										</tr>
									</thead>
									<tbody>
										<?php
                                        
                                        $operatorWiseArray = array();
                                        
                                        $q = mysqli_query($con, "SELECT users.name, familyDetails.createdId, COUNT(DISTINCT(familyDetails.beda)) as 'bedaCnt' , COUNT(DISTINCT(familyDetails.memberId)) as 'memberCnt', COUNT(DISTINCT(familyDetails.familyId)) as 'familyCnt' FROM familyDetails JOIN users ON familyDetails.createdId = users.user_id GROUP BY familyDetails.createdId ORDER BY COUNT(familyDetails.memberId) DESC;;");
                                        while($r = mysqli_fetch_assoc($q)){
                                            $operatorId = $r['createdId'];
                                            $operator = $r['name'];
                                            $bedaCnt = $r['bedaCnt'];
                                            $memberCnt = $r['memberCnt'];
                                            $familyCnt = $r['familyCnt'];
                                            
                                            $operatorWiseArray[] = array(
                                                "operator" =>$operator, 
                                                "bedaCnt" => $bedaCnt, 
                                                "memberCnt" => $memberCnt, 
                                                "familyCnt" =>$familyCnt
                                                );
                                                
                                                $sqlQuery1 = "SELECT name, aadharNo, caste, dob FROM familyDetails WHERE familyHead  = '' AND createdId = '$operatorId';";
                                                $sqlQuery2 = "SELECT name, aadharNo, caste, dob FROM familyDetails WHERE 1 AND createdId = '$operatorId';";
                                        ?>
										<tr>
											<td>
												<?php echo $operator ?>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold">
													<?php echo $bedaCnt ?>
												</span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold">
													<a href="parameter-report-details?q=<?php echo base64_encode($sqlQuery1); ?>"><?php echo $familyCnt ?></a>
												</span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold">
													<a href="parameter-report-details?q=<?php echo base64_encode($sqlQuery2) ?>"><?php echo $memberCnt ?></a>
												</span>
											</td>
										</tr>
										<?php 
                                        }
                                        $myfile = fopen("newjson.json", "w") or die("Unable to open file!");
                                        $json = json_encode($operatorWiseArray);
                                        fwrite($myfile, $json);
                                        fclose($myfile);
                                        ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php include('include/footer.php'); ?>
		</div>
	</main>
	<!--   Core JS Files   -->
	<script src="assets/js/core/popper.min.js"></script>
	<script src="assets/js/core/bootstrap.min.js"></script>
	<script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
	<script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
	<script src="assets/js/plugins/chartjs.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
		integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

	<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

	<script src="https://demos.creative-tim.com/soft-ui-dashboard-pro/assets/js/plugins/datatables.js"></script>
	<!--<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>-->
	<script src="https://cdn.datatables.net/rowreorder/1.3.1/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    
	<script src="https://demos.creative-tim.com/soft-ui-dashboard-pro/assets/js/plugins/chartjs.min.js"></script>

	<script>
		var win = navigator.platform.indexOf('Win') > -1;
		if (win && document.querySelector('#sidenav-scrollbar')) {
			var options = {
				damping: '0.5'
			}
			Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
		}
		
		/*$('table.dataTables').DataTable({
		    'responsive': true,
            'pageLength': 5
		});*/

		let bedaWiseTable = new simpleDatatables.DataTable("#beda-wise-table", {
			searchable: true,
			fixedHeight: true,
			responsive: true
		});

		let operatorWiseTable = new simpleDatatables.DataTable("#operator-wise-table", {
			searchable: true,
			fixedHeight: true,
			responsive: true
		});

		// Line chart with gradient
		var ctx2 = document.getElementById("line-chart-gradient").getContext("2d");

		var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

		gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
		gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
		gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

		var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

		gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
		gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
		gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

		new Chart(ctx2, {
			type: "line",
			data: {
				labels: [
    			    <?php
    			    $i = 0;
    			    foreach($bedaWiseArray as $bedaWise) {
    			        if ($i > 0) {
    			            echo ",";
    			        }
    			        echo "'".$bedaWise['beda']."'";
    			        $i++;
    			    }
    			    ?>
    			    ],
    	        datasets: [
			    {
    				label: "Member Entry",
    				tension: 0.4,
    				borderWidth: 0,
    				pointRadius: 2,
    				borderColor: "#17c1e8",
    				borderWidth: 3,
    				backgroundColor: gradientStroke1,
    				fill: true,
    				data: [
    				    <?php
    				    $i = 0;
    				    foreach($bedaWiseArray as $bedaWise) {
    				        if ($i > 0) {
    				            echo ",";
    				        }
    				        echo "'".$bedaWise['memberCnt']."'";
    				        $i++;
    				    }
    				    ?>
    				],
    				maxBarThickness: 6
			    },
			    {
			        label: "Family entry",
			        tension: 0.4,
			        borderWidth: 0,
			        pointRadius: 2,
			        borderColor: "#3A416F",
			        borderWidth: 3,
			        backgroundColor: gradientStroke2,
			        fill: true,
			        data: [
			            <?php
    				    $i = 0;
    				    foreach($bedaWiseArray as $bedaWise) {
    				        if ($i > 0) {
    				            echo ",";
    				        }
    				        echo "'".$bedaWise['familyCnt']."'";
    				        $i++;
    				    }
    				    ?>
			            ],
			        maxBarThickness: 6
			    }
    			],
    		},
			options: {
			responsive: true,
			maintainAspectRatio: false,
			plugins: {
				legend: {
					display: false,
				}
			},
			interaction: {
				intersect: false,
				mode: 'index',
			},
			scales: {
				y: {
					grid: {
						drawBorder: false,
						display: true,
						drawOnChartArea: true,
						drawTicks: false,
						borderDash: [5, 5]
					},
					ticks: {
						display: true,
						padding: 10,
						color: '#b2b9bf',
						font: {
							size: 11,
							family: "Open Sans",
							style: 'normal',
							lineHeight: 2
						},
					},
					title: {
                        display: true,
                        text: 'Member & Family count'
                    }
					
				},
				x: {
					grid: {
						drawBorder: false,
						display: false,
						drawOnChartArea: false,
						drawTicks: false,
						borderDash: [5, 5]
					},
					ticks: {
						display: true,
						color: '#b2b9bf',
						padding: 10,
						font: {
							size: 11,
							family: "Open Sans",
							style: 'normal',
							lineHeight: 2
						},
					},
					title: {
                        display: true,
                        text: 'Operator'
                    }
				},
			},
		},
    	});


		// Bar chart
		var ctx5 = document.getElementById("bar-chart").getContext("2d");

		new Chart(ctx5, {
			type: "bar",
			data: {
				labels: [
				    <?php
				    $i = 0;
				    foreach($operatorWiseArray as $operatorWise) {
				        if ($i > 0) {
				            echo ",";
				        }
				        echo "'".$operatorWise['operator']."'";
				        $i++;
				    }
				    ?>
    			    ],
    			datasets: [
    			{
    			    label: "# Memeber",
    			    weight: 5,
    				borderWidth: 0,
    				borderRadius: 4,
    				backgroundColor: '#3A416F',
    				data: [
    				    <?php
    				    $i = 0;
    				    foreach($operatorWiseArray as $operatorWise) {
    				        if ($i > 0) {
    				            echo ",";
    				        }
    				        echo "'".$operatorWise['memberCnt']."'";
    				        $i++;
    				    }
    				    ?>
    				    ],
    				    fill: false,
    				    maxBarThickness: 35
    			}
    			],
			},
			options: {
			responsive: true,
			maintainAspectRatio: false,
			plugins: {
				legend: {
					display: false,
				}
			},
			scales: {
				y: {
					grid: {
						drawBorder: false,
						display: true,
						drawOnChartArea: true,
						drawTicks: false,
						borderDash: [5, 5]
					},
					ticks: {
						display: true,
						padding: 10,
						color: '#9ca2b7',
					},
					title: {
                        display: true,
                        text: 'Member'
                    }
				},
				x: {
					grid: {
						drawBorder: false,
						display: false,
						drawOnChartArea: true,
						drawTicks: true,
					},
					ticks: {
						display: true,
						color: '#9ca2b7',
						padding: 10
					},
					title: {
                        display: true,
                        text: 'Beda'
                    }
				},
			},
		},
    	});


		$(".chart").css("overflow-x", "scroll");

	</script>
	<!-- Github buttons -->
	<script async defer src="https://buttons.github.io/buttons.js"></script>
	<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
	<script src="assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>

	<?php 
    
    require_once('include/sweetAlert.php');
    if(isset($_SESSION['status'])){
        $status = $_SESSION['status'];
        $msg = $_SESSION['msg'];
        if($status != true){
            toastMsg('error', $msg);
        } else {
            toastMsg('success', $msg);
        }
        unset($_SESSION['status']);
        unset($_SESSION['msg']);
    }
    if(isset($_GET['familyId']) && !isset($_GET['member'])){
    ?>

	<script>
		addMember('<?php echo $familyId ?>', 'family-details');
	</script>
	<?php
    }
    ?>
</body>

</html>