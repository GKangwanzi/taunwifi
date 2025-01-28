<?php include "includes/head.php"; ?>
<!-- END #header -->

<?php include "includes/menu.php"; ?>

<!-- BEGIN #content -->
<div id="content" class="app-content">
<!-- BEGIN container -->
<div class="container">
<!-- BEGIN row --> 
<div class="row justify-content-center">
<!-- BEGIN col-11 -->
<div class="col-xl-11">



<!-- BEGIN row -->
<!-- BEGIN row -->
<div class="row">

<div class="col-md-4">
	<!-- BEGIN card -->
	<div class="card mb-3 overflow-hidden fs-13px border-0 bg-gradient-custom-orange" style="min-height: 199px;">
		<!-- BEGIN card-img-overlay -->
		<div class="card-img-overlay mb-n4 me-n4 d-flex" style="bottom: 0; top: auto;">
		</div>
		<!-- END card-img-overlay -->
		
		<!-- BEGIN card-body -->
		<div class="card-body position-relative">
			<h5 class="text-white text-opacity-80 mb-3 fs-16px">New Incident</h5>
			<div style="padding-bottom: 10px; margin-top: -15px;" class="text-white text-opacity-40">in the last 1 week</div>
			<h3 class="text-white mt-n1">
			<?php
			$district = $_SESSION['district'];

			$sql = "SELECT * FROM parishes WHERE district = '$district' ";
			$result = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($result);
			$parish = $row['parishID'];


			$sql = "SELECT COUNT(incidentID) AS NumberOf2Weeks FROM incident WHERE date1 >= DATE_SUB(CURDATE(), INTERVAL 14 DAY) AND parish = '$parish' ";
			$result = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($result);
			$twoweeks = $row['NumberOf2Weeks'];

			$sql = "SELECT COUNT(incidentID) AS NumberOfIncidents FROM incident WHERE  date1 >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND parish = '$parish' ";
			$result = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($result);
			echo $row['NumberOfIncidents']."<br/>";;
			$oneweeksago = $row['NumberOfIncidents'];

			
			$twoweeksago = $twoweeks-$oneweeksago;
			$diff = $oneweeksago - $twoweeksago;  
			 


			  ?>
			</h3>
			
			<div class="text-white text-opacity-80 mb-4">
				<?php if($twoweeksago >= 1 ){

						if ($diff < 1) {
						$increase = ($diff/$twoweeksago)*100;
						echo "<i class='fa fa-caret-down'></i>";
						echo " ".-1*round($increase, 0)."% decrease <br>compare to last week";
					}elseif($diff >= 1){
						$increase = ($diff/$twoweeksago)*100;
						echo "<i class='fa fa-caret-up'></i>";
						echo " ".$increase."% increase <br>compare to last week";
					}  
					echo "</div>";
				}elseif($twoweeksago < 1){
						echo "not enough data yet";
					echo "</div>";
				} ?>
					
				 



			<div><a href="#" class="text-white d-flex align-items-center text-decoration-none">View report <i class="fa fa-chevron-right ms-2 text-white text-opacity-50"></i></a></div>
		</div>
		<!-- BEGIN card-body -->
	</div>
	<!-- END card -->
</div>
	
	<!-- BEGIN card -->
<div class="col-md-4">
	<div class="card mb-3 overflow-hidden fs-13px border-0 bg-gradient-custom-teal" style="min-height: 199px;">
		<!-- BEGIN card-img-overlay -->
		<div class="card-img-overlay mb-n4 me-n4 d-flex" style="bottom: 0; top: auto;">
		</div>
		<!-- END card-img-overlay -->
		
		<!-- BEGIN card-body -->
		<div class="card-body position-relative">
			<h5 class="text-white text-opacity-80 mb-3 fs-16px">Pending Incidents</h5>
			<div style="padding-bottom: 10px; margin-top: -15px;" class="text-white text-opacity-40">in the last 1 week</div>
			<h3 class="text-white mt-n1">
			<?php
			$sql = "SELECT COUNT(incidentID) AS NumberOf2Weeks FROM incident WHERE date1 >= DATE_SUB(CURDATE(), INTERVAL 14 DAY) AND status='incomplete' AND parish = '$parish' ";
			$result = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($result);
			$twoweeks = $row['NumberOf2Weeks'];

			$sql = "SELECT COUNT(incidentID) AS NumberOfIncidents FROM incident WHERE date1 >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND status='incomplete' AND parish = '$parish' ";
			$result = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($result);
			echo $row['NumberOfIncidents']."<br/>";;
			$oneweeksago = $row['NumberOfIncidents'];

			
			$twoweeksago = $twoweeks-$oneweeksago;
			$diff = $oneweeksago - $twoweeksago;  
			 
			  ?>
			</h3>
			
			<div class="text-white text-opacity-80 mb-4">
				<?php if($twoweeksago >= 1 ){

						if ($diff < 1) {
						$increasep = ($diff/$twoweeksago);
						echo "<i class='fa fa-caret-down'></i>";
						echo " ".-1*round($increasep, 0)."x increase in completion rate <br>compare to last week";
					}elseif($diff >= 1){
						$increasep = ($diff/$twoweeksago);
						echo "<i class='fa fa-caret-down'></i>";
						echo " ".$increasep."x decline in completion rate <br>compare to last week";
					}  
					echo "</div>";
				}elseif($twoweeksago < 1){
						echo "not enough data yet";
					echo "</div>";
				} ?>



			<div><a href="#" class="text-white d-flex align-items-center text-decoration-none">View report <i class="fa fa-chevron-right ms-2 text-white text-opacity-50"></i></a></div>
		</div>
		<!-- END card-body -->
	</div>
	<!-- END card -->
</div>

	
	<!-- BEGIN card -->
<div class="col-md-4">
	<div class=" card mb-3 overflow-hidden fs-13px border-0 bg-gradient-custom-indigo" style="min-height: 199px;">
		<!-- BEGIN card-img-overlay -->
		<div class="card-img-overlay mb-n4 me-n4 d-flex" style="bottom: 0; top: auto;">
			
		</div>
		<!-- end card-img-overlay -->
		
		<!-- BEGIN card-body -->
		<div class="card-body position-relative">
			<h5 class="text-white text-opacity-80 mb-3 fs-16px">Completed Incidents</h5>
			<div style="padding-bottom: 10px; margin-top: -15px;" class="text-white text-opacity-40">in the last 1 week</div>
			<h3 class="text-white mt-n1">
			<?php
			$sql = "SELECT COUNT(incidentID) AS NumberOf2Weeks FROM incident WHERE date1 >= DATE_SUB(CURDATE(), INTERVAL 14 DAY) AND status='complete' AND parish = '$parish' ";
			$result = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($result);
			$twoweeks = $row['NumberOf2Weeks'];

			$sql = "SELECT COUNT(incidentID) AS NumberOfIncidents FROM incident WHERE date1 >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND status='complete' AND parish = '$parish' ";
			$result = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($result);
			echo $row['NumberOfIncidents']."<br/>";;
			$oneweeksago = $row['NumberOfIncidents'];

			$twoweeksago = $twoweeks-$oneweeksago;
			$diff = $oneweeksago - $twoweeksago;  
			 
			  ?>
			</h3>
			
			<div class="text-white text-opacity-80 mb-4">
				<?php if($twoweeksago >= 1 ){

						if ($diff < 1) {
						$increasep = ($diff/$twoweeksago);
						echo "<i class='fa fa-caret-down'></i>";
						echo " ".-1*round($increasep, 0)."x increase in completion rate <br>compare to last week";
					}elseif($diff >= 1){
						$increasep = ($diff/$twoweeksago);
						echo "<i class='fa fa-caret-down'></i>";
						echo " ".$increasep."x decline in completion rate <br>compare to last week";
					}  
					echo "</div>";
				}elseif($twoweeksago < 1){
						echo "not enough data yet";
					echo "</div>";
				} ?>



			<div><a href="#" class="text-white d-flex align-items-center text-decoration-none">View report <i class="fa fa-chevron-right ms-2 text-white text-opacity-50"></i></a></div>
		</div>
		<!-- END card-body -->
	</div>
	<!-- END card -->
</div>

</div>
<!-- END row -->

<!-- BEGIN row -->
<div class="row">

<!-- BEGIN col-6 -->
<div class="col-xl-12 mb-3">
<!-- BEGIN card -->
<div class="card h-100">
<!-- BEGIN card-body -->
<div class="card-body">
<div class="d-flex align-items-center mb-2">
<div class="flex-grow-1">
<h5 class="mb-1">Incidents</h5>
<div class="fs-13px">Latest incident history</div>
</div>
<a href="my-incidents.php" class="text-decoration-none">See All</a>
</div>
 
<!-- BEGIN table-responsive -->
<div class="table-responsive mb-n2">
<table class="table mb-20">
<thead>
	<tr class="text-body">
		<th class="ps-0">Severity</th>
		<th>Incident Details</th>
		<th class="text-center">Status</th>
		<th class="text-end pe-0">Peace Monitor</th>
	</tr>
</thead>
<tbody>

<?php  
$sql = "SELECT * FROM incident INNER JOIN users ON incident.monitor=users.userID WHERE parish = '$parish' LIMIT 5 ";
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result)) {
	echo "<tr>"; 
	if ($row['severity'] == 'Minor') {
		echo "<td><span class='badge bg-success bg-opacity-20 text-success'>".strtoupper($row['severity'])."</span></td>";
	}elseif ($row['severity'] == 'Moderate') {
		echo "<td><span class='badge bg-primary bg-opacity-20 text-primary'>".strtoupper($row['severity'])."</span></td>";
	}elseif($row['severity'] == 'Severe'){
		echo "<td><span class='badge bg-danger bg-opacity-20 text-danger'>".strtoupper($row['severity'])."</span></td>";
	}

	echo "<td>";
	echo "<div class=' flex-grow-1'>";
	echo "<div class='fw-600 text-body'>".$row['incidentID']."</div>";
	echo "<div class='fs-13px'>".substr_replace($row['name'], "...", 160)."</div>";
	echo "</div>";
	echo "</td>";
	if ($row['status'] == 'complete') {
		echo "<td class='text-center'><span class='badge bg-success bg-opacity-20 text-success' style='min-width: 60px;'>".strtoupper($row['status'])."</span></td>";
	}elseif ($row['status'] == 'incomplete') {
		echo "<td class='text-center'><span class='badge bg-danger bg-opacity-20 text-danger' style='min-width: 60px;'>".strtoupper($row['status'])."</span></td>";
	}else{
		echo "";
	}
	echo "<td class='text-end pe-0'>".$row['fullname']."</td>";
	echo "</tr>";
}

?>

</tbody>
</table>
</div>
<!-- END table-responsive -->
</div>
<!-- END card-body -->
</div>
<!-- END card -->
</div>
<!-- END col-6 -->
</div>
<!-- END row -->
</div>
<!-- END col-10 -->
</div>
<!-- END row -->
</div>
<!-- END container -->
</div>
<!-- END #content -->

<!-- BEGIN btn-scroll-top -->
<a href="#" data-click="scroll-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>
<!-- END btn-scroll-top -->
<!-- BEGIN theme-panel -->
<div class="theme-panel">
<a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
<div class="theme-panel-content">
<ul class="theme-list clearfix">
<li><a href="javascript:;" class="bg-red" data-theme="theme-red" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Red" data-original-title="" title="">&nbsp;</a></li>
<li><a href="javascript:;" class="bg-pink" data-theme="theme-pink" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Pink" data-original-title="" title="">&nbsp;</a></li>
<li><a href="javascript:;" class="bg-orange" data-theme="theme-orange" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Orange" data-original-title="" title="">&nbsp;</a></li>
<li><a href="javascript:;" class="bg-yellow" data-theme="theme-yellow" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Yellow" data-original-title="" title="">&nbsp;</a></li>
<li><a href="javascript:;" class="bg-lime" data-theme="theme-lime" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Lime" data-original-title="" title="">&nbsp;</a></li>
<li><a href="javascript:;" class="bg-green" data-theme="theme-green" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Green" data-original-title="" title="">&nbsp;</a></li>
<li><a href="javascript:;" class="bg-teal" data-theme="theme-teal" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Teal" data-original-title="" title="">&nbsp;</a></li>
<li><a href="javascript:;" class="bg-cyan" data-theme="theme-cyan" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Aqua" data-original-title="" title="">&nbsp;</a></li>
<li class="active"><a href="javascript:;" class="bg-blue" data-theme="" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Default" data-original-title="" title="">&nbsp;</a></li>
<li><a href="javascript:;" class="bg-purple" data-theme="theme-purple" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Purple" data-original-title="" title="">&nbsp;</a></li>
<li><a href="javascript:;" class="bg-indigo" data-theme="theme-indigo" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Indigo" data-original-title="" title="">&nbsp;</a></li>
<li><a href="javascript:;" class="bg-gray-600" data-theme="theme-gray-600" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Gray" data-original-title="" title="">&nbsp;</a></li>
</ul>
<hr class="mb-0">
<div class="row mt-10px pt-3px">
<div class="col-9 control-label text-body-emphasis fw-bold">
<div>Dark Mode <span class="badge bg-theme text-theme-color ms-1 position-relative py-4px px-6px" style="top: -1px">NEW</span></div>
<div class="lh-sm fs-13px fw-semibold">
<small class="text-body-emphasis opacity-50">
Adjust the appearance to reduce glare and give your eyes a break.
</small>
</div>
</div>
<div class="col-3 d-flex">
<div class="form-check form-switch ms-auto mb-0 mt-2px">
<input type="checkbox" class="form-check-input" name="app-theme-dark-mode" id="appThemeDarkMode" value="1">
<label class="form-check-label" for="appThemeDarkMode">&nbsp;</label>
</div>
</div>
</div>
</div>
</div>
<!-- END theme-panel -->
</div>
<!-- END #app -->

<?php include "includes/scripts.php" ?>
