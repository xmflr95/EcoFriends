<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- W3.CSS -->
    <link rel="stylesheet" href="css/w3.css">
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
    <meta http-equiv="refresh" content="0;url=signIn.php" />
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Sign in | EcoFriends</title>

    <style>
       .box {
          margin-top: 15%;
       }

       .loadingText {
          font-size: 80px;
          text-align: center;
          color: #0C8D24;
       }

       .spinner {
          text-align: center;
          margin: 30px 0;
       }

       .fa {
          font-size:160px;
         margin: 30px 0;
         color: #5D5859;
       }

       @media (max-width: 575.98px) {
         .box {
            margin-top: 50%;
         }

         .loadingText {
            font-size: 30px;
         }

          .fa {
            font-size:90px;
             margin: 30px 0;
          }
       }
    </style>
</head>
<body>
   <div class="w3-container w3-panel w3-mobile box">
      <h1 class="loadingText">회원가입 중 ...</h1>
      <p class="spinner"><i class="fa fa-spinner w3-spin"></i></p>
   </div>
   <?php
   require("dbinfo.php");

   // Create connection & check connect
   $conn = new mysqli($servername, $username, $password, $dbname);

   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }

   $userEmail = $_POST["email"];
   $userName = $_POST["username"];
   $userPassword = $_POST["pwd"];
   $userCPassword = $_POST["cPwd"];

   // 패스워드 암호화(hash) -> sha256알고리즘 사용
   // $hashPass = hash('sha256', $userPassword);
   // $hashCpass = hash('sha256', $userCPassword);
   // $cpHash = ($hashPass === $hashCpass);

   // // 패스워드 암호화(password_hash)
   const PASSWORD_COST = ['cost'=>7]; // 암호화 복잡도 증가(기본값 10)
   $phashPass = password_hash($userPassword, PASSWORD_DEFAULT, PASSWORD_COST);

   // echo "<p> 이메일 : " . $userEmail . "</p>";
   // echo "<p> 이름 : " . $userName . "</p>";
   // echo "<p> 패스워드 : " . $userPassword . "</p>";
   // echo "<p> 확인패스워드 : " . $userCPassword . "</p>";
   // echo "<p> 패스워드(해쉬값1) : " . $hashPass . "</p>";
   // echo "<p> 확인패스워드(해쉬값1) : " . $hashCpass . "</p>";
   // echo "<p> 패스워드(해쉬값2) : " . $phashPass . "</p>";
   // echo "<p> 확인패스워드(해쉬값2) : " . $phashPass . "</p>";
   // echo "<p> 해쉬값 비교 : " . $cpHash . "</p>";

   // if ( !password_verify($userPassword , $phashPass)) {
   //     echo "해쉬와 패스워드 불일치 <br>";
   // } else {
   //     echo "해쉬와 패스워드 일치 <br>";
   // }

   // if ( !password_verify($userCPassword, $phashPass)) {
   //     echo "확인 비밀번호가 비밀번호와 같지않습니다. <br>";
   // } else {
   //     echo "확인 비밀번호와 비밀번호가 일치합니다. <br>";
   // }

   if ($userPassword != $userCPassword) {
      echo "<script>alert('확인 비밀번호가 일치하지 않습니다.');";
      echo "window.location.replace('signUp.php');</script>";
   }

   $sql = "INSERT INTO usertbl(user_email, user_name, user_pwd, user_cPwd) VALUES ('" . $userEmail . "', '" . $userName ."', '" . $phashPass . "', '" . $phashPass . "')";

   $findSQl = "SELECT user_email, user_name FROM usertbl ";
   $result = $conn->query($findSQl);

   while($row = $result->fetch_assoc()) {
      $r_id = $row['user_email'];
      // $r_name = $row['user_name'];

      if ($r_id == $userEmail) {
         echo "<script>alert('이미 가입된 회원입니다.');";
         echo "window.location.replace('signUp.php?overlap=true');</script>";
         return;
      } else {
         continue;
      }
   }

   if ($conn->query($sql) === TRUE) {
         echo "<script>alert('회원가입 성공!');</script>";
   } else {
         echo "Error : " . $sql . "<br>" . $conn->error;
   }

   // 연결 종료
   $conn->close();
   ?>
</body>
</html>