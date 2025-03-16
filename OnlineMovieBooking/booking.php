<?php 
include('connect.php');

if(!isset($_SESSION['uid'])){
  echo "<script> window.location.href='login.php';  </script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Booking</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

      body {
        font-family: "IBM Plex Sans Thai", sans-serif;
        background: url('path-to-your-movie-ticket-image.jpg') no-repeat center center fixed;
        background-size: cover;
        color: white;
        background: linear-gradient(120deg, #075596, #000000 35% );
      }

      .section-title h2 {
        font-size: 36px;
        font-weight: bold;
        text-align: center;
        color: #fff;
        margin-bottom: 30px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
      }

      .form-control {
        border-radius: 30px;
        padding: 10px 20px;
        background-color: rgba(255, 255, 255, 0.8);
        border: none;
      }

      .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 30px;
        padding: 10px 30px;
        transition: background-color 0.3s ease;
        color: white;
      }

      .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
      }

      .form-group {
        margin-bottom: 20px;
      }

      .container {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        background-color: rgba(0, 0, 0, 0.7);
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        border: double #007bff;
      }

      section {
        padding: 60px 0;
      }
    </style>

</head>
<body>
    
<?php
    $theaterid = $_GET['id'];
?>

<section id="team" class="team section-bg">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2>จองตั๋วภาพยนต์</h2>
    </div>

    <form action="booking.php" method="post">
      <input type="hidden" name="theaterid" value="<?=$theaterid?>">
      
      <div class="form-group">
        <input type="text" class="form-control" name="person" placeholder="กรอกจำนวน" required>
      </div>

      <div class="form-group">
        <input type="date" class="form-control" name="date" required>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-primary" name="ticketbook">จองตั๋ว</button>
      </div>
    </form>
  </div>
</section>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php
if(isset($_POST['ticketbook'])){
  $person     = $_POST['person'];
  $date       = $_POST['date'];
  $theaterid  = $_POST['theaterid'];
  $uid = $_SESSION['uid'];

  $sql = "INSERT INTO `booking`(`theaterid`, `bookingdate`, `person`, `userid`) VALUES ('$theaterid','$date','$person','$uid')";

  if(mysqli_query($con, $sql)){
     echo "<script> alert('จองตั๋วภาพยนต์สำเร็จ!') </script>";
     echo "<script> window.location.href='index.php';  </script>";
  }else{
    echo "<script> alert('จองตั๋วภาพยนต์ล้มเหลว') </script>";
  }
}
?>
