<!DOCTYPE html>
<html lang="en">
  <head>
	<?php 
	$GLOBALS["where"] = 'change';
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
              <strong>What changed?</strong>
            </h1>
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5">	We try to keep our tool as "up to date" as possible. We don´t always make a shoutout to what changed, because sometimes its just an update of the core.
										However you might find it interesting what changes over the time, so we started writing a public changelog that you can see what happens behind the scene.
			</p>
			<div class="row">
				<div class="col-lg-4 mx-auto">		
					<a class="btn btn-primary btn-xl js-scroll-trigger" href="#Changelog">What changed</a>
				</div>
			</div>
         </div>
	    </div>
	 </div>   
    </header>
	 <section class="bg-primary" id="Changelog">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
		  <div class="container">
		  <h1 class="text-uppercase text-white"><strong>Changelog</strong></h3>
		  <hr class="light my-4">
		  <h3 class="section-heading text-white">Alpha release</h2>
		  <p class="mb-5 text-white">Date: 01.10.2018 </p>	  
			<ul class="mb-5 text-white text-left">
				<li>Closed Alpha release of altcoinprice.io</li>
			</ul>
			
		  <hr class="light my-4">
		  <h3 class="section-heading text-white">UI updates</h2>
		  <p class="mb-5 text-white">Date: 15.10.2018 </p>	  
			<ul class="mb-5 text-white text-left">
				<li>UI Update: Now seems a bit more dynamic</li>
				<li>UI Update: Added the changelog</li>
				<li>UI Update: Added footer with donation address</li>
				<li>Core update: The BTC-USD value now gets stored in DB and updates every minute</li>
				<li>Core update: HitBTC & Bleutrade added</li>				
			</ul>            
		  </div>
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