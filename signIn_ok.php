<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- W3.CSS -->
    <link rel="stylesheet" href="css/w3.css">
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->

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
      <h1 class="loadingText">로그인 중 ...</h1>
      <p class="spinner"><i class="fa fa-spinner w3-spin"></i></p>
   </div>

    <?php
   require("dbinfo.php");

      // Create connection & check connect
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
      }

      if ( !isset($_POST['email'])) {
         header("Content-Type: text/html; charset=UTF-8");
         echo "<script>alert('아이디 또는 비밀번호가 빠졌거나 잘못된 접근입니다.');";
         echo "window.location.replace('signIn.php');</script>";
         exit();
      }

   $userEmail = $_POST['email'];
   $userPassword = $_POST['pwd'];

   $checkSql = "SELECT * FROM usertbl WHERE user_email='$userEmail' ";

   $result = $conn->query($checkSql);
   if($result->num_rows == 1) {
      while($row=$result->fetch_assoc()) {
         if (password_verify($userPassword, $row['user_pwd'])) {
               // 비밀번호가 같을 시
               if($row['user_email'] == $userEmail) {
                  session_start();
                  $_SESSION['userid'] = $row['user_id'];
                  $_SESSION['email'] = $userEmail;
                  $_SESSION['username'] = $row['user_name'];
                  echo "<script>window.location.replace('index.php?login=success');</script>";
                  //  echo $_SESSION['email'] . "<br>";
                  //  echo  $_SESSION['username'];
               } else {
                  echo "<script>alert('세션 저장 실패');</script>";
               }
         } else {
               // echo "해쉬와 패스워드 불일치 <br>";
               echo "<script>alert('패스워드 불일치!');";
               echo "window.location.replace('signIn.php');</script>";
               exit();
               // header("Location: ../w3_logintest.php");
               // exit;
         }
      }
   } else {
      echo "<script>alert('가입된 정보가 없습니다.');";
      echo "window.location.replace('signIn.php');</script>";
      exit();
   }
   ?>
</body>
</html>
