
<?php
    require("database/connect2DB.php");

    /*Daca sunt setate datele necesare pentru logare*/
    if (isset($_POST['username_login']) and isset($_POST['password'])) {
        /* Scoatem caracterele speciale din username si parola pentru evitarea sql injection*/
        $username = trim($_POST['username_login']);
        $password = trim($_POST['password']);

        /* Apelam functia care face logarea */
        login_user($conn, $username, $password);
    }

    /*===========LOGIN===========*/
    function login_user($conn, $username, $password) {
        /* Creeam si executam query-ul pentru a vedea daca exista user-ul in baza de date */
        unset($stmt);
        $stmt =  $conn->stmt_init();
        $sql_query = "SELECT id, trim(parola) FROM UTILIZATORI WHERE username = ? AND parola = ?";
        if($stmt =  $conn->prepare($sql_query)) {
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $stmt->bind_result($id_user, $hash_password);
        $stmt->fetch();

        //password_verify($password, $hash_password) == TRUE
        if(isset($id_user)) {
            /* Pornim sesiunea si setam parametrii la sesiune */
            $_SESSION['id'] = $id_user;
            $_SESSION['username'] = $username;

            /* Facem update la campul "conectat" */
            unset($stmt);
            $stmt =  $conn->stmt_init();
            $sql_query = "UPDATE utilizatori SET conectat = 1 WHERE id = ?";
            if($stmt =  $conn->prepare($sql_query)) {
                $stmt->bind_param('d', $id_user);
                $stmt->execute();
            }
        }
        else {
                print_login_error("Username sau parola gresite");
            }
        }
    }




    /*=============REGISTER===========*/
    if (isset($_POST['username']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['firstname']) and isset($_POST['lastname']) and isset($_POST['city'])
        and isset($_POST['county']) and isset($_POST['address']) and isset($_POST['phone']) and isset($_POST['birthday'])) {

        /* Scoatem caracterele speciale din username si parola pentru evitarea sql injection*/
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $lastname = trim($_POST['lastname']);
        $firstname = trim($_POST['firstname']);
        $city =trim($_POST['city']);
        $county = trim($_POST['county']);
        $address = trim($_POST['address']);
        $phone = trim($_POST['phone']);
        $birth_date = date("Y-m-d", strtotime($_POST['birthday']));

        /* Criptam parola */
        //$hash_password = password_hash($password, PASSWORD_DEFAULT);
        $hash_password = $password;

        unset($stmt);
        $stmt =  $conn->stmt_init();
        $sql_query = "INSERT INTO UTILIZATORI (username, parola, email, nume, prenume, adresa, data_nasterii, telefon, oras, judet)
                                 VALUES (?, ?, ?, ?, ?, ?, DATE_FORMAT(?,'%Y-%m-%d'), ?, ?, ?)";
        if($stmt =  $conn->prepare($sql_query)) {
            $stmt->bind_param('ssssssssss', $username, $hash_password, $email, $lastname, $firstname, $address, $birth_date, $phone, $city, $county);
            $stmt->execute();

            /*Daca am ajuns pana aici inseamna ca inregistrarea a avut loc cu succes, asa ca facem login */
            login_user($conn, $username, $password);
        }
    }

    echo "Inregistrarea s-a realizat cu succes!";
