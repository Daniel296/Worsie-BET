<?php
    require("database/connect2DB.php");

    $id_user = $_REQUEST['id'];
    $html = "<h5> ERROR: Something went wrong </h5>";
    /* Luam informatiile despre bilet din baza de date */
    unset($stmt);
    $stmt =  $conn->stmt_init();
    $sql_query = "SELECT pariuri FROM bilete WHERE id = ?";
    if($stmt =  $conn->prepare($sql_query)) {
        $stmt->bind_param('d', $id_user);
        $stmt->execute();
        $stmt->bind_result($pariuri);
        $stmt->fetch();

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

        $html = "<div class=\"bet-ticket1\">";
        for($i = 0; $i < count($ticket_details); $i++) {
            $html .= "<div class=\"race-on-ticket1\">" .
                            "<div class=\"detail\"><div class=\"top-left1\">" . $ticket_details[$i]['horse_name'] . "</div>" .
                            "<div class=\"top-right1\">" . $ticket_details[$i]['jockey_name'] . "</div></div>" .
                            "<div class=\"detail\"><div class=\"bottom-left1\">" . $ticket_details[$i]['race_name'] . "</div>".
                            "<div class=\"bottom-right1\">" . substr($ticket_details[$i]['race_time'],0,5) . " / " . $ticket_details[$i]['race_date'] . "</div></div>" .
    				"</div>";
        }
        $html .= "</div>";
    }
    else {
        echo "Biletul nu există în baza de date";
    }
    echo $html;

 ?>
