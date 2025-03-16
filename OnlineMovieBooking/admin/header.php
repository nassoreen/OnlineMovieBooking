


  <!-- Template Main CSS File -->
  <!-- <link href="../assets/css/style.css" rel="stylesheet"> -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


  <header id="header" class="d-flex align-items-center py-3 bg-dark">
    <div class="container d-flex align-items-center justify-content-between">

        <!-- Logo Section -->
        <h1 class="logo mb-0"><a href="dashboard.php" class="text-light text-decoration-none">DBR System</a></h1>

        <!-- Navigation Bar -->
        <nav id="navbar" class="navbar">
            <ul class="navbar-nav d-flex flex-row align-items-center gap-3 mb-0">
                <li class="nav-item"><a class="nav-link text-light" href="dashboard.php">เดชบอร์ด</a></li>
                <li class="nav-item"><a class="nav-link text-light" href="categories.php">หมวดหมู่</a></li>
                <li class="nav-item"><a class="nav-link text-light" href="movies.php">ภาพยนต์</a></li>
                <li class="nav-item"><a class="nav-link text-light" href="theater.php">โรงภาพยนต์</a></li>
                <li class="nav-item"><a class="nav-link text-light" href="viewallusers.php">ผู้ใช้</a></li>
                <li class="nav-item"><a class="nav-link text-light" href="viewallbooking.php">การจอง</a></li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="logout.php" onclick="return confirmLogout()">ออกจากระบบ</a>
                </li>
            </ul>
        </nav>

    </div>
</header>

<script>
    function confirmLogout() {
        return confirm("คุณต้องการออกจากระบบใช่ไหม?");
    }
</script>
