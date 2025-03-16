<?php include('connect.php') ?>



<?php
if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert user details into the database
    $sql = "INSERT INTO `users`(`name`, `email`, `password`, `roteype`) VALUES ('$name','$email','$password','2')";

    if (mysqli_query($con, $sql)) {
        echo "<script> alert('User registered successfully!') </script>";
        echo "<script> window.location.href='index.php';  </script>";
    } else {
        echo "<script> alert('Registration failed') </script>";
    }
}
?>
