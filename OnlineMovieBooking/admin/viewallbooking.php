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
    <title>Booking</title>
</head>
<body>


<?php include('header.php')  ?>

<div class="container" style="margin-top:100px!important;">
  <form action="viewallbooking.php" method="post">
    <div class="row">
      <div class="col-lg-3">
        <input type="date" name="start" class="form-control">
      </div>
      <div class="col-lg-3">
        <input type="date" name="end" class="form-control">
      </div>
      <div class="col-lg-3">
         <select name="status" id="" class="form-control">
          <option value="">เลือกสถานะ</option>
          <option value="0">รอดำเนินการ</option>
          <option value="1">อนุมัติ</option>
         </select>
      </div>
      <div class="col-lg-3">
        <input type="submit" name="btnsearch" value="ค้นหา" class="btn btn-success">
      </div>
    </div>
  </form>
</div>

<div class="container">
   
<div class="row mt-5">


  <div class="col-lg-12">
  
     <table class="table">
      <tr>
        <th>ลำดับ</th>
        <th>โรงภาพยนตร์</th>
        <th>ภาพยนตร์</th>
        <th>วันที่</th>
        <th>วัน-เวลา</th>
        <th>ราคาตั๋ว</th>
        <th>ที่อยู่</th>
        <th>ผู้ใช้</th>
        <th>สถานะ</th>
        <th>การกระทำ</th>
      </tr>
      
      <?php

      if(isset($_POST['btnsearch'])){

        $start  = $_POST['start'];
        $end    = $_POST['end'];
        $status = $_POST['status'];

        $total_sale = 0;

        $sql = "select booking.bookingid, booking.bookingdate, booking.person, theater.theater_name, theater.timing, theater.days, theater.price, theater.location, movies.title,  categories.catname, users.name as 'username',
        booking.status
        from booking
        inner join theater on theater.theaterid = booking.theaterid
        inner join users on users.userid = booking.userid
        inner join movies on movies.movieid = theater.movieid
        inner join categories on categories.catid = movies.catid
        where booking.bookingdate between '$start' AND '$end' and booking.status = '$status'";
        $res  = mysqli_query($con, $sql);
        if(mysqli_num_rows($res) > 0){
          while($data = mysqli_fetch_array($res)){

            $total_sale = $total_sale + $data['price'];
  
            ?>

          <tr>
          <td><?= $data['bookingid'] ?></td>
            <td><?= $data['theater_name'] ?></td>
            <td><?= $data['title'] ?> - <?= $data['catname'] ?></td>
            <td><?= $data['bookingdate'] ?></td>
            <td><?= $data['days'] ?> - <?= $data['timing'] ?></td>       
            <td><?= $data['price'] ?></td>
          
            <td><?= $data['location'] ?></td>
            <td><?= $data['username'] ?></td>
     
            <td>

              <?php

              if($data['status'] == 0){
                echo "<a href='#' class='btn btn-warning' > รอดำเนินการ </a>";
              }else{
                echo "<a href='#' class='btn btn-success' > อนุมติ </a>";
              }

              ?>


            </td>
           
            <td>
              <?php

                if($data['status'] == 1){
                  echo "<button type='button' class='btn btn-light' disabled> เสร็จสิ้น </button>";
                }else{
                  echo "<a href='viewallbooking.php?bookingid=".$data['bookingid']."' class='btn btn-primary'> อนุมัติ</a>";
                }
              ?>
              
          </td>
          </tr>

            <?php
          }
            echo "<tr> <td>Total Sale: <strong> Rs.".$total_sale." </strong></td> </tr>";
        }

      }else{


      $sql = "select booking.bookingid, booking.bookingdate, booking.person, theater.theater_name, theater.timing, theater.days, theater.price, theater.location, movies.title,  categories.catname, users.name as 'username',
      booking.status
      from booking
      inner join theater on theater.theaterid = booking.theaterid
      inner join users on users.userid = booking.userid
      inner join movies on movies.movieid = theater.movieid
      inner join categories on categories.catid = movies.catid 
      ";
      $res  = mysqli_query($con, $sql);
      if(mysqli_num_rows($res) > 0){
        while($data = mysqli_fetch_array($res)){

          ?>

        
          <tr>
          <td><?= $data['bookingid'] ?></td>
            <td><?= $data['theater_name'] ?></td>
            <td><?= $data['title'] ?> - <?= $data['catname'] ?></td>
            <td><?= $data['bookingdate'] ?></td>
            <td><?= $data['days'] ?> - <?= $data['timing'] ?></td>       
            <td><?= $data['price'] ?></td>
          
            <td><?= $data['location'] ?></td>
            <td><?= $data['username'] ?></td>
     
            <td>

              <?php

              if($data['status'] == 0){
                echo "<a href='#' class='btn btn-warning' > รอดำเนินการ </a>";
              }else{
                echo "<a href='#' class='btn btn-success' > อนุมัติ </a>";
              }

              ?>

            </td>
           
            <td>
            <?php

              if($data['status'] == 1){
                echo "<button type='button' class='btn btn-light' disabled> เสร็จสิ้น </button>";
              }else{
                echo "<a href='viewallbooking.php?bookingid=".$data['bookingid']."' class='btn btn-primary'> อนุมัติ</a>";
              }
              ?>
          </td>
          </tr>


       <?php
        }
      }else{
        echo 'no booking found';
      }

    }
   

      ?>


     </table>

  </div>
</div>
  

</div>



</body>
</html>

<?php

if(isset($_GET['bookingid'])){

  $bookingid  = $_GET['bookingid'];
  $sql = "UPDATE `booking` SET `status`= 1 WHERE bookingid = '$bookingid'";

  if(mysqli_query($con,$sql)){
    echo "<script> alert('อนุมัติสำเร็จ!!') </script>";
    echo "<script> window.location.href='viewallbooking.php';  </script>";
  }else{
    echo "<script> alert('อนุมัติล้มเหลว!!') </script>";
  }
}
?>


