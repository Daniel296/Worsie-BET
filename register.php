<!DOCTYPE HTML>
<html>
<head>
	<title>Înregistrare - WorsieBet</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style-header.css">
	<link rel="stylesheet" type="text/css" href="css/popup-style.css">
</head>
<body>

<?php
	require('pages/header.php');

	if(isset($_SESSION['id'])) {
		header('Location: profile.php?page=account');
	}
?>
<div id="wrap">
	<div id="main">
        <h2> Înregistrare </h2>
        <div class="box">
            <div class="info-box-left">
                1. Detaliile dumneavoastră
            </div>
            <div class="info-box-right">
                <span>Vă rugăm completa&#355i mai jos detaliile dumneavoastră pentru a deschide un cont de pariere. Toate informa&#355iile dumneavoastră sunt păstrate în siguran&#355ă, securizate &#351i confiden&#355iale.</span>
                <div id="reg-err1">
                    <!-- Mesaje de eroare din JAVASCRIPT -->
                </div>
                <div class="line-input">
                    <div class="form-register">
                        <div class="left-form">
        				     <label><b>Username</b></label>
        				     <input type="text" id="username" onchange="validate_register_data(1, 0)" required/>
                        </div>
                    </div>
                </div>

                <div class="line-input">
                    <div class="form-register">
                        <div class="left-form">
        				    <label><b>E-mail</b></label>
        				    <input type="email" id="email" onchange="validate_register_data(2, 0)" required/>
                        </div>
                        <div class="right-form">
        				    <label><b>Confirmă E-mail</b></label>
        				    <input type="email" id="re_email" onchange="validate_register_data(3, 0)" required/>
                        </div>
        			</div>
                </div>
                <div class="line-input">
                    <div class="form-register">
                        <div class="left-form">
        				    <label><b>Parolă</b></label>
							<input type="password" id="reg_password" onchange="validate_register_data(4, 0)" required/>
                        </div>
                        <div class="right-form">
        				    <label><b>Confirmă parolă</b></label>
        				    <input type="password" id="re_password" onchange="validate_register_data(5, 0)" required/>
                        </div>
        			</div>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="info-box-left">
                2. Verificare date
            </div>
            <div class="info-box-right">
                <span> &nbsp; &nbsp; &nbsp; &nbsp; Vă rugăm completa&#355i datele a&#351a cum apar în actul dumneavoastră de identitate. </span>
				<div id="reg-err2">
					<!-- Eroare din Javascript -->
				</div>
                <div class="line-input">
                    <div class="form-register">
                        <div class="left-form">
        				    <label><b>Nume</b></label>
        				    <input type="text" id="lastname" onchange="validate_register_data(6, 0)" required/>
                        </div>
                        <div class="right-form">
        				    <label><b>Prenume</b></label>
        				    <input type="text" id="firstname" onchange="validate_register_data(7, 0)" required/>
                        </div>
        			</div>
                </div>

                <div class="line-input">
                    <div class="form-register">
                        <div class="left-form">
        				    <label><b>Jude&#355</b></label>
        				    <input type="text" id="county" onchange="validate_register_data(8, 0)" required/>
                        </div>
                        <div class="right-form">
        				    <label><b>Ora&#351</b></label>
        				    <input type="text" id="city" onchange="validate_register_data(9, 0)" required/>
                        </div>
        			</div>
                </div>

                <div class="line-input">
                    <div class="form-register">
                        <div class="left-form">
                            <label><b>Adresă</b></label>
        				    <input type="text" id="address" onchange="validate_register_data(10, 0)" required/>

                        </div>
                        <div class="right-form">
                            <label><b>&#354ară</b></label>
        				    <input type="text" id="country" onchange="validate_register_data(11, 0)" required/>
                        </div>
        			</div>
                </div>

                <div class="line-input">
                    <div class="form-register">
                        <div class="left-form">
                            <label><b>Data na&#351terii</b></label>
            				<input type="date" id="bday" onchange="validate_register_data(13, 0)" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required >
            			</div>
                        <div class="right-form">
        				    <label><b>Telefon</b></label>
        				    <input type="text" id="phone" onchange="validate_register_data(12, 0)" required/>
                        </div>
        			</div>
                </div>
                <div class="terms-box">
                    <input type="checkbox" id="terms"> Accept <a href="regulament.php">Termenii &#351i Condi&#355iile </a> a&#351a cum sunt publicate pe acest site. <br>
                </div>
				<div id="reg-err-submit">
					<!-- Eroare din Javascript -->
				</div>
            </div>
        </div>

        <div class="button-register">
            <button type="button" onclick="register_user()">Înregistrează-te </button>
        </div>
	</div>

</div>

<script src="js/account.js"></script>

<?php
	require('pages/footer.php');
?>

</body>
</html>
