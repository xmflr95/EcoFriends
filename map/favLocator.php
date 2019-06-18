<?php
session_start();
require("../dbinfo.php");
// Get parameters from URL
// $center_lat = $_GET["lat"];
// $center_lng = $_GET["lng"];
// $radius = $_GET["radius"];
$mapNum = $_GET['mapid'];

// Start XML file, create parent node
$dom = new DOMDocument('1.0', 'UTF-8');
$node = $dom->createElement("map");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server

$connection=@mysql_connect ($servername, $username, $password);
if (!$connection) {  die('Not connected : ' . mysql_error());}

// Set the active MySQL database

$db_selected = mysql_select_db($dbname, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

$useremail = $_SESSION['email'];
   $username = $_SESSION['username'];

$usql = "SELECT user_id FROM usertbl WHERE user_email = '$useremail' AND user_name = '$username' ";
$result2 = mysql_query($usql);
if (!$result2) {
   die('Invalid usql: ' . mysql_error());
}

$row2 = @mysql_fetch_assoc($result2);
$userid = $row2['user_id'];


$query1 = sprintf("SELECT maptbl.id as id, maptbl.name as name, citytbl.city_name as city, maptbl.address as address, maptbl.lat as lat, maptbl.lng as lng, chargetypetbl.type as type, favoritetbl.f_status as f_status, favoritetbl.u_id as u_id, favoritetbl.m_id as m_id FROM maptbl INNER JOIN citytbl on maptbl.city_id = citytbl.city_id LEFT JOIN chargetypetbl on maptbl.type_id = chargetypetbl.type_id LEFT JOIN favoritetbl ON favoritetbl.m_id = maptbl.id WHERE favoritetbl.u_id = $userid && favoritetbl.m_id = $mapNum ");
$result1 = mysql_query($query1);
if (!$result1) {
   die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

while ($row1 = @mysql_fetch_assoc($result1)){
   // Add to XML document node
   $node = $dom->createElement("marker");
   $newnode = $parnode->appendChild($node);
   $newnode->setAttribute("id",$row1['id']);
   $newnode->setAttribute("name",$row1['name']);
   $newnode->setAttribute("city",$row1['city']);
   $newnode->setAttribute("address", $row1['address']);
   $newnode->setAttribute("lat", $row1['lat']);
   $newnode->setAttribute("lng", $row1['lng']);
   $newnode->setAttribute("type", $row1['type']);
   $newnode->setAttribute("u_id", $row1['u_id']);
   $newnode->setAttribute("m_id", $row1['m_id']);
   $newnode->setAttribute("f_status", $row1['f_status']);
   // $newnode->setAttribute("distance", $row1['distance']);
}

echo $dom->saveXML();


?>
