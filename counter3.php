<?php
// SQL PHP로 출력
require("dbinfo.php");

    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // 쿼리문
    // $sql = "SELECT name, address FROM markers";
    $sql3 = "SELECT COUNT(*) AS total from maptbl";
    
    // 쿼리를 result에
    $result = $conn->query($sql2);

    $arr3 = $result->fetch_assoc();
    $total3 = $arr3['total'];
    
    if ($result->num_rows > 0) {
        // output
        while($row = $result->fetch_assoc()) {
            // echo "이름 : " . $row['name'] . " / 주소 : " . $row['address'] . "<br>";
            // echo $row['total'];
        }
    } else {
        echo "0 results";
    }

$conn->close();
?>
<!-- 숫자 증감 카운터 애니메이션 -->
<script>
    var value3 = <?= $total3 ?>;

    function numberCounter2(target_frame, target_number) {
        this.count = 0; 
        this.diff = 0;
        this.target_count = parseInt(target_number);
        this.target_frame = document.getElementById(target_frame);
        this.timer = null;
        this.counter();
    };
    numberCounter2.prototype.counter = function() {
        var self = this;
        this.diff = this.target_count - this.count;

        if(this.diff > 0) {
        self.count += Math.ceil(this.diff / 5);
        }

        this.target_frame.innerHTML = this.count.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');

        if(this.count < this.target_count) { 
            this.timer=setTimeout(function() { 
                self.counter(); 
            }, 20);
        } else {
            clearTimeout(this.timer); 
        } 
    }; 
    
    new numberCounter2("counter3", value3);
</script>