<?php
   
    // Conexiunea cu baza de date
    include('config/db.php');
    
    // Mesaje eroare/succes
    global $success_msg, $email_exist, $_prenumeErr, $_numeErr, $_emailErr, $_telefonErr, $_parolaErr;
    global $prenumeEmptyErr, $numeEmptyErr, $emailEmptyErr, $telefonEmptyErr, $parolaEmptyErr, $email_verify_err, $email_verify_success;
    
    $_prenume = $_nume = $_email = $_telefon = $_parola = "";

    if(isset($_POST["submit"])) {
        $prenume  = $_POST["prenume"];
        $nume     = $_POST["nume"];
        $email    = $_POST["email"];
        $telefon  = $_POST["telefon"];
        $parola   = $_POST["parola"];

        // Verific daca exista deja emailul
        $email_check_query = mysqli_query($connection, "SELECT * FROM users WHERE email = '{$email}' ");
        $rowCount = mysqli_num_rows($email_check_query);


        // Verific daca variabilele sunt goale
        if(!empty($prenume) && !empty($nume) && !empty($email) && !empty($telefon) && !empty($parola)){
            
            // Verific daca exista deja emailul
            if($rowCount > 0) {
                $email_exist = '
                    <div class="alert alert-danger" role="alert">
                        User with email already exist!
                    </div>
                ';
            } else {
                // Se elibereaza formul
                $_prenume = mysqli_real_escape_string($connection, $prenume);
                $_nume = mysqli_real_escape_string($connection, $nume);
                $_email = mysqli_real_escape_string($connection, $email);
                $_telefon = mysqli_real_escape_string($connection, $telefon);
                $_parola = mysqli_real_escape_string($connection, $parola);

                // Validare
                if(!preg_match("/^[a-zA-Z ]*$/", $_prenume)) {
                    $_prenumeErr = '<div class="alert alert-danger">
                            Only letters and white space allowed.
                        </div>';
                }
                if(!preg_match("/^[a-zA-Z ]*$/", $_nume)) {
                    $_numeErr = '<div class="alert alert-danger">
                            Only letters and white space allowed.
                        </div>';
                }
                if(!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
                    $_emailErr = '<div class="alert alert-danger">
                            Email format is invalid.
                        </div>';
                }
                if(!preg_match("/^[0-9]{10}+$/", $_telefon)) {
                    $_telefonErr = '<div class="alert alert-danger">
                            Only 10-digit mobile numbers allowed.
                        </div>';
                }
                if(!preg_match("/^[a-zA-Z0-9]{3,20}$/", $_parola)) {
                    $_parolaErr = '<div class="alert alert-danger">
                             parola should be between 3 to 20 charcters long.
                        </div>';
                }
                
                // Conditia de stocare in baza de date
                if((preg_match("/^[a-zA-Z ]*$/", $_prenume)) && (preg_match("/^[a-zA-Z ]*$/", $_nume)) &&
                 (filter_var($_email, FILTER_VALIDATE_EMAIL)) && (preg_match("/^[0-9]{10}+$/", $_telefon)) && 
                 (preg_match("/^[a-zA-Z0-9]{3,20}$/", $_parola))){

                    // Query
                    $sql = "INSERT INTO users (prenume, nume, email, telefon, parola, data) 
					VALUES ('{$prenume}', '{$nume}', '{$email}', '{$telefon}', '{$parola}', now())";
                    
                    // Mysql query
                    $sqlQuery = mysqli_query($connection, $sql);
                    
                    if(!$sqlQuery){
                        die("MySQL query failed!" . mysqli_error($connection));
                    }
					else $success_msg = '<div class="alert alert-success"> You have registered successfully </div>';
                }
            }
        } else { //Erori daca variabilele sunt goale
            if(empty($prenume)){
                $prenumeEmptyErr = '<div class="alert alert-danger">
                    First name can not be blank.
                </div>';
            }
            if(empty($nume)){
                $numeEmptyErr = '<div class="alert alert-danger">
                    Last name can not be blank.
                </div>';
            }
            if(empty($email)){
                $emailEmptyErr = '<div class="alert alert-danger">
                    Email can not be blank.
                </div>';
            }
            if(empty($telefon)){
                $telefonEmptyErr = '<div class="alert alert-danger">
                    Mobile number can not be blank.
                </div>';
            }
            if(empty($parola)){
                $parolaEmptyErr = '<div class="alert alert-danger">
                    parola can not be blank.
                </div>';
            }            
        }
    }
?>