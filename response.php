<?php include "includes/head.php"; ?>
<!-- END #header -->

<?php include "includes/menu.php"; ?>

<!-- BEGIN #content -->
<div id="content" class="app-content">
<!-- BEGIN container -->
<div class="container">
<!-- BEGIN row -->
<div class="row justify-content-center">
<!-- BEGIN col-10 -->
<div class="col-xl-10">
<!-- BEGIN row -->

<?php 

if (isset($_POST['submit'])){
$incidentID			= $_GET['id'];
$security 			= $_POST["security"];
$emergency 			= $_POST["emergency"];
$prevention 		= $_POST["prevention"];
$humanitarian 		= $_POST["humanitarian"];
$effectiveness 		= $_POST["effectiveness"];
$peace 				= $_POST["peace"];

$status 			= "1";



$sql = "INSERT INTO responseindicator (incidentID, securityForce, emergencyService, prevention, humanitarian, effectiveness, peaceBuilding) VALUES ('$incidentID', '$security', '$emergency', '$prevention', '$humanitarian', '$effectiveness', '$peace')";



if(mysqli_query($con, $sql)){
$sql2 = "UPDATE incident SET response='$status' WHERE incidentID='$incidentID' ";
mysqli_query($con, $sql2);

echo "
<div class='alert alert-primary alert-dismissible fade show' role='alert'>
    Risk indicators added successful! <a clas'btn btn-sm' href='responses.php'></a>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>  
    </button> 
</div>";
?>
<script type="text/javascript"> 

window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = "responses.php";

    }, 3000);

</script>
<?php
} else{
echo "
<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    An error occured. Contact Systems admin
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>  
    </button> 
</div>";
?>
<script type="text/javascript"> 
window.history.go(-5);
</script>
<?php
} }
?>

<div class="row">
	<!-- BEGIN col-9 -->
	<div class="col-xl-12">
<?php
if (isset($_GET['id'])){
	echo '<h1 class="page-header">';
	echo "Incident #".$_GET['id'];
	echo ' <br/><small>Monitoring the responses of local authorities, peacekeepers, and humanitarian actors.</small>';
	echo "</h1>";
}
	?>
		
		<hr class="mb-4">
		
		<!-- BEGIN #formControls -->
		<div id="formControls" class="mb-5">
			<div class="card">
				<div class="card-body pb-2">
					<form action="" method="POST">
						<div class="row">
								<div class="form-group mb-3">
									<label class="form-label" for="exampleFormControlSelect1">Security Force Presence and Response</label>
									<select class="form-select" name="security" id="exampleFormControlSelect1">
										<option>Local police</option>
										<option>Miltary/Police reinforcement</option>
										<option>Community policing</option>
										<option>Arrests of perpetrators</option>
										<option>None</option>
									</select>
								</div>

								<div class="form-group mb-3">
									<label class="form-label" for="exampleFormControlSelect1">Emergency Services Availability and lvel of preparedness</label>
									<select class="form-select" name="emergency" id="exampleFormControlSelect1">
										<option>Office of the Prime Minister</option>
										<option>Ministry of internal affairs</option>
										<option>Ministry of Health</option>
										<option>None</option>
									</select>
								</div>

								<div class="form-group mb-3">
									<label class="form-label" for="exampleFormControlSelect1">Prevention of Conflict</label>
									<select class="form-select" name="prevention" id="exampleFormControlSelect1">
										<option>District peace committees</option>
										<option>Sub county peace committees</option>
										<option>Cs</option>
									</select>
								</div>

								<div class="form-group mb-3">
									<label class="form-label" for="exampleFormControlSelect1">Humanitarian Aid needed</label>
									<select class="form-select" name="humanitarian" id="exampleFormControlSelect1">
										<option>Distribution of food, water and shelter</option>
										<option>Emergency relief efforts</option>
										<option>Medical support</option>
										<option>None</option>
									</select>
								</div>

								<div class="form-group mb-3">
									<label class="form-label" for="exampleFormControlSelect1">Effectiveness of Response</label>
									<select class="form-select" name="effectiveness" id="exampleFormControlSelect1">
										<option>Response improving the situation</option>
										<option>Response exacerbating tension</option>
										<option>No response</option>
									</select>
								</div>

								<div class="form-group mb-3">
									<label class="form-label" for="exampleFormControlSelect1">Peace Building interventions</label>
									<select class="form-select" name="peace" id="exampleFormControlSelect1">
										<option>Community dialogues</option>
										<option>Mediation</option>
										<option>Conflict resolution</option>
										<option>Negotiation</option>
									</select>
								</div>

								<div class="form-group mb-3">
									<button type="submit" name="submit" class="btn btn-theme btn">Submit</button>
								</div>

						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- END #formControls -->
		
	</div>
	<!-- END col-9-->
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

<!-- ================== BEGIN core-js ================== -->
<script src="assets/js/vendor.min.js"></script>
<script src="assets/js/app.min.js"></script>
<!-- ================== END core-js ================== -->

<!-- ================== BEGIN page-js ================== -->
<script src="assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script>
<script src="assets/js/demo/highlightjs.demo.js"></script>
<script src="assets/js/demo/sidebar-scrollspy.demo.js"></script>
<!-- ================== END page-js ================== -->

</body>
</html>
