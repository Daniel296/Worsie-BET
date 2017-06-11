<?php
    /*=========SEARCH TICKET=========*/
    require("database/connect2DB.php");

    $pin = $_POST['pin'];

    $html = "";
    /* Luam informatiile despre bilet din baza de date */
    unset($stmt);
    $stmt =  $conn->stmt_init();
    $sql_query = "SELECT status, suma_depusa, suma_castig, pariuri, cota, data_creare FROM bilete WHERE cod = ?";
    if($stmt =  $conn->prepare($sql_query)) {
        $stmt->bind_param('s', $pin);
        $stmt->execute();
        $stmt->bind_result($status, $suma_depusa, $suma_castig, $pariuri, $cota, $data_creare);
        $stmt->fetch();

        if(isset($status)) {
            $ticket_details = array();
            $ids = array();

            $ids = explode(' ', $pariuri);
            for($i = 0; $i < count($ids); $i++) {
                $ticket_details[$i] = array();
                $ids1 = explode('.', $ids[$i]);

                $ticket_details[$i]['id_race'] = $ids1[0];
                $ticket_details[$i]['id_horse'] = $ids1[1];
                $ticket_details[$i]['id_jockey'] = $ids1[2];

                unset($stmt);
                $stmt =  $conn->stmt_init();
                $sql_query = "SELECT nume, substr(DATE_FORMAT(data,'%d-%m'), 1, 5), ora FROM curse WHERE id = ?";
                if($stmt =  $conn->prepare($sql_query)) {
                    $stmt->bind_param('d', $ticket_details[$i]['id_race'] );
                    $stmt->execute();
                    $stmt->bind_result($ticket_details[$i]['race_name'], $ticket_details[$i]['race_date'], $ticket_details[$i]['race_time'] );
                    $stmt->fetch();
                }

                unset($stmt);
                $stmt =  $conn->stmt_init();
                $sql_query = "SELECT nume FROM cai WHERE id = ?";
                if($stmt =  $conn->prepare($sql_query)) {
                    $stmt->bind_param('d', $ticket_details[$i]['id_horse'] );
                    $stmt->execute();
                    $stmt->bind_result($ticket_details[$i]['horse_name'] );
                    $stmt->fetch();
                }

                unset($stmt);
                $stmt =  $conn->stmt_init();
                $sql_query = "SELECT nume, antrenor FROM jochei WHERE id = ?";
                if($stmt =  $conn->prepare($sql_query)) {
                    $stmt->bind_param('d', $ticket_details[$i]['id_jockey'] );
                    $stmt->execute();
                    $stmt->bind_result($ticket_details[$i]['jockey_name'], $ticket_details[$i]['jockey_trainer']);
                    $stmt->fetch();
                }

            }

            /*In functie de status alegem clasa potrivita pentru ticket-box*/
            if($status == -1)
                $html = "<div class=\"bet-ticket-lost\">";
            else if($status == 0)
                    $html = "<div class=\"bet-ticket\">";
                else
                    $html = "<div class=\"bet-ticket-win\">";

            for($i = 0; $i < count($ticket_details); $i++) {
                $html .= "<div class=\"race-on-ticket1\">" .
                                "<div class=\"detail\"><div class=\"top-left1\">" . $ticket_details[$i]['horse_name'] . "</div>" .
                                "<div class=\"top-right1\">" . $ticket_details[$i]['jockey_name'] . "</div></div>" .
                                "<div class=\"detail\"><div class=\"bottom-left1\">" . $ticket_details[$i]['race_name'] . "</div>".
                                "<div class=\"bottom-right1\">" . substr($ticket_details[$i]['race_time'],0,5) . " / " . $ticket_details[$i]['race_date'] . "</div></div>" .
        				"</div>";
            }

            $html .= "<br><div class=\"total\">
    				    <span style=\"float: left;\">Cotă totală: </span>
    				    <span id=\"total_odd\" style=\"float: right;\">$cota</span><br>
            		</div>
                    <div class=\"total\">
            			<span style=\"float: left;\">Suma pariată: </span>
            		    <span id=\"total_odd\" style=\"float: right;\">$suma_depusa</span><br>
                    </div>";
            if($status == -1) {//Biletul este pierdut
            	$html .=	"<div class=\"total\">
            				    <span style=\"float: left;\">Câ&#351tig: </span>
            				    <span id=\"total_win\" style=\"float: right;\">0 RON</span><br>
                    		</div>
                            <div class=\"total\">
                    				<span style=\"float: left;\">Status: </span>
                    				<span id=\"total_win\" style=\"float: right; color: #CE000B\"> Pierdut</span><br>
                    		</div>";
            }
            else {
                if($status == 1) { //Biletul este gastigator
                	$html .=	"<div class=\"total\">
                				    <span style=\"float: left;\">Câ&#351tig: </span>
                				    <span id=\"total_win\" style=\"float: right;\">$suma_castig</span><br>
                        		</div>
                                <div class=\"total\">
                        				<span style=\"float: left;\">Status: </span>
                        				<span id=\"total_win\" style=\"float: right; color: #006600\"> Câ&#351tigat</span><br>
                        		</div>";
                }
                else { //Biletul este in asteptare
                    $html .=	"<div class=\"total\">
                                    <span style=\"float: left;\">Câ&#351tig poten&#355ial: </span>
                                    <span id=\"total_win\" style=\"float: right;\">$suma_castig</span><br>
                                </div>
                                <div class=\"total\">
                                        <span style=\"float: left;\">Status: </span>
                                        <span id=\"total_win\" style=\"float: right;\"> În asteptare...</span><br>
                                </div>";
                }
            }
            $html .= "</div>";
        }
        else {
            echo "0";
        }
    }
    echo $html;

 ?>
