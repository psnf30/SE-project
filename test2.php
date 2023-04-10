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
require 'lib/phpPasswordHashing/passwordLib.php';
require 'app/DB.php';
require 'app/Util.php';
require 'app/dao/CustomerDAO.php';
require 'app/dao/BookingDetailDAO.php';
require 'app/models/RequirementEnum.php';
require 'app/models/Customer.php';
require 'app/models/Booking.php';
require 'app/models/Reservation.php';
require 'app/handlers/CustomerHandler.php';
require 'app/handlers/BookingDetailHandler.php';
$username = $cHandler = $bdHandler = $cBookings = $cHandler1 = null;

$cHandler = new CustomerHandler();
$cHandler = $cHandler->getCustomerObj($_SESSION["accountEmail"]);
$bdHandler = new BookingDetailHandler();
$cBookings = $bdHandler->getCustomerBookings($cHandler);


?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/background.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style/selection.css">
    <title>Report</title>
    <?php
if (isset($_COOKIE["transcript_id"])) {
    $transcript_id = $_COOKIE["transcript_id"];
    // ดำเนินการต่อไป...
}
?>

</head>
<body>
<div>
<header>
    
    <div>
        <h4>Reservations</h4>
        <table id="myReservationsTbl" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th class="text-hide p-0" data-bookId="12"></th>
                <th scope="col">Start date</th>
                <th scope="col">End date</th>
                <th scope="col">Room type</th>
                <th scope="col">Requirements</th>
                <th scope="col">Adults</th>
                <th scope="col">Children</th>
                <th scope="col">Requests</th>
                <th scope="col">Timestamp</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
                
            <?php  ?> 
                <?php   foreach ($cBookings as $k => $v) { ?>
                    <tr>
                        <?php if($v["id"] == $transcript_id){?>
                        <th scope="row"><?php echo ($k+1); ?></th>
                        <td><?php echo $v["id"]; ?></td>
                        <td><?php echo $v["start"]; ?></td>
                        <td><?php echo $v["end"]; ?></td>
                        <td><?php echo $v["type"]; ?></td>
                        <td><?php echo $v["requirement"]; ?></td>
                        <td><?php echo $v["adults"]; ?></td>
                        <td><?php echo $v["children"]; ?></td>
                        <td><?php echo $v["requests"]; ?></td>
                        <td><?php echo $v["timestamp"]; ?></td>
                        <td><?php echo $v["status"]; ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            <?php  ?>
            </tbody>
        </table>
    </div>
</header>
        <?php
            $html = ob_get_contents();      // เรียกใช้ฟังก์ชัน รับข้อมูลที่จะมาแสดงผล
            $mpdf->WriteHTML($html);
            $mpdf->Output('Report.pdf');  //สร้างไฟล์ PDF ชื่อว่า myReport.pdf
            ob_end_flush();                 // ปิดการแสดงผลข้อมูลของไฟล์ HTML ณ จุดนี้
        ?>
        <center><a href="index.php">
        <button class="btn btn-primary">Back</button>
    </a></center>
        <br>
        <center><a href="Report.pdf"><button class="btn btn-primary">Download PDF</button> </a></center>
    </div>
</body>
</html>