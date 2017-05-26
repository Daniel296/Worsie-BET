
<?php
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
    if (isset($_POST['bday']) and isset($_POST['username']) and isset($_POST['lastname']) and isset($_POST['firstname']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['re_password'])) {
        $ok = false;

        /* Scoatem caracterele speciale din username si parola pentru evitarea sql injection*/
        $username = trim($_POST['username']);
        $lastname = trim($_POST['lastname']);
        $firstname = trim($_POST['firstname']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $re_password = trim($_POST['re_password']);
        $birth_date = date("Y-m-d", strtotime($_POST['bday']));

        /* Validam datele introduse de utilizator si afisam mesajele de eroare corespunzatoare */
        if(strlen($username) < 6 or strlen($username) > 30)
        print_register_error("Username-ul trebuie sa aiba intre 6 si 30 de caractere");
        if(preg_match('/^[A-Za-z][A-Za-z0-9]$/', $username))
        print_register_error("Username-ul poate sa contina doar litere si cifre");
        if(strlen($firstname) > 15)
        print_register_error("Lungimea prenumelui este prea mare");
        if(strlen($lastname) > 15)
        print_register_error("Lungimea numelui este prea mare");
        if(!preg_match('/[A-Za-z]$/', $firstname) or !preg_match('/[A-Za-z]$/', $lastname) )
        print_register_error("Numele poate sa contina doar litere");
        if(strlen($password) > 30)
        print_register_error("Parola este prea lunga");
        if($password != $re_password)
        print_register_error("Parolele sunt diferite");


        /* Criptam parola */
        //$hash_password = password_hash($password, PASSWORD_DEFAULT);
        $hash_password = $password;

        /* Verificam daca username-ul sau email-ul exista deja in baza de date */
        $stmt =  $conn->stmt_init();
        $sql_query = "SELECT username, email FROM utilizatori WHERE username = ? or email = ?";
        if($stmt =  $conn->prepare($sql_query)) {
            $stmt->bind_param('ss', $username, $email);
            $stmt->execute();
            $stmt->bind_result($username1, $email1);
            $stmt->fetch();
            echo "H1 ";
            if(isset($username1) == false and isset($email1) == false) {
                 echo "H2 ";
                 unset($stmt);
                 $stmt =  $conn->stmt_init();
                 $sql_query = "INSERT INTO UTILIZATORI (username, parola, email, nume, prenume, data_nasterii)
                                 VALUES (?, ?, ?, ?, ?, DATE_FORMAT(?,'%Y-%m-%d'))";
                 if($stmt =  $conn->prepare($sql_query)) {
                     $stmt->bind_param('ssssss', $username, $hash_password, $email, $lastname, $firstname, $birth_date);
                     $stmt->execute();
                     echo "H3 ";

                     if (!$conn->commit()) {
                         print_register_error("Transaction commit failed");
                         exit();
                     }

                     /*Daca am ajuns pana aici inseamna ca inregistrarea a avut loc cu succes, asa ca facem login */
                     login_user($conn, $username, $password);
                 }
                 else {
                     if(isset($username1) == true and $username1 == $username)
                         print_error("Acest username exista deja");
                     if(isset($email1) == true and $email1 == $email)
                         print_error("Aceasta adresa de email exista deja");
                     echo "H5";
                 }
            }
            else {
                 print_register_error("Username-ul exista deja in baza de date");
             }
        }
    }
