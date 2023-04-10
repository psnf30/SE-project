<!DOCTYPE html>
<html lang="en">

<?php
include ('hoteldb.php');
session_start();
require_once __DIR__ . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/tmp',
    ]),
    'fontdata' => $fontData + [
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf',
            'BI' => 'THSarabunNew BoldItalic.ttf'
        ]
    ], 
    'default_font' => 'sarabun'
]);

$mpdf->SetFont('sarabun','',14);
ob_start();  //ฟังก์ชัน ob_start()
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link rel="stylesheet" href="style/background.css">
    <link rel="stylesheet" href="style/selection.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    </style>

</head>

<div class="section">
    <?php  
        $sql = "select * from reservation order by id";
        $result = mysqli_query($conn,$sql);
        while($row=mysqli_fetch_array($result)){
            
        }
                $report_id = $_SESSION['id'];
                $reservation_start = $_SESSION['start'];
                $reservation_end = $_SESSION['end'];
                $reservation_type = $_SESSION['type'];
                $reservation_requirement = $_SESSION['requirement'];
                $reservation_adults = $_SESSION['adults'];
                $reservation_children = $_SESSION['children'];
                $reservation_requests = $_SESSION['requests'];
                $reservation_timestamp = $_SESSION['timestamp'];
                $booking_status = $_SESSION['status'];
                ?>
    <center>
<body>
    <div class="row">
        <div class="col">
            <div>
                <h3 style= font-size: 20px;margin-top: 20px"><b>Report Booking Room</b></h3> <br>
                <table class="table table-hover">
                    <tr height="40px" style="border: 1px solid black;">
                        <td width="200px" style="border: 1px solid black;">
                            <b>รหัสการจอง / ID :</b> <?php echo "$report_id"?> <?php echo "$report_id"?>
                        </td style="border: 1px solid black;">
                        <td width="200px" style="border: 1px solid black;">
                            <b>ตั้งแต่ / Start Date :</b> <?php echo "$reservation_start"?>
                        </td>
                        <td width="200px" style="border: 1px solid black;">
                            <b>จนถึง / End Date :</b> <?php echo "$reservation_end"?>
                        </td>
                        
                    </tr>
                </table>
                <table class="table table-hover">
                    <tr height="40px" style="border: 1px solid black;">
                        <td width="300px" style="border: 1px solid black;">
                            <b>ประเภท / Room Type :</b> <?php echo "$reservation_type"?>
                        </td>
                        <td width="305px" style="border: 1px solid black;">
                            <b>ความต้องการ / Requirements :</b> <?php echo "$reservation_requirement"?>
                        </td>
                        
                    </tr>
                </table>
                <table class="table table-hover">
                    <tr height="40px" style="border: 1px solid black;">
                        
                        <td width="150px" style="border: 1px solid black;">
                            <b>ผู้ใหญ่ / Adults :</b> <?php echo "$reservation_adults"?>
                        </td>
                        <td width="150px" style="border: 1px solid black;">
                            <b>เด็ก / Children :</b> <?php echo "$reservation_children"?>
                        </td>
                        <td width="300px" style="border: 1px solid black;">
                            <b>แนะนำ / Requests :</b> <?php echo "$reservation_requests"?>
                        </td>
                        
                    </tr>
                </table>
                <table class="table table-hover">
                    <tr height="40px" style="border: 1px solid black;">
                        <td width="300px" style="border: 1px solid black;">
                            <b>วันที่จอง / Timestamp :</b> <?php echo "$reservation_timestamp"?>
                        </td>
                        <td width="305px" style="border: 1px solid black;">
                            <b>สถานะ / Status :</b> <?php echo "$booking_status"?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    </center>

    <br><br>
    <a href="test.pdf"><button class="btn btn-primary">Export PDF</button> </a>
    <br><br><br>
</body>

</html>