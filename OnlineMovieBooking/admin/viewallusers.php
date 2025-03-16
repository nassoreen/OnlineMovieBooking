<?php 
include('../connect.php');

if(!isset($_SESSION['uid'])){
  echo "<script> window.location.href='../login.php';  </script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>
<body>

<?php include('header.php')  ?>

<div class="container">
   
<div class="row">
 
  <div class="col-lg-12">
  
     <table class="table">
      <tr>
        <th>ลำดับ</th>
        <th>ชื่อ</th>
        <th>Email</th>
        <th>รหัสผ่าน</th>
        <th>ประเภทบทบาท</th>      
        <th>ลบข้อมูล</th>
      </tr>
      
      <?php
      $sql = "SELECT * FROM `users`";
      $res  = mysqli_query($con, $sql);
      if(mysqli_num_rows($res) > 0){
        while($data = mysqli_fetch_array($res)){
          ?>

          <tr>
            <td><?= htmlspecialchars($data['userid']) ?></td>
            <td><?= htmlspecialchars($data['name']) ?></td>
            <td><?= htmlspecialchars($data['email']) ?> </td>
            <td><?= htmlspecialchars($data['password']) ?> </td>       
            <td>
             <?php
               if($data['roteype'] == 1){
                echo "ADMIN";
               } else {
                echo "USER";
               }
             ?>
            </td>
            <td>
              <a href="viewallusers.php?userid=<?= htmlspecialchars($data['userid']) ?>" class="btn btn-danger">ลบข้อมูล</a>
            </td>
          </tr>

       <?php
        }
      } else {
        echo 'ไม่มีไฟล์ผู้ใช้';
      }
      ?>
     </table>

  </div>
</div>
  
</div>



</body>
</html>

<?php

if(isset($_GET['userid'])){
  $userid = mysqli_real_escape_string($con, $_GET['userid']); // Prevent SQL injection

  $sql = "DELETE FROM users WHERE userid = '$userid'";

  if(mysqli_query($con, $sql)){
    echo "<script> alert('ลบข้อมูลผู้ใช้สำเร็จ');</script>";
    echo "<script> window.location.href='viewallusers.php'; </script>";
  } else {
    echo "<script> alert('ลบข้อมูลล้มเหลว');</script>";
  }
}
?>
