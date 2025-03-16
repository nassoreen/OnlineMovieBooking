<?php 
include('../connect.php');

// Check if the user is logged in
if(!isset($_SESSION['uid'])){
  echo "<script> window.location.href='../login.php';  </script>";
}

// Handle form submission for adding and updating theaters
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $movieid = $_POST['movieid'];
    $theater_name = $_POST['theater_name'];
    $days = $_POST['days'];
    $timing = $_POST['timing'];
    $price = $_POST['price'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $region = $_POST['region_id'];

    // Add a new theater
    if (isset($_POST['add'])) {
        $sql = "INSERT INTO `theater`(`theater_name`,`timing`, `days`, `date`, `price`, `location`, `region_id`, `movieid`) 
                VALUES ('$theater_name','$timing','$days','$date','$price','$location','$region','$movieid')";
        
        if(mysqli_query($con, $sql)){
            echo "<script> alert('เพิ่มโรงภาพยนตร์สำเร็จ')</script>";
            echo "<script> window.location.href='theater.php' </script>";
        } else {
            echo "<script> alert('เพิ่มโรงภาพยนตร์ล้มเหลว')</script>";
        }
    }
    
    // Update theater information
    if (isset($_POST['update'])) {
        $theaterid = $_POST['theaterid']; // Get theater ID for updating
        $sql = "UPDATE `theater` SET 
                    `theater_name`='$theater_name',
                    `timing`='$timing', 
                    `days`='$days', 
                    `date`='$date', 
                    `price`='$price', 
                    `location`='$location', 
                    `region_id`='$region', 
                    `movieid`='$movieid' 
                WHERE `theaterid`='$theaterid'";
        
        if(mysqli_query($con, $sql)){
            echo "<script> alert('อัพเดทโรงภาพยนตร์สำเร็จ')</script>";
            echo "<script> window.location.href='theater.php' </script>";
        } else {
            echo "<script> alert('อัพเดทโรงภาพยนตร์ล้มเหลว)</script>";
        }
    }
}

// Handle deletion of a theater
if (isset($_GET['deleteid'])) {
    $deleteid = $_GET['deleteid'];
    $sql = "DELETE FROM `theater` WHERE `theaterid`='$deleteid'";

    if(mysqli_query($con, $sql)){
        echo "<script> alert('ลบโรงภาพยนตร์สำเร็จ')</script>";
        echo "<script> window.location.href='theater.php' </script>";
    } else {
        echo "<script> alert('ลบโรงภาพยนตร์ล้มเหลว')</script>";
    }
}

// Check if we are editing a theater
$editdata = null;
if (isset($_GET['editid'])) {
    $editid = $_GET['editid'];
    $sql = "SELECT * FROM `theater` WHERE `theaterid`='$editid'";
    $res = mysqli_query($con, $sql);
    $editdata = mysqli_fetch_array($res);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theater</title>
</head>
<body>

<?php include('header.php') ?>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <form action="theater.php<?= isset($editdata) ? '?editid=' . $editdata['theaterid'] : '' ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="theaterid" value="<?= isset($editdata) ? $editdata['theaterid'] : '' ?>"> <!-- Hidden input for theater ID -->
                <div class="form-group mb-4">
                    <input type="text" class="form-control" name="theater_name" value="<?= isset($editdata) ? $editdata['theater_name'] : '' ?>" placeholder="ชื่อโรงภาพยนตร์" required>
                </div>

                <div class="form-group mb-4">
                    <select name="movieid" class="form-control" required>
                        <option value="">เลือกชื่อหนัง</option>
                        <?php
                        $sql = "SELECT * FROM `movies`";
                        $res = mysqli_query($con, $sql);
                        if(mysqli_num_rows($res) > 0){
                            while($data = mysqli_fetch_array($res)){
                                echo "<option value='{$data['movieid']}' " . (isset($editdata) && $editdata['movieid'] == $data['movieid'] ? 'selected' : '') . ">{$data['title']}</option>";
                            }
                        } else {
                            echo "<option value=''>No Movies found</option>";
                        }  
                        ?> 
                    </select>
                </div>

                <div class="form-group mb-4">
                    <input type="time" class="form-control" name="timing" value="<?= isset($editdata) ? $editdata['timing'] : '' ?>" required>
                </div>

                <div class="form-group mb-4">
                    <input type="text" class="form-control" name="days" value="<?= isset($editdata) ? $editdata['days'] : '' ?>" placeholder="เลือกวัน" required>
                </div>

                <div class="form-group mb-4">
                    <input type="date" class="form-control" name="date" value="<?= isset($editdata) ? $editdata['date'] : '' ?>" required>
                </div>

                <div class="form-group mb-4">
                    <input type="number" class="form-control" name="price" value="<?= isset($editdata) ? $editdata['price'] : '' ?>" placeholder="ราคา" required>
                </div>

                <div class="form-group mb-4">
                    <input type="text" class="form-control" name="location" value="<?= isset($editdata) ? $editdata['location'] : '' ?>" placeholder="ที่อยู่" required>
                </div>

                <div class="form-group mb-4">
                    <select name="region_id" class="form-control" required>
                        <option value="">จังหวัด</option>
                        <?php
                        $sql = "SELECT * FROM `region`";
                        $res = mysqli_query($con, $sql);
                        if(mysqli_num_rows($res) > 0){
                            while($data = mysqli_fetch_array($res)){
                                echo "<option value='{$data['region_id']}' " . (isset($editdata) && $editdata['region_id'] == $data['region_id'] ? 'selected' : '') . ">{$data['region_name']}</option>";
                            }
                        } else {
                            echo "<option value=''>No Regions found</option>";
                        }  
                        ?> 
                    </select>
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
                    <th>โรงหนัง</th>
                    <th>หนัง</th>
                    <th>หมวดหมู่</th>
                    <th>วันที่</th>
                    <th>วัน/เวลา</th>
                    <th>ตั่ว</th>
                    <th>ที่อยู่</th>
                    <th>จังหวัด</th>
                    <th>จัดการ</th>
                </tr>
                
                <?php
                $sql = "SELECT theater.*, movies.title, categories.catname
                        FROM theater
                        INNER JOIN movies ON movies.movieid = theater.movieid
                        INNER JOIN categories ON categories.catid = movies.catid";
                $res = mysqli_query($con, $sql);
                if(mysqli_num_rows($res) > 0){
                    while($data = mysqli_fetch_array($res)){
                        ?>
                        <tr>
                            <td><?= $data['theaterid'] ?></td>
                            <td><?= $data['theater_name'] ?></td>
                            <td><?= $data['title'] ?></td>
                            <td><?= $data['catname'] ?></td>
                            <td><?= $data['date'] ?></td>
                            <td><?= $data['days'] ?> - <?= $data['timing'] ?></td>
                            <td><?= $data['price'] ?></td>
                            <td><?= $data['location'] ?></td>
                            <td><?= $data['region_id'] ?></td>
                            <td>
                                <a href="theater.php?editid=<?= $data['theaterid'] ?>" class="btn btn-primary"> แก้ไข</a>
                                <a href="theater.php?deleteid=<?= $data['theaterid'] ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบโรงภาพยนตร์นี้ใช่หรรือไม่?');">ลบ</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo '<tr><td colspan="10">ลบโรงภาพยนตร์ล้มเหลว</td></tr>';
                }
                ?>
            </table>
        </div>
    </div>
</div>

</body>
</html>
