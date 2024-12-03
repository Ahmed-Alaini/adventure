<?php
include('db.php'); // الاتصال بقاعدة البيانات

// // إذا تم إرسال النموذج
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book'])) {
//     // معالجة بيانات النموذج
//     $num_people = mysqli_real_escape_string($conn, $_POST['num_people']);
//     $trip_date = mysqli_real_escape_string($conn, $_POST['trip_date']);
//     $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);

//     // استعلام لإدخال بيانات الحجز في قاعدة البيانات
//     $sql = "INSERT INTO bookings (num_people, trip_date, payment_method) 
//             VALUES ('$num_people', '$trip_date', '$payment_method')";

//     if (mysqli_query($conn, $sql)) {
//         // إرسال تأكيد بالبريد الإلكتروني
//         $to = "support@hikingproject.com";
//         $subject = "تأكيد حجز هايكنق في حائل";
//         $message = "تم حجز رحلة هايكنق في حائل بنجاح. التفاصيل:\n";
//         $message .= "عدد الأشخاص: $num_people\n";
//         $message .= "تاريخ الرحلة: $trip_date\n";
//         $message .= "طريقة الدفع: $payment_method\n";
//         $headers = "From: no-reply@hikingproject.com";

//         if (mail($to, $subject, $message, $headers)) {
//             $success_message = "تم الحجز بنجاح! سيتم إرسال تفاصيل الحجز إلى بريدك الإلكتروني.";
//         } else {
//             $error_message = "حدث خطأ أثناء إرسال البريد الإلكتروني.";
//         }
//     } else {
//         $error_message = "حدث خطأ أثناء حفظ البيانات في قاعدة البيانات.";
//     }
// }
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حجز هايكنق - حائل</title>
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
        <h1>حجز هايكنق في حائل</h1>
        <img src="images/p-4.jpg" alt="صورة من حائل">
        <h2>معلومات عن جبال أجا</h2>
        <p>جبل أجا هو من أبرز معالم منطقة حائل في السعودية، ويتميز بقممه العالية والتضاريس الوعرة. يعد من أهم الوجهات السياحية لمحبي الهايكنج والمغامرات الجبلية، حيث يوفر مناظر طبيعية خلابة ومسارات مثيرة للمشي. يعتبر الجبل جزءًا من سلسلة جبال حائل ويشتهر بجماله الفريد الذي يجذب الزوار من مختلف أنحاء المملكة.</p>

        <h2>الفترة الافتراضية للرحلة</h2>
        <p>مدة الرحلة: 3 ساعات</p>
        <p>مسافة المشي التقريبية: 7 كيلومترات</p>

        <div class="team">
            <h2>فريق العمل</h2>
            <p><strong>القائد:</strong> خالد السبهان</p>
            <p><strong>المنظمين:</strong> ندى العنزي، ماجد الشمري، محمد البلوي</p>
            <p><strong>المسعفين:</strong> علي العنزي، ليلى الرشيدي، بدر المطيري</p>
        </div>

        <div class="activities">
            <h2>الأنشطة</h2>
            <ul>
                <li>الهايكنج</li>
                <li>التخييم في الطبيعة</li>
                <li>التصوير الفوتوغرافي</li>
            </ul>
        </div>

        <div class="essentials">
            <h2>أشياء يجب أن تحضرها معك</h2>
            <ul>
                <li>بطاقة الهوية أو الجواز أو الإقامة</li>
                <li>حذاء هايكنق</li>
                <li>ملابس رياضية مريحة</li>
                <li>زجاجة ماء ووجبة خفيفة</li>
                <li>كاميرا لتوثيق المناظر الطبيعية</li>
            </ul>
        </div>

        <div class="trip-location">
            <h2>موقع الرحلة</h2>
            <img src="images/trip-location-hail.jpg" alt="صورة لموقع الرحلة">
        </div>

        <div class="steps">
            <h2>خطوات الدفع</h2>
            <ol>
                <li>اختر عدد الأشخاص وتاريخ الرحلة.</li>
                <li>أدخل بيانات الدفع الخاصة بك.</li>
                <li>ستتلقى تأكيدًا بالبريد الإلكتروني فور إتمام الحجز.</li>
            </ol>
        </div>

        <!-- نموذج الدفع -->
        <form action="hail.php" method="POST">
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
