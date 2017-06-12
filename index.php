<!DOCTYPE HTML>
<html>
<head>
	<title>Acasă - WorsieBet</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style-header.css">
	<link rel="stylesheet" type="text/css" href="css/popup-style.css">
</head>
<body>

<?php
	require('pages/header.php');
?>
<?php
	require('php/rss_data.php');
?>
<div id="wrap">
	<div id="main">
		<div class="thumbnail" onMouseOut="hide('bet-now')" onMouseOver="show('bet-now')" >
			<img src="images/betting-img.jpg" id="betting-img" alt="betting">
			<a href="pariuri.php?date=<?php echo date("Y-m-d", time());?>">
				<div id="bet-now">
					<span id="bet-now-text">PARIAZĂ ACUM</span>
				</div>
			</a>
		</div>

		<div class="statistics">
			<h2>TOP PARIORI</h2>
			<?php
				$connection = mysqli_connect('localhost', 'root', '', 'worsiebet');
				$res = mysqli_query($connection,"SELECT username, bilete_total, bilete_castigate FROM utilizatori WHERE bilete_castigate<>0 ORDER BY bilete_total/bilete_castigate");
				if($res === FALSE) {
					die(mysql_error()); // TODO: better error handling
				}
				echo "<table align=\"center\">";
				echo "<tr>";
				echo	"<th>Username</th>";
				echo	"<th>Bilete total</th>";
				echo	"<th>Bilete câștigate</th>";
			    echo	"</tr>";
				while ($row = $res->fetch_assoc()) {
					echo "<tr>";
			        echo "<td>";
					echo $row['username'];
					echo "</td>";
					echo "<td>";
					echo $row['bilete_total'];
					echo "</td>";
					echo "<td>";
					echo $row['bilete_castigate'];
					echo "</td>";
			        echo "</tr>";
				}
				echo "</table>";
			?>
			
			<div class="rss-feed">
				<a href="C:\xampp\htdocs\Worsie-BET\php\rss.xml" target="blank">
					<img src="./images/RSS.png">
				</a>
			</div>
			
		</div>
	</div>
</div>

<?php
	require('pages/footer.php');
?>

<script>
  function show(id) {
    document.getElementById(id).style.visibility = "visible";
	document.getElementById(id).style.display = "block";
  }
  function hide(id) {
    document.getElementById(id).style.visibility = "hidden";
	document.getElementById(id).style.display = "none";
  }
</script>
</body>
</html>
