<!DOCTYPE html>
<?php session_start(); ?>
<html lang="ko">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">

   <!-- W3.CSS -->
   <link rel="stylesheet" href="/css/w3.css">
   <link rel="stylesheet" href="/css/w3-colors-flat.css">
   <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->

   <!-- font-awesome -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <title>Sign up | EcoFriends</title>

   <style>
      .w3-sidebar a {
         font-family: "Roboto", sans-serif
      }

      body,
      h1,
      h2,
      h3,
      h4,
      h5,
      h6,
      .w3-wide {
         font-family: "Montserrat", sans-serif;
      }

      #mySidebar {
         z-index: 3;
         width: 250px;
         top: 52px;
         bottom: 0;
         height: inherit;
      }

      #mainContent {
         margin-left: 250px;
         margin-top: 50px;
      }

      @media (min-width: 992px) {
         #signBox {
            margin: 0 25%;
         }
      }
   </style>
</head>

<body class="w3-content" style="max-width: 100vw">
   <!-- <body class="w3-content" style="max-width: 100%"> -->

   <!-- Navbar -->
   <?php include('navbar.php'); ?>

   <!-- Top menu on small screens
<header class="w3-bar w3-top w3-hide-large w3-white w3-xlarge">
    <div class="w3-bar-item w3-padding-24 w3-wide">
        <strong style="color: darkcyan;">Eco</strong> Friends
    </div>
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()">
        <i class="fa fa-bars"></i>
    </a>
</header> -->

   <!-- Sidebar/menu -->
   <?php include('sidebar.php'); ?>

   <!-- 사이드바 열었을떄 사이드바 외의 부분 클릭시 사이드바 사라 -->
   <!-- Overlay effect when opening sidebar on small screens -->
   <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu"
      id="myOverlay"></div>

   <!-- !PAGE CONTENT! -->
   <div class="w3-main" id="mainContent">

      <!-- 모바일용 마진-탑 -->
      <!-- Push down content on small screens -->
      <!-- <div class="w3-hide-large" style="margin-top:83px"></div> -->

      <!-- Top header -->
      <header class="w3-container w3-xlarge"">
        <p class=" w3-left">Sign up</p>
      </header>

      <!-- Image header -->
      <div class="w3-display-container w3-container w3-margin-bottom w3-mobile" id="signBox">
      <?php if(!isset($_SESSION['email'])) { ?>
         <form class="w3-container" action="signUp_ok.php" method="POST">
            <div class="w3-section">
               <label><b>Email address</b></label>
               <input class="w3-input w3-border w3-margin-bottom" type="email" placeholder="Enter Email" name="email"
                  required>
               <label><b>Name</b></label>
               <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Name" name="username"
                  required>
               <label><b>Password</b></label>
               <input class="w3-input w3-border w3-margin-bottom" type="password" placeholder="Enter Password"
                  name="pwd" required>
               <label><b>Confirm Password</b></label>
               <input class="w3-input w3-border w3-margin-bottom" type="password" placeholder="Confirm Password"
                  name="cPwd" required>
               <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Sign up</button>
            </div>
         </form>
      <?php
      } else {
         $user_id = $_SESSION['email'];
         echo "<p><strong>($user_id)</strong>님은 이미 로그인 하고 있습니다. <br>";
         echo "<a href='index.php'>[돌아가기]</a> ";
         echo "<a href='logout.php'>[로그아웃]</a></p>";
      }
      ?>
      </div>      

      <?php include('footer.php'); ?>

      <!-- End page content -->
   </div>

   <script>
      // Accordion 
      function myAccFunc() {
         var x = document.getElementById("demoAcc");
         if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
         } else {
            x.className = x.className.replace(" w3-show", "");
         }
      }

      // Click on the "Jeans" link on page load to open the accordion for demo purposes
      // 밑의 코드는 미리 아코디언이 켜져있게함
      // document.getElementById("myBtn").click();


      // Open and close sidebar
      function w3_open() {
         document.getElementById("mySidebar").style.display = "block";
         document.getElementById("myOverlay").style.display = "block";
      }

      function w3_close() {
         document.getElementById("mySidebar").style.display = "none";
         document.getElementById("myOverlay").style.display = "none";
      }
   </script>

</body>

</html>