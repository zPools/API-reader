<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Cryptocurrency (e.g. Bitcoin - Litecoin) price information tool">
    <meta name="author" content="miXe">

    <title>CoinPrice.io - Your coin price info</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/creative.min.css" rel="stylesheet">
	
	<!-- Insert awesomecomplete -->
	<link href="css/awesomplete.base.css" rel="stylesheet">
	<link href="css/awesomplete.css" rel="stylesheet">
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
	
	
  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php">CoinPrice.io</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="info.php">Price Info</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <section class="bg-primary" id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading text-white">Choose one out of 
				<?php          
					include('../settings/mysql/settings-db.php');
					$sql = "SELECT COUNT(coin) AS count FROM coin";
					$result = $conn->query($sql);
					while ($row = $result->fetch_assoc()) 
						{echo $row["count"];}				
					$conn->close();
			?> coins and find where you get the best price. Highest and lowest!</h2>
            <hr class="light my-4">
			
			<form action="" method="POST">
			<input id="myinput" name="coin" class="dropdown-input" placeholder="e.g. LTC, DASH, ..."	
				<?php
					include('../settings/mysql/settings-db.php');
					$sql = "SELECT coin FROM coin"; 
					$result = $conn->query($sql);
					echo 'data-list="';
					// make a option for every key               
					while ($row = $result->fetch_assoc()) 
						{echo ($row["coin"].", ");}
					$conn->close();
				?> 
				"/>	
			<input type="submit" value="Submit" />	
			</form>
			
		
			<?php
			$coinsname = $_REQUEST['coin'];
			if ($coinsname)
			{
			echo '
			<div class="container">
				<br />
					<div>
						<canvas id="CoinChart"></canvas>
					</div>
			</div>';	
			}
			?> 
		
	
			
          </div>
        </div>

		
<div class="container">
  <?php
  $coinsname = $_REQUEST['coin'];
  echo '<h2 class="section-heading text-white">'.$coinsname.'</h2>'; 
  ?>            
  
  <table class="table table-hover">
    <thead>
      <tr>
        <th><p class="text-faded mb-4">Price in BTC:</p></th>
        <th><p class="text-faded mb-4">Price in USD:</p></th>
        <th><p class="text-faded mb-4">On Exchange:</p></th>
		<th><p class="text-faded mb-4">Last updated:</p></th>
      </tr>
    </thead>
    <tbody>
		<?php
		// Include db settings and make a connection
		include('../settings/mysql/settings-db.php');
		// Ask for all exchange we have (1st while) and echo their results (2nd while)
		$sqlask = "SELECT name, link, displayname FROM exchange";
		$resultask = $conn->query($sqlask);
		while ($row = $resultask->fetch_assoc())
			{	
			$ex = $row["name"];
			$exlink = $row["link"];
			$exdisp = $row["displayname"];
			$sql = "SELECT coin, price_btc, price_usd, date FROM $ex WHERE coin = '$coinsname' ORDER BY date DESC LIMIT 1;"; 
			$result = $conn->query($sql);
			while ($row = $result->fetch_assoc())
				{
				$time = strtotime($row["date"]);	
				echo "<tr>";
				echo "<td><a target='_blank' href='".$exlink."'><p class='text-faded mb-4'>".$row["price_btc"]."</p></a></td>";
				echo "<td><a target='_blank' href='".$exlink."'><p class='text-faded mb-4'>".$row["price_usd"]."</p></a></td>";
				echo "<td><a target='_blank' href='".$exlink."'><p class='text-faded mb-4'>".$exdisp."</p></a></td>";
				echo "<td><a target='_blank' href='".$exlink."'><p class='text-faded mb-4'>".'Last update was '.humanTiming($time).' ago'."</p></a></td>";
				echo "</tr></a>";
				}		
			}
			$conn->close();
		?>
    </tbody>
  </table>
  
	<script>
			var ctx = document.getElementById("CoinChart").getContext('2d');
				var CoinChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: [<?php 
								// Include db settings and make a connection
								include('../settings/mysql/settings-db.php');
								// Ask for all exchange we have (1st while) and echo their results (2nd while)
								$sqlask = "SELECT name, link, displayname FROM exchange";
								$resultask = $conn->query($sqlask);
								while ($row = $resultask->fetch_assoc())
									{	
									$ex = $row["name"];
									$exlink = $row["link"];
									$exdisp = $row["displayname"];
									$sql = "SELECT coin FROM $ex WHERE coin = '$coinsname' ORDER BY date DESC LIMIT 1;"; 
									$result = $conn->query($sql);
									while ($row = $result->fetch_assoc())
										{
										echo '"'.$exdisp.'" ,';
										}		
									}
									$conn->close();
							?>],
					datasets: [{
					label: 'Price in USD',
					data: [<?php 
								// Include db settings and make a connection
								include('../settings/mysql/settings-db.php');
								// Ask for all exchange we have (1st while) and echo their results (2nd while)
								$sqlask = "SELECT name, link, displayname FROM exchange";
								$resultask = $conn->query($sqlask);
								while ($row = $resultask->fetch_assoc())
									{	
									$ex = $row["name"];
									$exlink = $row["link"];
									$exdisp = $row["displayname"];
									$sql = "SELECT price_usd FROM $ex WHERE coin = '$coinsname' ORDER BY date DESC LIMIT 1;"; 
									$result = $conn->query($sql);
									while ($row = $result->fetch_assoc())
										{
										echo '"'.$row["price_usd"].'",';
										}		
									}
									$conn->close();
							?>],						
					backgroundColor: "rgba(255,255,255,0.5)",
					hoverBackgroundColor: "rgba(255,255,255,0.8)",
					}]
				},
				options: {
					responsive: true,
					legend: { 
							display: true,
							labels: {
									fontColor: "white"	
									}
							}, // Close legend
					title: {
						display: false,
						text: 'Not used yet'
							}, //Close title
					scales: {
						yAxes: [
								{
								display: true,
								ticks: {
										fontColor: "white",
										beginAtZero: false,
										}
								} 
								], //Close yAxes
						xAxes: [
								{
								display: true,
								ticks: {
										fontColor: "white",
										}
								} 
								] //Close xAxes
							} //Close scales
						 } //Close options				
				});
	</script>
</div>	
	  
    </section>
    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading"><?php          
					include('../settings/mysql/settings-db.php');
					$sql = "SELECT COUNT(name) AS count FROM exchange";
					$result = $conn->query($sql);
					while ($row = $result->fetch_assoc()) 
						{echo $row["count"];}				
					$conn->close();
			?> exchanges. <?php          
					include('../settings/mysql/settings-db.php');
					$sql = "SELECT COUNT(coin) AS count FROM coin";
					$result = $conn->query($sql);
					while ($row = $result->fetch_assoc()) 
						{echo $row["count"];}				
					$conn->close();
			?> coins. Still not enough?</h2>
            <hr class="my-4">
            <p class="mb-5">If we are missing a freshly listed coin that is on a listed exchange, wait 24 hours for the coin to show up. If its still not visible after or you have any other problems, please fill the "support request" Google form! <br /> <br />
							You are running an exchange and want to get listed? Awesome! Please fill out the "listing request" Google form!</p>
          </div>
        </div>
          <div class="col-lg-4 mr-auto text-center">
            <i class="fas fa-envelope fa-3x mb-3 sr-contact-2"></i>
            <p>
              <a href="mailto:your-email@your-domain.com">mail@not-set-yet.com</a>
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/creative.min.js"></script>
	<script src="js/awesomplete.js" async></script>
	
	

  </body>
<?php
function humanTiming ($time)
	{					
	$time = time() - $time; // to get the time since that moment
	$time = ($time<1)? 1 : $time;
	$tokens = array (
		31536000 => 'year',
		2592000 => 'month',
		604800 => 'week',
		86400 => 'day',
		3600 => 'hour',
		60 => 'minute',
		1 => 'second'
		);					
	foreach ($tokens as $unit => $text) 
		{
		if ($time < $unit) continue;
			$numberOfUnits = floor($time / $unit);
			return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
		}					
	}
?>
</html>