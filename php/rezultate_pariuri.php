<?php
function afiseazaCursa($curse_azi, $cursa, $data_meci, $ore) {
	$index = 0;
	$mesaj = " ";
	while($index != count($ore)) {
		$mesaj .= '<a href="./rezultate.php?data=' . $data_meci . '&ora=' . $ore[$index] . '">' . $ore[$index] . '</a>';
		$index ++;
	}
	echo
		'<div class="results-bar">
			<span>' . ($curse_azi + 1) . '. ' . $cursa . '</span>
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
		</div><br>';
		unset($mesaj);
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
			$i += 1;
		}
	}
	return $ore;
}

function formeazaNumeCurse($conn, $data_meci)
{
	unset($stmt);
	$nume_curse = array();
	$nume = "";
	$stmt =  $conn->stmt_init();
	$sql_query = "SELECT distinct nume FROM curse WHERE date_format(data, '%Y-%m-%d') like ?";
	
	if($stmt->prepare($sql_query)) { // or die(mysql_error());
		$stmt->bind_param('s', $data_meci);
		$stmt->execute();
		$stmt->bind_result($nume);
		$i = 0;
		while($stmt->fetch()) {
			//echo $nume . " ";
			$nume_curse[$i]['nume'] = $nume;
			$i ++;
		}
	}
	return $nume_curse;
}

function afiseazaRezultate($conn, $data_meci)
{
	$ore = array();
	unset($stmt);
	$info_curse = array();
	$info_curse = formeazaNumeCurse($conn, $data_meci); // Am creat un vector cu numele curselor din ziua respectiva
	
	$index = 0;
	while($index != count($info_curse)) {
		$info_curse[$index]['ore'] = array();
		$info_curse[$index]['ore'] = formeazaOreCurse($conn, $data_meci, $info_curse[$index]['nume']); // Pentru fiecare cursa din vector, am creat un vector cu orele la care au curse
		$index ++;
	}

	$number_of_curse = 0;
	while($number_of_curse != count($info_curse[$number_of_curse]['nume'])) {
		$index = 0;
		while($index != count($info_curse)) { // Pentru fiecare cursa
			afiseazaCursa($index, $info_curse[$index]['nume'], $data_meci, $info_curse[$index]['ore']);
				// Aici vor fi afisati concurentii
			$index += 1;
		}
		$number_of_curse ++;
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
