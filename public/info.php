<!DOCTYPE html>
<html lang="en">
  <head>
	<?php 
	$GLOBALS["where"] = 'info';
	include('static/head');?>
  </head>
  
  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
	<?php
	$GLOBALS["where"] = 'info';	
	include('static/navigation');?>
    </nav>
			<?php
			//Global PHP
			$coinsname = $_REQUEST['coin'];
			include('../settings/mysql/settings-db.php');
			$i = 1;
			//Exchangecount
				$sql = "SELECT COUNT(name) AS count FROM exchange";
				$result = $conn->query($sql);
				while ($row = $result->fetch_assoc()) 
					{$exchangecount = $row["count"];}				
			//Selected coin count for exchanges
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
						$selectcoincount = $i++;
						}		
					}
			//Coincoin
				$sql = "SELECT COUNT(coin) AS count FROM coin";
				$result = $conn->query($sql);
				while ($row = $result->fetch_assoc()) 
					{$coincoin = $row["count"];}				
				
			$conn->close();	
			?>	
	<header class="masthead text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <?php			
					if ($coinsname)
						{echo 'Current exchange prices for '.$coinsname.PHP_EOL.'</h1>'.PHP_EOL;}					
					else 
						{echo 'Choose a coin below for its trading informations </h1>'.PHP_EOL;}
			?>
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
			<p class="text-faded mb-5">The coin price engine found <strong><?php echo $coinsname."</strong> on ".$selectcoincount." of ".$exchangecount?> listed exchanges. Click on the button to see the coins exchange rate to bitcoin. You are able to sort the list in ascending and descending order to find the best price for your altcoin.</p>            <a class="btn btn-primary btn-xl js-scroll-trigger" href="#AltCoinPrice">Show exchange informations</a>
		  </div>
        </div>
      </div>
    </header>
	
    <section class="bg-primary" id="AltCoinPrice">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
		<div class="row">
          <div class="col-lg-10 mx-auto">
            
				<?php			
					if ($coinsname)
						{echo '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<ins class="adsbygoogle"
				style="display:block; text-align:center;"
				data-ad-layout="in-article"
				data-ad-format="fluid"
				data-ad-client="ca-pub-1300346742425258"
				data-ad-slot="3665608303"></ins>
			<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
			</script>'.PHP_EOL;}
					else 
						{echo '<h2 class="col-lg-8 mx-auto text-center text-white"> Choose a coin below for its trading informations </h2>'.PHP_EOL;}
				?>
		   </div>
		</div>

		<br>
		<br>
		<form action="" method="POST">
			<input placeholder="Search for other coins" id="myinput" name="coin" class="awesomplete" 	
				<?php
					include('../settings/mysql/settings-db.php');
					$sql = "SELECT coin FROM coin"; 
					$result = $conn->query($sql);
					echo 'data-list="';
					// make a option for every key               
					while ($row = $result->fetch_assoc()) 
						{echo ($row["coin"].", ");}
					$conn->close();
				?>" />	
			<input class='btn btn-primary btn-xl js-scroll-trigger' type="submit" value="Submit" />	
			</form>	
			<hr class="light my-4">			
			<?php
			$coinsname = $_REQUEST['coin'];         
			if ($coinsname)
				{
				echo '
				<div class="container">
					<div class="card shadow">
						<h5 class="card-header text-left">'.$coinsname.'-USD <span id="blocks-updated" class="float-right text-success" style="display: none;"><span class="oi oi-flash"></span></h5>
							<div class="table-responsive mt-3 mb-3">
								<canvas id="CoinChart"></canvas>
							</div>
					</div>
				</div>';	
				}
			?> 			
          </div>
        </div>	
		
		<hr class="light my-4">
		<div class="container"> 
			<div class="card shadow">
			<h5 class="card-header"><?php echo $coinsname;?>-BTC <span id="blocks-updated" class="float-right text-success" style="display: none;"><span class="oi oi-flash"></span></h5>
			<div class="table-responsive mt-3 mb-3">
			<br/>
  <?php 
	require_once "static/libs/Mobile_Detect.php";	
	$detect = new Mobile_Detect;
	
	if ( $detect->isMobile() )
	{echo '<table id="dataTable" class="table table-striped table-responsive table-hover table-bordered ">';}
  else
	{echo '<table id="dataTable" class="table table-striped table-hover table-bordered ">';}
  ?>
    <thead>
      <tr>
        <th>Price in BTC</th>
        <th>Price in USD</th>
        <th>On Exchange</th>
		<th>Last updated</th>
      </tr>
    </thead>
    <tbody>
		<?php
		// Include db settings and make a connection
		include('../settings/mysql/settings-db.php');
		$coinsname = $_REQUEST['coin'];
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
				echo "<td><a target='_blank' href='".$exlink."' class='text-black'>".$row["price_btc"]."</a></td>";
				echo "<td><a target='_blank' href='".$exlink."' class='text-black'>".$row["price_usd"]."</a></td>";
				echo "<td><a target='_blank' href='".$exlink."' class='text-black'>".$exdisp."</a></td>";
				echo "<td><a target='_blank' href='".$exlink."' class='text-black'>".humanTiming($time).' ago'."</a></td>";
				echo "</tr></a>";
				}		
			}
			$conn->close();
		?>
    </tbody>
  </table>
  </div>
  </div>
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
					backgroundColor: "rgba(240,95,64,0.5)",
					hoverBackgroundColor: "rgba(240,95,64,0.8)",
					}]
				},
				options: {
					responsive: true,
					legend: { 
							display: true,
							labels: {
									fontColor: "#f05f40"	
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
										fontColor: "#f05f40",
										beginAtZero: false,
										}
								} 
								], //Close yAxes
						xAxes: [
								{
								display: true,
								ticks: {
										fontColor: "#f05f40",
										}
								} 
								] //Close xAxes
							} //Close scales
						 } //Close options				
				});
		
	</script>
	<div class="table-responsive mt-3 mb-3 text-center text-white">
	<p class="mb-5">You can directly link to this site using following link:<br>
	<br>
	<a target='_blank' href='https://AltCoinPrice.io/info.php?coin=<?php echo $coinsname; ?>' class='text-white'>http://AltCoinPrice.io/info.php?coin=<?php echo $coinsname; ?></a></p>
	</div>
</div>	
	  
    </section>
    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading"><?php echo $exchangecount?> exchanges. 
			<?php echo $coincoin?> coins. Still not enough?</h2>
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
			order: [[ 0, 'desc' ]],
			searching: false
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