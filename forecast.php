<?php 
require_once './clases/forecastOE.php';
$ciudad = "";
//Get the parameter.
if (isset($argv)) {
	if (count($argv)>1) {
            $ciudad = $argv[1];
            //Some cities may contain to words and if user doesn't do it
            //well app could not display the result that is wanted.
            if (count($argv)>2) {
                $ciudad .= " " . $argv[2];	
            }                
	}
}

//Gets the forecast with the class forecastOE
$myForecast = new forecastOE();
$forecast =  $myForecast->getTxtForecast('today', $ciudad);

//Converts string encoding to display well the characters in windows CMD.
$forecast = iconv("UTF-8", "CP437", $forecast);

echo $forecast;


