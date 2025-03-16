<?php include('connect.php'); ?>
<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรโมชั่น</title>

    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <style>

@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
       

        body {
            font-family: "IBM Plex Sans Thai", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        
        header {
                color: white;
                padding: 40px 0;
                text-align: center;
        }



        header h1 {
            font-size: 36px;
            margin: 0;
        }

        .promotion-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 50px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .promotion-item {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
        }

        .promotion-item:hover {
            transform: translateY(-10px);
        }

        .promotion-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .promotion-content {
            padding: 20px;
            text-align: center;
        }

        .promotion-content h2 {
            font-size: 24px;
            color: #283593;
            margin-bottom: 15px;
        }

        .promotion-content p {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }

        .promotion-content a {
            display: inline-block;
            padding: 10px 25px;
            background-color: #faa816;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .promotion-content a:hover {
            background-color: #e91e63;
        }

        h2 {
            color: #007bff  ;
        }
    </style>
</head>
<body>

<header>
    <h1 style="color: #faa816;">โปรโมชั่น พิเศษ ที่มีให้แค่คุณ</h1>
</header>

<section class="promotion-section">
    <div class="promotion-item">
        <img src="admin\uploads\promo01.jpg" alt="Promo 1">
        <div class="promotion-content">
            <h2>ดูหนังกับครอบครัว</h2>
            <p>ได้ส่วนลดกินอาหารหรู 25%</p>
            <a href="#">New</a>
        </div>
    </div>

    <div class="promotion-item">
        <img src="admin\uploads\promo03.jpg" alt="Promo 2">
        <div class="promotion-content">
            <h2>ไอติม รสชาติสตอเบอร์รี่</h2>
            <p>ซื้อ 1 แถม 0</p>
            <a href="#">Grab Offer</a>
        </div>
    </div>

    <div class="promotion-item">
        <img src="admin\uploads\promo04.jpg" alt="Promo 3">
        <div class="promotion-content">
            <h2>popcorn ฟรี</h2>
            <p>เฉพาะลูกค้า วีไอพี</p>
            <a href="#">สมัครเลย</a>
        </div>
    </div>
</section>

<section class="promotion-section">
    <div class="promotion-item">
        <img src="admin\uploads\promo02.jpg" alt="Promo 1">
        <div class="promotion-content">
            <h2>ส่วนลด 50%</h2>
            <p>รับ 50% มากับครอบครัว</p>
            <a href="#">Shop Now</a>
        </div>
    </div>

    <div class="promotion-item">
        <img src="admin\uploads\promo05.jpg" alt="Promo 2">
        <div class="promotion-content">
            <h2>เบอร์คิง แจก</h2>
            <p>สั่งเซตใหญ่ แถม เซตเล็ก</p>
            <a href="#">สั่งเลย</a>
        </div>
    </div>

    <div class="promotion-item">
        <img src="admin\uploads\promo06.jpg" alt="Promo 3">
        <div class="promotion-content">
            <h2>ชมหนังฟรี</h2>
            <p>แต่!ต้องซื้อตั๋วหนังก่อน</p>
            <a href="#">ซื้อเลย</a>
        </div>
    </div>
</section>

</body>
</html>
