<?php
function afiseazaCurse($curse_azi, $cursa, $data_meci, $ore, $status) {
		$index = 0;
		$mesaj = " ";

		while($status == 0 && $index != count($ore)) { // Cand vede mai multe curse
			if($index > 0){
				if($ore[$index-1] != $ore[$index])
					$mesaj .= '<a href="./rezultate.php?race=' . $cursa . '&date=' . $data_meci . '&ora=' . $ore[$index] . '#res">' . $ore[$index] . '</a>';
			}
			else
				$mesaj .= '<a href="./rezultate.php?race=' . $cursa . '&date=' . $data_meci . '&ora=' . $ore[$index] . '#res">' . $ore[$index] . '</a>';
			$index ++;
		}

		if($status == 2) // Cand vede doar o cursa, afisam doar ora ei.
			$mesaj = '<a href="./rezultate.php#race=' . $cursa . '&date=' . $data_meci . '&ora=' . $ore[$curse_azi] . '#res">' . $ore[$curse_azi] . '</a>';

		echo
			'<div class="bet">
				<span> ' . $cursa . '</span>
				<div class="times">
					' . $mesaj . '
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
			</div>';
	unset($mesaj);
}

function afiseazaCursa($numar, $id, $nume, $ora, $data_cursa) {
	$mesaj = ' ';//<a href="./rezultate.php?race=' . $nume . '&date=' . $data_cursa . '&ora=' . $ora . '">' . $ora . '</a>';
	echo '<br><div class="results-bar">
				<span>' . ($numar + 1) . '. ' . $nume . '</span>
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
			</div>';
}

function formeazaOreCurse($conn, $dataa, $name)
{
	$i = 0;
	$ore = array();
	$index = 0;

	unset($stmt);
	$sql_query = "SELECT substr(ora, 1, 5) FROM curse WHERE nume like ? AND date_format(data, '%Y-%m-%d') like ?";
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
	$time = date('H:i', time() + 3600);
	if($status == 0)
		//$sql_query = "SELECT distinct nume FROM curse WHERE date_format(data, '%Y-%m-%d') like ?"; 
		$sql_query = "SELECT distinct nume FROM curse WHERE id = any(SELECT id_cursa FROM rezultate WHERE substr(ora, 1, 5) < ? AND date_format(data, '%Y-%m-%d') like ?)";
	else
		//$sql_query = "SELECT nume FROM curse WHERE date_format(data, '%Y-%m-%d') like ?";
		$sql_query = "SELECT nume FROM curse WHERE id = any(SELECT id_cursa FROM rezultate WHERE substr(ora, 1, 5) < ? AND date_format(data, '%Y-%m-%d') like ?)";

	if($stmt->prepare($sql_query)) { // or die(mysql_error());
		$stmt->bind_param('ss', $time, $data_meci);
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
	
	// Afisam locatiile si orele la care sunt curse
	$index = 0;
	while($index != count($info_curse)) {
		$info_curse[$index]['ore'] = array();
		$info_curse[$index]['ore'] = formeazaOreCurse($conn, $data_meci, $info_curse[$index]['nume']); // Pentru fiecare cursa din vector, am creat un vector cu orele la care au curse
		$info_curse[$index]['ids'] = array();
		$info_curse[$index]['ids'] = formeazaIDsCurse($conn, $data_meci, $info_curse[$index]['nume']); // Pentru fiecare cursa din vector, am creat un vector cu ID-urile curselor
		$index ++;
	}

	$index = 0;
	$count = 0;
	while($index < count($info_curse)) { // Pentru fiecare nume de cursa
		afiseazaCurse($count, $info_curse[$index]['nume'], $data_meci, $info_curse[$index]['ore'], 0);
		if(isset($_GET['race'])) {
			$index += count($info_curse[$index]['ore']);
			$count ++;
		}
		else{
			$index = $index + 1;
			$count ++;
		}
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
						$concurenti = array();
						$concurenti = formeazaInformatiiConcurent($conn, $info_curse[$index]['ids'][$count]);
						afiseazaConcurent($concurenti);
					}
					$count ++;
				}
			}
			$index += 1;
		}
	}
}


function afiseazaConcurent($participant)
{
	$index = 0;
	while($index != count($participant) - 1) {
		$cal_win_rate = 0;
		if($participant[$index]['cal_meciuri_pierdute'] == 0)
			$cal_win_rate = $participant[$index]['cal_meciuri_castigate'];
		else
			$cal_win_rate =  number_format((float)floatval($participant[$index]['cal_meciuri_castigate'] / $participant[$index]['cal_meciuri_pierdute']), 2, '.', '');;

		$jocheu_win_rate = 0;
		if($participant[$index]['jocheu_meciuri_pierdute'] == 0)
			$jocheu_win_rate = $participant[$index]['jocheu_meciuri_castigate'];
		else
			$jocheu_win_rate = number_format((float)floatval($participant[$index]['jocheu_meciuri_castigate'] / $participant[$index]['jocheu_meciuri_pierdute']), 2, '.', '');

		echo '
			<div class="results-body">
				<div class="results-team">
					<div class="dim50">
						<span>' . $participant[$index]["index"] . '</span>
					</div>
					<div class="dim200">
						<span>' . $participant[$index]["cal_nume"] . '</span>
					</div>
					<div class="dim200">
						<span>' . $participant[$index]["jocheu_nume"] . ' / ' . $participant[$index]["antrenor_nume"] . '</span>
					</div>
					<div class="dim50">
						<span>' . $participant[$index]["cal_varsta"] . '</span>
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
		$index ++;
	}
}

function formeazaInformatiiConcurent($conn, $id) {
	$participanti = array();
	unset($stmt);
	$stmt =  $conn->stmt_init();
	$sql_query = "SELECT id_cai, id_jochei FROM rezultate WHERE id_cursa = ?";
	/* Extrage informatii despre cai si jochei */
	if($stmt->prepare($sql_query)) {
		$stmt->bind_param('s', $id);
		$stmt->execute();
		$stmt->bind_result($lista_cai, $lista_jochei);
		$stmt->fetch();
	}

	$cai = explode(' ', $lista_cai);
	$jochei = explode(' ', $lista_jochei);
	
	$index = 0;
	$i = 0;
	while($index != count($cai)) {
		$participanti['p'] = array();
		$sql_query = "SELECT nume, varsta, meciuri_castigate, meciuri_pierdute, meciuri_abandonate FROM cai WHERE ID = ?";
		unset($stmt);
		if($stmt =  $conn->prepare($sql_query)) {
			$stmt->bind_param('d', $cai[$index]);
			$stmt->execute();
			$stmt->bind_result($cal_nume, $cal_varsta, $cal_meciuri_castigate, $cal_meciuri_pierdute, $cal_meciuri_abandonate);
			$stmt->fetch();
			$participanti[$i]['index'] = $i + 1;
			$participanti[$i]['cal_nume'] = $cal_nume;
			$participanti[$i]['cal_varsta'] = $cal_varsta;
			$participanti[$i]['cal_meciuri_castigate'] = $cal_meciuri_castigate;
			$participanti[$i]['cal_meciuri_pierdute'] = $cal_meciuri_pierdute;
			$participanti[$i]['cal_meciuri_abandonate'] = $cal_meciuri_abandonate;
		}
		unset($stmt);
		$sql_query = "SELECT nume, Antrenor, meciuri_castigate, meciuri_pierdute, meciuri_abandonate FROM jochei WHERE ID = ?";
		if($stmt =  $conn->prepare($sql_query)) {
			$stmt->bind_param('d', $jochei[$index]);
			$stmt->execute();
	 		$stmt->bind_result($jocheu_nume, $antrenor, $meciuri_castigate, $meciuri_pierdute, $meciuri_abandonate);
			$stmt->fetch();
			$participanti[$i]['jocheu_nume'] = $jocheu_nume;
			$participanti[$i]['antrenor_nume'] = $antrenor;
			$participanti[$i]['jocheu_meciuri_pierdute'] = $meciuri_pierdute;
			$participanti[$i]['jocheu_meciuri_castigate'] = $meciuri_castigate;
			$participanti[$i]['jocheu_meciuri_abandonate'] = $meciuri_abandonate;
		}
		$i++;
		$index ++;
	}

	return $participanti;
}
?>
