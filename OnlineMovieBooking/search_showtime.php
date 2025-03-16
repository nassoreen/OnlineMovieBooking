<?php include('connect.php'); ?>

<?php
// ตรวจสอบว่ามีการส่งข้อมูลเข้ามาหรือไม่
$movieid = isset($_POST['movieid']) ? $_POST['movieid'] : '';
$booking_date = isset($_POST['booking_date']) ? $_POST['booking_date'] : '';

// Generate dates for buttons (today and the next 20 days)
$dates = [];
for ($i = 0; $i < 7; $i++) {
    $dates[] = date('Y-m-d', strtotime("+$i days"));
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ค้นหาชื่อภาพยนตร์</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');


        body {
            font-family: "IBM Plex Sans Thai", sans-serif;
            background: linear-gradient(120deg, #075596, #000000 35% );
            margin: 0;
            padding: 0;
        }
        h1 {
            margin-top: 40px;
            text-align: center;
            color: #f0a500;
        }

        h3 {
            color: #fff;
            font-size: 25px;
        }
        .container {
        display: flex;
        justify-content: flex-start; /* Aligns items to the left */
        max-width: 100%; /* Use full width */
        margin: 0 auto; /* Center the container */
        padding: 20px; /* Add padding to prevent content from touching the edges */
        }

        form {
            flex: 0 0 auto; /* Keep the form at its default size */
            margin-right: 20px; /* Space between form and results */
            margin-left: 100px;
            background-color: #222;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .results-container {
            flex: 1; /* Allow results to take the remaining space */
            max-width: 300px; /* Limit width of results container */
            background: #fff; /* Background color for results */
            padding: 20px; /* Padding inside results */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Shadow for depth */
            overflow: auto; /* Add overflow auto for scrolling if content is too much */
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }
        .date-container {
            display: inline-block;
            overflow-x: hidden;
            margin: 10px 0;
            padding-bottom: 10px;
            white-space: nowrap;
            scroll-behavior: smooth;
            max-width: 70%;
        }
        .btn-container {
            display: flex;
            align-items: center;
        }
        .scroll-btn {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            margin: 5px;
            padding: 10px;
            font-size: 20px;
        }
        .scroll-btn:hover {
            background-color: #0056b3;
        }
        .btn-date {
            min-width: 100px;
            margin: 5px;
            background-color: #075596;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        h2 {
            text-align: left; /* Align text to the left for results heading */
            margin-top: 0; /* Remove top margin */
            color: #f0a500;
            font-size: 30px;
        }
        .results-container {
            flex: 1; /* Allow results to take the remaining space */
            max-width: 300px; /* Limit width of results container */
            background: #222; /* Background color for results */
            padding: 20px; /* Padding inside results */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Shadow for depth */
            overflow: auto; /* Add overflow auto for scrolling if content is too much */
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #075596;
            color: white;
        }
        td {
            background-color: #fff;
            color: #000000;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        p {
            text-align: center;
            color: #777;
        }
        .movie-container {
            margin-top: 20px;
            display: none;
        }
        .screen {
            width: 100%;
            height: 30px;
            background-color: #333;
            margin: 10px 0;
        }
    </style>
</head>
<body>

<h1>เช็ครอบฉาย</h1>
<div class="container">
    <form method="post" action="search_showtime.php" id="bookingForm">
        <div>
            <?php
            $sql_movie = "SELECT title, image FROM movies WHERE movieid = ?";
            $stmt_movie = $con->prepare($sql_movie);
            $stmt_movie->bind_param("i", $movieid);
            $stmt_movie->execute();
            $result_movie = $stmt_movie->get_result();
            
            if ($result_movie && $result_movie->num_rows > 0) {
                $movie_data = $result_movie->fetch_assoc();
                echo '<img src="admin/uploads/' . htmlspecialchars($movie_data['image']) . '" alt="' . htmlspecialchars($movie_data['title']) . '" style="max-width: 200px; margin-bottom: 20px;">';
            } else {
                echo '<p>ไม่พบข้อมูลภาพยนตร์</p>';
                $movie_data = null;
            }

            if ($movie_data !== null) {
                echo '<h3>โรงภาพยนตร์สำหรับ "' . htmlspecialchars($movie_data['title']) . '"</h3>';
            } else {
                echo '<p>กรุณาเลือกภาพยนตร์อีกครั้ง</p>';
            }
            ?>
        </div>

        <label for="booking_date" style="color: #f0a500;">เลือกวันที่:</label>
        <div class="btn-container">
            <button type="button" class="scroll-btn" onclick="scrollLeft()">&#8249;</button>
            <div class="date-container" id="dateContainer">
                <?php foreach ($dates as $date): ?>
                    <button type="button" class="btn btn-primary btn-date" onclick="selectDate('<?php echo $date; ?>')">
                        <?php echo date('d-m-Y', strtotime($date)); ?>
                    </button>
                <?php endforeach; ?>
            </div>
            <button type="button" class="scroll-btn" onclick="scrollRight()">&#8250;</button>
        </div>

        <!-- ช่องที่ซ่อนสำหรับเก็บค่าที่เลือก -->
        <input type="hidden" name="booking_date" id="booking_date" required>
        <input type="hidden" name="movieid" value="<?php echo htmlspecialchars($movieid); ?>">
    </form>

    <div class="results-container">
        <h2 id="results">ผลการค้นหา:</h2>
        <?php if ($movieid && $booking_date): ?>
            <?php
            // Fetch theater showtimes for the selected movie and date
            $sql_theater = "SELECT theater_name, timing FROM theater WHERE movieid = ? AND date = ?";
            $stmt_theater = $con->prepare($sql_theater);
            $stmt_theater->bind_param("is", $movieid, $booking_date);
            $stmt_theater->execute();
            $result_theater = $stmt_theater->get_result();

            // Display theater information
            if ($result_theater && $result_theater->num_rows > 0): ?>
                <h3>โรงภาพยนตร์สำหรับ "<?php echo htmlspecialchars($movie_data['title']); ?>" ในวันที่ <?php echo htmlspecialchars($booking_date); ?></h3>
                <table>
                    <thead>
                        <tr>
                            <th>ชื่อโรงภาพยนตร์</th>
                            <th>เวลา</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php while ($row_theater = $result_theater->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row_theater['theater_name']); ?></td>
                    <td>
                        <?php if (isset($row_theater['timing'])): ?>
                            <?php echo htmlspecialchars($row_theater['timing']); ?>
                        <?php else: ?>
                            <p>ไม่มีข้อมูลเวลา</p>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
                </table>
            <?php else: ?>
                <p style="color: #fff;">ไม่มีข้อมูลโรงภาพยนตร์สำหรับภาพยนตร์นี้ในวันที่ที่เลือก</p>
            <?php endif; ?>
            
        <?php else: ?>
            <p style="color: #fff;">กรุณาเลือกภาพยนตร์และวันที่เพื่อค้นหา</p>
        <?php endif; ?>
    </div>
</div>

<div id="seatSelection" style="display:none;">
    <h3>เลือกที่นั่ง</h3>
    <div id="detailsSection"></div>
    <!-- Add your seat selection code here -->
</div>

<?php
// ปิดการเชื่อมต่อฐานข้อมูล
if (isset($con) && $con) {
    $con->close();
}
?>

<a href="index.php" class="btn btn-secondary" style="margin-top: 108px;">กลับหน้าหลัก</a>


<script>
    function scrollToDate(offset) {
        const container = document.getElementById('dateContainer');
        container.scrollLeft += offset;
    }

    function scrollLeft() {
        scrollToDate(-200); // Scroll left by 200 pixels
    }

    function scrollRight() {
        scrollToDate(200); // Scroll right by 200 pixels
    }

    function selectDate(date) {
        document.getElementById('booking_date').value = date;
        document.getElementById('bookingForm').submit(); // Automatically submit the form
    }
</script>
</body>
</html>
