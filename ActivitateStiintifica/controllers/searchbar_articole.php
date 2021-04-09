<!doctype html>
<html lang="en">
<?php 
	// Conexiunea cu baza de date
	include('config/db.php');
	global $search, $result, $res, $row;
	$rowCount = 0;
	if(isset($_POST["search"])) {

		$toate_check = $jurnal_check = $conf_check = $medie_check = "";
		$search = mysqli_real_escape_string($connection,$_POST["search"]);

		if(isset($_POST["tip"])) { //Verific ce radio button este activ
			$tip = $_POST["tip"];
			if($tip == "toate"){


				//Se selecteaza articolele si punctajele lor care au fost scrise in anul primit de la tastatura
				$toate = "SELECT * FROM `punctaje` P JOIN `articole` A 
				ON P.idArticol = A.idArticol WHERE an = '{$search}'";



				$result = mysqli_query($connection, $toate) or die('Nu s-a putut gasi niciun articol.');	
				if(isset($_POST["medie"])) {

					
					//Se selecteaza articolele care au punctajul peste medie lor care au fost scrise in anul primit de la tastatura
					$toate_medie = "SELECT * FROM `punctaje` P JOIN `articole` A ON P.idArticol = A.idArticol 
					WHERE an = '{$search}' AND P.punctaj > (SELECT AVG(PJ.punctaj) FROM `punctaje` PJ)";



					$result = mysqli_query($connection, $toate_medie) or die('Nu s-a putut gasi niciun articol.');
				}
			}

			if($tip == "jurnal"){


				//Se selecteaza articolele de jurnal si punctajele lor care au fost scrise in anul primit de la tastatura
				$jurnal_toate = "SELECT * FROM `punctaje` P JOIN `articole` A 
				ON P.idArticol = A.idArticol WHERE an = '{$search}' AND P.tipArticol = '2'";



				$result = mysqli_query($connection, $jurnal_toate) or die('Nu s-a putut gasi niciun articol.');
					if(isset($_POST["medie"])) {


						//Se selecteaza articolele de jurnal care au punctajul peste medie lor care au fost scrise in anul primit de la tastatura
						$jurnal_medie = "SELECT * FROM `punctaje` P JOIN `articole` A ON P.idArticol = A.idArticol 
						WHERE an = '{$search}' AND P.punctaj > (SELECT AVG(PJ.punctaj) 
						FROM `punctaje` PJ WHERE PJ.tipArticol = '2') AND P.tipArticol = '2'";



						$result = mysqli_query($connection, $jurnal_medie) or die('Nu s-a putut gasi niciun articol.');
					}
				}

			if($tip == "conferinta") {



				//Se selecteaza articolele de conferinta si punctajele lor care au fost scrise in anul primit de la tastatura
				$conferinta_toate = "SELECT * FROM `punctaje` P JOIN `articole` A 
				ON P.idArticol = A.idArticol WHERE an = '{$search}' AND P.tipArticol = '1'";



				$result = mysqli_query($connection, $conferinta_toate) or die('Nu s-a putut gasi niciun articol.');
				if(isset($_POST["medie"])) {


					//Se selecteaza articolele de conferinta care au punctajul peste medie lor care au fost scrise in anul primit de la tastatura
					$conferinta_medie = "SELECT * FROM `punctaje` P JOIN `articole` A ON P.idArticol = A.idArticol 
					WHERE an = '{$search}' AND P.punctaj > (SELECT AVG(PJ.punctaj) 
					FROM `punctaje` PJ WHERE PJ.tipArticol = '1') AND P.tipArticol = '1'";



					$result = mysqli_query($connection, $conferinta_medie) or die('Nu s-a putut gasi niciun articol.');
				}
			}
				$rowCount = mysqli_num_rows($result);
		}
		if($rowCount > 0) {
		?>
			<table class ="table">	
			<thread>
			<th scope = 'col'>Titlu</th>
			<th scope = 'col'>An</th>
			<th scope = 'col'>Punctaj</th>
			</thread>
			<tbody>
		<?php
			while ($row = mysqli_fetch_assoc($result)) {
		?>
				<tr>
				<td><?php echo $row['titlu'];?></td>
				<td><?php echo $row['an']; ?></td>
				<td><?php echo $row['punctaj']; ?></td>
				</tr>
		<?php
			}
		}else {
		?>
			<table class ="table">	
			<thread>
			<th scope = 'col'><?php echo "Nu s-a putut gasi niciun articol pentru \"".$search."\":";?></th>
			</thread>
			<tbody>
		<?php
		}
		?>
		</tbody>
		</table>
	<?php
	}
?>
</html>
