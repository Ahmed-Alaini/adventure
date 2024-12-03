<?php
include('db.php');  // الاتصال بقاعدة البيانات

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book'])) {
    // معالجة بيانات الحجز
    $num_people = mysqli_real_escape_string($conn, $_POST['num_people']);
    $trip_date = mysqli_real_escape_string($conn, $_POST['trip_date']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
    
    // استعلام لإدخال البيانات في قاعدة البيانات
    $sql = "INSERT INTO bookings (num_people, trip_date, payment_method) 
            VALUES ('$num_people', '$trip_date', '$payment_method')";

    if (mysqli_query($conn, $sql)) {
        echo "<p>تم الحجز بنجاح! سيتم إرسال تفاصيل الحجز إلى بريدك الإلكتروني.</p>";
    } else {
        echo "حدث خطأ: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حجز هايكنق - عسير</title>
    <style>
        :root {
            --yellow: #6f4e37;
        }
        * {
            font-family: Poppins, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-transform: capitalize;
            border: none;
            text-decoration: none;
            transition: all .5s linear;
        }
        body {
            background-color: #f4f4f4;
            direction: rtl;
            text-align: right;
            font-size: 1.6rem;
        }
        .navbar {
            background-color: var(--yellow);
            padding: 1rem;
            text-align: center;
            font-size: 1.8rem;
        }
        .navbar a {
            color: #ECB176;
            text-decoration: none;
            font-weight: bold;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 2rem;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2, p {
            color: #333;
            margin-bottom: 1rem;
        }
        img {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            margin-bottom: 20px;
            border-radius: 10px;
        }
        .steps, .trip-location, .team, .activities, .essentials {
            background-color: #fff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .steps h2, .trip-location h2, .team h2, .activities h2, .essentials h2 {
            color: var(--yellow);
            margin-bottom: 1rem;
        }
        .payment-form {
            display: flex;
            flex-direction: column;
            margin-top: 2rem;
        }
        .payment-form label {
            margin: 1rem 0 0.5rem;
            font-size: 1.5rem;
            color: #333;
        }
        .payment-form input, .payment-form select {
            padding: 1rem;
            font-size: 1.6rem;
            border: 1px solid rgba(0, 0, 0, 0.3);
            border-radius: 5px;
            margin-bottom: 1rem;
            background: #f7f7f7;
        }
        .button {
            display: inline-block;
            margin-top: 1rem;
            color: var(--yellow);
            padding: 0.8rem 3rem;
            border: 0.2rem solid var(--yellow);
            cursor: pointer;
            font-size: 1.7rem;
            background: rgba(255, 165, 0, .2);
            border-radius: 5px;
            text-align: center;
            transition: background 0.3s;
        }
        .button:hover {
            color: #000;
            background: var(--yellow);
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="index.php">العودة إلى الصفحة الرئيسية</a>
    </div>

    <div class="container">
        <h1>حجز هايكنق في عسير</h1>
        <img src="images/p-6.jpg" alt="صورة من عسير">
        <h2>معلومات عن جبال السروات</h2>
        <p>جبال السروات في منطقة عسير هي جزء من سلسلة جبال السروات الممتدة على طول الساحل الغربي لشبه الجزيرة العربية. تتميز بقممها العالية، مثل جبل السودة الذي يُعد الأعلى في المملكة بارتفاع 3,015 مترًا. تشتهر السروات بمناخها المعتدل وطبيعتها الخضراء، مما يجعلها وجهة مثالية للسياحة والاستجمام.</p>

        <h2>الفترة الافتراضية للرحلة</h2>
        <p>مدة الرحلة: 4 ساعات</p>
        <p>مسافة المشي التقريبية: 8 كيلومترات</p>

        <div class="team">
            <h2>فريق العمل</h2>
            <p><strong>القائد:</strong> يوسف آل خميس</p>
            <p><strong>المنظمين:</strong> فاطمة الشريف، عادل الزهراني، أحمد القحطاني</p>
            <p><strong>المسعفين:</strong> هالة فهد، علي الغامدي، بدر الجهني</p>
        </div>

        <div class="activities">
            <h2>الأنشطة</h2>
            <ul>
                <li>الهايكنج</li>
                <li>التأمل في المناظر الطبيعية</li>
                <li>التخييم في الطبيعة</li>
            </ul>
        </div>

        <div class="essentials">
            <h2>أشياء يجب أن تحضرها معك</h2>
            <ul>
                <li>بطاقة الهوية أو الجواز أو الإقامة</li>
                <li>حذاء هايكنق</li>
                <li>ملابس رياضية مريحة</li>
                <li>جاكيت شتوي أو معطف خفيف</li>
                <li>شاحن للهاتف المحمول</li>
            </ul>
        </div>

        <div class="trip-location">
            <h2>موقع الرحلة</h2>
            <img src="images/trip-location-asir.jpg" alt="صورة لموقع الرحلة">
        </div>

        <div class="steps">
            <h2>خطوات الدفع</h2>
            <ol>
                <li>اختر عدد الأشخاص وتاريخ الرحلة.</li>
                <li>أدخل بيانات الدفع الخاصة بك.</li>
                <li>ستتلقى تأكيدًا بالبريد الإلكتروني فور إتمام الحجز.</li>
            </ol>
        </div>

        <form action="asir.php" method="POST">
            <div class="payment-form">
                <label for="num-people">عدد الأشخاص:</label>
                <input type="number" id="num-people" name="num_people" placeholder="أدخل عدد الأشخاص" required>

                <label for="trip-date">تاريخ الرحلة:</label>
                <input type="date" id="trip-date" name="trip_date" required>

                <label for="payment-method">طريقة الدفع:</label>
                <select id="payment-method" name="payment_method" required>
                    <option value="">اختر طريقة الدفع</option>
                    <option value="credit-card">بطاقة ائتمانية</option>
                    <option value="paypal">باي بال</option>
                    <option value="bank-transfer">تحويل بنكي</option>
                </select>

                <button type="submit" name="book" class="button">أكمل عملية الدفع</button>
            </div>
        </form>
    </div>
</body>
</html>