<?php
function afiseazaCurse($curse_azi, $cursa, $data_meci, $ore, $status) {
		$index = 0;
		$mesaj = " ";
		while($status == 0 && $index != count($ore)) { // Cand vde mai multe curse
			$mesaj .= '<a href="./rezultate.php?race=' . $cursa . '&date=' . $data_meci . '&ora=' . $ore[$index] . '">' . $ore[$index] . '</a>';
			$index ++;
		}

		if($status == 2) // Cand vede doar o cursa, afisam doar ora ei.
			$mesaj = '<a href="./rezultate.php?race=' . $cursa . '&date=' . $data_meci . '&ora=' . $ore[$curse_azi] . '">' . $ore[$curse_azi] . '</a>';
		
		echo
			'<div class="results-bar">
				<span>' . ($curse_azi + 1) . '. ' . $cursa . '</span>
				<div class="results-times">' . 
					$mesaj . '
				</div>
			</div>';
		if($status > 0)
			echo
			'<div class="results-head">
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
			</div><br>';
	unset($mesaj);
}

function afiseazaCursa($numar, $id, $nume, $ora, $data_cursa) {
	$mesaj = '<a href="./rezultate.php?race=' . $nume . '&date=' . $data_cursa . '&ora=' . $ora . '">' . $ora . '</a>';
	echo '<div class="results-bar">
				<span>' . ($numar + 1) . '. ' . $nume . ' #' . $id . '</span>
				<div class="results-times">' . 
					$mesaj . '
				</div>
			</div>';
	echo
			'<div class="results-head">
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
			</div><br>';
}

function formeazaOreCurse($conn, $dataa, $name)
{
	$i = 0;
	$ore = array();
	$index = 0;

	unset($stmt);
	$sql_query = "SELECT ora FROM curse WHERE nume like ? AND date_format(data, '%Y-%m-%d') like ?";
	if($stmt =  $conn->prepare($sql_query)) {
		$stmt->bind_param('ss', $name, $dataa);
		$stmt->execute();
		$stmt->bind_result($ora);
		while($stmt->fetch()) {
			$ore[$i] = $ora;
			$i ++;
		}
	}
	return $ore;
}


function formeazaIDsCurse($conn, $dataa, $name)
{
	$i = 0;
	$ids = array();
	$index = 0;

	unset($stmt);
	$sql_query = "SELECT id FROM curse WHERE nume like ? AND date_format(data, '%Y-%m-%d') like ?";
	if($stmt =  $conn->prepare($sql_query)) {
		$stmt->bind_param('ss', $name, $dataa);
		$stmt->execute();
		$stmt->bind_result($id);
		while($stmt->fetch()) {
			$ids[$i] = $id;
			$i ++;
		}
	}
	return $ids;
}

function formeazaNumeCurse($conn, $data_meci, $status)
{
	unset($stmt);
	$nume_curse = array();
	$nume = "";
	$stmt =  $conn->stmt_init();
	if($status == 0)
		$sql_query = "SELECT distinct nume FROM curse WHERE date_format(data, '%Y-%m-%d') like ?";
	else
		$sql_query = "SELECT nume FROM curse WHERE date_format(data, '%Y-%m-%d') like ?";
	if($stmt->prepare($sql_query)) { // or die(mysql_error());
		$stmt->bind_param('s', $data_meci);
		$stmt->execute();
		$stmt->bind_result($nume);
		$i = 0;
		while($stmt->fetch()) {
			$nume_curse[$i]['nume'] = $nume;
			$i ++;
		}
	}
	return $nume_curse;
}

function afiseazaRezultate($conn, $data_meci)
{
	$status = 0;
	if(isset($_GET['ora']))
		$status = 1;
	else $status = 0;

	unset($stmt);
	$info_curse = array();
	$info_curse = formeazaNumeCurse($conn, $data_meci, $status); // Am creat un vector cu numele curselor din ziua respectiva
	
	$index = 0;
	while($index != count($info_curse)) {
		$info_curse[$index]['ore'] = array();
		$info_curse[$index]['ore'] = formeazaOreCurse($conn, $data_meci, $info_curse[$index]['nume']); // Pentru fiecare cursa din vector, am creat un vector cu orele la care au curse
		$info_curse[$index]['ids'] = array();
		$info_curse[$index]['ids'] = formeazaIDsCurse($conn, $data_meci, $info_curse[$index]['nume']); // Pentru fiecare cursa din vector, am creat un vector cu ID-urile curselor
		$index ++;
	}

	// Daca se da click pe ora unei curse, vor aparea doar cursele cu numele respectiv, de la ora respectiva.
	if(isset($_GET['race'])) {
		$index = 0;
		$count = 0;

		while($index < count($info_curse)) { // Pentru fiecare nume de cursa
			if($info_curse[$index]['nume'] == $_GET['race']) {
				
				if(isset($_GET['ora'])) {
					if($info_curse[$index]['ore'][$count] == $_GET['ora']) {
						afiseazaCursa($count, $info_curse[$index]['ids'][$count], $_GET['race'], $_GET['ora'], $_GET['date']);	
					}
					$count ++;
				}
			}
			$index += 1;
		}
	} else {
		$index = 0;
		while($index != count($info_curse)) { // Pentru fiecare nume de cursa
			afiseazaCurse($index, $info_curse[$index]['nume'], $data_meci, $info_curse[$index]['ore'], $status);
			echo "<br>";
			$index += 1;
		}
	}
}


function afiseazaConcurent($participant)
{
	$cal_win_rate = 0;
	if($participant['cal_meciuri_pierdute'] == 0)
		$cal_win_rate = $participant['cal_meciuri_castigate'];
	else
		$cal_win_rate = $participant['cal_meciuri_castigate'] / $participant['cal_meciuri_pierdute'];

	$jocheu_win_rate = 0;
	if($participant['cal_meciuri_pierdute'] == 0)
		$jocheu_win_rate = $participant['jocheu_meciuri_castigate'];
	else
		$jocheu_win_rate = $participant['jocheu_meciuri_castigate'] / $participant['jocheu_meciuri_pierdute'];


	echo '
		<div class="results-body">
			<div class="results-team">
				<div class="dim50">
					<span>' . $participant["index"] . '</span>
				</div>
				<div class="dim200">
					<span>' . $participant["cal_nume"] . '</span>
				</div>
				<div class="dim200">
					<span>' . $participant["jocheu_nume"] . ' / ' . $participant["antrenor_nume"] . '</span>
				</div>
				<div class="dim50">
					<span>' . $participant["cal_varsta"] . '</span>
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
