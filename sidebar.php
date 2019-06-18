<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top w3-card-2 w3-animate-left" id="mySidebar">
    <div class="w3-container w3-display-container w3-padding-16">
        <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
        <h3 class="w3-wide"><strong style="color: darkcyan; font-weight: bold;">Menu</strong></h3>
    </div>
    <?php
        include 'nowpage.php';
    ?>
    <div class="w3-padding-64 w3-large w3-text-black">
    <?php if(isset($_SESSION['email']) || isset($_SESSION['username'])) { ?>
      <p class="w3-bar-item">Welcome! <b>
      <?php 
         require 'dbinfo.php';
         $userId = $_SESSION['userid'];

         $conn = new mysqli($servername, $username, $password, $dbname);
         // Check connection
         if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
         }

         $sql = "SELECT user_name FROM usertbl WHERE user_id= $userId";
         $result = $conn->query($sql);
         $row = $result->fetch_assoc();
         echo $row['user_name'];
      ?>
            </b>님</p>
    <?php } ?>

        <?php if ($str_name == "index") { ?>
        <a href="index.php" class="w3-bar-item w3-button w3-hover-teal w3-teal">Home</a>
        <?php } else { ?>
            <a href="index.php" class="w3-bar-item w3-button">Home</a>
        <?php } ?>
        <a onclick="myAccFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align" id="myBtn">
            Map <i class="fa fa-caret-down"></i>
        </a>
        <div id="demoAcc" class="w3-hide w3-bar-block w3-padding-large w3-medium">
            <!-- <a href="#" class="w3-bar-item w3-button w3-light-grey">
                <i class="fa fa-caret-right w3-margin-right"></i>All Station
            </a> -->
            <?php if ($str_name == "allStation") { ?>
            <a href="allStation.php" class="w3-bar-item w3-button w3-hover-teal w3-teal">All Station</a>
            <?php } else { ?>
                <a href="allStation.php" class="w3-bar-item w3-button">All Station</a>
            <?php } ?>
            <?php if ($str_name == "nearStation") { ?>
            <a href="nearStation.php" class="w3-bar-item w3-button w3-hover-teal w3-teal">Near Station</a>
            <?php } else { ?>
                <a href="nearStation.php" class="w3-bar-item w3-button">Near Station</a>
            <?php } ?>
            <a href="#" class="w3-bar-item w3-button" onclick="alert('죄송합니다 개발 중입니다.');">Home Station</a>
        </div>
        <?php if ($str_name == "information") { ?>
         <a href="information.php" class="w3-bar-item w3-button w3-hover-teal w3-teal">Infomation</a>
         <?php } else { ?>
               <a href="information.php" class="w3-bar-item w3-button">Infomation</a>
         <?php } ?>
        <?php if ($str_name == "about") { ?>
         <a href="about.php" class="w3-bar-item w3-button w3-hover-teal w3-teal">About</a>
         <?php } else { ?>
               <a href="about.php" class="w3-bar-item w3-button">About</a>
         <?php } ?>
    </div>
    <?php if(!isset($_SESSION['email']) || !isset($_SESSION['username'])) { ?>
    <?php if ($str_name == "signIn") { ?>
   <a href="signIn.php" class="w3-bar-item w3-button w3-padding w3-hover-teal w3-teal">Sign in</a>
   <?php } else { ?>
         <a href="signIn.php" class="w3-bar-item w3-button w3-padding">Sign in</a>
   <?php } ?>
   <?php if ($str_name == "signUp") { ?>
   <a href="signUp.php" class="w3-bar-item w3-button w3-padding w3-hover-teal w3-teal">Sign up</a>
   <?php } else { ?>
         <a href="signUp.php" class="w3-bar-item w3-button w3-padding">Sign up</a>
   <?php } ?>
    <!-- <a href="signIn.php" class="w3-bar-item w3-button w3-padding">Sign in</a>
    <a href="signUp.php" class="w3-bar-item w3-button w3-padding">Sign up</a> -->
    <?php 
    } else {
    ?>
        <a href="logout.php" class="w3-bar-item w3-button w3-padding">Logout</a>
    <?php
    }
    ?>
</nav>