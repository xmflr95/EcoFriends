<?php
session_start();
require("dbinfo.php");
$mapNum = $_GET['mapnum'];

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$useremail = $_SESSION['email'];
$username = $_SESSION['username'];

$userSql = "SELECT user_id FROM usertbl WHERE user_email='$useremail' AND user_name='$username' ";
$result = $conn->query($userSql);
$row = $result->fetch_assoc();

$usr_id = $row['user_id'];

$sql1 = "SELECT id, name, lat, lng FROM maptbl WHERE id=$mapNum ";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();

// echo $mapNum;
$m_id = $row1['id'];
$m_name = $row1['name'];

$delsql = "UPDATE favoritetbl SET f_status = 0 WHERE u_id = $usr_id AND m_id = $m_id ";
$conn->query($delsql);
?>
<meta http-equiv="refresh" content="0;url=index.php" />