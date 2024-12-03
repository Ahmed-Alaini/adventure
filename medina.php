<?php
require_once 'mail.php'; 
include('db.php'); // الاتصال بقاعدة البيانات

// Ensure the user is logged in
// if (!isset($_SESSION['name'])) {
//     header("Location: auth.php");
//     exit();
// }

// إذا تم إرسال النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book'])) {
    // معالجة بيانات النموذج
    $num_people = mysqli_real_escape_string($conn, $_POST['num_people']);
    $trip_date = mysqli_real_escape_string($conn, $_POST['trip_date']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);

    // جلب البريد الإلكتروني من الجلسة

    // استعلام لإدخال بيانات الحجز في قاعدة البيانات
    $sql = "INSERT INTO bookings (num_people, trip_date, payment_method) 
            VALUES ('$num_people', '$trip_date', '$payment_method')";

    if (mysqli_query($conn, $sql)) {
        // إعداد رسالة التأكيد بالبريد الإلكتروني باستخدام PHPMailer
        try {
            $mail->setFrom('sadv65550@gmail.com', 'مغامرة حياتك');
            $mail->addAddress('alainiahmed91@gmail.com'); // إرسال إلى البريد الإلكتروني في الجلسة
            $mail->Subject = "تأكيد حجز هايكنق في المدينة المنورة";
            $mail->Body = "
            <b>تم حجز رحلة هايكنق في المدينة المنورة بنجاح</b><br>
            <b>عدد الأشخاص:</b> $num_people<br>
            <b>تاريخ الرحلة:</b> $trip_date<br>
            <b>طريقة الدفع:</b> $payment_method<br>
            ";

            // إرسال البريد الإلكتروني
            if ($mail->send()) {
                $success_message = "تم الحجز بنجاح! سيتم إرسال تفاصيل الحجز إلى بريدك الإلكتروني.";
                echo $success_message ;
                echo 'hello';
            } else {
                $error_message = "حدث خطأ أثناء إرسال البريد الإلكتروني: " . $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            $error_message = "حدث خطأ أثناء معالجة البريد الإلكتروني: " . $e->getMessage();
        }
    } else {
        $error_message = "حدث خطأ أثناء حفظ البيانات في قاعدة البيانات.";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حجز هايكنق - المدينة المنورة</title>
    <style>
        :root {
            --brown: #6f4e37; /* لون بني */
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
            background-color: var(--brown);
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
        .team, .activities, .items, .steps {
            background-color: #fff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .team h2, .activities h2, .items h2, .steps h2 {
            color: var(--brown);
            margin-bottom: 1rem;
        }
        ul {
            list-style-type: disc;
            margin-left: 20px;
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
            color: var(--brown);
            padding: 0.8rem 3rem;
            border: 0.2rem solid var(--brown);
            cursor: pointer;
            font-size: 1.7rem;
            background: rgba(165, 42, 42, 0.2);
            border-radius: 5px;
            text-align: center;
            transition: background 0.3s;
        }
        .button:hover {
            color: #000;
            background: var(--brown);
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="index.php">العودة إلى الصفحة الرئيسية</a>
    </div>

    <div class="container">
        <h1>حجز هايكنق في المدينة المنورة</h1>
        <img src="images/p-2.jpg" alt="صورة من المدينة المنورة">
        <h2>معلومات عن جبل أحد</h2>
        <p>يعد جبل أحد من المعالم الشهيرة في المدينة المنورة، ويتميز بجمال طبيعته وتضاريسه المثيرة. إنه مكان مثالي لعشاق الهايكنج.</p>
        
        <div class="team">
            <h2>فريق العمل</h2>
            <p>يتضمن الفريق:</p>
            <ul>
                <li>القائد: بسام عبدالحفيظ </li>
                <li>المنظمون: يارا كرعلي، أحمد عبدالحمن، مبارك الأحمدي، خالد نواف، سالم الدوسري، سعد المطيري</li>
                <li>المسعفون: سارة فهد، سمية القحطاني، سلمان الرشيدي، نايف سعود</li>
            </ul>
        </div>

        <div class="activities">
            <h2>الأنشطة</h2>
            <ul>
                <li>هايكنج</li>
                <li>التأمل</li>
                <li>أنشطة جماعية</li>
            </ul>
        </div>

        <div class="items">
            <h2>أشياء يجب أن تحضرها معك</h2>
            <ul>
                <li>بطاقة الهوية أو الجواز أو الإقامة</li>
                <li>حذاء هايكنق</li>
                <li>لبس رياضي مريح</li>
                <li>جاكيت شتوي</li>
            </ul>
        </div>

        <div class="trip-location">
            <h2>موقع الرحلة</h2>
            <img src="images/trip-location2.jpg" alt="صورة لموقع الرحلة">
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
        <form action="medina.php" method="POST">
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
        
        <!-- عرض الرسالة بعد الحجز بنجاح -->
        <?php if (isset($success_message)) { echo "<p>$success_message</p>"; } ?>
        <?php if (isset($error_message)) { echo "<p>$error_message</p>"; } ?>
    </div>
</body>
</html>
