			var ctx = document.getElementById("myChart").getContext('2d');
				var myChart = new Chart(ctx, {
				type: 'bar',
				$.ajax({
					url : "http://127.0.0.1:8080/core/select_exchange.php",
					type : "GET",
					success : function(data){
					console.log(data);
					
					var name = [];
					
					for(var i in data) {
						name.push("UserID " + data[i].name);
					}
					
				data: {
					labels: [name],
					datasets: [{
					label: 'Price in BTC',
					data: [0.121313, 0.211313, 0.11113],
					backgroundColor: "rgba(153,255,51,1)"
					}]
				}
				});
				});