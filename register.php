<!DOCTYPE HTML>
<html>
<head>
	<title>Inregistrare - WorsieBet</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style-header.css">
	<link rel="stylesheet" type="text/css" href="css/popup-style.css">
</head>
<body>

<?php
	require('pages/header.php');
?>
<div id="wrap">
	<div id="main">
        <h2> Inregistrare </h2>
        <div class="box">
            <div class="info-box-left">
                1. Detaliile dumneavoastra
            </div>
            <div class="info-box-right">
                <span>Va rugam completati mai jos detaliile dumneavostra pentru a deschide un cont de pariere. Toate informatiile dumneavoastra sunt pastrate în siguranta, securizate si confidentiale.</span>
                <div id="reg-err">
                    <!-- Mesaje de eroare din JAVASCRIPT -->
                </div>
                <div class="line-input">
                    <div class="form-register">
                        <div class="left-form">
        				     <label><b>Username</b></label>
        				     <input type="text" id="username" onchange="validate_register_data(1)" required/>
                        </div>
                    </div>
                </div>

                <div class="line-input">
                    <div class="form-register">
                        <div class="left-form">
        				    <label><b>Adresa de email</b></label>
        				    <input type="email" id="email" onchange="validate_register_data(2)" required/>
                        </div>
                        <div class="right-form">
        				    <label><b>Comfirmati adresa de email</b></label>
        				    <input type="email" id="re_email" onchange="validate_register_data(3)" required/>
                        </div>
        			</div>
                </div>
                <div class="line-input">
                    <div class="form-register">
                        <div class="left-form">
        				    <label><b>Parola</b></label>
        				    <input type="password" id="password" onchange="validate_register_data(4)" required/>
                        </div>
                        <div class="right-form">
        				    <label><b>Comfirmati parola</b></label>
        				    <input type="password" id="re_password" onchange="validate_register_data(5)" required/>
                        </div>
        			</div>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="info-box-left">
                1. Verificare date
            </div>
            <div class="info-box-right">
                <span> &nbsp; &nbsp; &nbsp; &nbsp; Va rugam completati datele asa cum apar in actul dumneavoastra de identitate </span>

                <div class="line-input">
                    <div class="form-register">
                        <div class="left-form">
        				    <label><b>Nume</b></label>
        				    <input type="text" id="lastname" onchange="validate_register_data(6)" required/>
                        </div>
                        <div class="right-form">
        				    <label><b>Prenume</b></label>
        				    <input type="text" id="firstname" onchange="validate_register_data(7)" required/>
                        </div>
        			</div>
                </div>

                <div class="line-input">
                    <div class="form-register">
                        <div class="left-form">
        				    <label><b>Judet</b></label>
        				    <input type="text" id="county" onchange="validate_register_data(8)" required/>
                        </div>
                        <div class="right-form">
        				    <label><b>Oras</b></label>
        				    <input type="text" id="city" onchange="validate_register_data(9)" required/>
                        </div>
        			</div>
                </div>

                <div class="line-input">
                    <div class="form-register">
                        <div class="left-form">
                            <label><b>Oras</b></label>
        				    <input type="text" id="Adresa" onchange="validate_register_data(10)" required/>

                        </div>
                        <div class="right-form">
                            <label><b>Tara</b></label>
        				    <input type="text" id="county" onchange="validate_register_data(11)" value="Romania" required/>
                        </div>
        			</div>
                </div>

                <div class="line-input">
                    <div class="form-register">
                        <div class="left-form">
                            <label><b>Data nasterii</b></label>
            				<input type="date" id="bday" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required >
            			</div>
                        <div class="right-form">
        				    <label><b>Telefon</b></label>
        				    <input type="text" id="phone" required/>
                        </div>
        			</div>
                </div>
                <div class="terms-box">
                    <input type="checkbox" id="terms" value="Bike"> Accept <a href="regulament.php">Termeni si Conditii </a> asa cum sunt publicate pe acest site. <br>
                </div>
            </div>
        </div>
        <div class="button-register">
            <button type="button">Inregistreaza-te </button>
        </div>
	</div>

</div>

<script src="js/account.js"></script>
<?php
	require('pages/footer.php');
?>

</body>
</html>
