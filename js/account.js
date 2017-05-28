function validate_register_data(flag) {
    /* flag este un numar de la 1 la 13 indentificant inputul pe care il primeste*/
    document.getElementById("reg-err").innerHTML = "";
    error = false;

    switch (flag) {
        case 1:
            var input = document.getElementById("username").value.toString();
            if(input.length < 6 || input.length > 30) {
                print_error("Username-ul trebuie sa aiba intre 6 si 30 de caractere!");
                error = true;
            }
            else {
                var regex = /^\w+$/;
                if(!regex.test(input)) {
                    print_error("Username-ul trebuie sa contina doar litere, cifre si caracterul _ ");
                    error = true;
                }
                else { /*Verificam daca username-ul exista deja in baza de date */
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            if(this.response === "1") {
                                print_error("Acest username exista deja!");
                                error = true;
                            }
                        }
                    };
                    xmlhttp.open("POST", "php/validate-register.php", true);
                    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xmlhttp.send("username=" + input);
                }
            }
            break;

        case 2:
                var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                var input = document.getElementById("email").value.toString();
                if(!regex.test(input)) {
                    print_error("Email-ul nu este valid!");
                    error = true;
                }
                else {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            if(this.response === "1") {
                                print_error("Acest email exista deja!");
                                error = true;
                            }
                        }
                    };
                    xmlhttp.open("POST", "php/validate-register.php", true);
                    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xmlhttp.send("email=" + input);
                }
                break;

        case 3:
                var email = document.getElementById("email").value;
                var re_email = document.getElementById("re_email").value;
                if(email != re_email) {
                    print_error("Email-urile nu se potrivesc!");
                    error = true;
                }
                break;

        case 4:
                var input = document.getElementById("password").value.toString();

                if(input.length < 8 ) {
                    print_error("Parola trebuie sa aiba cel putin 8 caractere!");
                    error = true;
                    break;
                }

                var regex = /[0-9]/;
                if(!regex.test(input)) {
                    print_error("Parola trebuie sa contina cel putin o cifra (0-9)!");
                    error = true;
                    break;
                }
                else password = input.toString();

                regex = /[a-z]/;
                if(!regex.test(input)) {
                    print_error("Parola trebuie sa contina cel putin o litera mica (a-z)!");
                    error = true;
                    break;
                }
                else password = input;

                regex = /[A-Z]/;
                if(!regex.test(input)) {
                    print_error("Parola trebuie sa contina cel putin o litera mare (A-Z)!");
                    error = true;
                    break;
                }
                break;

        case 5:
                var password = document.getElementById("password").value;
                var re_password = document.getElementById("re_password").value;
                if(password != re_password) {
                    print_error("Parolele nu se potrivesc");
                    error = true;
                }
                break;

        case 6:
                var input = document.getElementById("lastname").value.toString();
                var regex = /^[A-Z][a-z]*(-|\s)[A-Z][a-z]*$/;
                var regex1 = /^[A-Z][a-z]*$/;
                if(!regex.test(input) && !regex1.test(input)) {
                    print_error("Numele ar trebui sa contina doar litere si sa inceapa cu litera mare!");
                    error = true;
                }
                break;

        case 7:
                var input = document.getElementById("firstname").value.toString();
                var regex = /^[A-Z][a-z]*(-|\s)[A-Z][a-z]*$/;
                var regex1 = /^[A-Z][a-z]*$/;
                if(!regex.test(input) && !regex1.test(input)) {
                    print_error("Prenumele ar trebui sa contina doar litere si sa inceapa cu litera mare!");
                    error = true;
                }
                break;

        case 8:
                var input = document.getElementById("county").value.toString();
                var regex = /^[A-Z][a-z]*(-|\s)[A-Z][a-z]*$/;
                var regex1 = /^[A-Z][a-z]*$/;
                if(!regex.test(input) && !regex1.test(input)) {
                    print_error("Ati introdus un judet invalid!");
                    error = true;
                }
                break;

        case 9:
                var input = document.getElementById("city").value.toString();
                var regex = /^[A-Z][a-z]*(-|\s)[A-Z][a-z]*$/;
                var regex1 = /^[A-Z][a-z]*$/;
                if(!regex.test(input) && !regex1.test(input)) {
                    print_error("Ati introdus un oras invalid!");
                    error = true;
                }
                break;

        case 10:
                var input = document.getElementById("address").value.toString();
                var regex = /^[A-Za-z0-9\s,\.-]*$/;
                if(!regex.test(input)) {
                    print_error("Ati introdus o adresa invalida!");
                    error = true;
                }
                break;

        case 11:
                var input = document.getElementById("country").value.toString();
                var regex = /^[A-Z][a-z]*(-|\s)[A-Z][a-z]*$/;
                var regex1 = /^[A-Z][a-z]*$/;
                if(!regex.test(input) && !regex1.test(input)) {
                    print_error("Ati introdus un nume de tara invalid!");
                    error = true;
                }
                break;

        case 12:
                var input = document.getElementById("phone").value.toString();
                var regex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
                if(!regex.test(input)) {
                    print_error("Ati introdus un numar de telefon invalid!");
                    error = true;
                }
                break;

        case 13:
                birthday = document.getElementById("bday").value;
                break;
    }
}

function print_error(error) {
    document.getElementById("reg-err").innerHTML = "*" + error;
    error = true;
}


function register_user() {
    for(var i = 0; i < 14; i++)
        validate_register_data(i);

    /* Luam toate datele necesare pentru inregistrare*/
    username = document.getElementById("username").value;
    email = document.getElementById("email").value;
    password = document.getElementById("password").value;
    firstname = document.getElementById("firstname").value;
    lastname = document.getElementById("lastname").value;
    city = document.getElementById("city").value;
    county = document.getElementById("county").value;
    address = document.getElementById("address").value;
    country = document.getElementById("country").value;
    phone = document.getElementById("phone").value;
    birthday = document.getElementById("bday").value;


    /* verificam ca toate field-urile sa fie completate*/
     if(document.getElementById('terms').checked) {
         if(username != "" && email != "" && password != "" && firstname != "" && lastname != "" &&
             city != "" && county != "" && country != "" && address != "" && phone != "" && birthday != "") {

            /* Trimitem datele la server folosind XMLHttpRequest */
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("reg-err").innerHTML = this.response;
                }
            };
            xmlhttp.open("POST", "php/login-register.php", true);
            xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xmlhttp.send("username=" + username + "&email=" + email + "&password=" + password + "&firstname=" + firstname +
                "&lastname=" + lastname + "&city=" + city + "&county=" + county + "&address=" + address + "&phone=" + phone + "&birthday=" + birthday);
        }
        else {
            print_error("Toate campurile trebuie sa fie completate");
        }
    }
    else {
        print_error("Trebuie sa acceptati Termenii si Conditiile de utilizare ai serviciului!");
    }
}

var error = false;
/* Luam toate datele necesare pentru*/
// var username = ""
// var email = "";
// var password = "";
// var firstname = "";
// var lastname = "";
// var city = "";
// var county = "";
// var country = "";
// var address = "";
// var phone = "";
// var birthday = "";

// var username = document.getElementById("username").value;
// var email = document.getElementById("email").value;
// var password = document.getElementById("password").value;
// var firstname = document.getElementById("firstname").value;
// var lastname = document.getElementById("lastname").value;
// var city = document.getElementById("city").value;
// var county = document.getElementById("county").value;
// var address = document.getElementById("address").value;
// var phone = document.getElementById("phone").value;
// var birthday = document.getElementById("birthday").value;
