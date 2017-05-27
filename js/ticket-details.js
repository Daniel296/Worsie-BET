function ticket_details(id_ticket) {
    /* Trimitem datele la server folosind XMLHttpRequest */
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('id03').style.display = 'block';
            document.getElementById("ticket_details").innerHTML = this.response;
        }
    };
    xmlhttp.open("POST", "php/ticket_details.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send("id=" + id_ticket);
}
