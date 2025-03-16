<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/menu.css">
</head>
<body>
    <header>
        <nav class="navbar">
          <div class="logo">
            <a href="index.php">
                <img src="assets/img/logoDBR.png" alt="Logo" class="logo-img" />
            </a>
          </div>
            <div class="hamburger" aria-label="Toggle Navigation">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <ul class="nav-list">
                <li><a href="#"><i class="bi bi-search"></i></a></li>
                <li><a href="index.php">หน้าหลัก</a></li>
                
                <?php
                    if(!isset($_SESSION['uid'])){
                        echo '
                        <li><a href="allmovies.php">ภาพยนต์</a></li>
                        <li><a href="alltheater.php">โรงภาพยนต์</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">ล็อคอิน</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">สมัครสมาชิก</a></li>
                        ';
                    } else {
                        $type = $_SESSION['type'];
                        if($type == 2){
                            echo '
                            <li><a href="allmovies.php">ภาพยนต์</a></li>
                            <li><a href="alltheater.php">โรงภาพยนต์</a></li>
                            <li><a href="promotion.php">โปรโมชั่น</a></li>
                            ';
                            
                            // Display the profile dropdown here for user type 2
                            echo '
                            <div class="profile-dropdown">
                                <div onclick="toggle()" class="profile-dropdown-btn" aria-haspopup="true" aria-expanded="false">
                                    <div class="profile-img">
                                        <img src="admin/uploads/profile.jpg" alt="Profile Image" class="img-fluid"> 
                                    </div>
                                    <input type="file" id="fileInput" style="display: none;" onchange="loadImage(event)">
                                </div>
                                <ul class="profile-dropdown-list">
                                    <li class="profile-dropdown-list-item"><a href="viewprofile.php"><i class="bi bi-pencil-square"></i> แก้ไขโปรไฟล์</a></li>
                                    <li class="profile-dropdown-list-item"><a href="viewuserbooking.php"><i class="bi bi-ticket-perforated"></i> การจอง </a></li>
                                    <li class="profile-dropdown-list-item"><a href="#"><i class="bi bi-gear-fill"></i> ตั้งค่า</a></li>
                                    <li class="profile-dropdown-list-item"><a href="#"><i class="bi bi-people"></i> ช่วยเหลือ</a></li>
                                    <li class="profile-dropdown-list-item"><a href="logout.php"><i class="bi bi-box-arrow-in-right"></i> ล็อคเอาค์</a></li>
                                </ul>
                            </div>
                            ';
                        }
                    }
                ?>
            </ul>
        </nav>
    </header>

    <!-- Modal สำหรับการล็อกอิน -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="login.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="login">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal สำหรับการลงทะเบียน -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Register</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="register.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="register">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let profileDropdownList = document.querySelector(".profile-dropdown-list");
        let btn = document.querySelector(".profile-dropdown-btn");

        const toggle = () => {
            if (profileDropdownList) { // Check if dropdown exists
                profileDropdownList.classList.toggle("active");
                btn.setAttribute("aria-expanded", profileDropdownList.classList.contains("active"));
            }
        };

        window.addEventListener("click", function (e) {
            if (btn && !btn.contains(e.target)) {
                if (profileDropdownList) { // Check if dropdown exists
                    profileDropdownList.classList.remove("active");
                    btn.setAttribute("aria-expanded", "false");
                }
            }
        });

        function loadImage(event) {
            const img = document.querySelector('.profile-img img');
            const icon = document.querySelector('.profile-img i');
            
            img.src = URL.createObjectURL(event.target.files[0]); // Set src to the uploaded file's URL
            img.style.display = 'block'; // Show image
            icon.style.display = 'none'; // Hide icon
        }

        // Hamburger menu functionality
        let hamburgerbtn = document.querySelector(".hamburger");
        let nav_list = document.querySelector(".nav-list");

        hamburgerbtn.addEventListener("click", () => {
            nav_list.classList.toggle("show"); // Toggle display
        });
    </script>
</body>
</html>
