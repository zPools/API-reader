<!DOCTYPE html>
<html lang="en">

  <head>
<?php include('static/head'); ?>
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
			<input id="myinput" name="coin" class="awesomplete" placeholder="e.g. LTC, DASH, ..."	
				<?php
					include('../settings/mysql/settings-db.php');
					$sql = "SELECT coin FROM coin"; 
					$result = $conn->query($sql);
					echo 'data-list="';
					// make a option for every key               
					while ($row = $result->fetch_assoc()) 
						{echo ($row["coin"].", ");}
					$conn->close();
				?>"/>	
			<input type="submit" value="Submit" />	
			</form>		
			<?php
			$coinsname = $_REQUEST['coin'];
			if ($coinsname)
				{echo '<br/>
				<p class="text-uppercase text-white">'.$coinsname.'</p>';}            
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
  <br/>
  <table id="dataTable" class="table table-striped table-hover table-bordered ">
    <thead>
      <tr>
        <th><p class="text-white">Price in BTC:</p></th>
        <th><p class="text-white">Price in USD:</p></th>
        <th><p class="text-white">On Exchange:</p></th>
		<th><p class="text-white">Last updated:</p></th>
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
				echo "<td><a target='_blank' href='".$exlink."' class='text-white'>".$row["price_btc"]."</a></td>";
				echo "<td><a target='_blank' href='".$exlink."' class='text-white'>".$row["price_usd"]."</a></td>";
				echo "<td><a target='_blank' href='".$exlink."' class='text-white'>".$exdisp."</a></td>";
				echo "<td><a target='_blank' href='".$exlink."' class='text-white'>".'Last update was '.humanTiming($time).' ago'."</a></td>";
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
	
	<!-- Script for awesomeplete -->
	<script src="js/awesomplete.js" async></script>
	
	<!-- Script for DataTables -->
	<script type="text/javascript" src="//cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.js"></script>

  </body>
  
	<script type="text/javascript">
	function precisionRound(number, precision) {
        var factor = Math.pow(10, precision+1);
        return Math.floor(Math.round(number * factor)/10) / (Math.pow(10, precision));
    }

	$(document).ready(function(){
		var block_table = $('#dataTable').DataTable({
			order: [[ 0, 'desc' ]]
		});
		
	});
	</script>
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