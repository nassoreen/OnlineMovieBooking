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
    <title>Users</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>


<?php include('header.php')  ?>


<div class="container" style="margin-top: 120px;">
   
<div class="row">
 
  <div class="col-lg-12">
  
     <table class="table">
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>     
      </tr>
      
      <?php
      $uid = $_SESSION['uid'];
      $sql = "SELECT * FROM `users` where userid = '$uid'";
      $res  = mysqli_query($con, $sql);
      if(mysqli_num_rows($res) > 0){
        while($data = mysqli_fetch_array($res)){

          ?>

          <tr>
            <td><?= $data['name'] ?></td>
            <td><?= $data['email'] ?> </td>
            <td><?= $data['password'] ?> </td>       
        
          </tr>


       <?php
        }
      }else{
        echo 'ไม่พบบัญชีผู้ใช้';
      }
    

      ?>


     </table>

  </div>
</div>
  

</div>



</body>
</html>


