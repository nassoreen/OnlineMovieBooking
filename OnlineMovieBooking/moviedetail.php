<?php include('connect.php'); ?>
<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Booking Page</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>

    <?php
    // Check if movieid is set in the URL
    if (isset($_GET['movieid'])) {
        $movieid = mysqli_real_escape_string($con, $_GET['movieid']);
        
        // Query to fetch movie details
        $sql = "SELECT movies.*, categories.catname FROM movies INNER JOIN categories ON categories.catid = movies.catid WHERE movies.movieid = '$movieid'";
        $res = mysqli_query($con, $sql);

        // Fetch the movie details
        if ($res && mysqli_num_rows($res) > 0) {
            $movie = mysqli_fetch_array($res);
        } else {
            echo "<p>Movie not found.</p>";
            exit; // Exit if no movie is found
        }
    } else {
        echo "<p>No movie ID specified.</p>";
        exit; // Exit if no movie ID is provided
    }
    ?>

    <div class="container-moviedetail">
        <div class="movie-info">
            <div class="movie-poster">
                <img src="admin/uploads/<?= $movie['image'] ?>" alt="<?= $movie['title'] ?> Movie Poster">
            </div>
            <div class="movie-detail">
                <p>วันที่ออกฉาย: <?= date("d F Y", strtotime($movie['releasedate'])) ?></p>
                <h2><?= $movie['title'] ?></h2>
                <p>แนว: <?= $movie['catname'] ?></p>
                <p>ความยาว: 120 นาที</p>
                <p>เรทติ้ง:  <strong> <i class="bi bi-star-fill"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></i></strong></p>

                <div class="ratings">
                    <div class="rating">
                        <span>IMDb: 9.9 </span>
                    </div>
                    <div class="rating">
                        <span>Rotten Tomatoes: 90% </span>
                    </div>
                </div>

                <form method="post" action="search_showtime.php">
                    <input type="hidden" name="movieid" value="<?= $movie['movieid'] ?>"> <!-- Use the actual movie ID -->
                    <input type="hidden" name="booking_date" value=""> <!-- You can set a default date here if needed -->
                    <button type="submit" class="button-moviedetail">ดูรอบฉายทั้งหมด</button>
                </form>
            </div>
            <div class="movie-detail-video">
              <video src="admin/uploads/mov_bbb.mp4" controls loop autoplay  width="600px" style="margin-top: 20px; border-radius: 8px;" >
              </video>
            </div>
        </div>

        <div class="cast" >
            <h3>นักแสดง</h3>
            <div class="cast-list" >
                <img src="admin/uploads/actor001.jpg" alt="">
                <img src="admin/uploads/actor002.jpg" alt="">
                <img src="admin/uploads/actor003.jpg" alt="">
                <img src="admin/uploads/actor004.jpg" alt="">
                <img src="admin/uploads/actor005.jpg" alt="">
            </div>
        </div>
    </div>
</body>
</html>
