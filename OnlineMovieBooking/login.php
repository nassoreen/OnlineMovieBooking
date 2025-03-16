<?php include('connect.php')  ?>
<?php include('header.php')  ?>
<?php
if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";

    $rs = mysqli_query($con, $sql);

    if (mysqli_num_rows($rs) > 0) {
        $data = mysqli_fetch_array($rs);

        $role = $data['roteype'];

        $_SESSION['uid'] = $data['userid'];
        $_SESSION['type'] = $role;

        if ($role == 1) {
            echo "<script> alert('Admin login successfully!!') </script>";
            echo "<script> window.location.href='admin/dashboard.php';  </script>";
        } elseif ($role == 2) {
            echo "<script> alert('เข้าสู่ระบบสำเร็จ') </script>";
            echo "<script> window.location.href='index.php';  </script>";
        }
    } else {
        echo "<script>alert('ไม่พบชื่อผู้ใช้งานในระบบ')</script>";
        echo "<script> window.location.href='index.php';  </script>";
    }
  }
?>
