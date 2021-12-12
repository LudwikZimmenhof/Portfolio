<?php

$servername = "sql4.5v.pl";
$username = "l1ke5358_ludwik-zimmenhof-portfolio";
$password = "Ooozmg7!";
$dbname = "l1ke5358_ludwik-zimmenhof-portfolio";

// Create connection
$conn = new mysqli($servername,
	$username, $password, $dbname);

$user_agent = $_SERVER['HTTP_USER_AGENT']; //user browser
$ip_address = $_SERVER["REMOTE_ADDR"];     // user ip adderss
$page_name = $_SERVER["SCRIPT_NAME"];      // page the user looking
$query_string = $_SERVER["QUERY_STRING"];   // what query he used
$current_page = $page_name."?".$query_string; 

$url = json_decode(file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=/4182fca6758dcfdf98bb4ab480021065c8a0430ccf623883f25e803502601bdc/
        // you can get your api key form http://ipinfodb.com/
ip=".$_SERVER['REMOTE_ADDR']."&format=json"));
$country=$url->countryName;  // user country
$city=$url->cityName;       // city
$region=$url->regionName;   // regoin
$latitude=$url->latitude;    //lat and lon
$longitude=$url->longitude;



// Check connection
if ($conn->connect_error) {
	die("Connection failed: "
		. $conn->connect_error);
}

$sqlquery = "INSERT INTO `user_data`(`user_agent`, `ip_address`, `page_name`, `query_string`, `current_page`, `country`, `city`, `region`, `latitude`, `longitude`) VALUES ([$user_agent],[$ip_address],[$page_name],[$query_string],[$current_page],[$country],[$city],[$region],[$latitude],[$longitude])"

if ($conn->query($sql) === TRUE) {
	echo "record inserted successfully";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
