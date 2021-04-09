<?php include('config/db.php'); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style_tabel.css">
    <title>PHP User Registration System Example</title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>

	<!-- Header -->
    <?php 
		$page = "conferinte.php";
		include('./header_dash.php'); 
	?>
	
    <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <div class="card">
                <div class="card-body">
        <h3 class="card-title">Conferinte la care aveti cel putin 2 articole</h3>
		<table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Numar Conferinta</th>
                            <th scope="col">Data</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                 $email = $_SESSION['email'];


                                 //Se afiseaza conferintele la care utilizatorul a scris cel putin 2 articole
		                         $res = "SELECT C.nrConferinta, C.data FROM `articoleconferinta` AC 
                                 JOIN `autori` A ON AC.idArticol = A.idArticol 
                                 JOIN `conferinte` C ON AC.nrConferinta = C.nrConferinta 
                                 WHERE C.nrConferinta IN (SELECT nrConferinta FROM `articoleconferinta` AC 
                                                          JOIN `autori` A ON AC.idArticol = A.idArticol
                                                          WHERE email = '{$email}' 
                                                          GROUP BY nrConferinta 
                                                          HAVING COUNT(*)>=2) 
                                 GROUP BY nrConferinta";

		                         $result = mysqli_query($connection, $res) or die('Nu aveti niciun articol.');

		                         while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                    <td><?php echo $row['nrConferinta']; ?></td>     
                                    <td><?php echo $row['data']; ?></td>                 
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