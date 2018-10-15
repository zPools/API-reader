<!DOCTYPE html>
<html lang="en">
  <head>
	<?php 
	$GLOBALS["where"] = 'index';
	include('static/head');?>
  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
	<?php include('static/navigation');?>
    </nav>

    <header class="masthead text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <strong>Get the most out of your trades</strong>
            </h1>
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5">	Using AltCoinPrice.io helps you, finding highest and lowest prices across many exchanges with very frequently updated data.
										You may discover that your beloved coin is on many other exchanges, or at a stunning price!
										We at AltCoinPrice belive, that everyone should get easy access to the best coin prices.
			</p>
			<div class="row">
				<div class="col-lg-4 mx-auto">
					<a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Read more about</a>		
				</div>
				<div class="col-lg-4 mx-auto">		
					<a class="btn btn-primary btn-xl js-scroll-trigger" href="#GetStarted">Lets get started</a>
				</div>
			</div>
         </div>
	    </div>
	 </div>   
    </header>
    <section class="bg-primary" id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
		  <div class="container">
		  <h3 class="text-uppercase text-white"><strong>How it works?</strong></h3>
		   <hr class="light my-4">
		  	<p class="mb-5 text-white"> In nearly every trade there is a gap between in what you get and what you could have get.<br>
										You can increase your profit simply if you always choose the exchange with the highest, or if you want to buy coins, the lowest exchange rates.<br>
										<br>
										Finding such price differences can be very time consuming. Sometimes you miss a good deal because you spent too much time searching for others.<br>
										<br>
										We from altcoinprice.io offer you a clear list of stock exchanges for your chosen coin.<br>
										Finding the best price will no longer be a matter of hours, but will be done in nearly no time.</p>

				<a class="btn btn-secondary btn-xl js-scroll-trigger" href="#cost">What does it cost?</a>
				<br>
				<br>
					<div class="card shadow">
						<h5 class="card-header text-left">Price Trend<span id="blocks-updated" class="float-right text-success" style="display: none;"><span class="oi oi-flash"></span></h5>
							<div class="table-responsive mt-3 mb-3">
								<canvas id="CoinChart"></canvas>
							</div>
					</div>
				</div>
          </div>
        </div>
	</div>
	  
    </section>
    <section id="cost">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h3 class="text-uppercase"><strong>What does it cost?</strong></h3>
			<hr>
				<p class="mb-5"> Absolutely nothing. Ok, ok... it cost the time to find your coin and the site to load.<br>
								 No hidden terms, no link click, no "watch this", no bullshit.
								 <br>
								 <br>
								 <a class="btn btn-primary btn-xl js-scroll-trigger" href="#GetStarted">Lets get started</a>
								 <br>
								 <br>
          </div>
        </div>
      </div>
    </section>

	 <section class="bg-primary" id="GetStarted">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
		  <div class="container">
		  <h3 class="text-uppercase text-white"><strong>Lets get started</strong></h3>
		  <hr class="light my-4">
		  <p class="mb-5 text-white">Our coin price engine has currently  <strong>
				<?php          
					include('../settings/mysql/settings-db.php');
					$sql = "SELECT COUNT(coin) AS count FROM coin";
					$result = $conn->query($sql);
					while ($row = $result->fetch_assoc()) 
						{echo $row["count"];}				
					$conn->close();
			?></strong> coins listed. To get to the best coin prices you only need to type in the coin symbol (like LTC for Litecoin) in the search field.<br>
						No worries, the search helps you and try to guess the coin symbol you might mean.</p>
            <hr class="light my-4">
            <p class="text-faded mb-4">Once selected, simply press "Submit"</p>

			<form action="info.php" method="POST">
			<input placeholder="Search" id="myinput" name="coin" class="awesomplete" 	
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
		  </div>
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
    </section>
	
	
	<script>
			var ctx = document.getElementById("CoinChart").getContext('2d');
				var CoinChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: ['12 Months ago' , '11 Months ago', '10 Months ago', '9 Months ago', '8 Months ago', '7 Months ago', '6 Months ago', '5 Months ago', '4 Months ago', '3 Months ago', '2 Months ago', '1 Month ago', 'Today'],
					datasets: [{
					label: 'Using only one exchange',
					data: ['0.341121' , '0.31451', '0.31951', '0.37457', '0.38392', '0.29224', '0.28419', '0.29000', '0.29422', '0.30756', '0.31372', '0.35454', '0.38519'],						
					backgroundColor: "rgba(240,95,64,0.2)",
					
					},{
					label: 'Using multiple exchanges',
					data: ['0.351121' , '0.31451', '0.32008', '0.37887', '0.38392', '0.29331', '0.28519', '0.29090', '0.2982', '0.30796', '0.31483', '0.35591', '0.38712'],						
					backgroundColor: "rgba(4,95,64,0.2)",
					hoverBackgroundColor: "rgba(4,95,64,0.8)",
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
	
	<script src="js/awesomplete.js" async></script>
  </body>
</html>