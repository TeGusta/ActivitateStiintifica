<?php
   
    //Conexiunea cu baza de date
    include('config/db.php');
    
    //Mesaje eroare/succes
    global $success_msg, $titlu_exist, $_titluErr, $_conferintaErr,$_citariErr, $_email1Err, $_email2Err, $_tiparticolErr;
    global $titluEmptyErr, $tiparticolEmptyErr, $citariEmptyErr;
    
    $_titlu = $_conferinta = $_citari = $_email1 = $_email2 = $_tiparticol = "";
    $nrautori = 0;

    if(isset($_POST["submit"])) {
        $titlu      = $_POST["titlu"];
        $tiparticol = $_POST["tiparticol"];
        $conferinta = $_POST["conferinta"];
        $citari     = $_POST["citari"];
        $email1     = $_POST["email1"];
        $email2     = $_POST["email2"];

        //Vad daca exista numarul conferintei
        if(!empty($conferinta)){
            $conferinta_check_query = mysqli_query($connection, "SELECT * FROM `conferinte` WHERE nrConferinta = '{$conferinta}'");
            $rowCount_conferinta = mysqli_num_rows($conferinta_check_query);

            //Vad daca mai exista titlul la aceeasi conferinta
            $titlu_check_query = mysqli_query($connection, "SELECT * FROM `articole` A JOIN `articoleconferinta` AC 
            ON A.idArticol = AC.idArticol WHERE titlu = '{$titlu}' AND nrConferinta = '{$conferinta}' ");


            $rowCount_titlu = mysqli_num_rows($titlu_check_query);
        }
        else {

            
            //Vad daca mai exista titlul la articole de jurnal
            $titlu_check_query = mysqli_query($connection, "SELECT * FROM `punctaje` P JOIN `articole` A 
            ON P.idArticol = A.idArticol WHERE titlu = '{$titlu}' AND tipArticol = '{$tiparticol}' ");


            $rowCount_titlu = mysqli_num_rows($titlu_check_query);
        }

        //Vad daca exista autorul1
        $autor1_check_query = mysqli_query($connection, "SELECT * FROM `users` WHERE email = '{$email1}'");
        $rowCount_autor1 = mysqli_num_rows($autor1_check_query);

        //Vad daca exista autorul2
        $autor2_check_query = mysqli_query($connection, "SELECT * FROM `users` WHERE email = '{$email2}'");
        $rowCount_autor2 = mysqli_num_rows($autor2_check_query);

        //Verific daca valorile sunt goale
        if( (!empty($titlu) && !empty($tiparticol) && !empty($citari))){

            //Verific daca exista conferinta, daca nu, o creez
            if(!empty($conferinta)) {
                if($rowCount_conferinta == 0) {
                     $sql_conn = "INSERT INTO conferinte (nrConferinta, data) VALUES ('{$conferinta}',now())";
                    $sqlQuery_conn = mysqli_query($connection, $sql_conn);
                    if((!$sqlQuery_conn)){
                         die("MySQL query failed --conferinta--!" . mysqli_error($connection));
                    }
                 }
            }
            
            //Vad daca mai exista titlul
            if($rowCount_titlu > 0) {
                $titlu_exist = '
                    <div class="alert alert-danger" role="alert">
                        Titlul deja exista la aceasta conferinta.
                    </div>
                ';
            } else {
                //Eliberez formul
                $_titlu = mysqli_real_escape_string($connection, $titlu);
                $_conferinta = mysqli_real_escape_string($connection, $conferinta);
                $_email1 = mysqli_real_escape_string($connection, $email1);
                $_email2 = mysqli_real_escape_string($connection, $email2);
                $_tiparticol = mysqli_real_escape_string($connection, $tiparticol);
                $_citari = mysqli_real_escape_string($connection, $citari);

                //Validare
                if(!preg_match("/^[a-zA-Z ]*$/", $_titlu)) {
                    $_titluErr = '<div class="alert alert-danger">
                            Doar litere si spatii sunt permise.
                        </div>';
                }
                if(!preg_match("/^[1-2]*$/", $_tiparticol)) {
                    $_tiparticolErr = '<div class="alert alert-danger">
                            Tipul articolului poate fi doar 1 sau 2.
                        </div>';
                }

                if(!preg_match("/^[0-9]*$/", $_citari)) {
                    $_citariErr = '<div class="alert alert-danger">
                            Doar cifre sunt permise.
                        </div>';
                }

                if(!empty($conferinta)) {
                    if(!preg_match("/^[0-9]*$/", $_conferinta)) {
                        $_conferintaErr = '<div class="alert alert-danger">
                                Doar cifre sunt permise.
                            </div>';
                    }
                }   
                if(!empty($email1)) {
                    if(!filter_var($_email1, FILTER_VALIDATE_EMAIL)) {
                        $_email1Err = '<div class="alert alert-danger">
                             Email invalid.
                            < /div>';
                     }
                }
                if(!empty($email2)) {
                    if(!filter_var($_email2, FILTER_VALIDATE_EMAIL)) {
                         $_email2Err = '<div class="alert alert-danger">
                              Email invalid.
                            </div>';
                    }
                }
                
                //Store the data in db, if all the preg_match condition met
                if ( (preg_match("/^[a-zA-Z ]*$/", $_titlu)) && (preg_match("/^[0-9]*$/", $_citari)) && (preg_match("/^[1-2]*$/", $_tiparticol)) ){
                    
                    $nrautori = $nrautori + 1;

                    //ARTICOLE
                    $data = date("Y");
                    $sql_art = "INSERT INTO articole (titlu, an) VALUES ('{$titlu}','{$data}')";
                    $sqlQuery_art = mysqli_query($connection, $sql_art);
                    if((!$sqlQuery_art)){
                        die("MySQL query failed --articole--!" . mysqli_error($connection));
                    }

                    $last_id = $connection->insert_id;
                    //ARTICOLECONFERINTA
                    if(!empty($conferinta)){
                         $sql_ac = "INSERT INTO articoleconferinta (idArticol, nrConferinta) VALUES ('{$last_id}','{$conferinta}')";
                         $sqlQuery_ac = mysqli_query($connection, $sql_ac);
                         if((!$sqlQuery_ac)){
                            die("MySQL query failed--articoleconferinta--!" . mysqli_error($connection));

                        }
                    }

                    //AUTOR1
                    if(!empty($email1)) {
                        if ($rowCount_autor1 > 0){
                            if ( (filter_var($_email1, FILTER_VALIDATE_EMAIL)) ) {

                                //AUTOR1 querry
                                $sql_a1 = "INSERT INTO autori (idArticol, email) VALUES ('{$last_id}','{$email1}')";
                                $sqlQuery_a1 = mysqli_query($connection, $sql_a1);
                                if((!$sqlQuery_a1)){
                                   die("MySQL query failed--autor1--!" . mysqli_error($connection));
                                }
                                $nrautori = $nrautori + 1;
                            }
                        } else {
                            $_email1Err = '<div class="alert alert-danger">
                                Email invalid.
                            </div>';
                        }
                    }

                    //AUTOR2
                    if(!empty($email2)) {
                        if ($rowCount_autor2 > 0){
                            if((filter_var($_email2, FILTER_VALIDATE_EMAIL))) {

                                //AUTOR2 querry
                                $sql_a2 = "INSERT INTO autori (idArticol, email) VALUES ('{$last_id}','{$email2}')";
                                $sqlQuery_a2 = mysqli_query($connection, $sql_a2);
                                if((!$sqlQuery_a2)){
                                     die("MySQL query failed--autor2--!" . mysqli_error($connection));
                                 }   
                                 $nrautori = $nrautori + 1;
                             }
                        }
                        else {
                            $_email2Err = '<div class="alert alert-danger">
                                Email invalid.
                            </div>';
                        }
                    }

                    //AUTOR CURENT querry
                    $email = $_SESSION['email'];
                    $sql_current = "INSERT INTO autori (idArticol, email) VALUES ('{$last_id}','{$email}')";
                    $sqlQuery_current = mysqli_query($connection, $sql_current);
                    if((!$sqlQuery_current)){
                         die("MySQL query failed--autor curent--!" . mysqli_error($connection));
                    }

                    //AN
                    //Vad daca exista anul in baza de date
                    $an_check_query = mysqli_query($connection, "SELECT * FROM `ani` WHERE an = '{$data}'");
                    $rowCount_an = mysqli_num_rows($an_check_query);

                    if($rowCount_an == 0){
                        $punctajAn = array_sum(str_split($data));
                        $sql_an = "INSERT INTO ani (an,punctajAn) VALUES ('{$data}', '{$punctajAn}')";
                        $sqlQuery_an = mysqli_query($connection, $sql_an);
                        if((!$sqlQuery_an)){
                            die("MySQL query failed --ani--!" . mysqli_error($connection));
                        }
                    }

                    //PUNCTAJ
                    //gaseste factorul de impact corespunzator
                    $fi = "SELECT factorDeImpact FROM `factor` WHERE tipArticol = '{$tiparticol}'";
                    $factorimpact = mysqli_query($connection, $fi) or die('Error Querry.');
                    $rowi = mysqli_fetch_assoc($factorimpact);
                    $variabila_fi = $rowi['factorDeImpact'];

                    //gaseste punctajul corespunzator anului
                    $p_an = "SELECT punctajAn FROM `ani` WHERE an = '{$data}'";
                    $factoran = mysqli_query($connection, $p_an) or die('Error Querry.');
                    $rowa = mysqli_fetch_assoc($factoran);
                    $variabila_fa = $rowa['punctajAn'];

                    $punctaj = (0.3 * $citari + 30 * $variabila_fi + $variabila_fa)/$nrautori;

                    $sql_p = "INSERT INTO punctaje (idArticol, tipArticol, numarCitari,punctaj) VALUES ('{$last_id}','{$tiparticol}', '{$citari}', '{$punctaj}')";
                    $sqlQuery_p = mysqli_query($connection, $sql_p);
                    if((!$sqlQuery_p)){
                       die("MySQL query failed--punctaj--!" . mysqli_error($connection));
                    }
                    else $success_msg = '<div class="alert alert-success"> Ati creat un articol cu succes. </div>';
                }
            }
        } else {
            if(empty($titlu)){
                $titluEmptyErr = '<div class="alert alert-danger">
                    Titlul nu poate fi gol.
                </div>';
            }
            if(empty($tiparticol)){
                $tiparticolEmptyErr = '<div class="alert alert-danger">
                    Tip articol nu poate fi gol.
                </div>';
            }
            if(empty($citari)){
                $citariEmptyErr = '<div class="alert alert-danger">
                    Numarul de citari nu poate fi gol.
                </div>';
            }
        }
    }
?>