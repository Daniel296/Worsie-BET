function add_race(id_race, id_horse, id_jockey, horse_name, race_name, date, time, odd) {
	var count = array.length;

    /* Daca a fost eroarea de must login afisata atunci o stergem */
    document.getElementById("log-err").innerHTML  = "";

	/* Verificam daca s-a pus deja */
	for(var i = 0; i < count; i++) {
		/* Daca a pus deja pariu pe aceasta cursa atunci inlocuim informatiile anterioare cu informatiile curente */
		if(array[i]['id_race'] === id_race) {
			total_odd /= array[i]['odd'];

			/* Setam background diferentiat daca calul nu se afla pe bilet */
			if(array[i]['id_horse'] != id_horse)
				document.getElementById("button-" + array[i]['id_race'] + "-" + array[i]['id_horse']).style.backgroundColor = "#333333";
			document.getElementById("button-" + id_race + "-" + id_horse).style.backgroundColor = "#670011";

			array[i] = {'id_race': id_race,
						'id_horse': id_horse,
						'id_jockey': id_jockey,
						'horse_name': horse_name,
						'race_name': race_name,
						'date': date,
						'time': time,
						'odd': odd.toPrecision(3)
						};
			total_odd *= odd;
			total_win = document.getElementById("total_bet").value;
			total_win *= total_odd;
			break;
		}
	}

	/* Daca nu s-a mai pus pariu pe cursa curenta atunci adaugam in array informatiile */
	if(i == count) {
		array[count] = {};
		array[count] = {'id_race': id_race,
						'id_horse': id_horse,
						'id_jockey': id_jockey,
						'horse_name': horse_name,
						'race_name': race_name,
						'date': date,
						'time': time,
						'odd': odd.toPrecision(3)
					};
		total_odd *= odd;
		total_win = document.getElementById("total_bet").value;
		total_win *= total_odd;

		/* Setam background diferentiat daca calul nu se afla pe bilet */
		document.getElementById("button-" + id_race + "-" + id_horse).style.backgroundColor = "#670011";
	}

	/* Afisam cursele pe bilet */
	display_races_ticket(array, total_odd, total_win);
}

function delete_race(id_race, id_horse) {
    /* Daca a fost eroarea de must login afisata atunci o stergem */
    document.getElementById("log-err").innerHTML  = "";

	/* Cautam cursa care trebuie stearsa */
	for(var i = 0; i < array.length; i++) {
		if(array[i]['id_race'] === id_race && array[i]['id_horse'] === id_horse) {
			total_odd /= array[i]['odd'];		// actualizam cota
			total_win = document.getElementById("total_bet").value;
			total_win *= total_odd;				// actualizam castigul total

			array.splice(i, 1);					// stergem cursa din array
            if(document.getElementById("button-" + id_race + "-" + id_horse) != null)
			         document.getElementById("button-" + id_race + "-" + id_horse).style.backgroundColor = "#333333";	// schimbam background-ul butonului
			break;
		}
	}

	/* Actualizam detaliile de pe bilet */
	display_races_ticket(array, total_odd, total_win);
}

function create_ticket(user_balance, id_user) {
    var date = new Date();
    if(array.length === 0) {
        document.getElementById("races-on-ticket").innerHTML = '';
        document.getElementById("log-err").innerHTML  = "<p>Selecta&#355i cel pu&#355in o cursă!</p>";
    }
    else {
        if(id_user === '') {
            document.getElementById("log-err").innerHTML  = "<p>Trebuie să fi&#355i logat pentru a putea plasa bilete!</p>";
        }
        else {
            if(total_win === 0) {
                document.getElementById("log-err").innerHTML  = "<p>Adăuga&#355i suma pe care o paria&#355i!</p>";
            }
        }
    }

	var user_balance = parseFloat(document.getElementById("balance").innerHTML);
    var total_bet = document.getElementById("total_bet").value;     // suma pariata
	var diferenta = user_balance - total_bet;
	if(diferenta < 0) {
		document.getElementById("log-err").innerHTML  = "<p>Nu ave&#355i suficien&#355i bani!</p>";
	}
	else {
	    if( id_user != '' && total_win != 0) {
	         /* Formam codul biletului <id_user><luna><milisecunde><ora><suma_depusa + suma_castig><ziua><minute><secunde> */
	         var ticket_code = id_user + date.getMonth() + date.getMilliseconds() + date.getHours() + (total_bet + total_win).toString().split('.')[0] + date.getDay() + date.getMinutes() + date.getSeconds();

	         insert_statement = "INSERT INTO bilete(id_user, status, suma_depusa, suma_castig, cod, pariuri, cota) VALUES " +
	                    "(" + id_user + ", 0, " + total_bet + ", " + total_win + ", '" + ticket_code + "', '";

			 for(var i = 0; i < array.length; i++) {
	            insert_statement += array[i]['id_race'] + "." + array[i]['id_horse'] + "." + array[i]['id_jockey'] + " ";
	         }
	         //insert_statement.substring(0, insert_statement.length - 3);    //scoatem ultimul spatiu
			 insert_statement = insert_statement.slice(0, -1);
	         insert_statement += "', " + total_odd + ")";

			 /*Resetam background-ul la butoane, pentru ca vor fi sterse toate cursele */
			 set_background(array, 0);

			 /*Stergem continutul array-ului */
			 array = [];
			 myJSON = JSON.stringify(array);
		     sessionStorage.setItem("array", myJSON);

			 /* Resetam suma pariata si afisam informatiile*/
			 document.getElementById("total_bet").value = 0;
			 display_races_ticket(array, 1.0, 0.0);

			 /* Trimitem datele la server folosind XMLHttpRequest */
			 var xmlhttp = new XMLHttpRequest();
	         xmlhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
	                document.getElementById("log-err").innerHTML = "<center>Biletul a fost plasat cu succes!</center>";
					document.getElementById("balance").value = parseFloat(user_balance - total_bet).toFixed(2) + " RON";
	            }
	         };
	         xmlhttp.open("POST", "php/insert-ticket.php", true);
			 xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	         xmlhttp.send("insert_ticket=" + insert_statement + "&bet_count=" + total_bet + "&id=" + id_user);
	    }
	}

}

function display_races_ticket(array, total_odd, total_win) {
	text = "";

    if(array.length == 0) {
        document.getElementById("log-err").innerHTML = "<p>Nu a&#355i selectat nicio cursă!</p>";
    }

	for (var i = 0; i < array.length; i++) {
		text += "<div class=\"race-on-ticket\">" +
					"<div class=\"race-on-ticket-details\">" +
							"<span class=\"top-left\">" + array[i]['horse_name'] + "</span>" +
							"<span class=\"bottom-left\">" + array[i]['race_name'] + " " + array[i]['time'] + " / " + array[i]['date'] + "</span>" +
					"</div>" +
					"<div class=\"race-on-ticket-cota\">" +
						"<span class=\"cota-ticket\">" + array[i]['odd'] + "</span>" +
						"<span onclick=\"delete_race('" + array[i]['id_race'] + "', '" + array[i]['id_horse'] + "')\" class=\"close-thik\" title=\"Close Modal\">&times;</span>" +
					"</div>" +
				"</div>";
	}

	document.getElementById("races-on-ticket").innerHTML = text;
	document.getElementById("total_odd").innerHTML = total_odd.toFixed(2);
	document.getElementById("total_win").innerHTML = total_win.toFixed(2) + " RON";
}

function get_total_odd(array) {
    var total_odd = 1.0;
    for(var i = 0; i < array.length; i++) {
        total_odd *= array[i]['odd'];
    }
    return total_odd;
}

function get_total_win() {
	total_win = document.getElementById("total_bet").value;
	total_win *= total_odd;
	document.getElementById("total_win").innerHTML = total_win.toFixed(2) + " RON";
}

function set_background(array, flag) {
	for(var i = 0; i < array.length; i++) {
		if(	document.getElementById("button-" + array[i]['id_race'] + "-" + array[i]['id_horse']) != null) {
			if(flag == 1)
				document.getElementById("button-" + array[i]['id_race'] + "-" + array[i]['id_horse']).style.backgroundColor = "#670011";
			else
				document.getElementById("button-" + array[i]['id_race'] + "-" + array[i]['id_horse']).style.backgroundColor = "#333333";
		}
	}
}

window.onbeforeunload = function() {
    myJSON = JSON.stringify(array);
    sessionStorage.setItem("array", myJSON);
    sessionStorage.setItem("bet", document.getElementById("total_bet").value);
}


/* Citim array-ul din session storage */
if (sessionStorage.getItem("array") != null){
    myJSON = sessionStorage.getItem("array");
    array = JSON.parse(myJSON);

    var total_win = sessionStorage.getItem("bet");
    document.getElementById("total_bet").value = total_win;
}
else {
    var array = [];
    var total_win = document.getElementById("total_bet").value;

    myJSON = JSON.stringify(array);
    sessionStorage.setItem("array", myJSON);
    sessionStorage.setItem("bet", 0.0)
}

var total_odd = get_total_odd(array);
total_win *= total_odd;

/* Afisam cursele pe bilet (daca sunt) */
if(array.length != 0) {
     display_races_ticket(array, total_odd, total_win);
}

/* Setam precizia variabilelor */
total_odd.toPrecision(3);
total_win.toPrecision(3);

/* Coloram butoanele cotelor */
set_background(array, 1);
