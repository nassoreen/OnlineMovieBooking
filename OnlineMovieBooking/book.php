<?php
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $movieid = $_POST['movieid'];
    $person = $_POST['person'];
    $userid = $_POST['userid'];
    $bookingdate = date('Y-m-d'); // วันที่ปัจจุบัน

    // แทรกการจองลงในฐานข้อมูล
    $stmt = $con->prepare("INSERT INTO booking (theaterid, bookingdate, person, userid) VALUES (?, ?, ?, ?)");
    $theaterid = 1; // แทนที่ด้วย theater ID ที่คุณต้องการเชื่อมโยง
    $stmt->bind_param("issi", $theaterid, $bookingdate, $person, $userid);

    if ($stmt->execute()) {
        echo "การจองสำเร็จ!";
    } else {
        echo "ข้อผิดพลาด: " . $stmt->error;
    }

    $stmt->close();
}
$con->close();
?>
