<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- W3.CSS -->
    <link rel="stylesheet" href="css/w3.css">
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
    <meta http-equiv="refresh" content="0;url=index.php" />
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
          color: #DF123B;
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
      <h1 class="loadingText">로그아웃 중 ...</h1>
      <p class="spinner"><i class="fa fa-spinner w3-spin"></i></p>
   </div>

   <?php
      session_start();
      session_unset();
      session_destroy();
   ?>
</body>
</html>

