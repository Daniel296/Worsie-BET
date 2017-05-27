<!--<!DOCTYPE html>-->

<div id="bilete">
	<?php

	/* Paginare */
		if(isset($_GET['p']))
			$page = $_GET['p'];
		else $page = 1;

		$limit = 10;
		$pages = ceil($usr_bilete_total / $limit);
		if($page > $pages) $page = 1;
		$offset = ($page - 1) * $limit;

		$start = $offset + 1;
		$end = min(($offset + $limit), $usr_bilete_total);

		//echo $page . " / " . $pages;
		echo '<div align="center" class="links">';
			if($pages < 6) {
				echo '<a href="?page=bilete&p=1"> 1 </a>';
				for($i = 2; $i <= $pages; $i++)
					echo '&#9900 <a href="?page=bilete&p=' . ($i) . '"> ' . ($i) . ' </a>';
			}
			else {
				if($page < 6) {
					echo '<a href="?page=bilete&p=1"> 1 </a>';
					for($i = 2; $i <= 6; $i++)
						echo '&#9900 <a href="?page=bilete&p=' . ($i) . '"> ' . ($i) . ' </a>';
					echo '... &#9900 <a href="?page=bilete&p=' . $pages . '"> ' . $pages . ' </a>';
				}
				else if($page > 5 && $page < $pages - 3) {
					echo '<a href="?page=bilete&p=1"> 1 </a>&#9900 ... ';
					for($i = -2; $i < 3; $i ++)
						if($pages != $page + $i)
							echo '&#9900' . '<a href="?page=bilete&p=' . ($page+$i) . '"> ' . ($page+$i) . ' </a>';
					echo '... &#9900 <a href="?page=bilete&p=' . $pages . '"> ' . $pages . ' </a>';
				} else if ($page >= $pages - 3) {
					echo '<a href="?page=bilete&p=1"> 1 </a> &#9900 ... ';
					for($i = $pages-3; $i <= $pages+1; $i ++)
						echo '&#9900 <a href="?page=bilete&p=' . ($i-1) . '"> ' . ($i-1) . ' </a>';
				} else {
					echo '<a href="?page=bilete&p=1"> 1 </a>&#9900 ... ';
					for($i = $page; $i < $pages; $i ++)
							echo '&#9900' . '<a href="?page=bilete&p=' . ($i) . '"> ' . ($i) . ' </a>';
				}
			}

		echo '</div>';
		unset($stmt);
		$sql_query = "SELECT id, status, suma_depusa, suma_castig, cod, pariuri, cota, data_creare FROM bilete WHERE id_user = ? ORDER BY data_creare DESC LIMIT ? OFFSET ?";
		if($stmt =  $conn->prepare($sql_query)) {
			$stmt->bind_param('iii', $_SESSION['id'], $limit, $offset);
			$stmt->execute();
			$stmt->bind_result($id, $status, $suma_depusa, $suma_castig, $cod, $pariuri, $cota, $data_creare);
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

							<div class="detalii_bilet">
								<button type="button" onclick="ticket_details(' . $id . ')"> Detalii </button>
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

							<div class="detalii_bilet">
								<button type="button" onclick="ticket_details(' . $id . ')"> Detalii </button>
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

							<div class="detalii_bilet">
								<button type="button" onclick="ticket_details(' . $id . ')"> Detalii </button>
							</div>
						</div>
					';
				}
			}
		}
		echo '<div align="center" class="links">';
			if($pages < 6) {
				echo '<a href="?page=bilete&p=1"> 1 </a>';
				for($i = 2; $i <= $pages; $i++)
					echo '&#9900 <a href="?page=bilete&p=' . ($i) . '"> ' . ($i) . ' </a>';
			}
			else {
				if($page < 6) {
					echo '<a href="?page=bilete&p=1"> 1 </a>';
					for($i = 2; $i <= 6; $i++)
						echo '&#9900 <a href="?page=bilete&p=' . ($i) . '"> ' . ($i) . ' </a>';
					echo '... &#9900 <a href="?page=bilete&p=' . $pages . '"> ' . $pages . ' </a>';
				}
				else if($page > 5 && $page < $pages - 3) {
					echo '<a href="?page=bilete&p=1"> 1 </a>&#9900 ... ';
					for($i = -2; $i < 3; $i ++)
						if($pages != $page + $i)
							echo '&#9900' . '<a href="?page=bilete&p=' . ($page+$i) . '"> ' . ($page+$i) . ' </a>';
					echo '... &#9900 <a href="?page=bilete&p=' . $pages . '"> ' . $pages . ' </a>';
				} else if ($page >= $pages - 3) {
					echo '<a href="?page=bilete&p=1"> 1 </a> &#9900 ... ';
					for($i = $pages-3; $i <= $pages+1; $i ++)
						echo '&#9900 <a href="?page=bilete&p=' . ($i-1) . '"> ' . ($i-1) . ' </a>';
				} else {
					echo '<a href="?page=bilete&p=1"> 1 </a>&#9900 ... ';
					for($i = $page; $i < $pages; $i ++)
							echo '&#9900' . '<a href="?page=bilete&p=' . ($i) . '"> ' . ($i) . ' </a>';
				}
			}

		echo '</div>';
?>
</div>
<div id="id03" class="modal">
	<div id="ticket_details" class="modal-content animate">
		<div id="ticket_details">
			<!--JAVSCRIPT -->
		</div>
	</div>
</div>


<script src="js/ticket-details.js"></script>
<script>
// Get the modal
var modal = document.getElementById('id03');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
