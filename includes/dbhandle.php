<?php      
    $host = "localhost";  
    $user = "root";  
    $passw = "";  
    $dbname = "ewrt";   


    $con = mysqli_connect($host, $user, $passw, $dbname);  
    if( mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  
?>   