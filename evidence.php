<?php include "includes/head.php"; ?>
<!-- END #header -->

<?php include "includes/menu.php"; ?>

<!-- BEGIN #content -->

<div id="content" class="app-content">
<div class="container">
<div class="row justify-content-center">
<div class="row">
<div class="col-xl-12">
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

<?php
if (isset($_POST["submit"])) {
    $audio          = $_POST['audio'] ?? null;
    $video          = $_POST['video'] ?? null;
    $photo          = $_POST['photo'] ?? null;
    $document       = $_POST['document'] ?? null;
    $others         = $_POST['others'] ?? null;
    $none           = $_POST['none'] ?? null;

    $evidences      = $audio." ".$video." ".$photo." ".$document." ".$others." ".$none;

    $incidentID = $_POST['incidentID'];
    $status             = "1";
    $stmt = $con->prepare("INSERT INTO files (incidentID, file_name) VALUES (?, ?)");
    $stmt->bind_param("ss", $incidentID, $imagePath);
    $uploadedImages = $_FILES['images']; 

    $stmt2 = $con->prepare("UPDATE incident SET evidences=? WHERE incidentID=?");
    $stmt2->bind_param('ss', $evidences, $incident);
    $stmt2->execute();

    foreach ($uploadedImages['name'] as $key => $value) {
        $targetDir = "uploads/";
        $fileName = basename($uploadedImages['name'][$key]);
        $targetFilePath = $targetDir . $fileName;
        if (file_exists($targetFilePath)) {
            echo "
    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
    Sorry these evidence files already exist!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>  
        </button>
    </div>";
        } else {
            if (move_uploaded_file($uploadedImages["tmp_name"][$key], $targetFilePath)) {
                $imagePath = $targetFilePath;
                $stmt->execute();
                $sql2 = "UPDATE incident SET evidence='$status' WHERE incidentID='$incidentID' ";
                mysqli_query($con, $sql2);
                echo "
    <div class='alert alert-primary alert-dismissible fade show' role='alert'>"."The file " . $fileName . " has been uploaded successfully."."
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>  
        </button>
    </div>";
               
            } else {
                echo "
    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
    Sorry there was an error uploading your evidence files!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>  
        </button>
    </div>";
            }
        }
    }
    $stmt->close();
    $con->close();
}
?>
<!-- BEGIN #formControls -->
<div id="formControls" class="mb-5">
<div class="card">
<div class="card-body pb-2">
<form action="" method="POST" enctype="multipart/form-data"> 
<div class="row">
    <div class="col-4">
        <div class="form-group mb-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="Video" name="video">
            <label class="form-check-label" for="defaultCheck1">Video</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="Audio" name="audio">
            <label class="form-check-label" for="defaultCheck2">Audio</label>
        </div>
    </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="Photo" name="photo">
            <label class="form-check-label" for="defaultCheck1">Photo</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="document" value="Document">
            <label class="form-check-label" for="defaultCheck2">Document</label>
        </div>
    </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-4">
        <div class="form-check">
            <input class="form-check-input" name="others" type="checkbox" value="Other media" >
            <label class="form-check-label">Other media</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="No Evidence" name="none">
            <label class="form-check-label">No Evidence</label>
        </div>
    </div>
    </div>
    
</div>
<div class="row"> 
<div class="mb-3">
	<label class="form-label" for="multipleFile">Evidence Files</label>
	<input required type="file" name="images[]" class="form-control" id="multipleFile" multiple>
</div>

<div class="mb-3">
    <input hidden type="text" name="incidentID" class="form-control" 
    value="<?php echo $_GET['id']; ?>">
</div>
</div>

<div class="form-group mb-3">
	<button type="submit" name="submit" value="UPLOAD" class="btn btn-theme btn"><i class="fa fa-upload "></i> Upload Evidence</button>
</div>

</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>




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
