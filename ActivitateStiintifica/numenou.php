<?php include('config/db.php'); ?>
<?php include('./controllers/nume_nou.php'); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>PHP User Registration & Login System Demo</title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>

    <!-- Header -->
    <?php 
		$page = "numenou.php";
		include('./header_dash.php'); 
	?>

    <!-- Login form -->
    <div class="App">
        <div class="vertical-center">
            <div class="inner-block">

                <form action="" method="post">
                    <h3>Schimba numele</h3>

                    <?php echo $success_msg; ?>

                    <div class="form-group">
                        <label>Nume nou</label>
                        <input type="text" class="form-control" name="nume" id="nume" />

                        <?php echo $numeEmptyErr; ?>
                        <?php echo $_numeErr; ?>
                    </div>

                    <button type="submit" name="submit" id="submit" class="btn btn-outline-primary btn-lg btn-block">Schimba</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>