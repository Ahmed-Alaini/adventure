<?php
include('db.php');  // الاتصال بقاعدة البيانات


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // معالجة بيانات التسجيل
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $id_number = mysqli_real_escape_string($conn, $_POST['id_number']);
    $birth_date = mysqli_real_escape_string($conn, $_POST['birth_date']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);

    // التعامل مع الملف المرفق (السجل الصحي)
    if (isset($_FILES['medical_record'])) {
        $medical_record = $_FILES['medical_record']['name'];
        $medical_record_tmp = $_FILES['medical_record']['tmp_name'];
        move_uploaded_file($medical_record_tmp, "uploads/" . $medical_record);
    } else {
        $medical_record = NULL;
    }

    // عدم تشفير كلمة المرور، بل تخزينها كما هي
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    // حذف السطر أعلاه واستبداله بما يلي:
    $hashed_password = $password; // تخزين كلمة السر كما هي

    // استعلام لإدخال البيانات في قاعدة البيانات
    $sql = "INSERT INTO users (fullname, username, password, email, id_number, birth_date, city, phone, gender, medical_record) 
            VALUES ('$fullname', '$username', '$hashed_password', '$email', '$id_number', '$birth_date', '$city', '$phone', '$gender', '$medical_record')";

    if (mysqli_query($conn, $sql)) {
        echo "تم التسجيل بنجاح! <a href='auth.php'>تسجيل الدخول</a>";
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
    <title>تسجيل جديد</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url("images/bak.jpg");
        }

        .registration-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .input-group input, .input-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #A67B5B;
            border-radius: 4px;
        }

        .register-button {
            width: 100%;
            padding: 10px;
            background-color: #ECB176;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .register-button:hover {
            background-color: #ecb176;
        }

        a {
            color: #ecb176;
            text-decoration: none;
        }

        .login-forms {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="registration-container">
    <h1>تسجيل</h1>
    <form action="singup.php" method="post" enctype="multipart/form-data">
        <!-- حقل الاسم الكامل -->
        <div class="input-group">
            <label for="fullname">الاسم الكامل:</label>
            <input type="text" id="fullname" name="fullname" required
                pattern="^[\u0621-\u064Aa-zA-Z ]+$" title="يجب أن يحتوي الاسم على أحرف فقط">
        </div>
        <!-- حقل اسم المستخدم -->
        <div class="input-group">
            <label for="username">اسم المستخدم:</label>
            <input type="text" id="username" name="username" required>
        </div>  
        <!-- حقل الرمز السري -->
        <div class="input-group">
            <label for="password">الرمز السري:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <!-- تأكيد كلمة المرور -->
        <div class="input-group">
            <label for="confirm_password">تأكيد الرمز السري:</label>
            <input type="password" id="confirm_password" name="confirm_password" required 
                oninput="this.setCustomValidity(this.value !== document.getElementById('password').value ? 'الرمزان غير متطابقين' : '')">
        </div>
        <!-- باقي الحقول -->
        <div class="input-group">
            <label for="email">البريد الإلكتروني:</label>
            <input type="email" id="email" name="email" required placeholder="example@domain.com">
        </div>
        <div class="input-group">
            <label for="id_number">رقم الهوية:</label>
            <input type="text" id="id_number" name="id_number" required pattern="\d{10}" maxlength="10" title="يجب أن يحتوي رقم الهوية على 10 أرقام فقط">
        </div>
        <div class="input-group">
            <label for="medical_record"> السجل الصحي:</label>
            <input type="file" id="medical_record" name="medical_record" accept="image/*">
        </div>
        <div class="input-group">
            <label for="birth_date">تاريخ الميلاد:</label>
            <input type="date" id="birth_date" name="birth_date" required>
        </div>
        <div class="input-group">
            <label for="city">المدينة: </label>
            <select id="city" name="city" required>
                <option value="">اختر المدينة</option>
                <option value="المدينة المنورة">المدينة المنورة</option>
                <option value="الرياض">الرياض</option>
                <option value="العلا">العلا</option>
                <option value="الدمام">الدمام</option>
                <option value="أبها">أبها</option>
                <option value="الطائف">الطائف</option>
            </select>
        </div>
        <div class="input-group">
            <label for="phone">رقم الجوال:</label>
            <input type="tel" id="phone" name="phone" required pattern="^\d{10}$">
        </div>

        <div class="input-group">
            <label for="gender">الجنس: </label>
            <select id="gender" name="gender" required>
                <option value="">اختر الجنس</option>
                <option value="انثى">انثى</option>
                <option value="ذكر">ذكر</option>
            </select>
        </div> 
        <button type="submit" class="register-button" name="register">تسجيل</button>
    </form>

    <div class="login-forms">
        <p>هل لديك حساب؟ <a href="auth.php">تسجيل الدخول</a></p>
    </div>
</div>

</body>
</html>
