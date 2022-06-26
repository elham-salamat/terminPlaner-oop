<?php

function pathCorrection()
{
	$requestedUrl = explode("/",$_SERVER["REQUEST_URI"]);	
	unset($requestedUrl[0]); 
	$requestedUrl = implode("/", $requestedUrl);
	// echo $requestedUrl;
	// echo "<br>";
	// echo "-----------------------------------------------";
	// echo "<br>";

	$scriptName = explode("/",$_SERVER["SCRIPT_NAME"]);
	unset($scriptName[0]); 
	unset($scriptName[count($scriptName)]); 
	$scriptName = implode("/",$scriptName); 
	// echo $scriptName;
	// echo "<br>";
	// echo "-----------------------------------------------";
	// echo "<br>";

	define("BASIC_PATH", $scriptName);
	// echo BASIC_PATH;
	// echo "<br>";
	// echo "-----------------------------------------------";
	// echo "<br>";

	$difference = str_replace($scriptName,"",$requestedUrl);
	if(strpos($difference,"/",-1) !== false && "/" != trim($difference))
		$difference = substr_replace($difference ,"",-1);
	$difference	= strtolower($difference);
	define("SELECTED_PAGE", $difference);
	// echo SELECTED_PAGE;
	// echo "<br>";
	// echo "-----------------------------------------------";
	// echo "<br>";



	$folder = explode("/", $difference);
	unset($folder[0]);	

	$elementNumber = count($folder);

	$pathCorrection = "";
	for($counter = 1; $counter < $elementNumber; $counter++)
	{
        $pathCorrection .= "../";
	}	
	define("PATH_CORRECTION", $pathCorrection);
	// echo PATH_CORRECTION;
	// echo "<br>";
	// echo "-----------------------------------------------";
	
	// $constants = get_defined_constants();
	// $routingPath = array ($constants, $secondLevelSelection);
	// return $routingPath;
}

