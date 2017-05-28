<?php
    require("database/connect2DB.php");

    /* Verificam daca acest username exista deja in baza de date */
    if(isset($_POST['username'])) {
        $username = $_POST['username'];
        
        unset($stmt);
        $stmt =  $conn->stmt_init();
        $sql_query = "SELECT username FROM utilizatori WHERE username = ?";
        if($stmt =  $conn->prepare($sql_query)) {
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->bind_result($username1);
            $stmt->fetch();

            if($username == $username1) {
                echo "1";
            }
            else {
                echo "0";
            }
        }
    }

    /* Verificam daca acest email exista deja in baza de date */
    if(isset($_POST['email'])) {
        $email = $_POST['email'];

        unset($stmt);
        $stmt =  $conn->stmt_init();
        $sql_query = "SELECT email FROM utilizatori WHERE email = ?";
        if($stmt =  $conn->prepare($sql_query)) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->bind_result($email1);
            $stmt->fetch();

            if($email == $email1) {
                echo "1";
            }
            else {
                echo "0";
            }
        }
    }

?>
