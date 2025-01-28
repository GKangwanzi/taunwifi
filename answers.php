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
<div class="row">
	<div class="col-9">
	<h4 class="page-header">Responses</h4>
	</div>
	<div class="col-3">
	<button style="float: right;" type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalSm">Add New Response</button>
	</div>
</div>

<?php 
if (isset($_POST['register'])){

$name = $_POST["response"];
$indicator = $_POST["indicator"];

foreach ($name as $i) {
  $name = $i;
  $sql = "INSERT INTO responses (name, indicator) VALUES ('".mysqli_real_escape_string($con,$name)."', '$indicator')";
  mysqli_query($con,$sql);
}

if(mysqli_query($con, $sql)){
echo "
    <div class='alert alert-primary alert-dismissible fade show' role='alert'>
        Indicator added successful!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>  
        </button>
    </div>";

} else{
    echo mysqli_error($con);
}

}
?>
<!-- BEGIN #formControls -->
<div class="modal fade" id="modalSm">
<div class="modal-dialog modal-lg">
<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title">New Response</h5>
		<button onclick="add_field()" style="margin: calc(-.5* var(--bs-modal-header-padding-y)) calc(-.5* var(--bs-modal-header-padding-x)) calc(-.5* var(--bs-modal-header-padding-y)) auto;
" class="btn btn-outline-theme">Add More Fields</button>
	</div>
	<div class="modal-body">
		<form id="form" method="POST" action="">
<div class="row">
<div class="col-md-12"> 
	<div class="mb-3">
    <select class="form-select" id="example-select" class="choices form-select" name="indicator">
        <option>Select Indicator</option>
        <?php 

        $sql = "SELECT * FROM indicators";
        if($result = mysqli_query($con, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                        echo '<option value='.$row['qtnID'].'>' 
                        . $row['name']. '</option>';
                }
                mysqli_free_result($result);
            } else{
                echo "No records found.";
            }
        }
        ?>
        
    </select>
</div>
	<div class="form-group mb-3">
			<label class="form-check-label" for="defaultCheck1">Response</label>
			<input type="text" placeholder="Enter value here" class="form-control" name="response[]" >
	</div>
</div>
</div>
<div class="form-group mb-3" style="padding-top: 10px;">
	
	<button type="submit" name="register" class="btn btn-theme btn">Submit Indicator</button>
</div>
</form>
	</div>
</div>
</div>
</div>

<div id="formControls" class="mb-5">
<div class="card">
<div class="card-body pb-2">
<table id="table" class="table text-nowrap w-100">
	<thead>
		<tr>
			<th>Indicator</th>
			<th>Responses</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody> 
		<tr> 
			<?php  

			$tableid = "responseID";
			$tableName = "responses";
			$sql = "SELECT responses.name AS rname, responses.responseID, indicators.qtnID, indicators.name AS iname FROM responses INNER JOIN indicators on responses.indicator=indicators.qtnID";
			$result = mysqli_query($con, $sql);

			while($row = mysqli_fetch_array($result)) {
				  echo "<tr>";
				  echo "<td>".$row['iname']."</td>";
			      echo "<td>".$row['rname']."</td>";
			      echo "<td>                                                       
			    <a aria-label='anchor' class='btn btn-sm bg-primary-subtle me-1' data-bs-toggle='tooltip' data-bs-original-title='Edit'>
			        <i class='fa fa-edit'></i>
			    </a>
			    <a onclick='return checkDelete()' href='includes/delete.php?id=".$row['responseID']."&t=".$tableName."&tID=".$tableid."' aria-label='anchor' class='btn btn-sm bg-danger-subtle' data-bs-toggle='tooltip' data-bs-original-title='Delete'>
			        <i class='fa fa-trash'></i>
			    </a>
			</td>";
		      echo "</tr>";
		  			}
		      ?>
		</tr>
	</tbody>
</table>




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
        <script>
            function add_field(){

                var x = document.getElementById("form");
                // create an input field to insert
                var new_field = document.createElement("input");
                // set input field data type to text
                new_field.setAttribute("type", "text");
                // set input field name 
                new_field.setAttribute("name", "response[]");
                new_field.setAttribute("class", "form-control");
                new_field.setAttribute("placeholder", "Enter value here");
                // select last position to insert element before it
                var pos = x.childElementCount;

                // insert element
                x.insertBefore(new_field, x.childNodes[pos]);
            }
        </script>
<?php include "includes/scripts.php" ?>
