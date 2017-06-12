<?php 

//@date_default_timezone_set("GMT"); 

$writer = new XMLWriter(); 
// Output directly to the user 

$writer->openURI('php/rss.xml'); 
$writer->startDocument('1.0'); 

$writer->setIndent(4); 

$writer->startElement('rss'); 
$writer->writeAttribute('version', '2.0'); 
$writer->writeAttribute('xmlns:atom', 'http://www.w3.org/2005/Atom'); 


$writer->startElement("channel"); 
//---------------------------------------------------- 
//$writer->writeElement('ttl', '0'); 
$writer->writeElement('title', 'FAVORIȚII ZILEI'); 
$writer->writeElement('description', 'Descoperă care sunt favoriții curselor de astăzi!'); 
$writer->writeElement('link', 'C:\xampp\htdocs\Worsie-BET\php\rss.xml'); 
$writer->writeElement('pubDate', date("D, d M Y H:i:s e")); 
//---------------------------------------------------- 


//Selectam numele cursei si id-urile cailor + id-urile jocheilor pentru a afisa cel mai bun in FEED
$today = date('Y-m-d');
$stmt =  $conn->stmt_init();
$sql_query = "SELECT nume, id_cai, id_jochei FROM curse WHERE data=?";
if($stmt =  $conn->prepare($sql_query)) {
	$stmt->bind_param('s', $today);
	$stmt->execute();
	$stmt->bind_result($nume,$id_cai,$id_jochei);
	$i=0;
	while($stmt->fetch()) {
		$nume_curse[$i]=$nume;
		$cai[$i]=$id_cai;
		$jochei[$i]=$id_jochei;
		$top_cai[$i] = explode('.',$cai[$i]);
		$top_jochei[$i] = explode('.',$jochei[$i]);
		$i++;
	}
}

//Selectam numele cailor si meciurile castigate de acestia pentru a afisa cel mai bun in FEED
$stmt =  $conn->stmt_init();
for($j=0; $j<$i; $j++) {
	$sql_query = "SELECT nume, meciuri_castigate FROM cai WHERE id=?";
	if($stmt =  $conn->prepare($sql_query)) {
		$stmt->bind_param('i', $cai[$j]);
		$stmt->execute();
		$stmt->bind_result($nume,$meciuri_castigate);
		while($stmt->fetch()) {
			$nume_cai[$j]=$nume;
			$meciuri_castigate_cai[$j]=$meciuri_castigate;
		}
	}
}

//Selectam numele jocheilor si antrenorul pentru a afisa cel mai bun in FEED
$stmt =  $conn->stmt_init();
for($j=0; $j<$i; $j++) {
	$sql_query = "SELECT nume, antrenor FROM jochei WHERE id=?";
	if($stmt =  $conn->prepare($sql_query)) {
		$stmt->bind_param('i', $jochei[$j]);
		$stmt->execute();
		$stmt->bind_result($nume,$antrenor);
		while($stmt->fetch()) {
			$nume_jochei[$j]=$nume;
			$antrenori_jochei[$j]=$antrenor;
		}
	}
}

//---Avem de afisat asadar in titlu cursa si informatiile nume-cal, nume-jocheu, antrenor si meciuri castigate in descriere

for($j=0; $j<$i; $j++) {
	$writer->startElement("item"); 
		$writer->writeElement('title', $nume_curse[$j]); 
		$writer->writeElement('link', 'http://localhost:8181/worsie-BEt/pariuri.php?date=' . $today); 
		$writer->writeElement('description', 'Nume cal: '. $nume_cai[$j] .  ' Nume jocheu: ' . $nume_jochei[$j] . ' Nume antrenor: ' . $antrenori_jochei[$j] . ' Meciuri castigate: ' . $meciuri_castigate_cai[$j]); 
		$writer->writeElement('pubDate', date("D, d M Y H:i:s e")); 
	$writer->endElement(); 
}

//---------------------------------------------------- 

		

// End channel 
$writer->endElement(); 

// End rss 
$writer->endElement(); 

$writer->endDocument(); 

$writer->flush(); 
?>