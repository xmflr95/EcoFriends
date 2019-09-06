<!DOCTYPE html>
<?php 
session_start(); 
?>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- W3.CSS -->
    <link rel="stylesheet" href="/css/w3.css">
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- font-awesome -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>가까운 충전소 | EcoFriends</title>

    <style>
        #map {
            height: 600px;
            overflow: none;
        }
        
        #mainContent {
            margin-left:250px;
            margin-top: 50px;
        }

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

        #addrSearch {
            display: inline;
            margin-right: 16px;
        }

        #rSelec {
            display: inline;
            margin-right: 16px;
        }

        #radiusSelect {
            margin-right: 16px;
            width: 100px;
        }

        #locSelect {
            display: inline;
            margin-right: 16px;
        }

        #locationSelect {
            margin-right: 16px;
            width: 200px;
        }

        #searchButton {
            display: inline;
            width: 100px;
        }

        @media (max-width: 575.98px) {
            #addrSearch {
                display: block;
                margin: 0 0 8px 0;
            }

            #addressInput {
                width: 85%;
            }

            #rSelec {
                display: block;
                margin: 0 0 8px 0;
            }

            #radiusSelect {
                width: 30%;
                margin: 0 8px 8px 0;
            }

            #locationSelect {
                width: 50%;
                margin: 0 0 8px 0;
            }
            
            #searchButton {
                width: 100%;
            }
        }

        @media (min-width: 576px) and (max-width: 767.98px) {
            #map {
              height: 600px;
           }
        }

         @media (min-width: 768px) and (max-width: 991.98px) {
            #map {
              height: 750px;
           }
         }

         @media (min-width: 992px) and (max-width: 1199.98px) {
            #map {
              height: 800px;
           }
         }

         @media (min-width: 1200px) {
            #map {
              height: 1000px;
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
<?php
include('sidebar.php');
?>

<!-- 사이드바 열었을떄 사이드바 외의 부분 클릭시 사이드바 사라 -->
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu"
    id="myOverlay">
</div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" id="mainContent">

    <!-- Top header -->
    <header class="w3-container w3-xlarge"">
        <p class="w3-left">현재 위치와 가까운 충전소</p>
    </header>

    <div class="w3-container w3-margin-bottom w3-fixed menuBtn">
        <div id="rSelec">
            <label for="radiusSelect">거리:&nbsp;</label>
            <select class="w3-select" id="radiusSelect" label="Radius" name="option">
                <option value="100">100 kms</option>
                <option value="50">50 kms</option>
                <option value="30">30 kms</option>
                <option value="10">10 kms</option>
                <option value="5" selected>5 kms</option>
                <option value="3">3 kms</option>
                <option value="1">1 kms</option>
            </select>
            
            <select class="w3-select" id="locationSelect" style="visibility: hidden"></select>
        </div>
        <div id="addrSearch">
            <input class="w3-btn w3-green w3-hover-teal" type="button" id="myloc" value="내 위치 보기" />
        </div>

        <!-- <input type="button" id="searchButton" value="Search" /> -->
    </div>

    <div class="w3-display-container w3-container w3-margin-bottom" id="mapcontent">
        <!-- Map -->
        <div class="" id="map"></div>
        <!-- //Map -->
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
    document.getElementById("myBtn").click();

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

<script>
      var map;
      var markers = [];
      var infoWindow;
      var locationSelect;
      var nowLoc;
      var userMarker;
      var customMarker = '../mapicon/Here3.png';

      var startPoint = {
         lat: 35.848987,
         lng: 128.72818
      }

      // InitMap() 시작
      function initMap() { 
         var koreaCenter = {
            lat: 36.7653,
            lng: 127.9532
         };

         map = new google.maps.Map(document.getElementById('map'), {
            center: koreaCenter,
            zoom: 8,
            maxZoom: 19,
            minZoom: 8,
            
            // map control options
            mapTypeId: 'roadmap',
            // 스크롤 설정(상호작용)
            gestureHandling: 'greedy',

            streetViewControl: false,
            mapTypeControlOptions: {
               style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
            },
         });
         infoWindow = new google.maps.InfoWindow();

         map.addListener('click', function() {
            infoWindow.close();
         });

         myloc = document.getElementById("myloc").onclick = searchLocations2;
         
         locationSelect = document.getElementById("locationSelect");
         locationSelect.onchange = function () {
            var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
            if (markerNum != "none") {
               google.maps.event.trigger(markers[markerNum], 'click');
            }
         };
      }

      function searchLocations2() {
         if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
            nowLoc = {
               lat: position.coords.latitude,
               lng: position.coords.longitude
            };

            // console.log("lat : " + nowLoc.lat + " / lng : " + nowLoc.lng);

            searchLocationsNear2(nowLoc);
         }, function() {
            handleLocationError(true, infoWindow, map.getCenter(startPoint));
         });
         } else {
         // Browser doesn't support Geolocation
            alert("Your Location not found");
            handleLocationError(false, infoWindow, map.getCenter(startPoint));
         }

         // if (nowLoc !== null) {
         //    searchLocationsNear2(nowLoc);
         // } else {
         //    alert("Your Location not found");
         // }
      }

      function clearLocations() {
         infoWindow.close();
         for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
         }
         markers.length = 0;

         locationSelect.innerHTML = "";
         var option = document.createElement("option");
         option.value = "none";
         option.innerHTML = "See all results:";
         locationSelect.appendChild(option);
      }

      function searchLocationsNear2(center) {
         clearLocations();
         var radius = document.getElementById('radiusSelect').value;
         var searchUrl = 'map/mapLocator.php?lat=' + center.lat + '&lng=' + center.lng + '&radius=' + radius;
          // 내 위치 Latlng
         var myPlace = new google.maps.LatLng(center.lat, center.lng);
         // console.log(searchUrl);
         // console.log(center);
         // console.log(center.lat, center.lng);
         downloadUrl(searchUrl, function (data) {
            var xml = parseXml(data);
            var markerNodes = xml.documentElement.getElementsByTagName("marker");
            var bounds = new google.maps.LatLngBounds();
            for (var i = 0; i < markerNodes.length; i++) {
               var id = markerNodes[i].getAttribute("id");
               var name = markerNodes[i].getAttribute("name");
               var address = markerNodes[i].getAttribute("address");
               var distance = parseFloat(markerNodes[i].getAttribute("distance"));
               var latlng = new google.maps.LatLng(
                  parseFloat(markerNodes[i].getAttribute("lat")),
                  parseFloat(markerNodes[i].getAttribute("lng")));
               var type = markerNodes[i].getAttribute("type");
               var f_status = markerNodes[i].getAttribute("f_status");

               createOption(name, distance, i);
               createMarker(id, latlng, name, address, type, f_status);

               bounds.extend(myPlace);
               bounds.extend(latlng);
            }
            map.fitBounds(bounds, 10);
            
            locationSelect.style.visibility = "visible";
            locationSelect.onchange = function () {
               var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
               google.maps.event.trigger(markers[markerNum], 'click');
            };
         });
      }

      function handleLocationError(browserHasGeolocation, infoWindow, nowLoc) {
         map.setCenter(startPoint);
         infoWindow.setPosition(nowLoc);
         infoWindow.setContent(browserHasGeolocation ?
         '에러! 위치 서비스 실패, HTTPS가 지원되지 않습니다.' :
         '에러! 당신의 브라우저가 Geolocation을 지원하지 않습니다. 최신 브라우저를 사용해 주세요');
         infoWindow.open(map);
      }

      function createMarker(id, latlng, name, address, type, f_status) {

         var infowincontent = document.createElement('div');
         infowincontent.setAttribute('class', 'w3-container');
         // <strong>
         var strong = document.createElement('strong');
         strong.textContent = name;
         strong.setAttribute('class', 'w3-xlarge');
         infowincontent.appendChild(strong);
         // <br/>
         infowincontent.appendChild(document.createElement('br'));
         infowincontent.appendChild(document.createElement('br'));
         // <text>
         var text = document.createElement('text');
         text.textContent = address;
         text.setAttribute('class', 'w3-default');
         infowincontent.appendChild(text);
         // <br/>
         infowincontent.appendChild(document.createElement('br'));
         infowincontent.appendChild(document.createElement('br'));
         // <text>
         var info = document.createElement('text');
         var typetext = "타입 : " + type;
        //  console.log(typetext);
         info.textContent = typetext;
         info.setAttribute('class', 'w3-default');
         infowincontent.appendChild(info);
         // <br/><br/>
         infowincontent.appendChild(document.createElement('br'));
         infowincontent.appendChild(document.createElement('br'));
         // <button>
         var addBtn = document.createElement('button');
         addBtn.setAttribute('class', 'w3-button w3-teal w3-hover-green');
         addBtn.setAttribute('id', 'favBtn');
         if(f_status == "" || f_status == null) {
            addBtn.innerHTML = "즐겨찾기";
         } else {
            addBtn.innerHTML = "즐겨찾기 삭제";
         }
         addBtn.onclick = function () {
            addFavor(id, f_status);
         };
         infowincontent.appendChild(addBtn);

         
         var marker = new google.maps.Marker({
            map: map,
            position: latlng
         });
         
         google.maps.event.addListener(marker, 'click', function () {
            infoWindow.setContent(infowincontent);
            infoWindow.open(map, marker);
         });

         var userInfowin = document.createElement('div');
         var strong2 = document.createElement('strong');
         strong2.textContent = "당신의 현재 위치";
         strong2.setAttribute('class', 'w3-xlarge');
         infowincontent.appendChild(strong2);
         userInfowin.appendChild(strong2);
         
         var userMarker = new google.maps.Marker({
            map: map,
            draggable: false,
            // animation: google.maps.Animation.DROP,
            // position: {lat: position.coords.latitude, lng: position.coords.longitude}
            animation: google.maps.Animation.DROP,
            position: {lat: nowLoc.lat, lng:nowLoc.lng},
            icon: customMarker
         });

         userMarker.addListener('click', function() {
            infoWindow.setPosition(nowLoc);
            infoWindow.setContent(userInfowin);
            infoWindow.open(map, userMarker);
         });

         markers.push(marker);
         markers.push(userMarker);
      }

      function createOption(name, distance, num) {
         var option = document.createElement("option");
         option.value = num;
         option.innerHTML = name;
         locationSelect.appendChild(option);
      }

      function downloadUrl(url, callback) {
         var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

         request.onreadystatechange = function () {
            if (request.readyState == 4) {
               request.onreadystatechange = doNothing;
               callback(request.responseText, request.status);
            }
         };

         request.open('GET', url, true);
         request.send(null);
      }

      function parseXml(str) {
         if (window.ActiveXObject) {
            var doc = new ActiveXObject('Microsoft.XMLDOM');
            doc.loadXML(str);
            return doc;
         } else if (window.DOMParser) {
            return (new DOMParser).parseFromString(str, 'text/xml');
         }
      }

      // Ajax
      function addFavor(num, f_status) {
         if (num == "") {
            return;
         } else {
            if (window.XMLHttpRequest) {
               // code for IE7+, Firefox, Chrome, Opera, Safari
               xmlhttp = new XMLHttpRequest();
            } else {
               // code for IE6, IE5
               xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
               if (this.readyState == 4 && this.status == 200) {
                  alert(this.responseText);
                  var fBtn = document.getElementById('favBtn').innerHTML;
                  
                  if (f_status == null || f_status == undefined) { // 로그인 안했을 때
                     document.getElementById('favBtn').innerHTML = "즐겨찾기";
                  } else { // 로그인 했을 경우
                     if (fBtn == "즐겨찾기") {
                        document.getElementById('favBtn').innerHTML = "즐겨찾기 삭제";
                     } else {
                        document.getElementById('favBtn').innerHTML = "즐겨찾기";
                     }
                  }
               }
            };
            xmlhttp.open("GET","favControl.php?q="+num, true);
            xmlhttp.send();
         }
      }

      function doNothing() {}
   </script>
   <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjns8IGUUxUZmAQxSxHQfXVS3ns5QdMkg&callback=initMap">
   </script>

<!-- //Map Script -->

</body>

</html>