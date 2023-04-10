<?php
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