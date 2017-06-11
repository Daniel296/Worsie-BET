<?php
	//	getNumeCurse($conn, $data)							-> array_unique cu numele curselor
	//	getIDs_AND_OreCurse($conn, $data)					-> array cu ID'ul si ora curselor
	//	getNumeCursa($conn, $id)							-> numele cursei cu ID'ul $id
	//	getOraCursa($conn, $id)								-> ora cursei cu ID'ul $id
	//	getOreCursa_byName($conn, $data, $name, $status)	-> returneaza orele unei curse, dupa nume
	//	getIDCurse_NumeOre($conn, $data, $ora, $nume)		-> returneaza vector cu id'urile curselor de la data, ora si cu numele...
	//	getIDCurse_Nume($conn, $data, $nume)				-> returneaza vector cu id'urile curselor cu numele $nume, de la data $data
	//	printOreCursa_byName($conn, $data, $name, $status)	-> afiseaza orele unei curse, dupa nume
	//	printHeaderCursa($nume, $ora, $data)				-> afiseaza bara cu numele cursei si orele
	//	printCurse($nume, $data_meci, $ore)					-> afiseaza toate cursele si orele UNICE din ziua respectiva
	//	getInformatiiCursa($conn, $id)						-> returneaza un vector cu informatii despre concurentii cursei $id
	//	afiseazaConcurent($participant)						-> Afiseaza informatiile concurentului $participant


function afiseazaRezultate($conn, $data) {
	$curse = array();
	$curse = getNumeCurse($conn, $data);

	for($i = 0; $i < count($curse); $i++) {
		printCurse($curse[$i], $data, getOreCursa_byName($conn, $data, $curse[$i], 1));
	}
	

	if(isset($_GET['race']) && isset($_GET['ora'])) {
	 	$var = array();
	 	$var = getIDCurse_NumeOra($conn, $data, $_GET['ora'], $_GET['race']);

	 	if(count($var) > 0 && $var[0] != -1) {
	 		for($i = 0; $i < count($var); $i++) {
	 			echo "<br>";
	 			printHeaderCursa($_GET['race'], $_GET['ora'], $data);
		 		$participant = array();
		 		$participant = getInformatiiCursa($conn, $var[$i]);
		 		afiseazaConcurent($participant);
		 	}
	 	}
	}

	if(isset($_GET['race']) && !isset($_GET['ora'])) {
		$var = array();
	 	$var = getIDCurse_Nume($conn, $data, $_GET['race']);

	 	if(count($var) > 0 && $var[0] != -1) {
	 		for($i = 0; $i < count($var); $i++) {
	 			echo "<br>";
	 			printHeaderCursa(getNumeCursa($conn, $var[$i]), getOraCursa($conn, $var[$i]), $data);
		 		$participant = array();
		 		$participant = getInformatiiCursa($conn, $var[$i]);
		 		afiseazaConcurent($participant);
		 	}
	 	}
	}
}


// Afiseaza header'ul cursei
function printHeaderCursa($nume, $ora, $data) {
	echo
			'<div class="bet">
				<span> ' . $nume . '</span>
				<div class="times">
					' . $ora . '
				</div>
			</div>'
		;

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
					<span>Victorii</span>
				</div>
				<div class="dim100">
					<span>WR Cal</span>
				</div>
			</div>'
		;
	
}

// Afiseaza cursele
function printCurse($nume, $data_meci, $ore) {
	$index = 0;
	$mesaj = "";

	while($index != count($ore)) { // Cand vede mai multe curse
		$mesaj .= '<a href="./rezultate.php?race=' . $nume . '&date=' . $data_meci . '&ora=' . $ore[$index] . '#res">' . $ore[$index] . '</a>';
		$index ++;
	}

	echo
			'<div class="bet">
				<span> ' . $nume . '</span>
				<div class="times">
					' . $mesaj . '
				</div>
			</div>';
	unset($mesaj);
}

// Returneaza array_unique cu numele curselor
function getNumeCurse($conn, $data) {
	$nume_curse = array();
	$curse = getIDs_AND_OreCurse($conn, $data);
	for($i = 0; $i < count($curse); $i++) {
		$nume_curse[$i] = getNumeCursa($conn, $curse[$i]['id_cursa']);
	}

	$unique_nume_curse = array_unique($nume_curse); // pozitiile duplicate sunt goale
	$nume_curse_fixed = array(); 
	$j = 0;

	for($i = 0; $i < count($curse); $i++) {
		if(isset($unique_nume_curse[$i])) { // evitam pozitiile goale
			$nume_curse_fixed[$j] = $unique_nume_curse[$i];
			$j++;
		}
	}

	return $nume_curse_fixed;
}


// Returneaza Orele unei curse, si le returneaza
function getOreCursa_byName($conn, $data, $name, $status) {
	$ore = array();
	$time = date('H:i', time() + 3600); // ora si minutul curent
	if($status == 1) // ore distincte
		$sql_query = "SELECT distinct r.ora FROM rezultate r, curse c WHERE r.ora < ? AND date_format(r.data, '%Y-%m-%d') like ? AND c.nume like ? AND r.id_cursa=c.id";
	else
		$sql_query = "SELECT r.ora FROM rezultate r, curse c WHERE r.ora < ? AND date_format(r.data, '%Y-%m-%d') like ? AND c.nume like ? AND r.id_cursa=c.id";
	$i = 0;
	if($stmt = $conn->prepare($sql_query)) {
		$stmt->bind_param('sss', $time, $data, $name);
		$stmt->execute();
		$stmt->bind_result($ora);
		while($stmt->fetch()) {
			$ore[$i] = $ora;
			$i ++;
		}
	}
	return $ore;
}

// Afiseaza orele unei curse
function printOreCursa_byName($conn, $data, $name, $status) {
	$ore = array();
	$ore = getOreCursa_byName($conn, $data, $name, $status);
	
	for($i = 0; $i < count($ore); $i++)
		echo $ore[$i] . " ";
}

// Returneaza un vector cu id_cursa din `rezultate`
function getIDs_AND_OreCurse($conn, $data) {
	$ids = array();
	$i = 0;
	unset($stmt);
	$time = date('H:i', time() + 3600); // ora si minutul curent
	$sql_query = "SELECT id_cursa, substr(ora, 1, 5) FROM rezultate WHERE date_format(data, '%Y-%m-%d') like ? AND ora < ?";
	if($stmt = $conn->prepare($sql_query)) {
		$stmt->bind_param('ss', $data, $time);
		$stmt->execute();
		$stmt->bind_result($id_cursa, $ora);
		while($stmt->fetch()) {
			$ids[$i]['id_cursa'] = $id_cursa;
			$ids[$i]['ora'] = $ora;
			$i ++;
		}
	}
	return $ids;
}

// Returneaza numele unei curse
function getNumeCursa($conn, $id) {
	unset($stmt);
	
	$sql_query = "SELECT nume FROM curse WHERE id = ?";
	if($stmt = $conn->prepare($sql_query)) {
		$stmt->bind_param('s', $id);
		$stmt->execute();
		$stmt->bind_result($name);
		$stmt->fetch();
	}
	return $name;
}

// Returneaza ora unei curse
function getOraCursa($conn, $id) {
	unset($stmt);
	
	$sql_query = "SELECT substr(ora, 1, 5) FROM curse WHERE id = ?";
	if($stmt = $conn->prepare($sql_query)) {
		$stmt->bind_param('s', $id);
		$stmt->execute();
		$stmt->bind_result($ora);
		$stmt->fetch();
	}

	return $ora;
}

// Returneaza un vector cu ID'urile curselor in functie de data, ora, nume
function getIDCurse_NumeOra($conn, $data, $ora, $nume) {

	unset($stmt);
	$ids = array();
	$ids[0] = -1;
	
	$time = date('H:i', time() + 3600); // ora si minutul curent
	$sql_query = "SELECT count(*) FROM curse WHERE date_format(data, '%Y-%m-%d') like ? AND substr(ora, 1, 5) like ? AND nume like ? order by data, nume, ora";
	if($stmt = $conn->prepare($sql_query)) {
		$stmt->bind_param('sss', $data, $ora, $nume);
		$stmt->execute();
		$stmt->bind_result($res);
		$stmt->fetch();
	}

	if($res == 0) {
		return $ids;
	}
	else {
		$id = -2; $i = 0;
		unset($stmt);
		$time = date('H:i', time() + 3600); // ora si minutul curent
		$sql_query = "SELECT id FROM curse WHERE date_format(data, '%Y-%m-%d') like ? AND substr(ora, 1, 5) like ? AND nume like ? order by data, nume, ora";
		if($stmt = $conn->prepare($sql_query)) {
			$stmt->bind_param('sss', $data, $ora, $nume);
			$stmt->execute();
			$stmt->bind_result($id);
			while($stmt->fetch()) {
				$ids[$i] = $id;
				$i++;
			}
		}
		return $ids;
	}

	return $ids;
}

// Returneaza un vector cu ID'urile curselor, in functie de data, nume
function getIDCurse_Nume($conn, $data, $nume) {
	unset($stmt);
	$ids = array();
	$ids[0] = -1;
	$name = '%' . strtolower($nume) . '%';
	$time = date('H:i', time() + 3600);
	$sql_query = "SELECT count(*) FROM curse WHERE date_format(data, '%Y-%m-%d') like ? AND lower(nume) like ? AND ora < ? order by nume, ora";
	if($stmt = $conn->prepare($sql_query)) {
		$stmt->bind_param('sss', $data, $name, $time);
		$stmt->execute();
		$stmt->bind_result($res);
		$stmt->fetch();
	}

	if($res == 0) {
		return $ids;
	}
	else {
		$id = -2; $i = 0;
		unset($stmt);
		$sql_query = "SELECT id FROM curse WHERE date_format(data, '%Y-%m-%d') like ? AND lower(nume) like ? AND ora < ? order by nume, ora";
		if($stmt = $conn->prepare($sql_query)) {
			$stmt->bind_param('sss', $data, $name, $time);
			$stmt->execute();
			$stmt->bind_result($id);
			while($stmt->fetch()) {
				$ids[$i] = $id;
				$i++;
			}
		}
		return $ids;
	}

	return $ids;
}

/* Afiseaza detaliile despre concurentul $participant */
function afiseazaConcurent($participant) {
	$index = 0;
	while($index != count($participant) - 1) {
		$cal_win_rate = 0;
		if($participant[$index]['cal_meciuri_pierdute'] == 0)
			$cal_win_rate = $participant[$index]['cal_meciuri_castigate'];
		else
			$cal_win_rate =  number_format((float)floatval($participant[$index]['cal_meciuri_castigate'] / $participant[$index]['cal_meciuri_pierdute']), 2, '.', '');;

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
						<span>' . $participant[$index]["cal_meciuri_castigate"] . '</span>
					</div>
					<div class="dim100">
						<div class="win-chance">
							<span>' . $cal_win_rate . '</span>
						</div>
					</div>
				</div>
			</div>';
		$index ++;
	}
}

// returneaza detalii despre participantul cu id'ul $id
function getInformatiiCursa($conn, $id) {
	$participanti = array();

	unset($stmt);
	$stmt =  $conn->stmt_init();
	$sql_query = "SELECT id_cai, id_jochei FROM rezultate WHERE id_cursa = ?";
	/* Extrage informatii despre cai si jochei */
	if($stmt->prepare($sql_query)) {
		$stmt->bind_param('d', $id);
		$stmt->execute();
		$stmt->bind_result($lista_cai, $lista_jochei);
		$stmt->fetch();
	}

	$cai = explode(' ', $lista_cai); // vector cu id'ul cailor
	$jochei = explode(' ', $lista_jochei); // vector cu id'ul jocheilor
	
	$index = 0;
	$i = 0;
	while($index != count($cai)) {
		$participanti[$i] = array();
		$sql_query = "SELECT nume, varsta, meciuri_castigate, meciuri_pierdute FROM cai WHERE ID = ?";
		unset($stmt);
		if($stmt =  $conn->prepare($sql_query)) {
			$stmt->bind_param('d', $cai[$index]);
			$stmt->execute();
			$stmt->bind_result($cal_nume, $cal_varsta, $cal_meciuri_castigate, $cal_meciuri_pierdute);
			$stmt->fetch();
			$participanti[$i]['index'] = $i + 1;
			$participanti[$i]['cal_nume'] = $cal_nume;
			$participanti[$i]['cal_varsta'] = $cal_varsta;
			$participanti[$i]['cal_meciuri_castigate'] = $cal_meciuri_castigate;
			$participanti[$i]['cal_meciuri_pierdute'] = $cal_meciuri_pierdute;
		}
		unset($stmt);
		$sql_query = "SELECT nume, Antrenor FROM jochei WHERE ID = ?";
		if($stmt =  $conn->prepare($sql_query)) {
			$stmt->bind_param('d', $jochei[$index]);
			$stmt->execute();
	 		$stmt->bind_result($jocheu_nume, $antrenor);
			$stmt->fetch();
			$participanti[$i]['jocheu_nume'] = $jocheu_nume;
			$participanti[$i]['antrenor_nume'] = $antrenor;
		}
		$i++;
		$index ++;
	}
	
	return $participanti;
}

?>
