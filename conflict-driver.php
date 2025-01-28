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
$incidentID				= $_GET['id'];
$politicalTension 		= $_POST["political"];
$economicFactor 		= $_POST["economic"];
$socialIssue 			= $_POST["social"];
$grievances 			= $_POST["grievances"];
$externalInfluence 		= $_POST["external"];
$gbv 					= $_POST["gbv"];
$status 				= "1";



$sql = "INSERT INTO conflictdrivers (incidentID, politicalTension, economicFactor, socialIssue, grievance, externalInfluence, gbv) VALUES ('$incidentID', '$politicalTension', '$economicFactor', '$socialIssue', '$grievances','$externalInfluence', '$gbv')";



if(mysqli_query($con, $sql)){
$sql2 = "UPDATE incident SET conflict='$status' WHERE incidentID='$incidentID' ";
mysqli_query($con, $sql2);
echo "
    <div class='alert alert-primary alert-dismissible fade show' role='alert'>
        Conflict drivers added successful!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>  
        </button> 
    </div>";

} else{
    echo mysqli_error($con);
} }
?>
<h1 class="page-header">
<?php

$incident       = $_GET['id'];
$monitor        = $_SESSION['id']; 
$sql            = "SELECT * FROM incident WHERE incidentID='$incident' ";
$result         = mysqli_query($con, $sql);
$row            = mysqli_fetch_array($result);

if (isset($_GET['id'])){
    echo '<h1 class="page-header">';
    echo "Incident #".$_GET['id'];
    echo ' <br/><small>'.$row['name'].'</small>';
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
<div class="col-md-6">
<div class="mb-3">
	
<div class="form-group mb-4">
	<div class="small text-inverse text-opacity-50 mb-2"><b class="fw-bold">Political Tension</b></div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Ongoing protests"  name="political">
		<label class="form-check-label" for="defaultRadio1">Ongoing protests</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Election related issues"  name="political">
		<label class="form-check-label" for="defaultRadio2">Election related issues</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Emergence of self-defense non-state armed actors (Militia)"  name="political" >
		<label class="form-check-label" for="defaultRadio2">Emergence of self-defense non-state armed actors (Militia)</label>
	</div>
	<!-- <div class="">
		<input class="form-check-input" type="radio" >
		<label class="form-check-label" for="defaultRadio2">Other</label>
		<input class="form-control other_option"  name="political" placeholder="Specify" type="text">
	</div> -->
	 
</div>

</div>

</div>
<div class="col-md-6">
<div class="mb-3">
	<div class="form-group mb-4">
	<div class="small text-inverse text-opacity-50 mb-2"><b class="fw-bold">Economic Factors</b></div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Unemployment"  name="economic" >
		<label class="form-check-label" for="defaultRadio1">Unemployment</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Resource scarcity"  name="economic" >
		<label class="form-check-label" for="defaultRadio2">Resource scarcity (e.g land, water..)</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Corruption"  name="economic"  >
		<label class="form-check-label" for="defaultRadio2">Corruption</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Discrimination/Inequality"  name="economic" >
		<label class="form-check-label" for="defaultRadio2">Discrimination/Inequality</label>
	</div>
	<!-- <div class="">
		<input class="form-check-input" type="radio">
		<label class="form-check-label" for="defaultRadio2">Other</label>
		<input class="form-control other_option" name="economic" placeholder="Specify" type="text">
	</div> -->
	
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
<div class="mb-3">
	<div class="form-group mb-4">
	<div class="small text-inverse text-opacity-50 mb-2"><b class="fw-bold">Social/Ethnic Issues</b></div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Inter-ethinic Conflict"  name="social" >
		<label class="form-check-label" for="defaultRadio1">Inter-ethinic Conflict</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Religious tensions"  name="social" >
		<label class="form-check-label" for="defaultRadio2">Religious tensions</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Descrimination of specific groups"  name="social"  >
		<label class="form-check-label" for="defaultRadio2">Descrimination of specific groups</label>
	</div>
	<!-- <div class="">
		<input class="form-check-input" type="radio">
		<label class="form-check-label" for="defaultRadio2">Other</label>
		<input class="form-control other_option" name="social" placeholder="Specify" type="text">
	</div> -->
	
</div>

</div>
</div>
<div class="col-md-6">
<div class="mb-3">
	<div class="form-group mb-4">
	<div class="small text-inverse text-opacity-50 mb-2"><b class="fw-bold">Grievances or Unresolved Issues</b></div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Land disputes"  name="grievances" >
		<label class="form-check-label" for="defaultRadio1">Land disputes</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Historical Injustices"  name="grievances" >
		<label class="form-check-label" for="defaultRadio2">Historical Injustices</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Lack of basic services"  name="grievances"  >
		<label class="form-check-label" for="defaultRadio2">Lack of basic services e.g Health facilities, roads, schools....</label>
	</div>
	<!-- <div class="">
		<input class="form-check-input" type="radio">
		<label class="form-check-label" for="defaultRadio2">Other</label>
		<input class="form-control other_option" name="grievances" placeholder="Specify" type="text">
	</div> -->
	
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
<div class="mb-3">
	<div class="form-group mb-4">
	<div class="small text-inverse text-opacity-50 mb-2"><b class="fw-bold">External Influences</b></div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Foreign involvement and strite"  name="external" >
		<label class="form-check-label" for="defaultRadio1">Foreign involvement and strite (eg, arms trafficking in support of factions)</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Refugee settlements"  name="external" >
		<label class="form-check-label" for="defaultRadio2">Refugee settlements e.g access to resources - Land, water...</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Cross-border tension"  name="external"  >
		<label class="form-check-label" for="defaultRadio2">Cross-border tension</label>
	</div>
	<!-- <div>
		<input class="form-check-input" type="radio" >
		<label class="form-check-label" for="defaultRadio2">Other</label>
		<input class="form-control other_option" name="external" placeholder="Specify" type="text">
	</div> -->
	 
</div>

</div>
</div>
<div class="col-md-6">
<div class="mb-3">
	<div class="form-group mb-4">
	<div class="small text-inverse text-opacity-50 mb-2"><b class="fw-bold">Gender Based Violence</b></div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Physical Violence"  name="gbv" >
		<label class="form-check-label" for="defaultRadio1">Physical Violence</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Threats"  name="gbv" >
		<label class="form-check-label" for="defaultRadio2">Threats</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Sexual Violence"  name="gbv"  >
		<label class="form-check-label" for="defaultRadio2">Sexual Violence</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Political Violence"  name="gbv"  >
		<label class="form-check-label" for="defaultRadio2">Political Violence e.g Violation of women voting rights</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" type="radio" value="Economic Violence"  name="gbv"  >
		<label class="form-check-label" for="defaultRadio2">Economic Violence e.g denial of resources, family neglect, etc</label>
	</div>
	
</div>
</div>
</div>
</div>
<div class="form-group mb-3">
	<button type="submit" name="submit" class="btn btn-theme btn">Submit</button>
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
<style type="text/css">
.other_option{
  display: none;
}

[type="radio"]:checked ~ label ~ .other_option{
  display: block;
}
</style>
<?php include "includes/scripts.php" ?>
