<?php
session_start();

// إضافة العناصر إلى سلة التسوق
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    // الحصول على بيانات الرحلة المضافة
    $trip_name = $_POST['trip_name'];
    $price = $_POST['price'];
    
    // إضافة العنصر إلى سلة التسوق (المخزنة في الجلسة)
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // إضافة العنصر إلى السلة
    $_SESSION['cart'][] = ['trip_name' => $trip_name, 'price' => $price];
}

// حساب الإجمالي
$total = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'];
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سلة التسوق</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            box-shadow: 1px 1px 10px#6F4E37;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 45px;
            padding: 20px;
        }
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #6F4E37;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            padding: 2rem 9%;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #6F4E37;
            margin-bottom: 1rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        .total {
            text-align: center;
            margin-top: 20px;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #ecb176;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 40px;
            cursor: pointer;
            font-weight: bold;
        }
        a {
            color: #ecb176;
            text-decoration: none; 
        }
        .navbar {
            background-color: #6F4E37;
            padding: 1rem;
            text-align: center;
            font-size: 1.8rem;
        }
        .navbar a {
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>سلة التسوق</h1>
        <table>
            <thead>
                <tr>
                    <th>الرحلة</th>
                    <th>السعر</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // عرض العناصر في سلة التسوق
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $item) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($item['trip_name']) . '</td>';
                        echo '<td>' . htmlspecialchars($item['price']) . ' ر.س</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="2">سلة التسوق فارغة.</td></tr>';
                }
                ?>
            </tbody>
        </table>

        <!-- عرض الإجمالي -->
        <div class="total">
            <h3>الإجمالي: <?php echo $total; ?> ر.س</h3>
        </div>

        <!-- نموذج إضافة إلى سلة التسوق -->
        <form action="sallaha.php" method="POST">
            <div class="payment-form">
                <label for="trip_name">اسم الرحلة:</label>
                <input type="text" name="trip_name" required placeholder="أدخل اسم الرحلة">
                
                <label for="price">السعر:</label>
                <input type="number" name="price" required placeholder="أدخل السعر" min="1">
                
                <button type="submit" name="add_to_cart">إضافة إلى سلة التسوق</button>
            </div>
        </form>

        <br>
        <div class="navbar">
            <a href="index.php">العودة إلى الصفحة الرئيسية</a>
        </div>
    </div>
</body>
</html>
