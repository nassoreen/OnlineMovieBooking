<?php 
include('../connect.php');


// Check if the user is logged in
if(!isset($_SESSION['uid'])){
  echo "<script> window.location.href='../login.php'; </script>";
  exit(); // Ensure no further code is executed after redirection
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['add'])) {
    $name = mysqli_real_escape_string($con, $_POST['catname']); // Escape user input
    $sql = "INSERT INTO `categories` (`catname`) VALUES ('$name')";

    if (mysqli_query($con, $sql)) {
      echo "<script> alert('เพิ่มข้อมูลสำเร็จ')</script>";
      echo "<script> window.location.href='categories.php' </script>";
    } else {
      echo "<script> alert('เพิ่มข้อมูลล้มเหลว')</script>";
    }
  }

  if (isset($_POST['update'])) {
    $catid = mysqli_real_escape_string($con, $_POST['catid']);
    $name = mysqli_real_escape_string($con, $_POST['catname']);

    $sql = "UPDATE `categories` SET `catname`='$name' WHERE `catid`='$catid'";

    if (mysqli_query($con, $sql)) {
      echo "<script> alert('อัพเดทข้อมูลสำเร็จ')</script>";
      echo "<script> window.location.href='categories.php' </script>";
    } else {
      echo "<script> alert('อัพเดทข้อมูลล้มเหลง')</script>";
    }
  }
}

// Handle deletion of a category
if (isset($_GET['deleteid'])) {
  $deleteid = mysqli_real_escape_string($con, $_GET['deleteid']);
  $sql = "DELETE FROM `categories` WHERE `catid`='$deleteid'";

  if (mysqli_query($con, $sql)) {
    echo "<script> alert('ลบหมวดหมู่สำเร็จ')</script>";
    echo "<script> window.location.href='categories.php' </script>";
  } else {
    echo "<script> alert('ลบหมวดหมู่ล้มเหลว')</script>";
  }
}

// Check if we are editing a category
$editdata = null;
if (isset($_GET['editid'])) {
  $editid  = mysqli_real_escape_string($con, $_GET['editid']);
  $sql = "SELECT * FROM `categories` WHERE `catid`='$editid'";
  $res  = mysqli_query($con, $sql);
  $editdata = mysqli_fetch_array($res);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
</head>
<body>
<?php include('header.php'); ?>

<div class="container">
  <div class="row">
    <div class="col-lg-6">
      <form action="categories.php<?= isset($editdata) ? '?editid=' . $editdata['catid'] : '' ?>" method="post">
        <div class="form-group mb-4">
          <input type="hidden" class="form-control" value="<?= $editdata['catid'] ?? '' ?>" name="catid">
        </div>
        <div class="form-group mb-4">
          <input type="text" class="form-control" name="catname" value="<?= $editdata['catname'] ?? '' ?>" placeholder="เพิ่มหมวดหมู่" required>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-<?= isset($editdata) ? 'info' : 'primary' ?>" value="<?= isset($editdata) ? 'อัพเดท' : 'เพิ่ม' ?>" name="<?= isset($editdata) ? 'update' : 'add' ?>">
        </div>
      </form>
    </div>

    <div class="col-lg-6">
      <table class="table">
        <tr>
          <th>ลำดับ</th>
          <th>ชื่อ</th>
          <th>แก้ไขข้อมูล</th>
        </tr>
        
        <?php
        $sql = "SELECT * FROM `categories`";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) > 0) {
          while ($data = mysqli_fetch_array($res)) {
            ?>
            <tr>
              <td><?= $data['catid'] ?></td>
              <td><?= htmlspecialchars($data['catname']) ?></td>
              <td>
                <a href="categories.php?editid=<?= $data['catid'] ?>" class="btn btn-primary">แก้ไข</a>
                <a href="categories.php?deleteid=<?= $data['catid'] ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบหมวดหมู่นี้ใช่หรือไม่??');">ลบ</a>
              </td>
            </tr>
            <?php
          }
        } else {
          echo '<tr><td colspan="3">No categories found</td></tr>';
        }
        ?>
      </table>
    </div>
  </div>
</div>


</body>
</html>
