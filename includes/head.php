<?php
session_start();
if (!isset($_SESSION['user'])) {
header("Location: index.php");
}

if (isset($_POST['logout'])) {
// Initialize the session.
session_start();
// Unset all of the session variables.
unset($_SESSION['user']);
// Finally, destroy the session.    
session_destroy();
header("Location: index.php");
}

include "sms.php";
include "dbhandle.php";
?>
<!DOCTYPE html>
<html lang="en">
<head> 
<meta charset="utf-8">
<title>TaunWiFi</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<!-- ================== BEGIN core-css ================== -->
<link href="./assets/css/vendor.min.css" rel="stylesheet">
<link href="./assets/css/styles.css" rel="stylesheet">
<link href="./assets/css/app.min.css" rel="stylesheet">
<link rel="manifest" href="./manifest.json">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<!-- ================== END core-css ================== -->

<!-- ================== BEGIN page-css ================== -->
<link href="./assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="./assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet">
<link href="./assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet">
<link href="./assets/plugins/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet">
<link href="./assets/plugins/blueimp-file-upload/css/jquery.fileupload.css" rel="stylesheet">
<link href="./assets/plugins/select-picker/dist/picker.min.css" rel="stylesheet">



<!-- ================== BEGIN page-css ================== -->
<link href="./assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet">
<link href="./assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="./assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<link href="./assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet">
<link href="./assets/plugins/bootstrap-slider/dist/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="./assets/plugins/blueimp-file-upload/css/jquery.fileupload.css" rel="stylesheet">
<link href="./assets/plugins/summernote/dist/summernote-lite.css" rel="stylesheet">
<link href="./assets/plugins/spectrum-colorpicker2/dist/spectrum.min.css" rel="stylesheet">
<link href="./assets/plugins/select-picker/dist/picker.min.css" rel="stylesheet">
<link href="./assets/plugins/jquery-typeahead/dist/jquery.typeahead.min.css" rel="stylesheet">

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<!-- ================== END page-css ================== -->
<!-- ================== END page-css ================== -->

</head>
<body>
<!-- BEGIN #app -->
<div id="app" class="app">
<!-- BEGIN #header -->
<div id="header" class="app-header">
<!-- BEGIN mobile-toggler -->
<div class="mobile-toggler">
<button type="button" class="menu-toggler" data-toggle="sidebar-mobile">
	<span class="bar"></span>
	<span class="bar"></span>
</button>
</div>
<!-- END mobile-toggler -->

<!-- BEGIN brand -->
<div class="brand">
<div class="desktop-toggler">
	<button type="button" class="menu-toggler" data-toggle="sidebar-minify">
		<span class="bar"></span>
		<span class="bar"></span>
	</button>
</div>

<a  class="brand-logo">
	<img style="height: 550px !important;" src="./assets/img/logo.png" class="invert-dark" alt="" >
</a>
</div>
<!-- END brand -->

<!-- BEGIN menu -->
<div class="menu">
<form class="menu-search" method="POST" name="header_search_form">
	<div class="menu-search-icon"></div>
	<div class="menu-search-input">
		
	</div>
</form>
<div class="menu-item dropdown">

</div> 
<div class="menu-item dropdown">
	<a href="#" data-bs-toggle="dropdown" data-display="static" class="menu-link">
		<div class="menu-img online">
			<img src="./assets/img/user/user.jpg" alt="" class="ms-100 mh-100 rounded-circle">
		</div>
		<div class="menu-text"><?php echo $_SESSION['user']; ?></div>
	</a>
	<div class="dropdown-menu dropdown-menu-end me-lg-3">
		<a class="dropdown-item d-flex align-items-center" href="#">Edit Profile <i class="fa fa-user-circle fa-fw ms-auto text-body text-opacity-50"></i></a>

		<a class="dropdown-item d-flex align-items-center" href="./logout.php">Log Out <i class="fa fa-toggle-off fa-fw ms-auto text-body text-opacity-50"></i></a>
	</div>
</div>
</div>
<!-- END menu -->
</div>