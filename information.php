<!DOCTYPE html>
<?php session_start(); ?>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- W3.CSS -->
    <link rel="stylesheet" href="/css/w3.css">
    <!-- flat ui color -->
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->

    <!-- font-awesome -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Information | EcoFriends</title>

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

        .Grid {
            padding: 0 20px 0 20px;
        }

        .charType { 
            cursor:pointer;
            display:inline-block;
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

        .img1 {
               height: 300px;
           }

           .img2 {
               height: 250px;
           }

      @media (min-width: 768px) and (max-width: 991.98px) {
         .Grid {
              padding-bottom: 20px;
           }
      }

      @media (min-width: 992px) and (max-width: 1199.98px) {
         .Grid {
              padding-bottom: 30px;
           }
      }

      @media (min-width: 1200px) {
         .Grid {
            padding-bottom: 50px;
         }

         .img1 {
            height: 500px;
         }

         .img2 {
            height: 450px;
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
    <header class="w3-container w3-xlarge">
        <p class="w3-left">충전기 타입</p>
    </header>
    
    <div class="w3-row Grid">
        <div class="w3-half w3-border w3-hover-border-teal w3-center w3-card-2 charType" onclick="document.getElementById('modal01').style.display='block';">
            <img src="img/ac_w.png" style="width:100%;" class="img1">
            <button onclick="document.getElementById('modal01').style.display='block'" class="w3-button w3-teal w3-large" style="width:100%; height:auto;">AC완속</button>
        </div>
        <div class="w3-half w3-border w3-hover-border-teal w3-center w3-card-2 charType" onclick="document.getElementById('modal02').style.display='block';">
            <img src="img/dc_cha.png" style="width:100%;" class="img1">
            <button onclick="document.getElementById('modal02').style.display='block'" class="w3-button w3-teal w3-large" style="width:100%; height:auto;">DC차데모</button>
        </div>
    </div>
    <div class="w3-row Grid" style="padding-bottom: 24px;">
        <div class="w3-half w3-border w3-hover-border-teal w3-center w3-card-2 charType" onclick="document.getElementById('modal03').style.display='block';">
            <img src="img/dc_combo.png" style="width:100%;" class="img2">
            <button onclick="document.getElementById('modal03').style.display='block'" class="w3-button w3-teal w3-large" style="width:100%; height:auto;">DC콤보</button>
        </div>
        <div class="w3-half w3-border w3-hover-border-teal w3-center w3-card-2 charType" onclick="document.getElementById('modal04').style.display='block';">
            <img src="img/ac_3.png" style="width:100%;" class="img2">
            <button onclick="document.getElementById('modal04').style.display='block'" class="w3-button w3-teal w3-large" style="width:100%; height:auto;">AC3상</button>
        </div>
    </div>
    

    <div id="modal01" class="w3-modal"  onclick="this.style.display='none'">
        <div class="w3-modal-content w3-animate-zoom w3-container w3-center " style="height:auto;">
            <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright w3-xxlarge">&times;</span>
            <img src="img/ac_w.png" style="width:100%; height:auto;" >
                <h2 style="text-shadow:1px 1px 0 #444">충전방식 : AC단상 5핀(완속)</h2>
                <p>가능차종: 블루온, 레이, 쏘울, 아이오닉, 스파크, i3, Leaf</p>          
        </div>
    </div>  
    <!-- </p>       
    <div class="w3-card-4" style="width:55%; height:auto; cursor:pointer" onclick="document.getElementById('modal02').style.display='block';">
        <div class="w3-border w3-hover-border-teal w3-center">
            <img src="img/dc_cha.png" style="width:80%; height:auto;" >
            <button onclick="document.getElementById('modal02').style.display='block'" class="w3-button w3-teal" style="width:100%; height:auto;">DC차데모</button>
        </div>                
    </div> -->
    <div id="modal02" class="w3-modal"  onclick="this.style.display='none'">
        <div class="w3-modal-content w3-animate-zoom w3-container w3-center " style="height:auto;">
            <img src="img/dc_cha.png" style="width:100%; height:auto;" >
            <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright w3-xxlarge">&times;</span>
                <h2 style="text-shadow:1px 1px 0 #444">충전방식 : DC차데모 10핀(급속)</h2>
                <p>가능차종: 블루온, 레이, 쏘울, 아이오닉, Leaf</p>          
        </div>
    </div>   
    <!-- </p>       
    <div class="w3-card-4" style="width:55%; height:auto; cursor:pointer" onclick="document.getElementById('modal03').style.display='block';">
        <div class="w3-border w3-hover-border-teal w3-center">
            <img src="img/dc_combo.png" style="width:80%; height:auto;" >
            <button onclick="document.getElementById('modal03').style.display='block'" class="w3-button w3-teal" style="width:100%; height:auto;">DC콤보</button>
        </div>                
    </div> -->
    <div id="modal03" class="w3-modal"  onclick="this.style.display='none'">
        <div class="w3-modal-content w3-animate-zoom w3-container w3-center " style="height:auto;">
            <img src="img/dc_combo.png" style="width:100%; height:auto;" >
            <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright w3-xxlarge">&times;</span>
                <h2 style="text-shadow:1px 1px 0 #444">충전방식 : DC콤보 7핀(급속)</h2>
                <p>가능차종: 니로, 스파크, i3</p>
        </div>
    </div>   
    <!-- </p>       
    <div class="w3-card-4" style="width:55%; height:auto; cursor:pointer" onclick="document.getElementById('modal04').style.display='block';">
        <div class="w3-border w3-hover-border-teal w3-center">
            <img src="img/ac_3.png" style="width:80%; height:auto;" >
            <button onclick="document.getElementById('modal04').style.display='block'" class="w3-button w3-teal" style="width:100%; height:auto;">AC3상</button>
        </div>                
    </div> -->
    <div id="modal04" class="w3-modal"  onclick="this.style.display='none'">
         <div class="w3-modal-content w3-animate-zoom w3-container w3-center " style="height:auto;">
               <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright w3-xxlarge">&times;</span>
                <img src="img/ac_3.png" style="width:100%; height:auto;" >
                    <h2 style="text-shadow:1px 1px 0 #444">충전방식 : AC3상 7핀(급속/완속)</h2>
                    <p>가능차종: sm3</p>          
        </div>
    </div>   

    <!-- Footer -->
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