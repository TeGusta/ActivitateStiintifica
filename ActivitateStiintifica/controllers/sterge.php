<?php
   
    // Conexiunea cu baza de date
    include('../config/db.php');
      
        $email = $_SESSION['email'];
        //Stergere cont
        $sql = "DELETE FROM users WHERE email = '{$email}' ";
        $sqlQuery = mysqli_query($connection, $sql);
        if(!$sqlQuery){
            die("MySQL query failed!" . mysqli_error($connection));
        }else {
            //Sar la pagina de login
            header("Location:http://localhost/ActivitateStiintifica/logout.php");
        } 

          
?>