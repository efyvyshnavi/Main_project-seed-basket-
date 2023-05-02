<?php // Get the delivery address from the order details
$delivery_address = "123 Main St, Anytown, USA";

// Define the Google Maps API key
$api_key = "AIzaSyCP7ec2Tk3Ej0tAOxujdVOGCZk59B2u5qk";

// Set up the Google Maps API URL
$maps_url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($delivery_address) . "&key=" . $api_key;

// Use cURL to retrieve the JSON data from the Google Maps API
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $maps_url
));
$json_data = curl_exec($curl);
curl_close($curl);

// Parse the JSON data and retrieve the latitude and longitude of the delivery address
$location_data = json_decode($json_data);
$latitude = $location_data->results[0]->geometry->location->lat;
$longitude = $location_data->results[0]->geometry->location->lng;

// Use the latitude and longitude to retrieve the distance and duration of the route
$origin = "YOUR_STARTING_ADDRESS_HERE";
$destination = $latitude . "," . $longitude;
$mode = "driving";
$units = "imperial";
$maps_url = "https://maps.googleapis.com/maps/api/directions/json?origin=" . urlencode($origin) . "&destination=" . urlencode($destination) . "&mode=" . urlencode($mode) . "&units=" . urlencode($units) . "&key=" . $api_key;
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $maps_url
));
$json_data = curl_exec($curl);
curl_close($curl);
$route_data = json_decode($json_data);
$distance = $route_data->routes[0]->legs[0]->distance->text;
$duration = $route_data->routes[0]->legs[0]->duration->text;

// Output the distance and duration of the route
echo "Distance: " . $distance . "<br>";
echo "Duration: " . $duration . "<br>";
?>