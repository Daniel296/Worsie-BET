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
?>
<div id="wrap">
	<div id="main">
        <h2> Înregistrare </h2>
        <div class="box">
            <div class="info-box-left">
                1. Detaliile dumneavoastră
            </div>
            <div class="info-box-right">
                <span>Vă rugăm completați mai jos detaliile dumneavoastră pentru a deschide un cont de pariere. Toate informațiile dumneavoastră sunt păstrate în siguranță, securizate și confidențiale.</span>
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
        				    <label><b>E-mail</b></label>
        				    <input type="email" id="email" onchange="validate_register_data(2)" required/>
                        </div>
                        <div class="right-form">
        				    <label><b>Confirmă E-mail</b></label>
        				    <input type="email" id="re_email" onchange="validate_register_data(3)" required/>
                        </div>
        			</div>
                </div>
                <div class="line-input">
                    <div class="form-register">
                        <div class="left-form">
        				    <label><b>Parolă</b></label>
        				    <input type="password" id="password" onchange="validate_register_data(4)" required/>
                        </div>
                        <div class="right-form">
        				    <label><b>Confirmă parolă</b></label>
        				    <input type="password" id="re_password" onchange="validate_register_data(5)" required/>
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
                <span> &nbsp; &nbsp; &nbsp; &nbsp; Vă rugăm completați datele așa cum apar în actul dumneavoastră de identitate. </span>

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
        				    <label><b>Județ</b></label>
        				    <input type="text" id="county" onchange="validate_register_data(8)" required/>
                        </div>
                        <div class="right-form">
        				    <label><b>Oraș</b></label>
        				    <input type="text" id="city" onchange="validate_register_data(9)" required/>
                        </div>
        			</div>
                </div>

                <div class="line-input">
                    <div class="form-register">
                        <div class="left-form">
                            <label><b>Adresă</b></label>
        				    <input type="text" id="address" onchange="validate_register_data(10)" required/>

                        </div>
                        <div class="right-form">
                            <label><b>Țară</b></label>
        				    <input type="text" id="country" onchange="validate_register_data(11)" required/>
                        </div>
        			</div>
                </div>

                <div class="line-input">
                    <div class="form-register">
                        <div class="left-form">
                            <label><b>Data nașterii</b></label>
            				<input type="date" id="bday" onchange="validate_register_data(13)" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required >
            			</div>
                        <div class="right-form">
        				    <label><b>Telefon</b></label>
        				    <input type="text" id="phone" onchange="validate_register_data(12)" required/>
                        </div>
        			</div>
                </div>
                <div class="terms-box">
                    <input type="checkbox" id="terms"> Accept <a href="regulament.php">Termenii și Condițiile </a> așa cum sunt publicate pe acest site. <br>
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
