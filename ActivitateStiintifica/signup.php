<?php include('./controllers/register.php'); ?>
<?php  ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>PHP User Registration System Example</title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>
   
   <?php 
		$page = "signup.php";
		include('./header.php'); 
	?>

    <div class="App">
        <div class="vertical-center">
            <div class="inner-block">
                <form action="" method="post">
                    <h3>Register</h3>

                    <?php echo $success_msg; ?>
                    <?php echo $email_exist; ?>

                    <?php echo $email_verify_err; ?>
                    <?php echo $email_verify_success; ?>

                    <div class="form-group">
                        <label>Prenume</label>
                        <input type="text" class="form-control" name="prenume" id="prenume" />

                        <?php echo $prenumeEmptyErr; ?>
                        <?php echo $_prenumeErr; ?>
                    </div>

                    <div class="form-group">
                        <label>Nume</label>
                        <input type="text" class="form-control" name="nume" id="nume" />

                        <?php echo $_numeErr; ?>
                        <?php echo $numeEmptyErr; ?>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" id="email" />

                        <?php echo $_emailErr; ?>
                        <?php echo $emailEmptyErr; ?>
                    </div>

                    <div class="form-group">
                        <label>Telefon</label>
                        <input type="text" class="form-control" name="telefon" id="telefon" />

                        <?php echo $_telefonErr; ?>
                        <?php echo $telefonEmptyErr; ?>
                    </div>

                    <div class="form-group">
                        <label>Parola</label>
                        <input type="password" class="form-control" name="parola" id="parola" />

                        <?php echo $_parolaErr; ?>
                        <?php echo $parolaEmptyErr; ?>
                    </div>

                    <button type="submit" name="submit" id="submit" class="btn btn-outline-primary btn-lg btn-block">Sign up
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>