<?php
   
    // Conexiune cu baza de date
    include('config/db.php');
    
    // Mesaje eroare/succes
    global $success_msg,$_numeErr, $_emailErr;
    global $numeEmptyErr;
    
    $_nume = "";

    if(isset($_POST["submit"])) {

        $nume = $_POST["nume"];

        $_nume = mysqli_real_escape_string($connection, $nume);

    if(!empty($nume)) {
        //Validare
        if(!preg_match("/^[a-zA-Z ]*$/", $_nume)) {
            $_numeErr = '<div class="alert alert-danger">
                     Doar litere si spatii sunt permise.
                </div>';
        }
        //Conditiii de stocare in baza de date
        if((preg_match("/^[a-zA-Z ]*$/", $_nume))){

            $email = $_SESSION['email'];
            //Updatez numele in functie de email
            $sql = "UPDATE `users` SET `nume`='{$nume}' WHERE email = '{$email}'";
            $sqlQuery = mysqli_query($connection, $sql);
            if((!$sqlQuery)){
                    die("MySQL query failed!" . mysqli_error($connection));
            }
            else {
                //Mesaj de succes
                $success_msg = '<div class="alert alert-success"> Ati schimbat numele cu succes. </div>';
                $_SESSION ['nume']= $nume;
                header("Location: ./dashboard");
            }
        } 
    }else {//Eroare in caz ca nu a fost completat campul cu un nume nou
            if(empty($nume)){
                $numeEmptyErr = '<div class="alert alert-danger">
                    Numele nu poate fi gol.
                </div>';
            }
        }
         }

?>