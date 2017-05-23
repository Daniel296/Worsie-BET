<!--<!DOCTYPE html>-->
<div id="bilete">
<?php
	$bileteT = 0; $bileteW = 0; $bileteL = 0; $bileteU = 0;
	$sql_query = "SELECT bilete, bileteW, bileteL, bileteU FROM UTILIZATORI WHERE id = ?";
	if($stmt =  $conn->prepare($sql_query)) {
		$stmt->bind_param('i', $_SESSION['id']);
		$stmt->execute();
		$stmt->bind_result($bileteT, $bileteW, $bileteL, $bileteU);
		$stmt->fetch();
	}
	

	//echo "Total T: " . $bileteT . "<br>Bilete W: " . $bileteW . "<br>Bilete L: " . $bileteL . "<br>Bilete U: " . $bileteU;
	unset($stmt);
	
	$sql_query = "SELECT status, suma_depusa, suma_castig, cod, pariuri, cota, data_creare FROM bilete WHERE id_user = 1 ORDER BY data_creare DESC";
	if($stmt =  $conn->prepare($sql_query)) {
		$stmt->execute();
		$stmt->bind_result($status, $suma_depusa, $suma_castig, $cod, $pariuri, $cota, $data_creare);
		while($stmt->fetch()) {
			if($status == -1) { 
				echo '
					<div class="biletL">
						<div class="biletID">COD: ' . $cod . '
						</div>

						<div class="biletData">' . $data_creare . '
						</div>

						<div class="biletSuma">Suma: ' . $suma_depusa . ' RON
						</div>

						<div class="biletCastig">Castig: 0 RON
						</div>

						<div class="biletCota">Cota: ' . $cota . '
						</div>
					</div>
				';
			} else if($status == 0) {
				echo '
					<div class="biletU">
						<div class="biletID">COD: ' . $cod . '
						</div>

						<div class="biletData">' . $data_creare . '
						</div>

						<div class="biletSuma">Suma: ' . $suma_depusa . ' RON
						</div>

						<div class="biletCastig">Castig: ' . $suma_castig . ' RON
						</div>

						<div class="biletCota">Cota: ' . $cota . '
						</div>
					</div>
				';
			} else if($status == 1) {
				echo '
					<div class="biletW">
						<div class="biletID">COD: ' . $cod . '
						</div>

						<div class="biletData">' . $data_creare . '
						</div>

						<div class="biletSuma">Suma: ' . $suma_depusa . ' RON
						</div>

						<div class="biletCastig">Castig: ' . $suma_castig . ' RON
						</div>

						<div class="biletCota">Cota: ' . $cota . '
						</div>
					</div>
				';
			}
		}
	}
?>
	<!-- ================================================== - - >
	<div class="biletO">
		<div class="biletID">ID: 17apr1712009963
		</div>

		<div class="biletData">17.04.2017
		</div>

		<div class="biletSuma">Suma: 10 RON
		</div>

		<div class="biletCastig">Castig: 12.40 RON
		</div>
		
		<div class="biletCota">Cota: 1.24
		</div>

	</div>-->

</div>