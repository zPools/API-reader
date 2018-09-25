<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

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
	<link href="css/awesomplete.css" rel="stylesheet">
	
	
	
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
            <h2 class="section-heading text-white">Simply choose the coin you want to trade and find out where you get the best price.</h2>
            <hr class="light my-4">
			
			<form action="" method="">
			<select name="coin"> 			
			<?php
			$coinsname = $_REQUEST['coin'];
            include ('..\settings\mysql\settings-db.php');
			$conn = new mysqli($servername, $username, $password, $dbname);	
			
			if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			} 			
             // SQL-Query
             $sql = "SELECT coin FROM coin"; 
             $result = $conn->query($sql); 	
			if ($coinsname)
			{echo "<option>$coinsname</option>";}					 
             // make a option for every key               
            while ($row = $result->fetch_assoc()) { 
			$nameofcoin = $row["coin"];
			echo ("<option>".$row["coin"]."</option>");}
            $conn->close();
			?> 
			<input type="submit" value="Submit" />	
			</form>
          </div>
        </div>


		
<div class="container">
  <?php echo '<h2 class="section-heading text-white">'.$coinsname.'</h2>'; ?>            
  
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
		include ('..\settings\mysql\settings-db.php');
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
			
		?>
    </tbody>
  </table>
</div>	
	  
    </section>
    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading">Missing exchange? Missing coin?</h2>
            <hr class="my-4">
            <p class="mb-5">If we are missing a coin that is for sure on a exchange, wait 24 hours for the coin to show up. If its still not visible after, please send us a mail! <br /> <br />
							You are running an exchange and want to get listed? Awesome! Please fill out this Google form!</p>
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