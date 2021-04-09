<?php include('config/db.php'); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style_profil.css">
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
    
    <!-- Footer -->
    <?php 
		$page = "dashboard.php";
		include('./footer_profil.php'); 
	?>
	
    <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <div class="card">
                <div class="card-body">
				
                    <h5 class="card-title">Profil cercetator</h5>
					
                    <h6 class="card-subtitle mb-2 text-muted">
						<?php echo $_SESSION['prenume']; ?>
                        <?php echo $_SESSION['nume']; ?>
					</h6>
					
                    <p class="card-text">Adresa de email: <?php echo $_SESSION['email']; ?></p>
                    <p class="card-text">Numar de telefon: <?php echo $_SESSION['telefon']; ?></p>
                    <a class="btn btn-info btn-block" href="numenou.php">Schimba numele</a>
                    <a class="btn btn-info btn-block" href="prenumenou.php">Schimba prenumele</a>
                    <a class="btn btn-info btn-block" href="telefonnou.php">Schimba numarul de telefon</a>
                    <a class="btn btn-info btn-block" href="articolelemele.php">Articolele mele</a>
                    <a class="btn btn-info btn-block" href="creeazaarticol.php">Scrie un articol</a>
                    <a class="btn btn-danger btn-block" href="logout.php">Log out</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>