<?php
require("dbinfo.php");

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

//즐겨찾기 sql
$favSql = "SELECT favoritetbl.f_id as f_id, citytbl.city_name as f_cityname, maptbl.name as f_name, favoritetbl.m_id as m_id FROM favoritetbl LEFT JOIN maptbl ON favoritetbl.m_id = maptbl.id JOIN citytbl ON citytbl.city_id = maptbl.city_id WHERE u_id = $usr_id AND f_status = 1 ORDER BY f_id LIMIT 0, 5";

// $result2 = $conn->query($favSql);
// $row2 = $result2->fetch_assoc();
// $del_id = row2['']
// $delsql = "DELETE FROM favorite WHERE f_id='$f_id' ";

$result1 = $conn->query($favSql);

$favcnt = 1;

if($result1->num_rows > 0) {
        echo "<thead>";
        echo "<tr>";
        echo "<td class='w3-center'>번호</td>";
        echo "<td>지역</td>";
        echo "<td>장소명</td>";
        echo "<td class='w3-center'>지우기</td>";
        echo "</tr>";
        echo "</thead>";

    while($row1=$result1->fetch_assoc()) {
        $f_id = $row1['f_id'];
        $f_name = $row1['f_name'];
        $f_cityname = $row1['f_cityname'];
        $fm_id = $row1['m_id'];

        echo "<tr>";
        echo "<td class='w3-center'>$favcnt</td>";
        echo "<td>$f_cityname</td>";
        echo "<td><a href='allStation.php?fid=$fm_id' style='text-decoration:none; font-weight:bold;'>$f_name</a></td>";
        echo "<td class='w3-center'><button class='w3-button w3-hover-blue' style='padding: 0; margin: 0;' onclick='deleteFav($fm_id)';><i class='fa fa-times'></i></button></td>";
        echo "</tr>";

        $favcnt++;
    }
} else {
    echo "<p class='w3-padding w3-margin-left'>등록된 즐겨찾기가 없습니다.</p>";
    echo "<p><a href='allStation.php' class='w3-text-white w3-btn w3-light-blue w3-padding-large w3-margin-left' id='m_favAddBtn'><b>즐겨찾기 등록<b></a></p>";
}
?>