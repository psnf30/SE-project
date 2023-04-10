<!DOCTYPE html>
<html lang="en">

<?php
// เริ่มคำสั่ง Export ไฟล์ PDF
session_start();
require_once __DIR__ . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);

ob_start();  //ฟังก์ชัน ob_start()
?>

<?php
include ('hoteldb.php');
    $username = $cHandler = $bdHandler = $cBookings = $cHandler1 = null;
    $cHandler = new CustomerHandler();
    $cHandler = $cHandler->getCustomerObj($_SESSION["accountEmail"]);
    $cBookings = $bdHandler->getCustomerBookings($cHandler);
?>
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/background.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style/selection.css">
    
    <title>Document</title>
</head>
<body style="font-size:20px;">
    <div class="container">
        <center><h1><b>Report Booking Room</b></h1></center><br>
        <table class="table table-hover">
            <tr height="40px" style="font-size: 20px; border: 3px solid black;">
                <th >Id</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Room Type</th>
                <th>Requirements</th>
            </tr>
            <?php
                echo $_SESSION["id"];
                $email =  $_SESSION["accountEmail"];
    
                $sql = "SELECT id,start,end,type,requirement,adults,children,requests,timestamp,email
                FROM reservation 
                JOIN customer
                on reservation.id = customer.cid
                where email='$email'";
                $sql2 = "select * from reservation where id='19'";
                
                $result = mysqli_query($conn,$sql );
                while($row=mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?=$row["id"]?></td>
                <td><?=$row["start"]?></td>
                <td><?=$row["end"]?></td>
                <td><?=$row["type"]?></td>
                <td><?=$row["requirement"]?></td>
            </tr>
            <tr height="40px" style="font-size: 20px; border: 3px solid black;">
                <th>Adults</th>
                <th>Children</th>
                <th>Timestamp</th>
                <th>Email</th>
                <th>Requests</th>
            </tr>
            <tr>
                <td><?=$row["adults"]?></td>
                <td><?=$row["children"]?></td>
                <td><?=$row["timestamp"]?></td>
                <td><?=$row["email"]?></td>
                <td><?=$row["requests"]?></td>

            </tr>
            <?php
            }
            mysqli_close($conn);
            ?>
            
        </table>
        <?php
            $html = ob_get_contents();      // เรียกใช้ฟังก์ชัน รับข้อมูลที่จะมาแสดงผล
            $mpdf->WriteHTML($html);
            $mpdf->Output('Report.pdf');  //สร้างไฟล์ PDF ชื่อว่า myReport.pdf
            ob_end_flush();                 // ปิดการแสดงผลข้อมูลของไฟล์ HTML ณ จุดนี้
        ?>

        <!--การสร้างลิงค์ เรียกไฟล์ myReport.pdf แสดงผลไฟล์ PDF  -->
        <center><a href="Report.pdf"><button class="btn btn-primary">Download PDF</button> </a></center>
    </div>
</body>
</html>