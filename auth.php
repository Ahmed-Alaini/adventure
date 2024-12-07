<?php
include('db.php');  // الاتصال بقاعدة البيانات

// Initialize error variables
$usernameError = '';
$passwordError = '';
$errorMessage = '';
$username = '';  // Initialize username variable
$password = '';  // Initialize password variable

// التحقق مما إذا كان المستخدم قد طلب تسجيل الدخول
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // معالجة بيانات تسجيل الدخول
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // استعلام للتحقق من بيانات المستخدم
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // التحقق من كلمة المرور بدون تشفير (مقارنة مباشرة)
        if ($password == $user['password']) {  // مقارنة كلمة السر المدخلة مع القيمة المخزنة مباشرة
            // تسجيل الدخول بنجاح
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['id'];
            header("Location: index.php"); // التوجيه إلى الصفحة الرئيسية
            exit();
        } else {
            // كلمة المرور غير صحيحة
            $passwordError = 'is-invalid';
            $errorMessage = 'كلمة المرور غير صحيحة';
        }
    } else {
        // اسم المستخدم غير موجود
        $usernameError = 'is-invalid';
        $errorMessage = 'اسم المستخدم غير موجود';
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <style>
        /* تنسيق الصفحة */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url('images/bak.jpg');
            background-size: cover;
            background-position: center;
        }

        .login-container {
            background-color: white;
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

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #A67B5B;
            border-radius: 4px;
        }

        .input-group input.is-invalid {
            border: 1px solid red; /* Apply red border for invalid fields */
        }

        .login-button {
            width: 100%;
            padding: 10px;
            background-color: #ECB176;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .login-button:hover {
            background-color: #ecb176;
        }

        .register-forms {
            text-align: center;
            margin-top: 10px;
        }

        .register-forms a {
            color: #ECB176;
            text-decoration: none;
        }

        .register-forms a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h1>تسجيل الدخول</h1>
    <form action="auth.php" method="post">
        <div class="input-group">
            <label for="username">اسم المستخدم:</label>
            <input type="text" id="username" name="username" class="<?php echo $usernameError; ?>" value="<?php echo htmlspecialchars($username); ?>" required>
        </div>
        <div class="input-group">
            <label for="password">الرمز السري:</label>
            <input type="password" id="password" name="password" class="<?php echo $passwordError; ?>" value="<?php echo htmlspecialchars($password); ?>" required>
        </div>
        
        <?php if (!empty($errorMessage)): ?>
            <div class="error-message">
                <p><?php echo $errorMessage; ?></p>
            </div>
        <?php endif; ?>
        
        <button type="submit" class="login-button" name="login">دخول</button>
    </form>

    <div class="register-forms">
        <p>ليس لديك حساب؟ <a href="singup.php">تسجيل جديد</a></p>
    </div>
</div>

</body>
</html>
