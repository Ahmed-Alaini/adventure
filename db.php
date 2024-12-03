<?php
$host = "localhost"; // اسم الخادم
$username = "root"; // اسم المستخدم لقاعدة البيانات
$password = ""; // كلمة المرور لقاعدة البيانات (افتراضيًا تكون فارغة في XAMPP)
$database = "adventure"; // اسم قاعدة البيانات الخاصة بك

// الاتصال بقاعدة البيانات
$conn = mysqli_connect($host, $username, $password, $database);

// التحقق من نجاح الاتصال
if (!$conn) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}
?>
