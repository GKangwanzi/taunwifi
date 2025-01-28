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
<div class="col-xl-11">
<!-- BEGIN row -->
<div class="row">
<!-- BEGIN col-9 -->
<div class="col-xl-12">
 <div class="row">
	<div class="col-9">
	<h4 class="page-header">Cumulative Report</h4>
	</div>
	<div class="col-3">
	<button onclick="downloadPDF()" style="float: right;" type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modaluser"><i class="far fa-lg fa-fw me-2 fa-file-pdf"></i> Download Report</button>
	</div>
</div>












<?php  

$daterange = $_POST['daterange'];
// singlebyte strings
$startdate = substr($daterange, 0, 10);
$startdate = date("Y-m-d", strtotime($startdate));
$enddate = substr($daterange, -10);
$enddate = date("Y-m-d", strtotime($enddate));


/*
$sql2 = "SELECT * FROM location WHERE locationID='$location' ";
$result2 = mysqli_query($con, $sql2);
$row = mysqli_fetch_array($result2);

$sql3 = "SELECT * FROM users WHERE userID='$monitor' ";
$result3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_array($result3);

$sql3 = "SELECT * FROM users WHERE userID='$off' ";
$result3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_array($result3);
$officer = $row3['fullname']; 
 */
$sql = "SELECT incident.incidentID as iID, incident.name, incident.incidentType, incident.parish, incident.severity, incident.injured, incident.fatalities, incident.perpetrators, incident.evidences, incident.date1, incident.monitor, incident.action, incident.closingOfficer, responseindicator.incidentID AS resID, responseindicator.securityForce, responseindicator.emergencyService, responseindicator.prevention, responseindicator.humanitarian, responseindicator.effectiveness, responseindicator.peaceBuilding, riskindicator.incidentID AS riskID, riskindicator.weapon, riskindicator.mobilization, riskindicator.impact, riskindicator.rumors, conflictdrivers.incidentID AS conflictID, conflictdrivers.politicalTension, conflictdrivers.economicFactor, conflictdrivers.socialIssue, conflictdrivers.grievance, conflictdrivers.externalInfluence, conflictdrivers.gbv   FROM incident INNER JOIN conflictdrivers ON incident.incidentID = conflictdrivers.incidentID INNER JOIN riskindicator ON incident.incidentID = riskindicator.incidentID INNER JOIN responseindicator ON incident.incidentID=responseindicator.incidentID WHERE closingOfficer IS NOT NULL AND date1 BETWEEN '$startdate' AND '$enddate' ";
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
    	$monitor = $row['monitor'];
    	$sql3 = "SELECT * FROM users WHERE userID= '$monitor' ";
		$result3 = mysqli_query($con, $sql3);
		$row3 = mysqli_fetch_array($result3);

		$location = $row['parish'];
		$sql2 = "SELECT * FROM location WHERE locationID='$location' ";
		$result2 = mysqli_query($con, $sql2);
		$row2 = mysqli_fetch_array($result2);

		$off = $row['closingOfficer'];
		$sql3 = "SELECT * FROM users WHERE userID='$off' ";
		$result3 = mysqli_query($con, $sql3);
		$row3 = mysqli_fetch_array($result3);
		$officer = $row3['fullname']; 

echo "<div id='myBillingArea' style='padding: 20px 20px 20px 20px;' class='card'>
<div class='card-body pb-2'>";
echo '
<img class="center-photo" src="assets/img/report-logos.png">

<h3 style="padding-top: 5px; font-size: 2em;" class="report-heading">UGANDANS FOR PEACE ACTIVITY</h3>
<p style="text-align: center; font-style: none;">Early Warning And Rapid Response Mechanism</p>
<p style="text-align: center; font-weight: 800; font-size: 1.2em;">EARLY WARNING INCIDENT REPORT</p>';
echo "<div class='row bg-secondary' style='padding-top: 5px; padding-bottom: 5px;'>
	<div class='col-4'><strong>DISTRICT: </strong>".$row2['districtname']. "</div>
	<div class='col-4'><strong>SUB COUNTY: </strong>".$row2['subcountyname']. " </div>
	<div class='col-4'><strong>PARISH: </strong>".$row2['parishname']. "</div>
</div>";
echo "<br>";
echo "<strong>Incident Being Reported</strong>";
echo "<p>".$row['name']."</p>";
echo '
<div class="row" style="display: flex !important;">
	<!-- Nature of incident -->
	<div class="card col-4" style="padding-left: 0px; padding-right: 0px; margin: 5px; flex: 1 !important; border-radius: 0px !important;">
	<div class="card-header fw-bold small" style="border-radius: 0px !important;">Nature Of Incident</div>
	<div class="card-body">
	<div class="response">
	<p class="qtn">Type of Incident</p>
	<p class="answer mb-1">'; echo $row['incidentType'].'</p>
	</div>
	<div class="response">
	<p class="qtn">Severity of the incident</p>
	<p class="card-subtitle mb-1 text-body text-opacity-50">'; 
		$severity = $row['severity'];

		if ($severity = 'Minor') {
			echo '<span class="badge bg-success">Minor</span>';
		}elseif($severity = 'Moderate'){
			echo '<span class="badge bg-primary">Moderate</span>';
		}elseif($severity = 'Severe'){
			echo '<span class="badge bg-danger">Severe</span>';
		}
 '</p>
	</div>
	<div class="response"> 
	<p class="qtn">Number of casualities</p>
	<p class="answer mb-1">'; echo $row["injured"].' Injured & '.$row["fatalities"].' Fatalities'.'</p>
	</div>';
echo '
	<div class="response">
	<p class="qtn">Perpetrators</p>
	<p class="answer mb-1">'; echo $row['perpetrators'].'</p>
	</div>
	<div class="response-last">
	<p class="qtn">Evidence</p>
	<p class="answer mb-1">'; echo $row['evidences'].'</p>
	</div>
	</div>
	</div>


	<!-- Conflict Drivers -->
	<div class="card col-4" style="padding-left: 0px; padding-right: 0px; margin: 5px; flex: 1 !important; border-radius: 0px !important;">
	<div class="card-header fw-bold small" style="border-radius: 0px !important;">Conflict Drivers</div>
	<div class="card-body">
	<div class="response">
	<p class="qtn">Political tension</p>
	<p class="answer mb-1">'; echo $row['politicalTension'].'</p>
	</div>
	<div class="response">
	<p class="qtn">Economic Factor</p>
	<p class="answer mb-1">'; echo $row['economicFactor'].'</p>
	</div>
	<div class="response">
	<p class="qtn">Social/Ethnic Issues</p>
	<p class="answer mb-1">'; echo $row['socialIssue'].'</p>
	</div>

	<div class="response">
	<p class="qtn">Grievancies/Unresolved Issues</p>
	<p class="answer mb-1">'; echo $row['grievance'].'</p>
	</div>
	<div class="response">
	<p class="qtn">External Influence</p>
	<p class="answer mb-1">'; echo $row['externalInfluence'].'</p>
	</div>
	<div class="response-last">
	<p class="qtn">Gender-Based Violence</p>
	<p class="answer mb-1">'; echo $row['gbv'].'</p>
	</div>
	</div>
	</div>


	<!-- Risk Indicators -->
	<div class="card col-4" style="padding-left: 0px; padding-right: 0px; margin: 5px; flex: 1 !important; border-radius: 0px !important;">
	<div class="card-header fw-bold small" style="border-radius: 0px !important;">Risk Indicators</div>
	<div class="card-body">
	<div class="response">
	<p class="qtn">Weapon Availability</p>
	<p class="answer mb-1">'; echo $row['weapon'].'</p>
	</div>
	<div class="response">
	<p class="qtn">Mobilization of Groups</p>
	<p class="answer mb-1">'; echo $row['mobilization'].'</p>
	</div>
	<div class="response">
	<p class="qtn">Impact to Infrastructure</p>
	<p class="answer mb-1">'; echo $row['impact'].'</p>
	</div>

	<div class="response-last">
	<p class="qtn">Rumors or Misinformation</p>
	<p class="answer mb-1">'; echo $row['rumors'].'</p>
	</div>

	</div>
	</div>
	</div>



<div class="row" style="display: flex !important;">
	<!-- Nature of incident -->
	<div class="card col-12" style="padding-left: 0px; padding-right: 0px; margin: 5px; flex: 1 !important; border-radius: 0px !important;">
	<div class="card-header fw-bold small" style="border-radius: 0px !important;">Response Mechanism</div>
	<div class="card-body">


	<div class="row">
		<div class="col-6">
			<div class="response">
			<p class="qtn">Security Force Presence and Response</p>
			<p class="answer mb-1">'; echo $row['securityForce'].'</p>
			</div>
			<div class="response">
			<p class="qtn">Emergency Services Availability and level of preparedness</p>
			<p class="answer mb-1">'; echo $row['emergencyService'].'</p>
			</div>
			<div class="response-last">
			<p class="qtn">Prevention of Conflict</p>
			<p class="answer mb-1">'; echo $row['prevention'].'</p>
			</div>
		</div>
		<div class="col-6">
			<div class="response">
			<p class="qtn">Humanitarian Aid needed</p>
			<p class="answer mb-1">'; echo $row['humanitarian'].'</p>
			</div>
			<div class="response">
			<p class="qtn">Effectiveness of Response</p>
			<p class="answer mb-1">'; echo $row['effectiveness'] ?? null; '</p>
			</div>
			<div class="response-last">
			<p class="qtn">Peace Buidling Interventions</p>
			<p class="answer mb-1">'; echo $row['peaceBuilding'].'</p>
			</div>
		</div>

	</div>	

	</div>
	</div>
	</div>

	<div class="row" style="padding-left: 5px; padding-right: 5px; margin-top: 5px;">
	<div class=" col-12" style="background: #c9d2e3; margin: 0px !important;">
	<div class="card-body">
		<h5 class="card-title">Actions Taken</h5>
		<p class="card-text">'; echo $row['action'].'</p>
		<div>
			<span class="badge bg-primary">Submitted By '; echo $row3['fullname'].'</span>
			<span class="badge bg-primary">Incident Closed by '; echo $officer.'</span>
		</div>
	</div>
	</div>
	</div>



</div>
</div>';
                }
                mysqli_free_result($result);
            } else{
                echo "No records found.";
            }
        }





?>











</div>


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
	window.jsPDF = window.jspdf.jsPDF;
var docPDF = new jsPDF();

function downloadPDF(invoiceNo){

    var elementHTML = document.querySelector("#myBillingArea");
    docPDF.html(elementHTML, {
        callback: function(docPDF) {
            docPDF.save(invoiceNo+'.pdf');
        },
        x: 15,
        y: 15,
        width: 170,
        windowWidth: 650
    });
}
</script>


<?php include "includes/scripts.php" ?>
