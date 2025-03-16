<?php 
include('../connect.php');


// Check if the user is logged in
if(!isset($_SESSION['uid'])){
    echo "<script> window.location.href='../login.php'; </script>";
    exit(); // Ensure no further code is executed after redirection
}

// Handle form submissions for adding and editing movies
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catid = $_POST['catid'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $releasedate = $_POST['releasedate'];

    // Initialize variables for files
    $image = isset($_FILES['image']) ? $_FILES['image']['name'] : '';
    $tmp_image = isset($_FILES['image']) ? $_FILES['image']['tmp_name'] : '';

    $trailer = isset($_FILES['trailer']) ? $_FILES['trailer']['name'] : '';
    $tmp_trailer = isset($_FILES['trailer']) ? $_FILES['trailer']['tmp_name'] : '';

    $movie = isset($_FILES['movie']) ? $_FILES['movie']['name'] : '';
    $tmp_movie = isset($_FILES['movie']) ? $_FILES['movie']['tmp_name'] : '';

    // Check if we are editing or adding a new movie
    if (isset($_POST['add'])) {
        // Move uploaded files to the uploads directory
        move_uploaded_file($tmp_image, "uploads/$image");
        move_uploaded_file($tmp_trailer, "uploads/$trailer");
        move_uploaded_file($tmp_movie, "uploads/$movie");

        $sql = "INSERT INTO `movies`(`title`, `description`, `releasedate`, `image`, `trailer`, `movie`, `catid`) 
                VALUES ('$title','$description','$releasedate','$image','$trailer','$movie','$catid')";
        
        if(mysqli_query($con, $sql)){
            echo "<script> alert('เพิ่มภาพยนต์สำเร็จ')</script>";
            echo "<script> window.location.href='movies.php' </script>";
        }else{
            echo "<script> alert('เพิ่มภาพยนต์ล้มเหลว')</script>";
        }
    } elseif (isset($_POST['update'])) {
        $movieid = $_POST['movieid']; // Movie ID for updating

        // Update SQL query
        $update_sql = "UPDATE `movies` SET `title`='$title', `description`='$description', `releasedate`='$releasedate', `catid`='$catid'";

        // Update image only if a new file is uploaded
        if ($image) {
            move_uploaded_file($tmp_image, "uploads/$image");
            $update_sql .= ", `image`='$image'";
        }

        // Update trailer only if a new file is uploaded
        if ($trailer) {
            move_uploaded_file($tmp_trailer, "uploads/$trailer");
            $update_sql .= ", `trailer`='$trailer'";
        }

        // Update movie only if a new file is uploaded
        if ($movie) {
            move_uploaded_file($tmp_movie, "uploads/$movie");
            $update_sql .= ", `movie`='$movie'";
        }

        $update_sql .= " WHERE `movieid`='$movieid'";

        if(mysqli_query($con, $update_sql)){
            echo "<script> alert('อัพเดทภาพยนต์สำเร็จ')</script>";
            echo "<script> window.location.href='movies.php' </script>";
        } else {
            echo "<script> alert('อัพเดทภาพยนต์ล้มเหลว')</script>";
        }
    }
}

// Handle deletion of a movie
if (isset($_GET['deleteid'])) {
    $deleteid = $_GET['deleteid'];
    $sql = "DELETE FROM `movies` WHERE `movieid`='$deleteid'";

    if(mysqli_query($con, $sql)){
        echo "<script> alert('ลบข้อมูลสำเร็จ')</script>";
        echo "<script> window.location.href='movies.php' </script>";
    } else {
        echo "<script> alert('ลบข้อมูลล้มเหลว')</script>";
    }
}

// Check if we are editing a movie
$editdata = null;
if (isset($_GET['editid'])) {
    $editid = $_GET['editid'];
    $sql = "SELECT * FROM `movies` WHERE `movieid`='$editid'";
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
    <title>Movies</title>
</head>
<body>

<?php include('header.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <form action="movies.php<?= isset($editdata) ? '?editid=' . $editdata['movieid'] : '' ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="movieid" value="<?= isset($editdata) ? $editdata['movieid'] : '' ?>"> <!-- Hidden input for movie ID -->
                <div class="form-group mb-4">
                    <select name="catid" class="form-control" required>
                        <option value="">เลือกหมวดหมู่</option>
                        <?php
                        $sql = "SELECT * FROM `categories`";
                        $res = mysqli_query($con, $sql);
                        if(mysqli_num_rows($res) > 0) {
                            while($data = mysqli_fetch_array($res)){
                                echo "<option value='{$data['catid']}' " . (isset($editdata) && $editdata['catid'] == $data['catid'] ? 'selected' : '') . ">{$data['catname']}</option>";
                            }
                        } else {
                            echo "<option value=''>No Category found</option>";
                        }  
                        ?> 
                    </select>
                </div>

                <div class="form-group mb-4">
                    <input type="text" class="form-control" name="title" value="<?= isset($editdata) ? $editdata['title'] : '' ?>" placeholder="ชื่อหนัง" required>
                </div>

                <div class="form-group mb-4">
                    <input type="text" class="form-control" name="description" value="<?= isset($editdata) ? $editdata['description'] : '' ?>" placeholder="คำอธิบาย" required>
                </div>

                <div class="form-group mb-4">
                    <input type="date" class="form-control" name="releasedate" value="<?= isset($editdata) ? $editdata['releasedate'] : '' ?>" required>
                </div>

                <div class="form-group mb-4">
                    <label>โปสเตอร์:</label>
                    <input type="file" class="form-control" name="image" accept="image/*">
                </div>

                <div class="form-group mb-4">
                    <label>ตัวอย่าง:</label>
                    <input type="file" class="form-control" name="trailer" accept="video/*">
                </div>

                <div class="form-group mb-4">
                    <label>วีดีโอ:</label>
                    <input type="file" class="form-control" name="movie" accept="video/*">
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
                    <th>ชื่อหนัง</th>
                    <th>หมวดหมู่</th>
                    <th>โปสเตอร์</th>
                    <th>จัดการ</th>
                </tr>
                <?php
                $sql = "SELECT movies.*, categories.catname FROM movies INNER JOIN categories ON categories.catid = movies.catid";
                $res = mysqli_query($con, $sql);
                if(mysqli_num_rows($res) > 0) {
                    while($data = mysqli_fetch_array($res)) {
                        ?>
                        <tr>
                            <td><?= $data['movieid'] ?></td>
                            <td><?= $data['title'] ?></td>
                            <td><?= $data['catname'] ?></td>
                            <td><img src="uploads/<?= htmlspecialchars($data['image']) ?>" height="50" width="50" alt=""></td>
                            <td>
                                <a href="movies.php?editid=<?= $data['movieid'] ?>" class="btn btn-primary">แก้ไข</a>
                                <a href="movies.php?deleteid=<?= $data['movieid'] ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบภาพยนตร์นี้ใช่หรือไม่?');">ลบ</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo '<tr><td colspan="5">ลบภาพยนตร์ล้มเหลว</td></tr>';
                }
                ?>
            </table>
        </div>
    </div>
</div>


</body>
</html>
