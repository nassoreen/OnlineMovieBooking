
<?php include('connect.php'); ?>
<?php include('header.php'); ?>

<!-- ////////////////////////////  แยกหมวดหมู่ /////////////////////////////////////// -->



<!-- Search Form -->
<form action="allmovies.php" method="post" ;>
    <div class="row search-container">
        <!-- First dropdown for categories from database -->
        <div class="form-group select">
            <select name="catid" class="form-control" onchange="this.form.submit()">
                <option value="">ภาพยนต์ทั้งหมด</option>
                <?php
                $sqlCategories = "SELECT * FROM `categories`";
                $resCategories = mysqli_query($con, $sqlCategories);

                if (mysqli_num_rows($resCategories) > 0) {
                    while ($data = mysqli_fetch_array($resCategories)) {
                        // Check if this category is selected
                        $selected = (isset($_POST['catid']) && $_POST['catid'] == $data['catid']) ? 'selected' : '';
                        echo "<option value='".$data['catid']."' $selected>".$data['catname']."</option>"; 
                    }
                } else {
                    echo "<option value=''>No Category found</option>";
                }
                ?> 
            </select>
        </div>
    </div>
</form>

<div class="second">
    <div class="latest">
        <div class="container" style="padding: 2rem 1rem; margin-left: 160px; width: 100%";>
            <div class="row mt-5">
                <?php
                // Category Search Functionality
                if (isset($_POST['catid']) && !empty($_POST['catid'])) {
                    $catid = mysqli_real_escape_string($con, $_POST['catid']);

                    $sql = "SELECT movies.*, categories.catname
                            FROM movies
                            INNER JOIN categories ON categories.catid = movies.catid
                            WHERE movies.catid = '$catid'";
                    $res = mysqli_query($con, $sql);

                    if (mysqli_num_rows($res) > 0) {
                        while ($data = mysqli_fetch_array($res)) {
                            ?>
                            <div class="col-lg-2 custom-card col-md-4 mb-4">
                                <div class="card">
                                    <div class="details">
                                        <div class="left">
                                            <p class="name"><?= $data['title'] ?></p>
                                            <div class="date_quality">
                                                <p class="quality">HD</p>
                                                <p class="date"><?= date("Y", strtotime($data['releasedate'])) ?></p>
                                            </div>
                                            <p class="category"><?= $data['catname'] ?></p>
                                            <div class="info">
                                                <div class="rate">
                                                    <i class="fa-solid fa-star"></i>
                                                    <p><?= $data['rating'] ?></p>
                                                </div>
                                                <div class="time">
                                                    <i class="fa-regular fa-clock"></i>
                                                    <p><?= isset($data['runtime']) ? $data['runtime'] . ' min' : '' ?></p>
                                                </div>
                                                <div class="container-social">
                                                    <div class="social">
                                                    <a href="moviedetail.php?movieid=<?= $data['movieid'] ?>" class="btn btn-primary btn-video">
                                                        ดูเพิ่มเติม
                                                    </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right">
                                            <i class="fa-solid fa-play"></i>
                                        </div>
                                    </div>
                                    <img src="admin/uploads/<?= $data['image'] ?>">
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<p>ไม่พบภาพยนตร์สำหรับหมวดหมู่ที่ระบุ</p>";
                    }
                } else {
                    // Display all movies if no category is selected (Default)
                    $sql = "SELECT movies.*, categories.catname
                            FROM movies
                            INNER JOIN categories ON categories.catid = movies.catid
                            ORDER BY movies.movieid DESC LIMIT 40"; // Fetch the latest 40 movies
                    $res  = mysqli_query($con, $sql);
                    if (mysqli_num_rows($res) > 0) {
                        while ($data = mysqli_fetch_array($res)) {
                            ?>
                            <div class="col-lg-2 custom-card col-md-4 mb-4">
                                <div class="card">
                                    <div class="details">
                                        <div class="left">
                                            <p class="name"><?= $data['title'] ?></p>
                                            <div class="date_quality">
                                                <p class="quality">HD</p>
                                                <p class="date"><?= date("Y", strtotime($data['releasedate'])) ?></p>
                                            </div>
                                            <p class="category"><?= $data['catname'] ?></p>
                                            <div class="info">
                                                <div class="rate">
                                                    <i class="fa-solid fa-star"></i>
                                                    <p><?= $data['rating'] ?></p>
                                                </div>
                                                <div class="time">
                                                    <i class="fa-regular fa-clock"></i>
                                                    <p><?= isset($data['runtime']) ? $data['runtime'] . ' min' : '' ?></p>
                                                </div>
                                                <div class="container-social">
                                                    <div class="social">
                                                    <a href="moviedetail.php?movieid=<?= $data['movieid'] ?>"  class="btn btn-primary btn-video">
                                                        ดูเพิ่มเติม
                                                    </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right">
                                            <i class="fa-solid fa-play"></i>
                                        </div>
                                    </div>
                                    <img src="admin/uploads/<?= $data['image'] ?>">
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<p>No movies available.</p>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
