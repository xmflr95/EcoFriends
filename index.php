<!DOCTYPE html>
<?php session_start(); ?>
<html lang="ko">

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

    <title>전국 모든 전기차 충전소 | EcoFriends</title>

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
            z-index:3;
            width:250px;
            top: 52px;
            bottom: 0;
            height: inherit;
        }
        
        #mainContent {
            margin-left:250px;
            margin-top: 50px;
        }

        #mainTitle {
            padding: 24px 48px;
        }

        #favContent {
            padding: 0px;
        }

        #favTitle {
            margin-bottom: 16px;
            padding-left: 14px;
        }

        #m_favAddBtn {
            font-size: 20px;
        }

        @media (max-width: 575.98px) {
            #mainTitle {
                padding: 14px 24px;
            }

            #favTitle {
                font-size: 20px;
                margin-bottom: 10px;
            }

            td {
                font-size: 13px;
            }

            #m_favAddBtn {
                font-size: 15px;
                padding: 10px 20px;
            }
        }

        
    </style>
</head>

<body class="w3-content w3-light-grey" style="max-width: 100vw;">
<!-- <body class="w3-content" style="max-width: 100%"> -->

<!-- Navbar -->
<?php 
include('navbar.php');
?>

<!-- Sidebar/menu -->
<?php
include('sidebar.php');
?>

<!-- 사이드바 열었을떄 사이드바 외의 부분 클릭시 사이드바 사라 -->
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu"
    id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" id="mainContent">

    <!-- Image header -->
    <div class="w3-display-container">
        <img src="/img/car.jpg" alt="Background Car Image" style="width:100%">
        <div class="w3-display-topleft w3-text-dark-gray" id="mainTitle">
            <!-- Large Screen -->
            <h1 class="w3-jumbo w3-hide-small w3-hide-medium"><b>전국 방방곡곡의<br>충전소의 수는?</b></h1>            
            <!-- Tablet Screen(Medium) -->
            <h1 class="w3-xxlarge w3-hide-small w3-hide-large"><b>전국 방방곡곡의<br>충전소의 수는?</b></h1>
            <!-- Small Screen -->
            <h1 class="w3-hide-large w3-hide-medium w3-large" style="margin: 0 0 10px;"><b>전국 방방곡곡의<br>충전소의 수는?</b>
            </h1>
            <!-- 카운터 -->
            <h1 class="w3-wide w3-hide-small w3-hide-medium" style="font-size: 6.5rem;line-height: 1.5em;color: rgb(173, 171, 171);text-shadow: 1px 2px 2px black;" id="counter">
            <?php
            require("counter1.php");
            ?>
            </h1>
            <!-- 미디움 -->
            <h1 class="w3-wide w3-jumbo w3-hide-small w3-hide-large" style="line-height: 1.5em;color: rgb(173, 171, 171);text-shadow: 1px 2px 2px black;" id="counter3">
            <?php
            require("counter3.php");
            ?>
            </h1>
            
            <h1 class="w3-wide w3-xxlarge w3-hide-large w3-hide-medium" style="line-height: 1.5em;color: rgb(173, 171, 171);text-shadow: 1px 2px 2px black;" id="counter2">
            <?php
            require("counter2.php");
            ?>
            </h1>

            <p><a href="allStation.php"
            class="w3-hide-small w3-hide-medium w3-button w3-hover-green w3-teal w3-padding-large w3-large">더
            찾아보기</a></p>
            <p><a href="allStation.php"
            class="w3-hide-small w3-hide-large w3-button w3-hover-green w3-teal w3-padding-large w3-large">더
            찾아보기</a></p>
            <p><a href="allStation.php" class="w3-hide-large w3-hide-medium w3-button w3-hover-green w3-teal w3-padding-large w3-large">더 찾아보기</a></p>
        </div>
    </div>

    <!-- Subscribe section -->
    <div class="w3-container w3-blue w3-margin" id="favContent">
        <h1 id="favTitle">즐겨찾는 충전소</h1>

    <?php if(!isset($_SESSION['email']) || !isset($_SESSION['username'])) { ?>
        <p class="w3-padding w3-margin-left">로그인이 필요한 기능입니다.<br>로그인을 해주세요.</p>
        <p><a href="signIn.php" class="w3-btn w3-light-blue w3-padding-large w3-large w3-text-white w3-margin-left">로그인하기</a></p>
    <?php } else { ?>
        <table class="w3-table w3-large w3-bordered" id="favTable">
            
            <?php include('favTable.php'); ?>
            
        </table>
    <?php } ?>
    </div>
    
    <!-- Footer -->
    <?php include('footer.php'); ?>
    <!-- Footer -->    

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
    // Open and close sidebar
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("myOverlay").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("myOverlay").style.display = "none";
    }

    function deleteFav(m_id) {
        alert("즐겨찾기를 지우겠습니까?");
        document.location.href="delFavorite.php?mapnum=" + m_id;
    }
</script>

</body>

</html>