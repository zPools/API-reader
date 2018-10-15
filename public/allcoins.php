<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include('static/head');?>
  </head>
  
  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
	<?php
	$GLOBALS["where"] = 'allcoins';	
	include('static/navigation');
	?>
    </nav>
			<?php
			//Global PHP
			include('../settings/mysql/settings-db.php');
			//Exchangecount
				$sql = "SELECT COUNT(name) AS count FROM exchange";
				$result = $conn->query($sql);
				while ($row = $result->fetch_assoc()) 
					{$exchangecount = $row["count"];}			
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
              <?php echo $coincoin;?> coins listed
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5">Our goal is to be the first choice when it comes to coin price informations. We crawl exchanges, get their data and provide their prices to you. </p>
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="#AllCoins">Show all coins</a>
          </div>
        </div>
      </div>
    </header>
	<section class="bg-primary" id="AllCoins">
<div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
		<form action="info.php" method="POST">
			<input placeholder="Better use this search :)" id="myinput" name="coin" class="awesomplete" 	
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
		<div class="container"> 
			<div class="card shadow">
			<h5 class="card-header">All listed coins<span id="blocks-updated" class="float-right text-success" style="display: none;"><span class="oi oi-flash"></span></h5>
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
        <th>Coin</th>
      </tr>
    </thead>
    <tbody>
		<?php
		// Include db settings and make a connection
		include('../settings/mysql/settings-db.php');
		// Ask for all exchange we have (1st while) and echo their results (2nd while)
		$sqlask = "SELECT coin FROM coin";
		$resultask = $conn->query($sqlask);
		while ($row = $resultask->fetch_assoc())
			{	
			echo "<tr>";
			echo "<td><a target='_blank' href='info.php?coin=".$row["coin"]."'' class='text-black'>".$row["coin"]."</a></td>";
			echo "</tr></a>";

			}
			$conn->close();
		?>
    </tbody>
  </table>
  </div>
  </div>
	
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
            <p class="mb-5">Do you have a problem with using AltCoinPrice.io or have any other request, please use our "support request" Google form! <br /> <br />
							You are running an exchange and want to get listed? Awesome! Please fill out the "listing request" Google form!</p>
          </div>
        </div>
          <div class="row">
          <div class="col-lg-4 ml-auto text-center">
            <i class="fas fa-envelope fa-3x mb-3 sr-contact-2"></i>
			<p>
            <a target='_blank' href=https://goo.gl/forms/xRgnXxeTt1dSiBO03>Exchange listing request</a>
			</p>
          </div>
          <div class="col-lg-4 mr-auto text-center">
            <i class="fas fa-envelope fa-3x mb-3 sr-contact-2"></i>
            <p>
              <a target='_blank' href=https://goo.gl/forms/LXuRF5HLm4FCZoTb2>Support request</a>
            </p>
          </div>
		</div>
        </div>
      </div>
    </section>

	<?php include('static/footer');?>
	
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
			order: [[ 0, 'asc' ]],
			searching: true
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