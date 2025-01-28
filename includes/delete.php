 <?php 
    $id = $_GET['id'];
    $table = $_GET['t'];
    $tableid = $_GET['tID'];

    include "../includes/dbhandle.php";

    $sql = "DELETE FROM $table WHERE $tableid='$id' ";

    if(mysqli_query($con, $sql)){
        ?>
<script type="text/javascript"> 
alert("Record successfully deleted"); 
window.history.go(-2);
 
</script>
<?php 

    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
     
    // Close connection
    mysqli_close($con);
?>
