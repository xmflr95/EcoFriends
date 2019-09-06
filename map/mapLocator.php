<?php
session_start();
require("../dbinfo.php");
// Get parameters from URL
$center_lat = $_GET["lat"];
$center_lng = $_GET["lng"];
$radius = $_GET["radius"];

// Start XML file, create parent node
$dom = new DOMDocument('1.0', 'UTF-8');
$node = $dom->createElement("map");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server

$conn = new mysqli($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . $conn->connect_error);
}

// $db_selected = mysqli_select_db($dbname, $conn);
// if (!$db_selected) {
//   die ('Can\'t use db : ' . mysqli_error());
// }

if(!isset($_SESSION['email']) || !isset($_SESSION['username'])) {
  // 로그인 안했을 때
  $query = sprintf("SELECT maptbl.id as id, maptbl.name as name, citytbl.city_name as city, maptbl.address as address, maptbl.lat as lat, maptbl.lng as lng, chargetypetbl.type as type, ( 6371 * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) AS distance FROM maptbl INNER JOIN citytbl on maptbl.city_id = citytbl.city_id LEFT OUTER JOIN chargetypetbl on maptbl.type_id = chargetypetbl.type_id HAVING distance < '%s' ORDER BY distance LIMIT 0 , 3000",
    mysqli_real_escape_string($conn, $center_lat),
    mysqli_real_escape_string($conn, $center_lng),
    mysqli_real_escape_string($conn, $center_lat),
    mysqli_real_escape_string($conn, $radius));
  $result = $conn->query($query);
  if (!$result) {
    die('Invalid query: ' . $conn->connect_error);
  }
  
  header("Content-type: text/xml");

  while ($row = $result->fetch_assoc()){
    // Add to XML document node
    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);
    $newnode->setAttribute("id",$row['id']);
    $newnode->setAttribute("name",$row['name']);
    $newnode->setAttribute("city",$row['city']);
    $newnode->setAttribute("address", $row['address']);
    $newnode->setAttribute("lat", $row['lat']);
    $newnode->setAttribute("lng", $row['lng']);
    $newnode->setAttribute("type", $row['type']);
    $newnode->setAttribute("distance", $row['distance']);
  }
  // 연결 종료
   $conn->close();
  echo $dom->saveXML();
  
} else {
   $query1 = sprintf("SELECT maptbl.id as id, maptbl.name as name, citytbl.city_name as city, maptbl.address as address, maptbl.lat as lat, maptbl.lng as lng, chargetypetbl.type as type, favoritetbl.f_status as f_status,( 6371 * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) AS distance FROM maptbl INNER JOIN citytbl on maptbl.city_id = citytbl.city_id LEFT OUTER JOIN chargetypetbl on maptbl.type_id = chargetypetbl.type_id LEFT OUTER JOIN favoritetbl ON favoritetbl.m_id = maptbl.id HAVING distance < '%s' ORDER BY distance LIMIT 0 , 3000",
    mysqli_real_escape_string($conn, $center_lat),
    mysqli_real_escape_string($conn, $center_lng),
    mysqli_real_escape_string($conn, $center_lat),
    mysqli_real_escape_string($conn, $radius));
  $result1 = $conn->query($query1);
  if (!$result1) {
    die('Invalid query: ' . $conn->connect_error);
  }
  
  header("Content-type: text/xml");

  while ($row1 = $result1->fetch_assoc()){
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
    $newnode->setAttribute("f_status", $row1['f_status']);
    $newnode->setAttribute("distance", $row1['distance']);
  }
  // 연결 종료
   $conn->close();
  echo $dom->saveXML();
  
}

?>
