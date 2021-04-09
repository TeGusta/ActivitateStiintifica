<?php
   
    // Database connection
    include('config/db.php');     

    if(isset($_POST['delete'])) {

        $id = mysqli_real_escape_string($connection, $_POST['id']);
        $sql = "DELETE FROM articole WHERE idArticol = '{$id}' ";
        $sqlQuery = mysqli_query($connection, $sql);

        if(!$sqlQuery){
            die("MySQL query failed!" . mysqli_error($connection));
        }
            
   }
          
?>