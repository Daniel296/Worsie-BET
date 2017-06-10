<?php
//include "../pages/header.php";
require("../php/database/connect2DB.php");

sync_curse_with_rezultate($conn);

function sync_curse_with_rezultate($conn) {
	$sql = "UPDATE rezultate r SET
				r.data = (SELECT data FROM CURSE c WHERE c.id = r.id_cursa),
				r.ora = (SELECT ora FROM CURSE c WHERE c.id = r.id_cursa)
			";
	    
	if($stmt = $conn->prepare($sql)) {
		$stmt->execute();
		echo "Data si ora curselor din 'curse' si 'rezultate' au fost sincronizate.";
	}
}
?>