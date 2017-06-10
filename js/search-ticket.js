function search_ticket() {
    var pin = document.getElementById('ticket-code').value;

    if(pin != "") {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(this.response != "0") {
                    document.getElementById('id10').style.display = 'block';
                    document.getElementById("ticket_details").innerHTML = this.response;
                }
                else {
                    print_error("Acest bilet nu există!");
                }
            }
        };
        xmlhttp.open("POST", "php/search-ticket.php", true);
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xmlhttp.send("pin=" + pin);
    }
    else {
        print_error("Introduce&#355i PIN-ul biletului");
    }
}

function print_error(err) {
    document.getElementById('search-err').innerHTML = "<center>*" + err + "</center>";
}
