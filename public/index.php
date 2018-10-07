<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include('static/head');?>
  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Coin-Price.com</a>
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
            <p class="text-faded mb-5">Start using Coin-Price.com helps you to get the most profit out of your trades. It is as easy as select the coin you want to trade and find where you get the best price.</p>
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Start using - for free</a>
          </div>
        </div>
      </div>
    </header>
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
            <p class="text-faded mb-4">Once selected, simply press "Submit"</p>

			<form action="info.php" method="">
			<select name="coin"> 			
			<?php
			include('../settings/mysql/settings-db.php');
			$coinsname = $_REQUEST['coin'];	
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
</html>