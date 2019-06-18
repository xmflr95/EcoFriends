<?php 
require("dbinfo.php");
$q = intval($_GET['q']);
session_start();

// $q = $_POST['map_id'];

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(!isset($_SESSION['email']) || !isset($_SESSION['username'])) {
    // header("Content-Type: text/html; charset=UTF-8");
    echo "로그인이 필요합니다.";
} else {
    // echo "로그인 되어 있음<br>";

    $useremail = $_SESSION['email'];
    $username = $_SESSION['username'];

    // user에서 가져올 유저번호, 유저 이메일, 유저 이름
    $sql = "SELECT user_id, user_email, user_name FROM usertbl WHERE user_email='$useremail' AND user_name='$username' ";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $usr_id = $row['user_id'];
    
    // map에서 가져올 맵 번호, 주소, 설치 시도명
    $sql1 = "SELECT maptbl.id as id, maptbl.name as name, citytbl.city_name as city, maptbl.lat as lat, maptbl.lng as lng FROM maptbl INNER JOIN citytbl on maptbl.city_id = citytbl.city_id LEFT OUTER JOIN chargetypetbl on maptbl.type_id = chargetypetbl.type_id WHERE maptbl.id=$q ";

    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();

    $m_id = $row1['id'];
    $m_name = $row1['name'];
    $m_city = $row1['city'];
    $m_lat = $row1['lat'];
    $m_lng = $row1['lng'];
    
    // echo $m_name . "\n\n";

    // favorite 데이터 추가 sql f_status = 1
    $addsql = "INSERT INTO favoritetbl (u_id, m_id, f_status) VALUES ($usr_id, $m_id, 1)";

    // favorite 재검색 sql
   $f1sql = "SELECT favoritetbl.u_id as u_id, maptbl.id as m_id, favoritetbl.f_status as f_status FROM maptbl INNER JOIN citytbl on maptbl.city_id = citytbl.city_id LEFT JOIN chargetypetbl ON chargetypetbl.type_id = maptbl.type_id LEFT JOIN favoritetbl ON favoritetbl.m_id = maptbl.id WHERE favoritetbl.u_id = $usr_id OR favoritetbl.u_id is NULL ";

   // $fsql = "SELECT f_name, u_id, m_id FROM favoritetbl WHERE u_id=$usr_id";

    // favorite 삭제 sql
   //  $delsql = "DELETE FROM favoritetbl WHERE m_id=$m_id AND u_id=$usr_id ";
   $delsql = "UPDATE favoritetbl SET f_status = 0 WHERE u_id=$usr_id AND m_id = $m_id ";

   $toggle = "UPDATE favoritetbl SET f_status = 1 WHERE u_id=$usr_id AND m_id = $m_id ";

    // $addResult = $conn->query($addsql);
    $fResult = $conn->query($f1sql);

    // $addrow = $fResult->fetch_assoc();
    
    while($addrow = $fResult->fetch_assoc()) {
      //   $f_name = $addrow['f_name'];
        $fu_id = $addrow['u_id'];
        $fm_id = $addrow['m_id'];
        $f_status = $addrow['f_status'];
        
        if ($fm_id == $m_id && $fu_id == $usr_id && $f_status == 1) {
            $conn->query($delsql);
            echo "'" . $m_name . "' 즐겨찾기 삭제 완료!";
            return;
        } 

        if ($fm_id == $m_id && $fu_id == "" && $f_status == "") {
           $conn->query($addsql);
           echo "'" . $m_name . "' 즐겨찾기 추가 완료!";
           return;
        }

         if ($fm_id == $m_id && $fu_id == $usr_id && $f_status == 0) {
            $conn->query($toggle);
            echo "'" . $m_name . "' 즐겨찾기 추가 완료!";
            return;
         }
    }

   //  if ($conn->query($addsql) === TRUE) {
   //      echo "'" . $m_name . "' 즐겨찾기 추가 완료!";
   //      return;
   //  } else {
   //      echo "Error : " . $addsql . "<br>" . $conn->error;
   //  }
    
    
    $conn->close();
}
?>