<?php include('config/db.php'); ?>
<?php include('./controllers/addarticole.php'); ?>
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

	<!-- Header -->
    <?php 
		$page = "dashboard.php";
		include('./header_dash.php'); 
	?>
	
    <div class="App">
        <div class="vertical-center">
            <div class="inner-block">
                <form action="" method="post">

                    <?php echo $success_msg; ?>
                    <?php echo $titlu_exist; ?>

                    <div class="form-group">
                        <label>Titlu articol</label>
                        <input type="text" class="form-control" name="titlu" id="titlu" />

                        <?php echo $titluEmptyErr; ?>
                        <?php echo $_titluErr; ?>
                    </div>

                    <div class="form-group">
                        <label>Tip articol (1-conferinta, 2-jurnal)</label>
                        <input type="text" class="form-control" name="tiparticol" id="tiparticol" />

                        <?php echo $_tiparticolErr; ?>
                        <?php echo $tiparticolEmptyErr; ?>
                    </div>

                    <div class="form-group">
                        <label>Numar conferinta (optional) </label>
                        <input type="text" class="form-control" name="conferinta" id="conferinta" />

                        <?php echo $_conferintaErr; ?>
                    </div>

                    <div class="form-group">
                        <label>Numar citari</label>
                        <input type="text" class="form-control" name="citari" id="citari" />

                        <?php echo $_citariErr; ?>
                        <?php echo $citariEmptyErr; ?>
                    </div>

                    <h3>Alti autori (optional)</h3>

                    <div class="form-group">
                        <label>Email autor1</label>
                        <input type="email" class="form-control" name="email1" id="email1" />

                        <?php echo $_email1Err; ?>
                    </div>

                    <div class="form-group">
                        <label>Email autor2</label>
                        <input type="email" class="form-control" name="email2" id="email2" />

                        <?php echo $_email2Err; ?>
                    </div>

                    <button type="submit" name="submit" id="submit" class="btn btn-outline-primary btn-lg btn-block">Creeaza articol
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>