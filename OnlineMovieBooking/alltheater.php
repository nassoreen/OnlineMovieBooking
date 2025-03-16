

<?php include('connect.php'); ?>
<?php include('header.php'); ?>

<div class="bg-mv1">
    <img src="admin/uploads/bg-cicima.jpg" alt="" style="object-fit: cover;">
</div>

<div class="cinema-buttons">
    <button class="cinema-btn" onclick="showCinema(1)">ปัตตานี</button>
    <button class="cinema-btn" onclick="showCinema(2)">ยะลา</button>
    <button class="cinema-btn" onclick="showCinema(3)">นราธิวาส</button>
</div>



<div class="cinema-container">
    <?php
    // Check for selected region
// Check for selected region
$selected_region = isset($_GET['region']) ? (int)$_GET['region'] : 1;

// SQL query with region filtering
$sql = "SELECT theater.*, movies.*, categories.catname
        FROM theater
        INNER JOIN movies ON movies.movieid = theater.movieid
        INNER JOIN categories ON categories.catid = movies.catid
        WHERE theater.region_id = $selected_region
        ORDER BY theater.theaterid DESC";

  

$res = mysqli_query($con, $sql);
    
    // Check if there are results
    if (mysqli_num_rows($res) > 0) {
        while ($data = mysqli_fetch_array($res)) {
            ?>
            <div id="cinema-<?= $data['theaterid']; ?>" class="cinema-info active">
                <div class="movie"> 
                    <img src="admin/uploads/<?= $data['image']; ?>" alt="โปสเตอร์หนัง <?= $data['title']; ?>" class="movie-img">
                    <div class="movie-details-dt">
                        <div class="cinima-detials-name">
                            <h3 style="color: #f0a500;"><?= $data['theater_name']; ?></h3>
                            <h6><?= $data['title'] ?> <span><?= $data['catname'] ?></span></h6>
                            <div><?= $data['timing'] ?> <span><?= $data['days'] ?></span></div>
                            <div><?= $data['date'] ?></div>
                            <div><?= $data['location'] ?></div>
                            <h4 style="margin-top: 6px; color: #075596;">ราคาตั๋ว<?= $data['price'] ?></h4>
                        </div>
                        <div class="movie-buttons">
                            <a href="booking.php?id=<?= $data['theaterid']; ?>" target="_blank" class="book-btn">จองเลยตอนนี้</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            }
        } else {
            echo '<p>ไม่มีข้อมูลโรงภาพยนตร์ในภูมิภาคนี้</p>';
        }
    ?>
</div>



<!-- <script src="assets/js/main.js"></script> -->


<script>
function showCinema(region) {
    // เปลี่ยน URL เพื่อโหลดข้อมูลจากภูมิภาคที่เลือก
    window.location.href = `alltheater.php?region=${region}`;
}

// ฟังก์ชันนี้จะรันเมื่อโหลดหน้าเพื่อตั้งค่า active class
window.onload = function() {
    const params = new URLSearchParams(window.location.search);
    const region = params.get('region') || 1; // ถ้าไม่มีให้ใช้ค่าเริ่มต้น 1

    // ลบคลาส active จากทุกปุ่ม
    const buttons = document.querySelectorAll('.cinema-btn');
    buttons.forEach(button => {
        button.classList.remove('active');
    });

    // เพิ่มคลาส active ให้กับปุ่มที่ถูกเลือก
    const activeButton = document.querySelector(`.cinema-btn[onclick="showCinema(${region})"]`);
    if (activeButton) {
        activeButton.classList.add('active');
    }
};


</script>

