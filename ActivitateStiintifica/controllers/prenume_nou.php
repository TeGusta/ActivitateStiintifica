<?php
   
    // Verific daca exista deja emailul
    include('config/db.php');
    
    // Mesaje eroare/succes
    global $success_msg,$_prenumeErr, $_emailErr;
    global $prenumeEmptyErr;
    
    $_prenume = "";

    if(isset($_POST["submit"])) {

        $prenume = $_POST["prenume"];

        $_prenume = mysqli_real_escape_string($connection, $prenume);
    //Verific daca a fost completat campul
    if(!empty($prenume)) {
        //Validare
        if(!preg_match("/^[a-zA-Z ]*$/", $_prenume)) {
            $_prenumeErr = '<div class="alert alert-danger">
                     Doar litere si spatii sunt permise.
                </div>';
        }
        //Conditiii de stocare in baza de date
        if((preg_match("/^[a-zA-Z ]*$/", $_prenume))){

            $email = $_SESSION['email'];
            //Updatez prenumele in functie de email
            $sql = "UPDATE `users` SET `prenume`='{$prenume}' WHERE email = '{$email}'";
            $sqlQuery = mysqli_query($connection, $sql);
            if((!$sqlQuery)){
                    die("MySQL query failed!" . mysqli_error($connection));
            }
            else {
                //Mesaj de succes
                $success_msg = '<div class="alert alert-success"> Ati schimbat prenumele cu succes. </div>';
                $_SESSION ['prenume']= $prenume;
                header("Location: ./dashboard");
            }
        } 
    }else {//Eroare in caz ca nu a fost completat campul cu un prenume nou
            if(empty($prenume)){
                $prenumeEmptyErr = '<div class="alert alert-danger">
                    Prenumele nu poate fi gol.
                </div>';
            }
        }
         }

?>