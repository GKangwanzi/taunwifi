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
<div class="row">
<!-- BEGIN col-9 -->
<div class="col-xl-12">

<?php 

if (isset($_POST['submit'])){
$incidentID		= $_GET['id'];
$weapon 		= $_POST["weapon"];
$impact 		= $_POST["impact"];
$mobilization 	= $_POST["mobilization"];
$rumors 		= $_POST["rumors"];
$status 		= "1";



$sql = "INSERT INTO riskindicator (incidentID, weapon, impact, mobilization, rumors) VALUES ('$incidentID', '$weapon', '$impact', '$mobilization', '$rumors')";



if(mysqli_query($con, $sql)){
$sql2 = "UPDATE incident SET risk='$status' WHERE incidentID='$incidentID' ";
mysqli_query($con, $sql2);

echo "
    <div class='alert alert-primary alert-dismissible fade show' role='alert'>
        Risk indicators added successful!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>  
        </button> 
    </div>";
header( "refresh:2;url=risk-indicators.php" );
} else{
	
    echo mysqli_error($con);
} }
?>

<?php
if (isset($_GET['id'])){
	echo '<h1 class="page-header">';
	echo "Incident #".$_GET['id'];
	echo '<br/><small>Assess the risk of escalation or trigger events that could lead to greater violence.	</small>';
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
	<label class="form-label" for="exampleFormControlSelect1">Weapon Availability</label>
	<select class="form-select" name="weapon" id="exampleFormControlSelect1">
		<option>Increased presence of armed personnel</option>
		<option>Reports of arms smuggling or distribution</option>
		<option>Local stores of waepons seized or uncovered</option>
	</select>
</div>

<div class="form-group mb-3">
	<label class="form-label" for="exampleFormControlSelect1">Mobilization of Group</label>
	<select class="form-select" name="mobilization" id="exampleFormControlSelect1">
		<option>Armed groups forming or moving</option>
		<option>Violent demonstrations or mass gatherings</option>
		<option>Political rallies or opposition gatherings</option>
	</select>
</div>
<div class="col-md-6">
<div class="mb-3">
	<div class="form-group mb-4">
	<div class="small text-inverse text-opacity-50 mb-2"><b class="fw-bold">Impact to infrastructure</b></div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Churches, schools, fuel stations, health facilities"  name="impact" >
		<label class="form-check-label" for="defaultRadio1">Churches, schools, fuel stations, health facilities</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Road infrastructure"  name="impact" >
		<label class="form-check-label" for="defaultRadio2">Road infrastructure</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Gonvernment buildings"  name="impact"  >
		<label class="form-check-label" for="defaultRadio2">Gonvernment buildings</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Commercial buildings"  name="impact" >
		<label class="form-check-label" for="defaultRadio2">Commercial buildings</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Border areas or conflict zones"  name="impact" >
		<label class="form-check-label" for="defaultRadio2">Border areas or conflict zones</label>
	</div>
	<!-- <div class="">
		<input class="form-check-input" type="radio">
		<label class="form-check-label" for="defaultRadio2">Other</label>
		<input class="form-control other_option" name="economic" placeholder="Specify" type="text">
	</div> -->
	
</div>

</div>
</div>
<div class="col-md-6">
<div class="mb-3">
	<div class="form-group mb-4">
	<div class="small text-inverse text-opacity-50 mb-2"><b class="fw-bold">Rumors or Misinformation</b></div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="False information circulating about groups or events e.g on roads, groups. etc"  name="rumors" >
		<label class="form-check-label" for="defaultRadio1">False information circulating about groups or events e.g on roads, groups. etc</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Social media (Whatsapp, Facebook, X, etc)"  name="rumors" >
		<label class="form-check-label" for="defaultRadio2">Social media (Whatsapp, Facebook, X, etc)</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Boda-Boda groups"  name="rumors"  >
		<label class="form-check-label" for="defaultRadio2">Boda-Boda groups</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Youth groups"  name="rumors" >
		<label class="form-check-label" for="defaultRadio2">Youth groups</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Outside of churches/mosques"  name="rumors" >
		<label class="form-check-label" for="defaultRadio2">Outside of churches/mosques</label>
	</div>
	<!-- <div class="">
		<input class="form-check-input" type="radio">
		<label class="form-check-label" for="defaultRadio2">Other</label>
		<input class="form-control other_option" name="economic" placeholder="Specify" type="text">
	</div> -->
	
</div>
</div>
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
<script type="text/javascript">
$(document).ready(function(){
$('#ex-multiselect-2').picker();
$('#ex-multiselect-3').picker();
$('#ex-multiselect-4').picker();
$('#ex-multiselect-5').picker();
$('#ex-multiselect-6').picker();
$('#ex-multiselect-7').picker();
$('#ex-multiselect-8').picker();
$('#ex-multiselect-9').picker();
$('#ex-multiselect-10').picker();
});

</script>

<?php include "includes/scripts.php" ?>
