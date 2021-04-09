<?php include('config/db.php'); ?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style_tabel.css">
    <title>PHP User Registration System Example</title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>

	<!-- Header -->
    <?php 
		$page = "articolelemele.php";
		include('./header_dash.php'); 
	?>
    
    <!-- Buton -->
    <?php include('./controllers/buton.php'); ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Articolele mele</h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Articol</th>
                            <th scope="col">Numar citari</th>
                            <th scope="col">Punctaj</th>
                            <th scope="col">Sterge</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                                 $email = $_SESSION['email'];


                                 //Se afiseaza aticolele utilisatorului logat
		                         $res = "SELECT A.idArticol,titlu,numarCitari,punctaj FROM `articole` A 
                                 JOIN `autori` AU ON A.idArticol = AU.idArticol 
                                 JOIN `punctaje` P ON P.idArticol = AU.idArticol AND P.idArticol = A.idArticol 
                                 WHERE email = '{$email}'";



		                         $result = mysqli_query($connection, $res) or die('Nu aveti niciun articol.');

		
		                         while ($row = mysqli_fetch_assoc($result)) {
                            ?>    
                                    <tr>
                                    <td><?php echo $row['titlu']; ?></td>     
                                    <td><?php echo $row['numarCitari']; ?></td>       
                                    <td><?php echo $row['punctaj']; ?></td>   
                                    <td> 
                                    <form method="post" action="">
                                        <input type="hidden" name="id" value="<?php echo $row['idArticol']; ?>"/>
                                        <input type="submit" name="delete" class="btn btn-outline-primary btn-block" value ="Sterge"/>
                                    </form> 
                                    </td>
                                    </tr>
                            <?php
                                 }     
                            ?>                       
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>