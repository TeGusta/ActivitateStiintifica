<?php
   
    // Database connection
    include('config/db.php');

    global $wrongPwdErr, $accountNotExistErr, $emailPwdErr, $verificationRequiredErr, $email_empty_err, $pass_empty_err;

    if(isset($_POST['login'])) {
        $email_signin      = $_POST['email_signin'];
        $parola_signin     = $_POST['parola_signin'];

        // clean data 
        $user_email = filter_var($email_signin, FILTER_SANITIZE_EMAIL);
        $pswd = mysqli_real_escape_string($connection, $parola_signin);

        // Query if email exists in db
        $sql = "SELECT * From users WHERE email = '{$email_signin}' ";
        $query = mysqli_query($connection, $sql);
        $rowCount = mysqli_num_rows($query);

        // If query fails, show the reason 
        if(!$query){
           die("SQL query failed: " . mysqli_error($connection));
        }

        if(!empty($email_signin) && !empty($parola_signin)){
            if(!preg_match("/^[a-zA-Z]{3,20}$/", $pswd)) {
                $wrongPwdErr = '<div class="alert alert-danger">
                        Parola trebuie sa aiba intre 3 si 20 de caractere.
                    </div>';
            }
            // Check if email exist
            if($rowCount <= 0) {
                $accountNotExistErr = '<div class="alert alert-danger">
                        Utilizatorul nu exista.
                    </div>';
            } else {
                // Fetch user data and store in php session
                while($row = mysqli_fetch_array($query)) {
                    $prenume       = $row['prenume'];
                    $nume          = $row['nume'];
                    $email         = $row['email'];
                    $telefon       = $row['telefon'];
                    $parola        = $row['parola'];
                }

                if($email_signin == $email && $parola_signin == $parola) {
                    header("Location: ./dashboard.php");
                    $_SESSION['prenume'] = $prenume;
                    $_SESSION['nume'] = $nume;
                    $_SESSION['email'] = $email;
                    $_SESSION['telefon'] = $telefon;

                } else {
                        $emailPwdErr = '<div class="alert alert-danger">
                                Emailul sau parola sunt incorecte.
                            </div>';
                }

            }
			
        } else {
            if(empty($email_signin)){
                $email_empty_err = "<div class='alert alert-danger email_alert'>
                            Nu ati introdus emailul.
                    </div>";
            }
            
            if(empty($parola_signin)){
                $pass_empty_err = "<div class='alert alert-danger email_alert'>
                            Nu ati introdus parola.
                        </div>";
            }            
        }

    }

?>