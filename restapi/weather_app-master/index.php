<?php

ini_set('error_reporting', E_ALL);
$weather = '';
$errorString = '';

if(!empty($_GET['city'])){

	$city = urlencode($_GET['city']);

	$url = 'http://api.openweathermap.org/data/2.5/weather?q='.$city.'&appid=6e8221ba6807eb591e0151f7e04c48f2';

	 
	 $urlContents = @file_get_contents($url);
		
		$weatherArray = json_decode($urlContents, true);
		
		if($weatherArray['cod']==200){
	 
		 $weatherArray['main']['temp'] = $weatherArray['main']['temp'] - 273.15;
		 
		 if($weatherArray['weather'][0]['description'] == 'few clouds'){
			 $weatherArray['weather'][0]['description'] = 'a '.$weatherArray['weather'][0]['description'];
		 }
		 
		 $weather = "Das Wetter in ".ucwords($_GET['city'])." ist derzeit '".$weatherArray['weather'][0]['description']. "'. Der Temperatur ist ".$weatherArray['main']['temp'] ." Grad Celsius. Die Luftfeuchtigkeit ist ".$weatherArray['main']['humidity']." % und der Windgeschwindigkeit ist ".$weatherArray['wind']['speed']." meter/sek.";
		}
		else{
		
			$errorString = "Diese Stadt konnte nicht gefunden werden";
			
		}

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
  
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  
	<title>Carmen - Wetterbericht ☕</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<link rel='stylesheet' type='text/css' href='style.css'>
	<style type="text/css">
	.container h1 {
    font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", monospace;
}
    .container form .form-group label {
    font-family: Gotham, Helvetica Neue, Helvetica, Arial, sans-serif;
}
    </style>
  </head>
  
  <body>
	  
	<div class="page" style="background-color: burlywood; opacity: 0.7; margin-top: 12px; margin-bottom: 15px;">
	<div class='container'>
		<div class="main-title" style="font-family: Impact, Haettenschweiler, 'Franklin Gothic Bold', 'Arial Black', 'sans-serif'; font-size: 60px; color:black;" >
            <div>Wie ist das Wetter heute?</div>
        </div>
		<p>Geben Sie eine Stadtname ein...</p>
	
		<form action='' method='get'>
			  <div class="form-group">
				<input type="text" class="form-control" name="city" id="city" aria-describedby="emailHelp" placeholder="zB, Wien, Graz usw..." value="<?php if(!empty($_GET['city'])){echo $_GET['city'];}  ?>" required>
			  </div>
			  <strong>
			  <button type="submit" class="btn btn-primary" style="margin-left: 32%; margin-right: 26%; margin-top: -1%; margin-bottom: 2%; color: #F7F9F7; background-color: darkgreen;">Submit</button>
			  </strong>
		
		</form>
		<div id='weather' style="text-align: center; color: black">
			<?php
			if(!empty($_GET['city'])){
					if($weather){
					echo '<div class="alert alert-success" role="alert">'.
							$weather
						  .'</div>';
				}
				if($errorString){
					echo '<div class="alert alert-danger" role="alert"><strong>Error: </strong>'.
							$errorString
						  .'</div>';
				}
			}
			
			?>
		</div>
		
	</div>
	  </div>
	
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	
  </body>
  
</html>