<?php include('config/db.php'); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style_home.css">
    <title>PHP User Registration System Example</title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>

	<!-- Header -->
    <?php 
		$page = "articole.php";
		include('./header_dash.php'); 
	?>
	
	<!-- Search bar -->
    <?php include('./controllers/searchbar_articole.php'); ?>
	
    <div class="container mt-5">
        <div class="d-flex justify-content-center">
			<form action="" method="post">
				<div class="wrap">
					<div class="search">
						<input type="text" name="search" id="search" class="searchTerm" placeholder="Cauta articol dupa an...">
						<button type="submit" class="searchButton">
							<i class="fa fa-search"></i>
						</button>
					</div>
					<div class="boxc">
						<input type="radio" id="toate" name="tip" value="toate" <?php if(isset($_POST['tip'])){if($_POST['tip']=='toate'){echo "checked='checked'";}};?>>
						<label for="toate">Toate</label>
						
						<input type="radio" id="jurnal" name="tip" value="jurnal" <?php if(isset($_POST['tip'])){if($_POST['tip']=='jurnal'){echo "checked='checked'";}};?>>
						<label for="jurnal">Jurnal</label>

						<input type="radio" id="conferinta" name="tip" value="conferinta" <?php if(isset($_POST['tip'])){if($_POST['tip']=='conferinta'){echo "checked='checked'";}};?>>
						<label for="conferinta">Conferinta</label>
						
						<input type="checkbox" id="medie" name="medie" value="punctaj" <?php if(isset($_POST['medie'])) echo "checked='checked'"; ?>>
						<label for="medie">Doar cele peste media punctajelor</label>
					</div>
				</div>
			</form>
        </div>
    </div>

</body>



</html>