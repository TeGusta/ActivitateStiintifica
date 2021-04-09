<?php
   
    // Conexiunea cu baza de date
    include('config/db.php');
    
    // Mesaje eroare/succes
    global $success_msg,$_telefonErr, $_emailErr;
    global $telefonEmptyErr;
    
    $_telefon = "";

    if(isset($_POST["submit"])) {

        $telefon = $_POST["telefon"];

        $_telefon = mysqli_real_escape_string($connection, $telefon);

    if(!empty($telefon)) {
        //Validare
        if(!preg_match("/^[0-9]{10}+$/", $_telefon)) {
            $_telefonErr = '<div class="alert alert-danger">
                     Trebuie introdus un numar de telefon de 10 cifre.
                </div>';
        }
        //Conditiii de stocare in baza de date
        if((preg_match("/^[0-9]{10}+$/", $_telefon))){
            $email = $_SESSION['email'];
            //Updatez numarul de telefon in functie de email
            $sql = "UPDATE `users` SET `telefon`='{$telefon}' WHERE email = '{$email}'";
            $sqlQuery = mysqli_query($connection, $sql);
            if((!$sqlQuery)){
                    die("MySQL query failed!" . mysqli_error($connection));
            }
            else {
                //Mesaj de succes
                $success_msg = '<div class="alert alert-success"> Ati schimbat numarul de telefon cu succes. </div>';
                $_SESSION ['telefon']= $telefon;
                header("Location: ./dashboard");
            }
        } 
    }else {//Eroare in caz ca nu a fost completat campul cu un nume nou
            if(empty($telefon)){
                $telefonEmptyErr = '<div class="alert alert-danger">
                    Numarul de telefon nu poate fi gol.
                </div>';
            }
        }
         }

?>