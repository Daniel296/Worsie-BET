var error = 0;

function validate_register_data(flag, error) {
    /* flag este un numar de la 1 la 13 identificat inputul pe care il primeste*/
    if(error === 0) {
        document.getElementById("reg-err1").innerHTML = "";
        document.getElementById("reg-err2").innerHTML = "";
        document.getElementById("reg-err-submit").innerHTML = "";
    }

    switch (flag) {
        case 1:
            var input = document.getElementById("username").value.toString();
            if(input.length < 6 || input.length > 30) {
                print_register_error1("Username-ul trebuie sa aibă între 6 &#351i 30 de caractere!");
                error = 1;
            }
            else {
                var regex = /^\w+$/;
                if(!regex.test(input)) {
                    print_register_error1("Username-ul trebuie să con&#355ină doar litere, cifre &#351i caracterul _ ");
                    error = 1;
                }
                else { /*Verificam daca username-ul exista deja in baza de date */
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            if(this.response === "1") {
                                print_register_error1("Acest username există deja!");
                                error = 1;
                            }
                        }
                    };
                    xmlhttp.open("POST", "php/validate-data.php", true);
                    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xmlhttp.send("username=" + input);
                }
            }
            break;

        case 2:
                var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                var input = document.getElementById("email").value.toString();
                if(!regex.test(input)) {
                    print_register_error1("Email-ul nu este valid!");
                    error = 1;
                }
                else {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            if(this.response === "1") {
                                print_register_error1("Acest email există deja!");
                                error = 1;
                            }
                        }
                    };
                    xmlhttp.open("POST", "php/validate-data.php", true);
                    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xmlhttp.send("email=" + input);
                }
                break;

        case 3:
                var email = document.getElementById("email").value;
                var re_email = document.getElementById("re_email").value;
                if(email != re_email) {
                    print_register_error1("Email-urile nu se potrivesc!");
                    error = 1;
                }
                break;

        case 4:
                var input = document.getElementById("reg_password").value;

                if(input.length < 8 ) {
                    print_register_error1("Parola trebuie să aibă cel pu&#355in 8 caractere!  ");
                    error = 1;
                    break;
                }

                var regex = /[0-9]/;
                if(!regex.test(input)) {
                    print_register_error1("Parola trebuie să con&#355ina cel pu&#355in o cifră (0-9)!");
                    error = 1;
                    break;
                }

                regex = /[a-z]/;
                if(!regex.test(input)) {
                    print_register_error1("Parola trebuie să con&#355ină cel pu&#355in o literă mică (a-z)!");
                    error = 1;
                    break;
                }

                regex = /[A-Z]/;
                if(!regex.test(input)) {
                    print_register_error1("Parola trebuie să con&#355ină cel pu&#355in o literă mare (A-Z)!");
                    error = 1;
                    break;
                }
                break;

        case 5:
                var password = document.getElementById("reg_password").value;
                var re_password = document.getElementById("re_password").value;
                if(password != re_password) {
                    print_register_error1("Parolele nu se potrivesc!");
                    error = 1;
                }
                break;

        case 6:
                var input = document.getElementById("lastname").value.toString();
                var regex = /^[A-Z][a-z]*(-|\s)[A-Z][a-z]*$/;
                var regex1 = /^[A-Z][a-z]*$/;
                if(!regex.test(input) && !regex1.test(input)) {
                    print_register_error2("Numele ar trebui să con&#355ină doar litere &#351i să înceapă cu literă mare!");
                    error = 1;
                }
                break;

        case 7:
                var input = document.getElementById("firstname").value.toString();
                var regex = /^[A-Z][a-z]*(-|\s)[A-Z][a-z]*$/;
                var regex1 = /^[A-Z][a-z]*$/;
                if(!regex.test(input) && !regex1.test(input)) {
                    print_register_error2("Prenumele ar trebui să con&#355ină doar litere &#351i să înceapă cu literă mare!");
                    error = 1;
                }
                break;

        case 8:
                var input = document.getElementById("county").value.toString();
                var counties = ['alba', 'arad', 'arges', 'bacau', 'bihor', 'bistrita nasaud', 'botosani', 'braila', 'brasov', 'bucuresti', 'buzau', 'calarasi', 'caras', 'severin', 'cluj', 'constanta', 'covasna', 'dambovita',
                                'dolj', 'galati', 'giurgiu', 'gorj', 'harghita', 'hunedoara', 'ialomita', 'iasi', 'ilfov', 'maramures', 'mehedinti', 'mures', 'neamt', 'olt', 'prahova', 'salaj', 'satu mare', 'sibiu', 'suceava', 'teleorman',
                                'timis', 'tulcea', 'valcea', 'vaslui', 'vrancea'];

                if(counties.indexOf(input.toLowerCase()) === -1) {
                    print_register_error2("A&#355i introdus un jude&#355 invalid!");
                    error = 1;
                }
                break;

        case 9:
                var input = document.getElementById("city").value.toString();
                var regex = /^[A-Z][a-z]*(-|\s)[A-Z][a-z]*$/;
                var regex1 = /^[A-Z][a-z]*$/;
                if(!regex.test(input) && !regex1.test(input)) {
                    print_register_error2("A&#355i introdus un ora&#351 invalid!");
                    error = 1;
                }
                break;

        case 10:
                var input = document.getElementById("address").value.toString();
                var regex = /^[A-Za-z0-9\s,\.-]*$/;
                if(!regex.test(input)) {
                    print_register_error2("A&#355i introdus o adresă invalidă!");
                    error = 1;
                }
                break;

        case 11:
                var input = document.getElementById("country").value.toString();
                var country = "Romania";
                if(country.toLowerCase() != input.toLowerCase()) {
                    print_register_error2("A&#355i introdus un nume de &#355ară invalid!");
                    error = 1;
                }
                break;

        case 12:
                var input = document.getElementById("phone").value.toString();
                var regex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
                if(!regex.test(input)) {
                    print_register_error2("A&#355i introdus un număr de telefon invalid!");
                    error = 1;
                }
                break;

        case 13:
                birthday = document.getElementById("bday").value;
                break;
    }
    return error;
}

function print_register_error1(error_msg) {
    document.getElementById("reg-err1").innerHTML = "*" + error_msg;
}

function print_register_error2(error_msg) {
    document.getElementById("reg-err2").innerHTML = "*" + error_msg;
}

function print_submit_register_error(error_msg) {
    document.getElementById("reg-err-submit").innerHTML = "*" + error_msg;
}

function print_login_error(error_msg) {
    document.getElementById("err-log").innerHTML = "*" + error_msg;
}

function register_user() {
    var error = 0;
    for(var i = 0; i <= 13; i++) {
        error = validate_register_data(i, error);
    }

    /* Luam toate datele necesare pentru inregistrare*/
    username = document.getElementById("username").value;
    email = document.getElementById("email").value;
    password = document.getElementById("reg_password").value;
    firstname = document.getElementById("firstname").value;
    lastname = document.getElementById("lastname").value;
    city = document.getElementById("city").value;
    county = document.getElementById("county").value;
    county = county.substr(0, 1).toUpperCase() + county.substr(1);  //setam prima litera din judet sa fie UpperCase
    address = document.getElementById("address").value;
    country = document.getElementById("country").defaultValue;
    phone = document.getElementById("phone").value;
    birthday = document.getElementById("bday").value;


    /* verificam ca toate field-urile sa fie completate*/
     if(document.getElementById('terms').checked) {
         if(error === 0) {
             if(username != "" && email != "" && password != "" && firstname != "" && lastname != "" &&
                 city != "" && county != "" && country != "" && address != "" && phone != "" && birthday != "") {

                /* Trimitem datele la server folosind XMLHttpRequest */
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        window.location = "profile.php?page=account";
                    }
                };
                xmlhttp.open("POST", "php/login-register.php", true);
                xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xmlhttp.send("username=" + username + "&email=" + email + "&password=" + password + "&firstname=" + firstname +
                    "&lastname=" + lastname + "&city=" + city + "&county=" + county + "&address=" + address + "&phone=" + phone + "&birthday=" + birthday);
            }
            else {
                print_submit_register_error("*Toate câmpurile trebuie să fie completate!");
            }
        }
        else {
            print_submit_register_error("*Toate câmpurile trebuie să fie completate corect!");
        }
    }
    else {
        print_submit_register_error("*Trebuie să accep&#355ati Termenii &#351i Condi&#355iile de utilizare ale serviciului!");
    }
}

function login_user() {
    var username = "", password = "";

    username = document.getElementById("username_login").value;
    password = document.getElementById("password").value;

    if(username === "" || password === "") {
        print_login_error("Completa&#355i toate câmpurile!");
        return;
    }

    /* Trimitem datele la server folosind XMLHttpRequest */
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.response == 1) {
                window.location = window.location.pathname + window.location.search;
            }
            else {
                print_login_error("Username sau parolă invalid(ă)!");
            }
        }
    };
    xmlhttp.open("POST", "php/login-register.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send("username_login=" + username + "&password=" + password);
}
