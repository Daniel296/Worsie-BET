var error = 0;

function validare_input(flag, error) {
    /* flag este un numar de la 1 la 13 indentificant inputul pe care il primeste*/
    document.getElementById("err1").innerHTML = "";
    document.getElementById("err2").innerHTML = "";
    document.getElementById("err3").innerHTML = "";

    switch (flag) {
        case 2: // EMAIL
                var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                var input = document.getElementById("email").value.toString();
                if(!regex.test(input)) {
                    print_email_err("Email-ul nu este valid!");
                    error = 1;
                }
                else {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            if(this.response === "1") {
                                print_email_err("Acest email exista deja!");
                                error = 1;
                            }
                        }
                    };
                    xmlhttp.open("POST", "php/validate-data.php", true);
                    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xmlhttp.send("email=" + input);
                }
                break;

        case 3: // RE_EMAIL
                var email = document.getElementById("email").value;
                var re_email = document.getElementById("re_email").value;
                if(email != re_email) {
                    print_email_err("Email-urile nu se potrivesc!");
                    error = 1;
                }
                break;
        
        case 4: // PASSWORD
                var input = document.getElementById("password").value;

                if(input.length < 8 ) {
                    print_pass_err("Parola trebuie sa aiba cel putin 8 caractere!");
                    error = 1;
                    break;
                }

                var regex = /[0-9]/;
                if(!regex.test(input)) {
                    print_pass_err("Parola trebuie sa contina cel putin o cifra (0-9)!");
                    error = 1;
                    break;
                }
                else password = input.toString();

                regex = /[a-z]/;
                if(!regex.test(input)) {
                    print_pass_err("Parola trebuie sa contina cel putin o litera mica (a-z)!");
                    error = 1;
                    break;
                }
                else password = input;

                regex = /[A-Z]/;
                if(!regex.test(input)) {
                    print_pass_err("Parola trebuie sa contina cel putin o litera mare (A-Z)!");
                    error = 1;
                    break;
                }
                break;

        case 5: // RE_PASSWORD
                var password = document.getElementById("password").value;
                var re_password = document.getElementById("re_password").value;
                if(password != re_password) {
                    print_pass_err("Parolele nu se potrivesc");
                    error = 1;
                }
                break;

        case 6: // LASTNAME
                var input = document.getElementById("lastname").value.toString();
                var regex = /^[A-Z][a-z]*(-|\s)[A-Z][a-z]*$/;
                var regex1 = /^[A-Z][a-z]*$/;
                if(!regex.test(input) && !regex1.test(input)) {
                    print_date_err("Numele ar trebui sa contina doar litere si sa inceapa cu litera mare!");
                    error = 1;
                }
                break;

        case 7: // FIRSTNAME
                var input = document.getElementById("firstname").value.toString();
                var regex = /^[A-Z][a-z]*(-|\s)[A-Z][a-z]*$/;
                var regex1 = /^[A-Z][a-z]*$/;
                if(!regex.test(input) && !regex1.test(input)) {
                    print_date_err("Prenumele ar trebui sa contina doar litere si sa inceapa cu litera mare!");
                    error = 1;
                }
                break;

        case 8: // COUNTY
                var input = document.getElementById("county").value.toString();
                var regex = /^[A-Z][a-z]*(-|\s)[A-Z][a-z]*$/;
                var regex1 = /^[A-Z][a-z]*$/;
                if(!regex.test(input) && !regex1.test(input)) {
                    print_date_err("Ati introdus un judet invalid!");
                    error = 1;
                }
                break;

        case 9: // CITY
                var input = document.getElementById("city").value.toString();
                var regex = /^[A-Z][a-z]*(-|\s)[A-Z][a-z]*$/;
                var regex1 = /^[A-Z][a-z]*$/;
                if(!regex.test(input) && !regex1.test(input)) {
                    print_date_err("Ati introdus un oras invalid!");
                    error = 1;
                }
                break;

        case 10: // ADDRESS
                var input = document.getElementById("address").value.toString();
                var regex = /^[A-Za-z0-9\s,\.-]*$/;
                if(!regex.test(input)) {
                    print_date_err("Ati introdus o adresa invalida!");
                    error = 1;
                }
                break;

        case 11: // COUNTRY
                var input = document.getElementById("country").value.toString();
                var regex = /^[A-Z][a-z]*(-|\s)[A-Z][a-z]*$/;
                var regex1 = /^[A-Z][a-z]*$/;
                if(!regex.test(input) && !regex1.test(input)) {
                    print_date_err("Ati introdus un nume de tara invalid!");
                    error = 1;
                }
                break;

        case 12: // PHONE
                var input = document.getElementById("phone").value.toString();
                var regex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
                if(!regex.test(input)) {
                    print_date_err("Ati introdus un numar de telefon invalid!");
                    error = 1;
                }
                break;
        case 13: // OLD_PASSWORD
                var input = document.getElementById("old_password").value.toString();

                if(input.length >2 ) {
                    print_pass_err("Parola veche trebuie sa aiba cel putin 8 caractere!");
                    error = 1;
                    break;
                }

                var regex = /[0-9]/;
                if(!regex.test(input)) {
                    print_pass_err("Parola veche trebuie sa contina cel putin o cifra (0-9)!");
                    error = 1;
                    break;
                }
                else password = input.toString();

                regex = /[a-z]/;
                if(!regex.test(input)) {
                    print_pass_err("Parola veche trebuie sa contina cel putin o litera mica (a-z)!");
                    error = 1;
                    break;
                }
                else password = input;

                regex = /[A-Z]/;
                if(!regex.test(input)) {
                    print_pass_err("Parola veche trebuie sa contina cel putin o litera mare (A-Z)!");
                    error = 1;
                    break;
                }
                break;
    }
    return error;
}


function print_date_err(error_msg) {
    document.getElementById("err1").innerHTML = "*" + error_msg + "<br><br>";
}


function print_pass_err(error_msg) {
    document.getElementById("err2").innerHTML = "*" + error_msg + "<br><br>";
}


function print_email_err(error_msg) {
    document.getElementById("err3").innerHTML = "*" + error_msg + "<br><br>";
}

function schimba_date() {
    var error = 0;
    var date = [6, 7, 8, 9, 10, 12];
    for(var i = 0; i < 6; i++) {
        error = validare_input(date[i], error);
    }

    firstname = document.getElementById("firstname").value;
    lastname = document.getElementById("lastname").value;
    city = document.getElementById("city").value;
    county = document.getElementById("county").value;
    address = document.getElementById("address").value;
    phone = document.getElementById("phone").value;
    

    if(error === 0) {
        if(firstname != "" && lastname != "" && city != "" && county != "" && address != "" && phone != "") {
            /* Trimitem datele la server folosind XMLHttpRequest */
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("err1").innerHTML = this.response;
                }
            };
            xmlhttp.open("POST", "php/setari_exec.php", true);
            xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xmlhttp.send(   "flag=1" +
                            "&firstname=" + firstname +
                            "&lastname=" + lastname +
                            "&city=" + city +
                            "&county=" + county +
                            "&address=" + address +
                            "&phone=" + phone
                        );
        } else {
            print_date_err("Toate campurile trebuie sa fie completate!");
        }
    } else {
            print_date_err("Toate campurile trebuie sa fie completate corect!");
    }
}

function schimba_parola() {
    var error = 0;
    var date = [4, 5, 16];
    for(var i = 0; i < 3; i++) {
        error = validare_input(date[i], error);
    }

    password = document.getElementById("password").value;
    re_password = document.getElementById("re_password").value;
    
    if(error === 0) {
        if(password != "" && re_password != "") {
            /* Trimitem datele la server folosind XMLHttpRequest */
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("err2").innerHTML = this.response;
                }
            };
            xmlhttp.open("POST", "php/setari_exec.php", true);
            xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xmlhttp.send(   "flag=2" +
                            "&password=" + firstname +
                            "&re_password=" + lastname
                        );
        } else {
            print_pass_err("Toate campurile trebuie sa fie completate!");
        }
    } else {
            print_pass_err("Toate campurile trebuie sa fie completate corect!");
    }
}

function schimba_email() {
    var error = 0;
    var date = [2, 3];
    for(var i = 0; i < 2; i++) {
        error = validare_input(date[i], error);
    }

    email = document.getElementById("email").value;
    re_email = document.getElementById("re_email").value;
    
    if(error === 0) {
        if(email != "" && re_email != "") {
            /* Trimitem datele la server folosind XMLHttpRequest */
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("err3").innerHTML = this.response;
                }
            };
            xmlhttp.open("POST", "php/setari_exec.php", true);
            xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xmlhttp.send(   "flag=2" +
                            "&email=" + email +
                            "&re_email=" + re_email
                        );
        } else {
            print_email_err("Toate campurile trebuie sa fie completate!", "err1");
        }
    } else {
            print_email_err("Toate campurile trebuie sa fie completate corect!", "err1");
    }
}
