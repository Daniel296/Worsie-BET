<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Rezultate - WorsieBet</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style-header.css">
	<link rel="stylesheet" type="text/css" href="css/popup-style.css">
</head>

<body>

<?php
	require('pages/header.php');
?>

<div id="main-results">

	<div class="search-bar">
		<form action="" method="POST">
			<input name="search" placeholder="Search...">
			<div class="search-img">
				<img src="images/search.png">
			</div>
		</form>
	</div>


	<div class="show-bets-day">
		<ul>
			<?php
				$num_day = getdate();
				$days = array(0 => "Luni", 1 => "Marti", 2 => "Miercuri", 3 => "Joi", 4 => "Vineri", 5 => "Sambata", 6 => "Duminica");
				
				$day = date("Y-m-d", time() - 4 * 86400);
				echo "<li><a href =\"rezultate.php?date=$day\">".$days[($num_day['wday'] + 9) % 7 ]."</a></li>";
				
				$day = date("Y-m-d", time() - 3 * 86400);
				echo "<li><a href =\"rezultate.php?date=$day\">".$days[($num_day['wday'] + 10) % 7 ]."</a></li>";
				
				$day = date("Y-m-d", time() - 2 * 86400);
				echo "<li><a href =\"rezultate.php?date=$day\">".$days[($num_day['wday'] + 11) % 7 ]."</a></li>";
				
				$day = date("Y-m-d", time() - 86400);
				echo "<li><a href =\"rezultate.php?date=$day\">Ieri</a></li>";
				
				$day = date("Y-m-d", time());
				echo "<li class=\"active\"><a href =\"rezultate.php?date=$day\">Azi</a></li>";
				
				echo "<li class=\"active\">Maine</li>";

			?>
		</ul>
	</div>
	
	
	<div class ="bet-details">
		<div class="results-bar">
			<span>Ludlow</span>
			<div class="results-times">
				<div class="active-time">
					<a href="">13:20</a>
				</div>
				<a href="">14:20</a>
				<a href="">15:20</a>
				<a href="">16:20</a>
				<a href="">17:10</a>
				<a href="">18:20</a>
				<a href="">19:20</a>
			</div>
		</div>
		<div class="results-head">
			<div class="dim50">
				<span>#</span>
			</div>
			<div class="dim200">
				<span>Cal</span>
			</div>
			<div class="dim200">
				<span>Jocheu / Antrenor</span>
			</div>
			<div class="dim50">
				<span>Ani</span>
			</div>
			<div class="dim100">
				<span>WR Cal</span>
			</div>
			<div class="dim100">
				<span>WR Jocheu</span>
			</div>
		</div>
		<div class="results-body">
			<div class="results-team">
				<div class="dim50">
					<span>1.</span>
				</div>
				<div class="dim200">
					<span>Burtonwood</span>
				</div>
				<div class="dim200">
					<span>P Morris/Kieran Schofield</span>
				</div>
				<div class="dim50">
					<span>6</span>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>30%</span>
					</div>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>80%</span>
					</div>
				</div>
			</div>
			<div class="results-team">
				<div class="dim50">
					<span>2.</span>
				</div>
				<div class="dim200">
					<span>Pushkin Museum</span>
				</div>
				<div class="dim200">
					<span>D M Loughnane / David Egan</span>
				</div>
				<div class="dim50">
					<span>4</span>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>65%</span>
					</div>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>73%</span>
					</div>
				</div>
			</div>
			<div class="results-team">
				<div class="dim50">
					<span>3.</span>
				</div>
				<div class="dim200">
					<span>Mr Chuckles</span>
				</div>
				<div class="dim200">
					<span>D M Loughnane / David Egan</span>
				</div>
				<div class="dim50">
					<span>5</span>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>86%</span>
					</div>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>75%</span>
					</div>
				</div>
			</div>
			<div class="results-team">
				<div class="dim50">
					<span>4.</span>
				</div>
				<div class="dim200">
					<span>Burtonwood</span>
				</div>
				<div class="dim200">
					<span>P Morris/Kieran Schofield</span>
				</div>
				<div class="dim50">
					<span>6</span>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>30%</span>
					</div>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>80%</span>
					</div>
				</div>
			</div>
			<div class="results-team">
				<div class="dim50">
					<span>NR.</span>
				</div>
				<div class="dim200">
					<span>Pushkin Museum</span>
				</div>
				<div class="dim200">
					<span>D M Loughnane / David Egan</span>
				</div>
				<div class="dim50">
					<span>4</span>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>65%</span>
					</div>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>73%</span>
					</div>
				</div>
			</div>
			<div class="results-team">
				<div class="dim50">
					<span>NR.</span>
				</div>
				<div class="dim200">
					<span>Mr Chuckles</span>
				</div>
				<div class="dim200">
					<span>D M Loughnane / David Egan</span>
				</div>
				<div class="dim50">
					<span>5</span>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>86%</span>
					</div>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>75%</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class ="bet-details">
		<div class="results-bar">
			<span>Ludlow</span>
			<div class="results-times">
				<div class="active-time">
					<a href="">13:20</a>
				</div>
				<a href="">14:20</a>
				<a href="">15:20</a>
				<a href="">16:20</a>
				<a href="">17:10</a>
				<a href="">18:20</a>
				<a href="">19:20</a>
			</div>
		</div>
		<div class="results-head">
			<div class="dim50">
				<span>#</span>
			</div>
			<div class="dim200">
				<span>Cal</span>
			</div>
			<div class="dim200">
				<span>Jocheu / Antrenor</span>
			</div>
			<div class="dim50">
				<span>Ani</span>
			</div>
			<div class="dim100">
				<span>WR Cal</span>
			</div>
			<div class="dim100">
				<span>WR Jocheu</span>
			</div>
		</div>
		<div class="results-body">
			<div class="results-team">
				<div class="dim50">
					<span>1.</span>
				</div>
				<div class="dim200">
					<span>Burtonwood</span>
				</div>
				<div class="dim200">
					<span>P Morris/Kieran Schofield</span>
				</div>
				<div class="dim50">
					<span>6</span>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>30%</span>
					</div>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>80%</span>
					</div>
				</div>
			</div>
			<div class="results-team">
				<div class="dim50">
					<span>2.</span>
				</div>
				<div class="dim200">
					<span>Pushkin Museum</span>
				</div>
				<div class="dim200">
					<span>D M Loughnane / David Egan</span>
				</div>
				<div class="dim50">
					<span>4</span>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>65%</span>
					</div>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>73%</span>
					</div>
				</div>
			</div>
			<div class="results-team">
				<div class="dim50">
					<span>3.</span>
				</div>
				<div class="dim200">
					<span>Mr Chuckles</span>
				</div>
				<div class="dim200">
					<span>D M Loughnane / David Egan</span>
				</div>
				<div class="dim50">
					<span>5</span>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>86%</span>
					</div>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>75%</span>
					</div>
				</div>
			</div>
			<div class="results-team">
				<div class="dim50">
					<span>4.</span>
				</div>
				<div class="dim200">
					<span>Burtonwood</span>
				</div>
				<div class="dim200">
					<span>P Morris/Kieran Schofield</span>
				</div>
				<div class="dim50">
					<span>6</span>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>30%</span>
					</div>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>80%</span>
					</div>
				</div>
			</div>
			<div class="results-team">
				<div class="dim50">
					<span>NR.</span>
				</div>
				<div class="dim200">
					<span>Pushkin Museum</span>
				</div>
				<div class="dim200">
					<span>D M Loughnane / David Egan</span>
				</div>
				<div class="dim50">
					<span>4</span>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>65%</span>
					</div>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>73%</span>
					</div>
				</div>
			</div>
			<div class="results-team">
				<div class="dim50">
					<span>NR.</span>
				</div>
				<div class="dim200">
					<span>Mr Chuckles</span>
				</div>
				<div class="dim200">
					<span>D M Loughnane / David Egan</span>
				</div>
				<div class="dim50">
					<span>5</span>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>86%</span>
					</div>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>75%</span>
					</div>
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