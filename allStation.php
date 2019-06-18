<!DOCTYPE html>
<?php 
session_start(); 
require("dbinfo.php");

if(isset($_SESSION['email']) || isset($_SESSION['username'])) {
// Create connection & check connect
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

$useremail = $_SESSION['email'];
$username = $_SESSION['username'];

$sql = "SELECT user_id FROM usertbl WHERE user_email='$useremail' AND user_name='$username' ";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

$usr_id = $row['user_id'];

// echo "<script>console.log('세션 유저넘버 : ' + '$usr_id');</script>";

} else {
   $usr_id = null;
}
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

    <title>모든 충전소 | EcoFriends</title>

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

        #addressInput {
           display: inline;
           width: 250px;
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
              height: 650px;
           }

           #addressInput {
                width: 150px;
            }

           #locationSelect {
                width: 200px;
                margin: 0 0 8px 0;
            }
         }

         @media (min-width: 992px) and (max-width: 1199.98px) {
            #map {
              height: 650px;
           }

           #addressInput {
               width: 200px;
            }

           #locationSelect {
                width: 200px;
                margin: 0 0 8px 0;
            }
         }

         @media (min-width: 1200px) {
            #map {
              height: 800px;
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
        <p class="w3-left">모든 충전소</p>
    </header>

    <div class="w3-container w3-margin-bottom w3-fixed menuBtn">
        <!-- <div id="addrSearch">
            <label for="addressInput">장소:&nbsp;</label>
            <input class="w3-input" type="text" id="addressInput" size="20" />
        </div> -->
        <div id="rSelec">
            <label for="addressInput">장소:&nbsp;</label>
            <input class="w3-input" type="text" id="addressInput" size="20" autofocus onkeydown="Enter_Check();" tabindex="1"/>
            <label for="radiusSelect">거리:&nbsp;</label>
            <select class="w3-select" id="radiusSelect" label="Radius" name="option" tabindex="2">
                <option value="500">500 kms</option>
                <option value="250">250 kms</option>
                <option value="200">200 kms</option>
                <option value="150">150 kms</option>
                <option value="100">100 kms</option>
                <option value="50" selected>50 kms</option>
                <option value="30">30 kms</option>
                <option value="10">10 kms</option>
                <option value="5">5 kms</option>
                <option value="2.5">2.5 kms</option>
                <option value="1">1 kms</option>
            </select>

            <select class="w3-select" id="locationSelect" style="visibility: hidden" name="option" tabindex="3"></select>
        </div>

        <input class="w3-btn w3-green w3-hover-teal" type="button" id="searchButton" value="검색" tabindex="4" />
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
      var mid = getQueryStringObject();
      var mapNum = mid.fid;

      // custom icons
      var customIcon = {
         'DC차데모+AC3상+DC콤보': {
            name: 'DC차데모+AC3상+DC콤보',
            icon: '../mapicon/st5.png'
         },
         'AC3상+DC차데모+DC콤보': {
            name: 'DC차데모+AC3상+DC콤보',
            icon: '../mapicon/st5.png'
         },
         'DC콤보, DC차데모, AC3상': {
            name: 'DC차데모+AC3상+DC콤보',
            icon: '../mapicon/st5.png'
         },
         'DC차데모+AC3상': {
            name: 'DC차데모+AC3상',
            icon: '../mapicon/st2.png'
         },
         'DC차데모': {
            name: 'DC차데모',
            icon: '../mapicon/st6.png'
         },
         'DC콤보': {
            name: 'DC콤보',
            icon: '../mapicon/st3.png'
         },
         'AC3상': {
            name: 'AC3상',
            icon: '../mapicon/st.png'
         },
         'AC완속': {
            name: 'AC완속',
            icon: '../mapicon/st4.png'
         },


      }

      // 지도를 한국 내에서만 보도록
      // var SOUTH_KOREA_BOUNDS = {
      // north: 38.8955,
      // south: 33.0640,
      // west: 124.1100,
      // east: 131.5242,
      // };

      var daegu = {
         lat: 35.848987,
         lng: 128.72818
      }

      function initMap() {
         var koreaCenter = {
            lat: 36.7653,
            lng: 127.9532
         };

         
         map = new google.maps.Map(document.getElementById('map'), {
            // 지도 처음 위치
            center: koreaCenter,
            // 줌 설정(기본,최대,최소)
            zoom: 8,
            maxZoom: 19,
            minZoom: 7,
            // 맵 타입
            mapTypeId: 'roadmap',
            // 스크롤 설정(상호작용)
            gestureHandling: 'greedy',
            // 지도 국가 제한(동서남북 좌표로)
            // restriction: {
            //    latLngBounds: SOUTH_KOREA_BOUNDS,
            //    strictBounds: false,
            // },
            // 맵 컨트롤러 설정
            streetViewControl: false,
            mapTypeControlOptions: {
               style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
            }
         });

         infoWindow = new google.maps.InfoWindow();
         // 버튼에 이벤트 추가
         searchButton = document.getElementById("searchButton").onclick = searchLocations;
         
         if (mapNum != null) {
            favorLocation(mapNum);
         }

         locationSelect = document.getElementById("locationSelect");
         locationSelect.onchange = function () {
            var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
            if (markerNum != "none") {
               google.maps.event.trigger(markers[markerNum], 'click');
            }
         };

         // 마커가 커진상태에서 맵을 클릭하면 닫히게하기
         map.addListener('click', function() {
            infoWindow.close();
         });

         
      }

      function Enter_Check() {
         // 인풋에서 엔터키 입력시
         if (event.keyCode == 13) {
            searchLocations();
         }
      }

      // 쿼리 스트링 사용
      function getQueryStringObject() {
         var a = window.location.search.substr(1).split('&');
         if (a == "") return {};
         var b = {};
         for (var i = 0; i < a.length; ++i) {
            var p = a[i].split('=', 2);
            if (p.length == 1)
                  b[p[0]] = "";
            else
                  b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
         }
         return b;
      }

      function searchLocations() {
         var address = document.getElementById("addressInput").value;
         var geocoder = new google.maps.Geocoder();
         geocoder.geocode({
            address: address
         }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
               searchLocationsNear(results[0].geometry.location);
            } else if (address === "") {
                alert('찾는 장소를 입력해주세요.');
            } else {
                alert('\'' + address + '\'를 찾을 수 없습니다.');
            }
         });
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
         option.innerHTML = "위치 목록 보기:";
         locationSelect.appendChild(option);
      }

      function clearLocations2() {
         infoWindow.close();
         for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
         }
         markers.length = 0;
      }

      function favorLocation(map_id) {
         clearLocations2();

         var radius = document.getElementById('radiusSelect').value;
         var searchUrl = 'map/favLocator.php?mapid=' + map_id;
         downloadUrl(searchUrl, function (data) {
            var xml = parseXml(data);
            var markerNodes = xml.documentElement.getElementsByTagName("marker");
            var bounds = new google.maps.LatLngBounds();
            for (var i = 0; i < markerNodes.length; i++) {
               var id = markerNodes[i].getAttribute("id");
               var name = markerNodes[i].getAttribute("name");
               var city = markerNodes[i].getAttribute("city");
               var address = markerNodes[i].getAttribute("address");
               var distance = parseFloat(markerNodes[i].getAttribute("distance"));
               var latlng = new google.maps.LatLng(
                  parseFloat(markerNodes[i].getAttribute("lat")),
                  parseFloat(markerNodes[i].getAttribute("lng")));
               var type = markerNodes[i].getAttribute("type");
               var f_status = markerNodes[i].getAttribute("f_status");
               var usr_id = markerNodes[i].getAttribute("u_id");
               var fmap_id = markerNodes[i].getAttribute("m_id");
               
               // createMarker(id, latlng, name, address, type, f_status);
               createMarker(id, latlng, name, address, type, f_status);
               bounds.extend(latlng);
            }
            map.fitBounds(bounds);

         });
      }

      function searchLocationsNear(center) {
         clearLocations();

         var radius = document.getElementById('radiusSelect').value;
         var searchUrl = 'map/mapLocator.php?lat=' + center.lat() + '&lng=' + center.lng() + '&radius=' + radius;

         downloadUrl(searchUrl, function (data) {
            var xml = parseXml(data);
            var markerNodes = xml.documentElement.getElementsByTagName("marker");
            var bounds = new google.maps.LatLngBounds();
            for (var i = 0; i < markerNodes.length; i++) {
               var id = markerNodes[i].getAttribute("id");
               var name = markerNodes[i].getAttribute("name");
               var city = markerNodes[i].getAttribute("city");
               var address = markerNodes[i].getAttribute("address");
               var distance = parseFloat(markerNodes[i].getAttribute("distance"));
               var latlng = new google.maps.LatLng(
                  parseFloat(markerNodes[i].getAttribute("lat")),
                  parseFloat(markerNodes[i].getAttribute("lng")));
               var type = markerNodes[i].getAttribute("type");
               // var f_status = markerNodes[i].getAttribute("f_status");
               // var usr_id = markerNodes[i].getAttribute("u_id");
               // var fmap_id = markerNodes[i].getAttribute("m_id");
               
               createOption(name, distance, i);
               createMarker(id, latlng, name, address, type);
               bounds.extend(latlng);
            }
            map.fitBounds(bounds);

            locationSelect.style.visibility = "visible";
            locationSelect.onchange = function () {
               var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
               google.maps.event.trigger(markers[markerNum], 'click');
            };
         });
      }

      function createMarker(id, latlng, name, address, type) {
         // console.log(vname, addr);

         // <div>
         var infowincontent = document.createElement('div');
         infowincontent.setAttribute('class', 'w3-container')
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
         // console.log(typetext);
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
         addBtn.innerHTML = "즐겨찾기";
         // if(f_status == "" || f_status == undefined) {
         //    addBtn.innerHTML = "즐겨찾기";
         // } else {
         //    if (f_status == 1) {
         //       addBtn.innerHTML = "즐겨찾기 삭제";
         //    }
            
         //    if (f_status == 0) {
         //       addBtn.innerHTML = "즐겨찾기";
         //    }
         // }
         addBtn.onclick = function () {
            addFavor(id);
            // if (addBtn.innerHTML == "즐겨찾기") {
            //    addBtn.innerHTML = "즐겨찾기 삭제";
            // } else {
            //    addBtn.innerHTML = "즐겨찾기";
            // }
         };
         infowincontent.appendChild(addBtn);

         // // addBtn.addEventListener('click', showUser(id));
         // var fav = document.createElement('text');
         // fav.textContent = "즐겨찾기 ";
         // infowincontent.appendChild(fav);

         // var addBtn = document.createElement("input");
         // addBtn.setAttribute("id", "favBtn");
         // addBtn.setAttribute("type", "checkbox");

         var icons = customIcon[type] || {};

         var marker = new google.maps.Marker({
            map: map,
            position: latlng,
            // icon: icons.icon,
         });

         google.maps.event.addListener(marker, 'click', function () {
            infoWindow.setContent(infowincontent);
            infoWindow.open(map, marker);
         });

         markers.push(marker);
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
      // function addFavor(num, f_status) {
         function addFavor(num) {
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
                  
                  // if (f_status == null || f_status == undefined) { // 로그인 안했을 때
                     // document.getElementById('favBtn').innerHTML = "즐겨찾기";
                  // } else { // 로그인 했을 경우
                     if (fBtn == "즐겨찾기") {
                        document.getElementById('favBtn').innerHTML = "즐겨찾기 삭제";
                     } else {
                        document.getElementById('favBtn').innerHTML = "즐겨찾기";
                     }
                  // }
               }
            };

            xmlhttp.open("GET","favControl.php?q="+num, true);
            xmlhttp.send();
         }
      }

      function doNothing() {}
   </script>
   <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
   </script>

<!-- //Map Script -->

</body>

</html>