<!--<!DOCTYPE html>-->
<?php
	if(isset($_GET['p'])) {
	} else {
		$location = "Location: ./profile.php?page=bilete&p=1";
		header($location);
	}
?>

<div id="bilete">

	<?php

	if($usr_bilete_total > 0) {
		/* Paginare */
		if(isset($_GET['p']))
			$page = $_GET['p'];
		else $page = 1;

		$limit = 10;

		$pages = ceil($usr_bilete_total / $limit);

		if($page > $pages)
			$page = $pages;

		//echo $pages . " " . $page;

		$offset = ($page - 1) * $limit;

		$start = $offset + 1;
		$end = min(($offset + $limit), $usr_bilete_total);


		echo '<div align="center" class="links">';
			if($pages == 1)
				echo '<a id="paging_link_top_1" href="?page=bilete&p=1"> 1 </a>';
			else if($pages < 6) {
				echo '<a id="paging_link_top_1" href="?page=bilete&p=1"> 1 </a>';
				for($i = 2; $i <= $pages; $i++)
					echo '&#9900 <a id="paging_link_top_' . $i . '" href="?page=bilete&p=' . ($i) . '"> ' . ($i) . ' </a>';
			}
			else {
				if($page < 5) {
					echo '<a id="paging_link_top_1" href="?page=bilete&p=1"> 1 </a>';
					for($i = 2; $i < 6; $i++)
						echo '&#9900 <a id="paging_link_top_' . $i . '" href="?page=bilete&p=' . ($i) . '"> ' . ($i) . ' </a>';
					echo '&#9900 ... &#9900 <a id="paging_link_top_' . $pages . '" href="?page=bilete&p=' . $pages . '"> ' . $pages . ' </a>';
				}
				else if($page > 5 && $page < $pages - 3) {
					echo '<a id="paging_link_top_1" href="?page=bilete&p=1"> 1 </a>&#9900 ... ';
					for($i = -2; $i < 3; $i ++)
						if($pages != $page + $i)
							echo '&#9900' . '<a id="paging_link_top_' . ($page+$i) . '" href="?page=bilete&p=' . ($page+$i) . '"> ' . ($page+$i) . ' </a>';
					echo '... &#9900 <a id="paging_link_top_' . $pages . '" href="?page=bilete&p=' . $pages . '"> ' . $pages . ' </a>';
				} else if ($page >= $pages - 3) {
					echo '<a id="paging_link_top_1" href="?page=bilete&p=1"> 1 </a> &#9900 ... ';
					for($i = $pages-3; $i <= $pages+1; $i ++)
						echo '&#9900 <a id="paging_link_top_' . ($i-1) . '" href="?page=bilete&p=' . ($i-1) . '"> ' . ($i-1) . ' </a>';
				} else {
					echo '<a id="paging_link_top_' . $i . '" href="?page=bilete&p=1"> 1 </a>&#9900 ... ';
					for($i = $page-1; $i < $pages; $i ++)
							echo '&#9900' . '<a id="paging_link_top_' . $i . '" href="?page=bilete&p=' . ($i) . '"> ' . ($i) . ' </a>';
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

							<div class="biletSuma">Sumă: ' . $suma_depusa . ' RON
							</div>

							<div class="biletCastig">Câ&#351tig: 0 RON
							</div>

							<div class="biletCota">Cotă: ' . $cota . '
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

							<div class="biletSuma">Sumă: ' . $suma_depusa . ' RON
							</div>

							<div class="biletCastig">Câ&#351tig poten&#355ial: ' . $suma_castig . ' RON
							</div>

							<div class="biletCota">Cotă: ' . $cota . '
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

							<div class="biletSuma">Sumă: ' . $suma_depusa . ' RON
							</div>

							<div class="biletCastig">Câ&#351tig: ' . $suma_castig . ' RON
							</div>

							<div class="biletCota">Cotă: ' . $cota . '
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
			if($pages == 1)
				echo '<a id="paging_link_bot_1" href="?page=bilete&p=1"> 1 </a>';
			else if($pages < 6) {
				echo '<a id="paging_link_bot_1" href="?page=bilete&p=1"> 1 </a>';
				for($i = 2; $i <= $pages; $i++)
					echo '&#9900 <a id="paging_link_bot_' . $i . '" href="?page=bilete&p=' . ($i) . '"> ' . ($i) . ' </a>';
			}
			else {
				if($page < 5) {
					echo '<a id="paging_link_bot_1" href="?page=bilete&p=1"> 1 </a>';
					for($i = 2; $i < 6; $i++)
						echo '&#9900 <a id="paging_link_bot_' . $i . '" href="?page=bilete&p=' . ($i) . '"> ' . ($i) . ' </a>';
					echo '&#9900 ... &#9900 <a id="paging_link_bot_' . $pages . '" href="?page=bilete&p=' . $pages . '"> ' . $pages . ' </a>';
				}
				else if($page > 5 && $page < $pages - 3) {
					echo '<a id="paging_link_bot_1" href="?page=bilete&p=1"> 1 </a>&#9900 ... ';
					for($i = -2; $i < 3; $i ++)
						if($pages != $page + $i)
							echo '&#9900' . '<a id="paging_link_bot_' . ($page+$i) . '" href="?page=bilete&p=' . ($page+$i) . '"> ' . ($page+$i) . ' </a>';
					echo '... &#9900 <a id="paging_link_bot_' . $pages . '" href="?page=bilete&p=' . $pages . '"> ' . $pages . ' </a>';
				} else if ($page >= $pages - 3) {
					echo '<a id="paging_link_bot_1" href="?page=bilete&p=1"> 1 </a> &#9900 ... ';
					for($i = $pages-3; $i <= $pages+1; $i ++)
						echo '&#9900 <a id="paging_link_bot_' . ($i-1) . '" href="?page=bilete&p=' . ($i-1) . '"> ' . ($i-1) . ' </a>';
				} else {
					echo '<a id="paging_link_bot_' . $i . '" href="?page=bilete&p=1"> 1 </a>&#9900 ... ';
					for($i = $page-1; $i < $pages; $i ++)
							echo '&#9900' . '<a id="paging_link_bot_' . $i . '" href="?page=bilete&p=' . ($i) . '"> ' . ($i) . ' </a>';
				}
			}

		echo '</div>';
	} else {
		?>
		<div class="zero_bilete">
			<p>Nu a&#355i plasat niciun bilet</p>
		</div> <?php
	}

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
