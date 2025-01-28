<?php      
    $host = "localhost";  
    $user = "root";  
    $passw = "";  
    $dbname = "taunwifi";   


    $con = mysqli_connect($host, $user, $passw, $dbname);  
    if( mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  
?>   