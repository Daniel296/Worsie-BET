var error = 0;

function mesajEroare(id) {
    switch(id) {
        case "2":
            return "Email invalid.";
            break;

        case "3":
            return "Email vechi invalid";
            break;

        case "campuri necompletate":
            return "Toate câmpurile trebuie completate";
            break;

        case "campuri completate incorect":
            return "Toate câmpurile trebuie completate corect.";
            break;

        default:
            return id;
            break;
    }
}

function validare_input(flag, error) {
    switch (flag) {
        case 2: // EMAIL
                var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                var input = document.getElementById("current_email").value.toString();
                if(!regex.test(input)) {
                    print_email_err(mesajEroare("Email actual invalid"));
                    error = 2;
                }
                else {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            if(this.response === "1") {
                                print_email_err(mesajEroare("Acesta nu este email'ul tau"));
                                error = 2;
                            }
                        }
                    }
                    xmlhttp.open("POST", "./php/validate-data.php", true);
                    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xmlhttp.send("current_email=" + input);
                }
                break;

        case 3: // new_EMAIL
                var current_email = document.getElementById("current_email").value;
                var new_email = document.getElementById("new_email").value;
                if(current_email != new_email) {
                    var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    var input = document.getElementById("new_email").value.toString();
                    if(!regex.test(input)) {
                        print_email_err(mesajEroare("Email nou invalid."));
                        error = 3;
                    }
                    else {
                            var xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                if(this.response === "1") {
                                    print_email_err(mesajEroare("Acest email exista deja."));
                                    error = 3;
                                }
                            }
                        }
                        
                    }
                    xmlhttp.open("POST", "./php/validate-data.php", true);
                    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xmlhttp.send("email=" + input);
                }
                else {
                    print_email_err(mesajEroare("Email-urile trebuie sa fie diferite."));
                    error = 3;
                }
                break;
        
        case 4: // CURRENT_PASSWORD
                var input = document.getElementById("current_password").value;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        if(this.response === "1") {
                            print_pass_err(mesajEroare("Acesta nu este parola ta actuală."));
                            error = 3;
                        }
                    }
                }
                xmlhttp.open("POST", "./php/validate-data.php", true);
                xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xmlhttp.send("current_password=" + input);
                break;

        case 5: // NEW_PASSWORD
                var current_password = document.getElementById("current_password").value;
                var new_password = document.getElementById("new_password").value;
                if(password === new_password) {
                    print_pass_err(mesajEroare("Alege o parolă diferită."));
                    error = 5;
                    break;
                }
                else {
                    if(new_password.length < 8 ) {
                        print_register_error1("Noua parolă trebuie să aibă cel pu&#355in 8 caractere!  ");
                        error = 5;
                        break;
                    }

                    var regex = /[0-9]/;
                    if(!regex.test(new_password)) {
                        print_register_error1("Noua parolă trebuie să con&#355ina cel pu&#355in o cifră (0-9)!");
                        error = 5;
                        break;
                    }

                    regex = /[a-z]/;
                    if(!regex.test(new_password)) {
                        print_register_error1("Noua parolă trebuie să con&#355ină cel pu&#355in o literă mică (a-z)!");
                        error = 5;
                        break;
                    }

                    regex = /[A-Z]/;
                    if(!regex.test(new_password)) {
                        print_register_error1("Noua parolă trebuie să con&#355ină cel pu&#355in o literă mare (A-Z)!");
                        error = 5;
                        break;
                    }
                }
                break;

        case 6: // LASTNAME
                var input = document.getElementById("lastname").value.toString();
                var regex = /^[A-Z][a-z]*(-|\s)[A-Z][a-z]*$/;
                var regex1 = /^[A-Z][a-z]*$/;
                if(!regex.test(input) && !regex1.test(input)) {
                    print_date_err(mesajEroare("Numele trebui să contină doar litere si să inceapă cu literă mare!"));
                    error = 6;
                }
                break;

        case 7: // FIRSTNAME
                var input = document.getElementById("firstname").value.toString();
                var regex = /^[A-Z][a-z]*(-|\s)[A-Z][a-z]*$/;
                var regex1 = /^[A-Z][a-z]*$/;
                if(!regex.test(input) && !regex1.test(input)) {
                    print_date_err(mesajEroare("Prenumele ar trebui să contină doar litere si să inceapă cu literă mare!"));
                    error = 7;
                }
                break;

        case 8: // COUNTY
                var input = document.getElementById("county").value.toString();
                var counties = ['alba', 'arad', 'arges', 'bacau', 'bihor', 'bistrita nasaud', 'botosani', 'braila', 'brasov', 'bucuresti', 'buzau', 'calarasi', 'caras', 'severin', 'cluj', 'constanta', 'covasna', 'dambovita',
                                'dolj', 'galati', 'giurgiu', 'gorj', 'harghita', 'hunedoara', 'ialomita', 'iasi', 'ilfov', 'maramures', 'mehedinti', 'mures', 'neamt', 'olt', 'prahova', 'salaj', 'satu mare', 'sibiu', 'suceava', 'teleorman',
                                'timis', 'tulcea', 'valcea', 'vaslui', 'vrancea'];

                if(counties.indexOf(input.toLowerCase()) === -1) {
                    print_date_err(mesajEroare("A&#355i introdus un jude&#355 invalid!"));
                    error = 8;
                }
                break;

        case 9: // CITY
                var input = document.getElementById("city").value.toString();
                var regex = /^[A-Z][a-z]*(-|\s)[A-Z][a-z]*$/;
                var regex1 = /^[A-Z][a-z]*$/;
                if(!regex.test(input) && !regex1.test(input)) {
                    print_date_err(mesajEroare("Oras invalid!"));
                    error = 9;
                }
                break;

        case 10: // ADDRESS
                var input = document.getElementById("address").value.toString();
                var regex = /^[A-Za-z0-9\s,\.-]*$/;
                if(!regex.test(input)) {
                    print_date_err(mesajEroare("Adresă invalidă!"));
                    error = 10;
                }
                break;

        case 11: // COUNTRY
                var input = document.getElementById("country").value.toString();
                var regex = /^[A-Z][a-z]*(-|\s)[A-Z][a-z]*$/;
                var regex1 = /^[A-Z][a-z]*$/;
                if(!regex.test(input) && !regex1.test(input)) {
                    print_date_err(mesajEroare("Tară invalidă!"));
                    error = 11;
                }
                break;

        case 12: // PHONE
                var input = document.getElementById("phone").value.toString();
                var regex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
                if(!regex.test(input)) {
                    print_date_err(mesajEroare("Număr de telefon invalid!"));
                    error = 12;
                }
                break;
        case 13: // CONFIRM_PASSWORD
                var input = document.getElementById("new_password").value.toString();

                
                break;
    }
    return error;
}


function print_date_err(error_msg) {
    document.getElementById("settings_err1").innerHTML = "* " + error_msg + "<br>";
}


function print_pass_err(error_msg) {
    document.getElementById("settings_err2").innerHTML = "* " + error_msg + "<br>";
}


function print_email_err(error_msg) {
    document.getElementById("settings_err3").innerHTML = "* " + error_msg + "<br>";
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
            // Trimitem datele la server folosind XMLHttpRequest
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if(this.response === "0") {
                        window.location = "./profile.php?page=account";
                    }
                    else
                        document.getElementById("settings_err1").innerHTML = "Datele nu au putut fi schimbate din cauza unor erori.";
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
            print_date_err(mesajEroare("campuri necompletate"));
        }
    } else {
            print_date_err(mesajEroare("campuri completate incorect"));
    }
}

function schimba_parola() {
    var error = 0;
    var date = [4, 5, 16];
    for(var i = 0; i < 3; i++) {
        error == validare_input(date[i]);
    }

    current_password = document.getElementById("current_password").value;
    new_password = document.getElementById("new_password").value;
    confirm_password = document.getElementById("confirm_password").value;
    
    if(error === 0) {
        if(current_password != "" && new_password != "" && confirm_password != "") {
            /* Trimitem datele la server folosind XMLHttpRequest */
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if(this.response === "0")
                        window.location = "./profile.php?page=account";
                    else
                        document.getElementById("settings_err2").innerHTML = "Parola nu a putut fi modificată din cauza unor erori.";
                }
            };
            xmlhttp.open("POST", "php/setari_exec.php", true);
            xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xmlhttp.send(   "flag=2" +
                            "&current_password=" + current_password +
                            "&new_password=" + new_password
                        );
        } else {
            print_pass_err(mesajEroare("campuri necompletate"));
        }
    } else {
            print_pass_err(mesajEroare("campuri completate incorect"));
    }
}

function schimba_email() {
    var error = 0;
    var x = 100;
    for(var i = 2; i < 4; i++) {
        error = validare_input(i, error);
    }

    current_email = document.getElementById("current_email").value;
    new_email = document.getElementById("new_email").value;
    
    if(error === 0) {
        if(current_email != "" && new_email != "") {
            /* Trimitem datele la server folosind XMLHttpRequest */
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if(this.response === "0") {
                        window.location = "./profile.php?page=account";
                    }
                    else
                        document.getElementById("settings_err3").innerHTML = "Email-ul nu a putut fi schimbat din cauza unor erori.";
                }
            };
            xmlhttp.open("POST", "./php/setari_exec.php", true);
            xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xmlhttp.send(   "flag=3" +
                            "&current_email=" + current_email +
                            "&new_email=" + new_email
                        );
        } else {
            print_email_err(mesajEroare("campuri necompletate"));
        }
    } else {
            print_email_err(mesajEroare("campuri completate incorect"));
    }
}
