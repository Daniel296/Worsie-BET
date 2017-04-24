<!DOCTYPE HTML>
<html>
<head>
	<title>Pariuri - WorsieBet</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style-header.css">
	<link rel="stylesheet" type="text/css" href="css/popup-style.css">
</head>
<body>

	<?php
		require('pages/header.php');
	?>

	<div class="fixed-wrapper">
		<div class="check-ticket">
			<p>Verificati bilet</p>
			<form method="POST">
				<input type="text" name="PIN" placeholder="Introduceti PIN-ul biletului">
				<button type="submit">Verificati</button>
			</form>
		</div>

		<div class="bet-ticket">
			<p>Plaseaza bilet</p>
			<div class="race-on-ticket">
				<div class="race-on-ticket-details">
					<span class="top-left">Burtonwood</span>
					<span class="bottom-left">Ludlow 15:30 / 18.04</span>
				</div>
				<div class="race-on-ticket-cota">
					<span class="cota-ticket">4.75</span>
					<a href="#" class="close-thik"></a>
				</div>
			</div>
			<div class="race-on-ticket">
				<div class="race-on-ticket-details">
					<span class="top-left">Pushkin Museum</span>
					<span class="bottom-left">Ludlow 15:30 / 18.04</span>
				</div>
				<div class="race-on-ticket-cota">
					<span class="cota-ticket">4.33</span>
					<a href="#" class="close-thik"></a>
				</div>
			</div>
			<div class="race-on-ticket">
				<div class="race-on-ticket-details">
					<span class="top-left">Mr Chuckles</span>
					<span class="bottom-left">Ludlow 15:30 / 18.04</span>
				</div>
				<div class="race-on-ticket-cota">
					<span class="cota-ticket">8.33</span>
					<a href="#" class="close-thik"></a>
				</div>
			</div>
			<div class="total">
					<span style="float: left;">Cota totala: </span>
					<span style="float: right;">18.45</span><br>
			</div>
			<div class="total">
					<span style="float: left;">Castig potential: </span>
					<span style="float: right;">200 RON</span><br>
			</div>
			<div class="ticket-form">
				<form method="POST">
					<span>RON:</span>
					<input type="text" placeholder="TOTAL">

					<button type="submit">Trimiteti</button>
				</form>
			</div>
		</div>
	</div>


<div id="main-pariuri">
	<div class="show-bets-day">
		<ul>
			<?php
				$num_day = getdate();
				$days = array(0 => "Luni", 1 => "Marti", 2 => "Miercuri", 3 => "Joi", 4 => "Vineri", 5 => "Sambata", 6 => "Duminica");
				
				$day = date("Y-m-d", time() - 86400);
				echo "<li><a href =\"Pariuri.php?date=$day\">Ieri</a></li>";
				
				$day = date("Y-m-d", time());
				echo "<li class=\"active\"><a href =\"Pariuri.php?date=$day\">Azi</a></li>";
				
				$day = date("Y-m-d", time() + 86400);
				echo "<li><a href =\"Pariuri.php?date=$day\">Maine</a></li>";
				
				$day = date("Y-m-d", time() + 2 * 86400);
				echo "<li><a href =\"Pariuri.php?date=$day\">".$days[($num_day['wday'] + 8) % 7 ]."</a></li>";
				
				$day = date("Y-m-d", time() + 3 * 86400);
				echo "<li><a href =\"Pariuri.php?date=$day\">".$days[($num_day['wday'] + 9) % 7 ]."</a></li>";
				
			?>
		</ul>
	</div>
	
	<div class="bets">
		<div class="bet">
			<a href="">Newmarket</a>
			<div class="times">
				<span>13:20</span>
				<span>14:20</span>
				<span>15:20</span>
				<span>16:20</span>
				<span>17:10</span>
				<span>18:20</span>
				<span>19:20</span>
			</div>
		</div>
		
		<div class="bet">
			<a href="">Kempton</a>
			<div class="times">
				<span>13:20</span>
				<span>14:20</span>
				<span>15:20</span>
				<span>16:20</span>
				<span>17:10</span>
				<span>18:20</span>
				<span>19:20</span>
			</div>
		</div>
		
		<div class="bet">
			<a href="" >Fairyhouse</a>
			<div class="times">
				<span>13:20</span>
				<span>14:20</span>
				<span>15:20</span>
				<span>16:20</span>
				<span>17:10</span>
				<span>18:20</span>
				<span>19:20</span>
			</div>
		</div>
		
		<div class="bet">
			<a href="">Ludlow</a>
			<div class="times">
				<span>13:20</span>
				<span>14:20</span>
				<span>15:20</span>
				<span>16:20</span>
				<span>17:10</span>
				<span>18:20</span>
				<span>19:20</span>
			</div>
		</div>
	</div>
	
	<div class ="bet-details">
		<div class="bet-race-bar">
			Ludlow
			<span>15:30</span> 
			<span class="weather">Meteo: 10&#176;C - innorat</span>
		</div>
		<div class="bet-details-head">
			<div class="collumn1">
				<span class="top">Nr.</span>
				<span class="bottom">(Staul)</span>
			</div>
			<div class="collumn2">
				<span class="top">Vesta Jocheu</span>
			</div>
			<div class="collumn3">
				<span class="top-left">Cal</span>
				<span class="bottom-left">Antrenor/Jocheu</span>
			</div>
			<div class="collumn2">
				<span class="top">Sanse de castig</span>
			</div>
			<div class="collumn1">
				<span class="top">Greutate</span>
				<span class="bottom">Varsta</span>
			</div>
			<div class="collumn2">
				<span class="top">Cota</span>
			</div>
		</div>
		<div class="bet-details-body">
			<div class="team">
				<div class="collumn1">
					<span class="top">1</span>
					<span class="bottom">(6)</span>
				</div>
				<div class="collumn2">
					<img alt="vesta-jocheu" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB0AAAAVCAYAAAC6wOViAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RjUyRjkxMjIxQzZCMTFFNzhEQzY5MkYxRjNFQkM0QjIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RjUyRjkxMjMxQzZCMTFFNzhEQzY5MkYxRjNFQkM0QjIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpGNTJGOTEyMDFDNkIxMUU3OERDNjkyRjFGM0VCQzRCMiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpGNTJGOTEyMTFDNkIxMUU3OERDNjkyRjFGM0VCQzRCMiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PlYotusAAAVbSURBVHjanFVdbBRVFP7unZmd3dnddtvSH1tpXSjQf/4KxBKefDAGMGDAX0gaYiQkAg/EByCaKC/EGGIEfbDBoBJNBU2RRmlBsBKhGisUbCnt1rKU0lJr2e3+zszOXO9M2dLoC+vJnszsnHPPueec75xDMItycgBFAZJJkKoKLDOYtEVUXM95sqmLMWamUgQL/RrqanR8fdoNKjBQCmKkCLk3onYrjuSngQA7rWsIx5MEahJCw5PYs3cftmdlQWlqQktLC/aRfzl1+v1kfe4c+TWDuNcsKGfy+nVJFBWZXMoQCov4+pSC+fN0xOIEG9bGoaoEqRRw8aIDP3fKSMbUP2NTsS+vdRsfcFvPdHSwY1YwaWpsJEfF2U4lp/RykT/n6OJqA5s2RrGkTrUimaFIVEf7Dw4kE0DNogQWV6szsoaVSYyPC/iuXZl35lz+/lAkvnLzpohhOWRsWofwEHfvZmt5cgTYzCmk5ddHVAmvNk5i2ZJph9aB9CHTtJif5D89NZ2ktNziggIDjVsiqK2OYmSiqI5ALMF/iVEwbsliwKmR3GXhmAfDtx8azJSsLPQHRCTl3KxvvpUGE3EwK0LyoJBNTeScFYtdLxCaB9m7MJTwoKdPxP+loSDFjSEvNEeW68o192jnZQTSsjt3gNZWnKCgDoBK3KlrAVTZF40QdHa57OAJydzpzX4B0agIGrfqke3ZuQu7mpvJzbY2MrZ9O3lreBitIsyUrVxRqa14Y28XqV8cx6GPvAgOC3iizMjY6R99TuzbeRdlpWP45DOhpvlzdOzYgVqXCwpHedjSEQlhdu02PKuv2LZVtw+Wzk3heq+UkVMrKymuHrwNbH1R505NeN1YcOoE8d+/j16O4rD6AOy0oABwu5HdsBoVaQOL5mvo7RMyjnJwUODQEG2HFlVWwlNaiirrfWICCPM4BW5WvHcP8HhYwcCQs+zgYR+y3QmsWRHFpd88vOljEMVHR3FXt4yyuTquXpVwvCUfy2tjyM2LrPLlsJMOx3Q2PF7u1EJuNKH497y5KgsqlzhMPPX0ABRhChN/CygqfPQUj08I6BuQcOjjOkwGuXUHbw5zsFJQ++3eTpMoyRTFj7OVG17ox9KqEL5qfQxnfynB6uq4PQwyIVEyeVnyIQomDr1/Gboho62dLjzfCg+lJDqjp6sMW19KrjpwYMT+8MrzARw4OIK2Cx6ejsx6RlVFlJeN4tiRAGrrpjO0eR2Kl/xEqiIR/Co8gIk1WX0NDazy4W2BwrxkLJUyDWTYpybjg4+qU8XFxkxNCgvh5oCqsnBhLQaLaU018ztkWvD9WQWXLku2YmcnOnmQGjIcgxZYBgbI74EARuJ8CzWfVHi/O1BezuqtosrOaRYHgkrFptdrvaFJN3zuOHZt69P6boS65Bw0ZDp6RZ4+XWPB41+I6Hm3vPTCjyVw5qUgq8FKQbglGQaxBwFV4V0a0n2g2RRTQjbeea9y9NaQeN3pZDTjRuXlcDqNqSMfFndfuOLnQ4AvAOpE2JhTZZgkN6UzWEyp4lsuWKMXJt9wPDY5OsZYapSDSErjaPaTUGbvB1FkD7+RdKR8ulEHgUO7KsgaCC+kQA0IilIIwVkBItpzXoQglcDQ+B/B/kC0SD8HUziRoHRwSILGRbpO7NTdD1HEYhS+bBO37zgwcjeFRHLao+IyMTbOz7OkhORkr91vogwYPKOmQYhDqeLvHdYNRXMisJHGJji6zHo4fatJcrJd9gD5Odpf+9/2MFE0ZwaSrlFUlGsoK9ZwuMmL1jPSrNXMgSQTd0Feiu8X1sMmg+d5xu5CjV3iF7jO1EhPWvUfAQYAgK0y6Ujp6AwAAAAASUVORK5CYII=">
				</div>
				<div class="collumn3">
					<span class="top-left">Burtonwood</span>
					<span class="bottom-left">P Morris/Kieran Schofield</span>
				</div>
				<div class="collumn2">
					<div class="win-red">
					</div>
				</div>
				<div class="collumn1">
					<span class="top">9-10</span>
					<span class="bottom">Varsta - 6</span>
				</div>
				<div class="collumn2">
					<form method="POST">
						<button name="cota" value="" type="button"><span class="cota">4.75</span></button>
					</form>
				</div>
			</div>
			
			<div class="team">
				<div class="collumn1">
					<span class="top">8</span>
					<span class="bottom">(5)</span>
				</div>
				<div class="collumn2">
					<img alt="vesta-jocheu" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB0AAAAVCAYAAAC6wOViAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RjY1OTk1NEUxQzZCMTFFNzhEQzY5MkYxRjNFQkM0QjIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RjY1OTk1NEYxQzZCMTFFNzhEQzY5MkYxRjNFQkM0QjIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpGNjU5OTU0QzFDNkIxMUU3OERDNjkyRjFGM0VCQzRCMiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpGNjU5OTU0RDFDNkIxMUU3OERDNjkyRjFGM0VCQzRCMiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PjmIuBkAAAakSURBVHjafFZbbBzV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">
				</div>
				<div class="collumn3">
					<span class="top-left">Pushkin Museum</span>
					<span class="bottom-left">D M Loughnane / David Egan</span>
				</div>
				<div class="collumn2">
					<div class="win-green">
					</div>
				</div>
				<div class="collumn1">
					<span class="top">8-9</span>
					<span class="bottom">Varsta - 4</span>
				</div>
				<div class="collumn2">
					<form method="POST">
						<button name="cota" value="" type="button"><span class="cota">4.33</span></button>
					</form>
				</div>
			</div>
			
			<div class="team">
				<div class="collumn1">
					<span class="top">2</span>
					<span class="bottom">(4)</span>
				</div>
				<div class="collumn2">
					<img alt="vesta-jocheu" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB0AAAAVCAYAAAC6wOViAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RjZGOEFCQUUxQzZCMTFFNzhEQzY5MkYxRjNFQkM0QjIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RjZGOEFCQUYxQzZCMTFFNzhEQzY5MkYxRjNFQkM0QjIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpGNkY4QUJBQzFDNkIxMUU3OERDNjkyRjFGM0VCQzRCMiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpGNkY4QUJBRDFDNkIxMUU3OERDNjkyRjFGM0VCQzRCMiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PnfNBj0AAAYgSURBVHjanFZ5bFN1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">
				</div>
				<div class="collumn3">
					<span class="top-left">Mr Chuckles</span>
					<span class="bottom-left">D M Loughnane / David Egan</span>
				</div>
				<div class="collumn2">
					<div class="win-orange">
					</div>
				</div>
				<div class="collumn1">
					<span class="top">9-10</span>
					<span class="bottom">Varsta - 5</span>
				</div>
				<div class="collumn2">
					<form method="POST">
						<button name="cota" value="" type="button"><span class="cota">8.56</span></button>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<div class ="bet-details">
		<div class="bet-race-bar">
			Ludlow
			<span>16:30</span> 
			<span class="weather">Meteo: 12&#176;C - innorat</span>
		</div>
		<div class="bet-details-head">
			<div class="collumn1">
				<span class="top">Nr.</span>
				<span class="bottom">(Staul)</span>
			</div>
			<div class="collumn2">
				<span class="top">Vesta Jochei</span>
			</div>
			<div class="collumn3">
				<span class="top-left">Cal</span>
				<span class="bottom-left">Antrenor/Jocheu</span>
			</div>
			<div class="collumn2">
				<span class="top">Sanse de castig</span>
			</div>
			<div class="collumn1">
				<span class="top">Greutate</span>
				<span class="bottom">Varsta</span>
			</div>
			<div class="collumn2">
				<span class="top">Cota</span>
			</div>
		</div>
		<div class="bet-details-body">
			<div class="team">
				<div class="collumn1">
					<span class="top">1</span>
					<span class="bottom">(6)</span>
				</div>
				<div class="collumn2">
					<img alt="vesta-jocheu" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB0AAAAVCAYAAAC6wOViAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RjUyRjkxMjIxQzZCMTFFNzhEQzY5MkYxRjNFQkM0QjIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RjUyRjkxMjMxQzZCMTFFNzhEQzY5MkYxRjNFQkM0QjIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpGNTJGOTEyMDFDNkIxMUU3OERDNjkyRjFGM0VCQzRCMiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpGNTJGOTEyMTFDNkIxMUU3OERDNjkyRjFGM0VCQzRCMiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PlYotusAAAVbSURBVHjanFVdbBRVFP7unZmd3dnddtvSH1tpXSjQf/4KxBKefDAGMGDAX0gaYiQkAg/EByCaKC/EGGIEfbDBoBJNBU2RRmlBsBKhGisUbCnt1rKU0lJr2e3+zszOXO9M2dLoC+vJnszsnHPPueec75xDMItycgBFAZJJkKoKLDOYtEVUXM95sqmLMWamUgQL/RrqanR8fdoNKjBQCmKkCLk3onYrjuSngQA7rWsIx5MEahJCw5PYs3cftmdlQWlqQktLC/aRfzl1+v1kfe4c+TWDuNcsKGfy+nVJFBWZXMoQCov4+pSC+fN0xOIEG9bGoaoEqRRw8aIDP3fKSMbUP2NTsS+vdRsfcFvPdHSwY1YwaWpsJEfF2U4lp/RykT/n6OJqA5s2RrGkTrUimaFIVEf7Dw4kE0DNogQWV6szsoaVSYyPC/iuXZl35lz+/lAkvnLzpohhOWRsWofwEHfvZmt5cgTYzCmk5ddHVAmvNk5i2ZJph9aB9CHTtJif5D89NZ2ktNziggIDjVsiqK2OYmSiqI5ALMF/iVEwbsliwKmR3GXhmAfDtx8azJSsLPQHRCTl3KxvvpUGE3EwK0LyoJBNTeScFYtdLxCaB9m7MJTwoKdPxP+loSDFjSEvNEeW68o192jnZQTSsjt3gNZWnKCgDoBK3KlrAVTZF40QdHa57OAJydzpzX4B0agIGrfqke3ZuQu7mpvJzbY2MrZ9O3lreBitIsyUrVxRqa14Y28XqV8cx6GPvAgOC3iizMjY6R99TuzbeRdlpWP45DOhpvlzdOzYgVqXCwpHedjSEQlhdu02PKuv2LZVtw+Wzk3heq+UkVMrKymuHrwNbH1R505NeN1YcOoE8d+/j16O4rD6AOy0oABwu5HdsBoVaQOL5mvo7RMyjnJwUODQEG2HFlVWwlNaiirrfWICCPM4BW5WvHcP8HhYwcCQs+zgYR+y3QmsWRHFpd88vOljEMVHR3FXt4yyuTquXpVwvCUfy2tjyM2LrPLlsJMOx3Q2PF7u1EJuNKH497y5KgsqlzhMPPX0ABRhChN/CygqfPQUj08I6BuQcOjjOkwGuXUHbw5zsFJQ++3eTpMoyRTFj7OVG17ox9KqEL5qfQxnfynB6uq4PQwyIVEyeVnyIQomDr1/Gboho62dLjzfCg+lJDqjp6sMW19KrjpwYMT+8MrzARw4OIK2Cx6ejsx6RlVFlJeN4tiRAGrrpjO0eR2Kl/xEqiIR/Co8gIk1WX0NDazy4W2BwrxkLJUyDWTYpybjg4+qU8XFxkxNCgvh5oCqsnBhLQaLaU018ztkWvD9WQWXLku2YmcnOnmQGjIcgxZYBgbI74EARuJ8CzWfVHi/O1BezuqtosrOaRYHgkrFptdrvaFJN3zuOHZt69P6boS65Bw0ZDp6RZ4+XWPB41+I6Hm3vPTCjyVw5qUgq8FKQbglGQaxBwFV4V0a0n2g2RRTQjbeea9y9NaQeN3pZDTjRuXlcDqNqSMfFndfuOLnQ4AvAOpE2JhTZZgkN6UzWEyp4lsuWKMXJt9wPDY5OsZYapSDSErjaPaTUGbvB1FkD7+RdKR8ulEHgUO7KsgaCC+kQA0IilIIwVkBItpzXoQglcDQ+B/B/kC0SD8HUziRoHRwSILGRbpO7NTdD1HEYhS+bBO37zgwcjeFRHLao+IyMTbOz7OkhORkr91vogwYPKOmQYhDqeLvHdYNRXMisJHGJji6zHo4fatJcrJd9gD5Odpf+9/2MFE0ZwaSrlFUlGsoK9ZwuMmL1jPSrNXMgSQTd0Feiu8X1sMmg+d5xu5CjV3iF7jO1EhPWvUfAQYAgK0y6Ujp6AwAAAAASUVORK5CYII=">
				</div>
				<div class="collumn3">
					<span class="top-left">Burtonwood</span>
					<span class="bottom-left">P Morris/Kieran Schofield</span>
				</div>
				<div class="collumn2">
					<div class="win-chance">
						<span>30%</span>
					</div>
				</div>
				<div class="collumn1">
					<span class="top">9-10</span>
					<span class="bottom">Varsta - 6</span>
				</div>
				<div class="collumn2">
					<form method="POST">
						<button name="cota" value="" type="button"><span class="cota">4.75</span></button>
					</form>
				</div>
			</div>
			
			<div class="team">
				<div class="collumn1">
					<span class="top">8</span>
					<span class="bottom">(5)</span>
				</div>
				<div class="collumn2">
					<img alt="vesta-jocheu" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB0AAAAVCAYAAAC6wOViAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RjY1OTk1NEUxQzZCMTFFNzhEQzY5MkYxRjNFQkM0QjIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RjY1OTk1NEYxQzZCMTFFNzhEQzY5MkYxRjNFQkM0QjIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpGNjU5OTU0QzFDNkIxMUU3OERDNjkyRjFGM0VCQzRCMiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpGNjU5OTU0RDFDNkIxMUU3OERDNjkyRjFGM0VCQzRCMiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PjmIuBkAAAakSURBVHjafFZbbBzV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">
				</div>
				<div class="collumn3">
					<span class="top-left">Pushkin Museum</span>
					<span class="bottom-left">D M Loughnane / David Egan</span>
				</div>
				<div class="collumn2">
					<div class="win-chance">
						<span>80%</span>
					</div>
				</div>
				<div class="collumn1">
					<span class="top">8-9</span>
					<span class="bottom">Varsta - 4</span>
				</div>
				<div class="collumn2">
					<form method="POST">
						<button name="cota" value="" type="button"><span class="cota">4.33</span></button>
					</form>
				</div>
			</div>
			
			<div class="team">
				<div class="collumn1">
					<span class="top">2</span>
					<span class="bottom">(4)</span>
				</div>
				<div class="collumn2">
					<img alt="vesta-jocheu" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB0AAAAVCAYAAAC6wOViAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RjZGOEFCQUUxQzZCMTFFNzhEQzY5MkYxRjNFQkM0QjIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RjZGOEFCQUYxQzZCMTFFNzhEQzY5MkYxRjNFQkM0QjIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpGNkY4QUJBQzFDNkIxMUU3OERDNjkyRjFGM0VCQzRCMiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpGNkY4QUJBRDFDNkIxMUU3OERDNjkyRjFGM0VCQzRCMiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PnfNBj0AAAYgSURBVHjanFZ5bFN1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">
				</div>
				<div class="collumn3">
					<span class="top-left">Mr Chuckles</span>
					<span class="bottom-left">D M Loughnane / David Egan</span>
				</div>
				<div class="collumn2">
					<div class="win-chance">
						<span>65%</span>
					</div>
				</div>
				<div class="collumn1">
					<span class="top">9-10</span>
					<span class="bottom">Varsta - 5</span>
				</div>
				<div class="collumn2">
					<form method="POST">
						<button name="cota" value="" type="button"><span class="cota">8.56</span></button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	require('pages/footer.php');
?>
</body>
</html>