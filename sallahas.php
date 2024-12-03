<?php
session_start();

// التحقق مما إذا كانت سلة التسوق تحتوي على عناصر
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// التحقق إذا تم الضغط على زر "إتمام الشراء"
if (isset($_POST['checkout'])) {
    // هنا يمكن إضافة كود لمعالجة الدفع أو إرسال بريد إلكتروني
    $message = "تم إتمام الشراء بنجاح! سيتم إرسال تفاصيل الحجز إلى بريدك الإلكتروني.";
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سلة التسوق</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    /* نفس التنسيق من الملف السابق */
    body {
        box-shadow: 1px 1px 10px#6F4E37;
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 45px;
        padding: 20px;
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
    .button {
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
</style>
<body>
    <div class="container">
        <h1>سلة التسوق</h1>

        <!-- عرض الرسالة بعد إتمام الشراء -->
        <?php if (isset($message)) { echo "<p>$message</p>"; } ?>

        <!-- عرض الجدول مع العناصر الموجودة في سلة التسوق -->
        <table>
            <thead>
                <tr>
                    <th>الإجمالي</th>
                    <th>السعر</th>
                    <th>الرحلة</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0; // الإجمالي الإجمالي
                foreach ($_SESSION['cart'] as $item) {
                    echo "<tr>";
                    echo "<td>{$item['price']} ر.س</td>";
                    echo "<td>{$item['price']} ر.س</td>";
                    echo "<td>{$item['trip_name']}</td>";
                    echo "</tr>";
                    $total += $item['price']; // جمع السعر الإجمالي
                }
                ?>
                <tr>
                    <td colspan="2">الإجمالي الكلي</td>
                    <td><?php echo $total; ?> ر.س</td>
                </tr>
            </tbody>
        </table>

        <!-- زر لإتمام عملية الدفع -->
        <form action="sallahas.php" method="POST">
            <button type="submit" name="checkout" class="button">إتمام الشراء</button>
        </form>

        <!-- زر العودة للصفحة الرئيسية -->
        <div class="navbar">
            <a href="index.php">العودة إلى الصفحة الرئيسية</a>
        </div>
    </div>
</body>
</html>
