<!DOCTYPE html>
<?php session_start(); ?>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- W3.CSS -->
    <link rel="stylesheet" href="/css/w3.css">
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->

    <!-- font-awesome -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>About | EcoFriends</title>

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

<body class="w3-content" style="max-width: 100vw">
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

   <!-- Top header -->
    <header class="w3-container w3-xlarge">
        <p class="w3-left" style="margin-bottom: 4px;">EcoFrineds는...</p>
    </header>

    <!-- Subscribe section -->
    <div class="w3-container w3-light-gray w3-margin" id="favContent">
        <h2 class="w3-margin">공공 데이터를 이용해 전기차 충전소를 보여주는 사이트입니다.</h2>
        <p class="w3-padding w3-large" title="2025년 세계 전기차시장 10배 ‘껑충’-한겨레신문">지난해 110만대로 사상 처음 100만대를 돌파한 세계 전기차 시장이 2025년에 연간 1100만대로 급팽창할 것이라는 전망이 나왔다. 8년만에 10배라는 무서운 성장 속도를 보일 것이라는 예측이다. - 한겨레신문(2018-05-22)</p>
        <p class="w3-padding w3-large" title="">전기차의 무서운 성장 속도에 맞춰 늘어나는 충전소의 위치를 알고 싶은 사람들을 위해서 만든 사이트입니다.</p>
        <p class="w3-padding w3-large" title="">기타 수정과 문의 사항은 <b>xmflr95@gmail.com</b>으로 메일 부탁드립니다.</p>
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
</script>

</body>

</html>