<?php
include('db.php');  // تأكد من أنك قمت بتوصيل قاعدة البيانات بشكل صحيح

// معالجة بيانات النموذج بعد إرسالها
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استلام البيانات من النموذج
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // التحقق من أن الحقول ليست فارغة
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error_message = "جميع الحقول مطلوبة!";
    } else {
        // إرسال البريد الإلكتروني
        $to = "support@hikingproject.com";
        $headers = "From: $email";
        $body = "الاسم: $name\nالبريد الإلكتروني: $email\n\nالرسالة:\n$message";

        if (mail($to, $subject, $body, $headers)) {
            // إذا تم إرسال البريد بنجاح، قم بإضافة البيانات إلى قاعدة البيانات
            $sql = "INSERT INTO contact_messages (name, email, subject, message) 
                    VALUES ('$name', '$email', '$subject', '$message')";

            if (mysqli_query($conn, $sql)) {
                $success_message = "تم إرسال رسالتك بنجاح! سيتم الرد عليك قريبًا.";
            } else {
                $error_message = "حدث خطأ أثناء حفظ الرسالة في قاعدة البيانات.";
            }
        } else {
            $error_message = "حدث خطأ أثناء إرسال الرسالة. يرجى المحاولة لاحقًا.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تواصل معنا</title>
    <style>
        :root {
            --yellow: #6F4E37;
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
            direction: rtl;
            text-align: right;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url("images/bakc.jpg");
            font-size: 1.6rem;
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
        .contact-section {
            margin-top: 2rem;
        }
        .contact-info {
            background-color: #fff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .contact-info h2 {
            color: var(--yellow);
            margin-bottom: 1rem;
        }
        .contact-info p {
            margin-bottom: 0.5rem;
        }
        .btn {
            display: inline-block;
            margin-top: 1.5rem;
            color: var(--yellow);
            padding: 0.8rem 2rem;
            border: 0.2rem solid var(--yellow);
            cursor: pointer;
            font-size: 1.7rem;
            background: rgba(255, 165, 0, .2);
            border-radius: 5px;
            text-align: center;
            transition: background 0.3s;
        }
        .btn:hover {
            color: #000;
            background: var(--yellow);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 1.6rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #f7f7f7;
        }
        .form-group textarea {
            resize: vertical;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>تواصل معنا</h1>

        <!-- رسالة نجاح أو فشل -->
        <?php if (isset($success_message)): ?>
            <div class="alert" style="color: green;"><?php echo $success_message; ?></div>
        <?php elseif (isset($error_message)): ?>
            <div class="alert" style="color: red;"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <div class="contact-section">
            <div class="contact-info">
                <h2>للتقديم على وظيفة</h2>
                <p>نرحب بانضمامك إلى فريقنا! يمكنك إرسال طلبات التوظيف عبر الإيميل التالي:</p>
                <p>البريد الإلكتروني: <a href="mailto:jobs@hikingproject.com">jobs@hikingproject.com</a></p>
            </div>

            <div class="contact-info">
                <h2>للتواصل بشأن الشكاوى أو الاقتراحات</h2>
                <p>إذا كان لديك أي شكاوى أو اقتراحات، يمكنك التواصل معنا عبر الرقم أو البريد الإلكتروني:</p>
                <p>رقم التواصل: <a href="tel:+966512345678">+966512345678</a></p>
                <p>البريد الإلكتروني: <a href="mailto:support@hikingproject.com">support@hikingproject.com</a></p>
            </div>
        </div>

        <!-- نموذج التواصل -->
        <form action="contact.php" method="POST">
            <div class="form-group">
                <label for="name">الاسم:</label>
                <input type="text" name="name" id="name" placeholder="أدخل اسمك" required>
            </div>

            <div class="form-group">
                <label for="email">البريد الإلكتروني:</label>
                <input type="email" name="email" id="email" placeholder="أدخل بريدك الإلكتروني" required>
            </div>

            <div class="form-group">
                <label for="subject">الموضوع:</label>
                <input type="text" name="subject" id="subject" placeholder="أدخل موضوع الرسالة" required>
            </div>

            <div class="form-group">
                <label for="message">الرسالة:</label>
                <textarea name="message" id="message" rows="5" placeholder="أدخل رسالتك" required></textarea>
            </div>

            <button type="submit" class="btn">إرسال</button>
        </form>

        <button class="btn" onclick="window.location.href='index.php';">العودة للصفحة الرئيسية</button>
    </div>
</body>
</html>
