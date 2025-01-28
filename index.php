
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>CAF | EWRT</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<!-- ================== BEGIN core-css ================== -->
<link href="assets/css/vendor.min.css" rel="stylesheet">
<link href="assets/css/app.min.css" rel="stylesheet">
<!-- ================== END core-css ================== -->

</head>
<body>



<!-- BEGIN #app -->
<div id="app" class="app app-full-height app-without-header">
<!-- BEGIN login -->
<div class="login">
<!-- BEGIN login-content -->
<div class="login-content">
<form action="" method="POST" >
	<img style="display: block;
  margin-left: auto;
  margin-right: auto;
  width: 100%;" src="assets/img/signin-logo.png">

	<div class="text-muted text-center mb-4">
		Early Warning Reporting Tool
	</div> 
	<?php

if (isset($_POST['login'])) {
require_once 'includes/dbhandle.php';
$username = $_POST['username'];
$password = $_POST['password'];

//to prevent from mysqli injection  
$username = stripcslashes($username);  
$password = stripcslashes($password);  

$sql = "SELECT * FROM users WHERE username='$username' ";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_array($result, MYSQLI_ASSOC);

if ($user) {
if ($password == $user["password"]) {
session_start();
$fullname = $arr = explode(' ',trim($user["fullname"]));
$_SESSION['user'] = $fullname[0];
$_SESSION['role'] = $user["role"];
$_SESSION['id'] = $user["userID"];
$_SESSION['district'] = $user["district"];

$lastLogin = (date("Y/m/d h:i:s a"));
$sql = "UPDATE users SET lastlogin='$lastLogin' WHERE username='$username'";

if(mysqli_query($con, $sql) AND $_SESSION['role'] == 'admin'){
header("Location: dash.php"); 
die();
} elseif(mysqli_query($con, $sql) AND $_SESSION['role'] == 'officer'){
header("Location: dash-o.php"); 
die();
}elseif(mysqli_query($con, $sql) AND $_SESSION['role'] == 'monitor'){
header("Location: dash-m.php"); 
die();
}else{
die();
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

// Close connection
mysqli_close($con);

}else{
echo "
<div class='alert alert-primary alert-dismissible fade show' role='alert'>
Password is wrong!
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>  
</button>
</div>";
}
}else{
echo "
<div class='alert alert-primary alert-dismissible fade show' role='alert'>
User does not exist!
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>  
</button>
</div>";
}
}

?>
	<div class="mb-3">
		<label class="form-label">Username</label>
		<input type="text" class="form-control form-control-lg fs-15px" name="username" placeholder="Username">
	</div> 
	<div class="mb-3">
		<div class="d-flex">
			<label class="form-label">Password</label>
		</div>
		<input type="password" class="form-control form-control-lg fs-15px" name="password" placeholder="Enter your password">
	</div>

	<button type="submit" name="login" class="btn btn-theme btn-lg d-block w-100 fw-500 mb-3">Sign In</button>
</form>
</div>
<!-- END login-content -->
</div>
<!-- END login -->

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


</body>
</html>
