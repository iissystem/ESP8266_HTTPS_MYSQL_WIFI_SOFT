<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Gestione Servizi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<style>
.chart {
  width: 100%; 
  min-height: 450px;
}
.row {
  margin:0 !important;
}
</style>
</head>
<body>
<div class="container">
  <div class="row">
  <div class="col-md-12 text-center">
    <h1>Real Time Weather Station</p></h1>
    <p>Created By: <a href="#">IIS system</a></p>
  </div>
  <div class="clearfix"></div>
  <div class="col-md-6">
    <div id="chart_temperature" class="chart"></div>
  </div>
  
  <div class="col-md-6">
    <div id="chart_humidity" class="chart"></div>
  </div>
</div>
</div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
google.charts.load('current', {'packages':['gauge']});
google.charts.setOnLoadCallback(drawTemperatureChart);
function drawTemperatureChart() {
	//guage starting values
	var data = google.visualization.arrayToDataTable([
		['Label', 'Value'],
		['Temp', 0],
	]);
	
	var options = {
		width: 		1600, 
		height: 	480,
		redFrom: 	70, 
		redTo:		100,
		yellowFrom:	40, 
		yellowTo: 	70,
		greenFrom:	00, 
		greenTo: 	40,
		minorTicks: 5
	};

	var chart = new google.visualization.Gauge(document.getElementById('chart_temperature'));
	chart.draw(data, options);
	
	function refreshData () {
		$.ajax({
			url: 'getdata.php',
			// use value from select element
			data: 'q=' + $("#users").val(),
			dataType: 'json',
			success: function (responseText) {
				//console.log(responseText);
				var var_temperature = parseFloat(responseText.temperature).toFixed(2)
				//guage starting values
				var data = google.visualization.arrayToDataTable([
					['Label', 'Value'],
					['Temp', eval(var_temperature)],
				]);
				
				chart.draw(data, options);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(errorThrown + ': ' + textStatus);
			}
		});
    }
	
	setInterval(refreshData, 1000);
}

google.charts.load('current', {'packages':['gauge']});
google.charts.setOnLoadCallback(drawHumidityChart);

function drawHumidityChart() {
	//guage starting values
	var data = google.visualization.arrayToDataTable([
		['Label', 'Value'],
		['Hum', 0],
	]);
	
	var options = {
		width: 		1600, 
		height: 	480,
		redFrom: 	75, 
		redTo:		100,
		yellowFrom:	65, 
		yellowTo: 	75,
		greenFrom:	00, 
		greenTo: 	65,
		minorTicks: 5
	};

	var chart = new google.visualization.Gauge(document.getElementById('chart_humidity'));
	chart.draw(data, options);
	
	function refreshData () {
		$.ajax({
			url: 'getdata.php',
			// use value from select element
			data: 'q=' + $("#users").val(),
			dataType: 'json',
			success: function (responseText) {
				//console.log(responseText);
				var var_humidity = parseFloat(responseText.humidity).toFixed(2)
				//guage starting values
				var data = google.visualization.arrayToDataTable([
					['Label', 'Value'],
					['Hum', eval(var_humidity)],
				]);
				//var chart = new google.visualization.Gauge(document.getElementById('chart_temperature'));
				chart.draw(data, options);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(errorThrown + ': ' + textStatus);
			}
		});
    }
	//refreshData();
	setInterval(refreshData, 1000);
}

$(window).resize(function(){
  drawTemperatureChart();
  drawHumidityChart();
});
</script>
</body>
</html>
