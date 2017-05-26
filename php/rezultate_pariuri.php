<?php
function afiseazaCursa($curse_azi, $cursa, $data_meci, $ore) {
	$data = getdate();
	$index = 0;
	$mesaj = " ";

	while($index != count($ore)) {
		$mesaj = '<a href="./rezultate2.php?data=' . $data_meci . '&ora=' . $ore[$index] . '">' . $ore[$index] . '</a>';
		$index += 1;
	}
	unset($ore);

	//echo $mesaj;
/*
				<div class="active-time">
					<a href="./rezultate2.php?data=' . $data_meci . '&ora=13:20">13:20</a>
				</div>
				<a href="./rezultate2.php?data=' . $data_meci . '&ora=14:20">14:20</a>
				<a href="./rezultate2.php?data=' . $data_meci . '&ora=15:20">15:20</a>
				<a href="./rezultate2.php?data=' . $data_meci . '&ora=16:20">16:20</a>
				<a href="./rezultate2.php?data=' . $data_meci . '&ora=17:10">17:10</a>
				<a href="./rezultate2.php?data=' . $data_meci . '&ora=18:20">18:20</a>
				<a href="./rezultate2.php?data=' . $data_meci . '&ora=19:20">19:20</a>

*/
	echo
		'<div class="results-bar">
			<span>' . ($curse_azi + 1) . '. ' . $cursa['nume'] . ' #' . $cursa['id'] . '</span>
			<div class="results-times">' . 
				$mesaj . '
			</div>
		</div>
		
		<div class="results-head">
			<div class="dim50">
				<span>#</span>
			</div>
			<div class="dim200">
				<span>Cal</span>
			</div>
			<div class="dim200">
				<span>Jocheu / Antrenor</span>
			</div>
			<div class="dim50">
				<span>Ani</span>
			</div>
			<div class="dim100">
				<span>WR Cal</span>
			</div>
			<div class="dim100">
				<span>WR Jocheu</span>
			</div>
		</div>';
		unset($mesaj);
}

function formeazaOre($conn, $dataa, $name)
{
	unset($stmt);
	$i = 0;
	$ore = array();
	$sql_query = "SELECT ora FROM curse WHERE nume like ?";//" AND date_format(data, '%Y-%m-%d') like ?";
	if($stmt =  $conn->prepare($sql_query)) {
		$stmt->bind_param('s', $name);//, $dataa);
		$stmt->execute();
		$stmt->bind_result($oora);
		while($stmt->fetch()) {
			$ore[$i] = $oora;
			$i += 1;
		}
	}
	return $ore;
}

function afiseazaRezultate($conn, $data_meci)
{
	$ore = array();
	$curse = array();
	$oraa = 0;
	$curse_azi = 0;
	$participanti = 0;

	if(isset($_GET['ora'])) {
		$sql_query = "SELECT id, nume, id_cai, id_jochei, ora FROM curse WHERE date_format(data, '%Y-%m-%d') like ? AND ora like ?";
		$oraa = 1;
	}
	else {
		$sql_query = "SELECT distinct nume, id, id_cai, id_jochei, ora FROM curse WHERE date_format(data, '%Y-%m-%d') like ?";
	}
	unset($stmt);
	
	if($stmt =  $conn->prepare($sql_query)) {
		if($oraa == 0) {
			$stmt->bind_param('s', $data_meci);
		}
		else {
			$stmt->bind_param('ss', $data_meci, $_GET['ora']);
		}
		$stmt->execute();
		$stmt->bind_result($nume, $id, $id_cai, $id_jochei, $ora);
		$i = 0;
		while($stmt->fetch()) {
			$curse[$i] = array();
			$curse[$i]['id'] = $id;
			$curse[$i]['nume'] = $nume;
			$curse[$i]['id_cai'] = $id_cai;
			$curse[$i]['id_jochei'] = $id_jochei;
			$curse[$i]['ora'] = $ora;
			$i += 1;
		}
		$index = 0;
		while($index != count($curse)) { // Pentru fiecare cursa
			//echo $curse[$index]['ora'] . " " . $curse[$index]['nume'];
			$ore = formeazaOre($conn, $curse[$index]['ora'], $curse[$index]['nume']);
			afiseazaCursa($index, $curse[$index], $data_meci, $ore);
			$index2 = 0;
			while($index2 != count($curse[$index])) { // Pentru fiecare pozitie din cursa
				$cai = explode(" ", $curse[$index]['id_cai']);
				$jochei = explode(" ", $curse[$index]['id_jochei']);
				unset($stmt);
				$sql_query = "SELECT nume, varsta, meciuri_castigate, meciuri_pierdute, meciuri_abandonate FROM cai WHERE ID = ?";
				if($stmt =  $conn->prepare($sql_query)) {
					$stmt->bind_param('d', $cai[$index2]);
					$stmt->execute();
					$stmt->bind_result($cal_nume, $cal_varsta, $cal_meciuri_castigate, $cal_meciuri_pierdute, $cal_meciuri_abandonate);
					$stmt->fetch();
					$participanti = array();
					$participanti['index'] = $index2 + 1;
					$participanti['cal_nume'] = $cal_nume;
					$participanti['cal_varsta'] = $cal_varsta;
					$participanti['cal_meciuri_pierdute'] = $cal_meciuri_pierdute;
					$participanti['cal_meciuri_castigate'] = $cal_meciuri_castigate;
					$participanti['cal_meciuri_abandonate'] = $cal_meciuri_abandonate;
				}
				unset($stmt);
				$sql_query = "SELECT nume, Antrenor, meciuri_castigate, meciuri_pierdute, meciuri_abandonate FROM jochei WHERE ID = ?";
				if($stmt =  $conn->prepare($sql_query)) {
					$stmt->bind_param('d', $jochei[$index2]);
					$stmt->execute();
					$stmt->bind_result($jocheu_nume, $antrenor, $meciuri_castigate, $meciuri_pierdute, $meciuri_abandonate);
					$stmt->fetch();
					$participanti['jocheu_nume'] = $jocheu_nume;
					$participanti['antrenor_nume'] = $antrenor;
					$participanti['jocheu_meciuri_pierdute'] = $cal_meciuri_pierdute;
					$participanti['jocheu_meciuri_castigate'] = $cal_meciuri_castigate;
					$participanti['jocheu_meciuri_abandonate'] = $cal_meciuri_abandonate;
					afiseazaConcurent($participanti);
					empty($participanti);
				}
				$index2 += 1;
			}
			$index += 1;
		}
	}
}


function afiseazaConcurent($participanti)
{
	$cal_win_rate = 0;
	if($participanti['cal_meciuri_pierdute'] == 0)
		$cal_win_rate = $participanti['cal_meciuri_castigate'];
	else
		$cal_win_rate = $participanti['cal_meciuri_castigate'] / $participanti['cal_meciuri_pierdute'];

	$jocheu_win_rate = 0;
	if($participanti['cal_meciuri_pierdute'] == 0)
		$jocheu_win_rate = $participanti['jocheu_meciuri_castigate'];
	else
		$jocheu_win_rate = $participanti['jocheu_meciuri_castigate'] / $participanti['jocheu_meciuri_pierdute'];


	echo '
		<div class="results-body">
			<div class="results-team">
				<div class="dim50">
					<span>' . $participanti["index"] . '</span>
				</div>
				<div class="dim200">
					<span>' . $participanti["cal_nume"] . '</span>
				</div>
				<div class="dim200">
					<span>' . $participanti["jocheu_nume"] . ' / ' . $participanti["antrenor_nume"] . '</span>
				</div>
				<div class="dim50">
					<span>' . $participanti["cal_varsta"] . '</span>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>' . $cal_win_rate . ' </span>
					</div>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>' . $jocheu_win_rate . '</span>
					</div>
				</div>
			</div>
		</div>';
}
?>
