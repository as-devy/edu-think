<?php
session_start();

if (isset($_SESSION['user_id'])) {
    // Redirect to signin if not logged in
    header("Location: index.php");
    exit();
}

require_once "db.php"; // include the database connection


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $educational_level = $_POST['educational_level'];
    $age      = $_POST['age'];
    $password   = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashed_password);

    if ($stmt->execute()) {
        // ✅ Get the newly inserted user ID
        $user_id = $conn->insert_id;

        // ✅ Store it in the session
        $_SESSION['user_id'] = $user_id;

        // Redirect after signup
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- 
    - primary meta tag
  -->
    <title>EduWeb - أفضل برنامج للالتحاق بالتبادل الدراسي</title>
    <meta name="title" content="EduWeb - أفضل برنامج للالتحاق بالتبادل الدراسي">
    <meta name="description" content="هذا قالب HTML تعليمي مقدم من codewithsadee">

    <!-- 
    - favicon
  -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!-- 
    - custom css link
  -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/auth.css">

    <!-- 
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">

    <!-- 
    - preload images
  -->
    <link rel="preload" as="image" href="./assets/images/hero-bg.svg">
    <link rel="preload" as="image" href="./assets/images/hero-banner-1.jpg">
    <link rel="preload" as="image" href="./assets/images/hero-banner-2.jpg">
    <link rel="preload" as="image" href="./assets/images/hero-shape-1.svg">
    <link rel="preload" as="image" href="./assets/images/hero-shape-2.png">

</head>

<body id="top" dir="rtl">

    <!-- 
    - #HEADER
  -->

    <?php require_once "./layout/header.php" ?>

    <body id="top">

        <main>
            <div class="main_container">
                <div class="auth_overlay">

                    <div class="content" dir="ltr">
                        <a href="#" class="logo">
                            <img src="./assets/images/logo.png" width="162" height="50" alt="Logo">
                            <h2>Edu-Think</h2>
                        </a>
                        <p>Edu-Think is your ultimate study buddy—an online platform that blends technology with education for learners of all ages. With interactive tools, flexible study options, and easy access to resources, it makes learning engaging and accessible anytime, anywhere. Join Edu-Think to enhance your skills, achieve academic goals, and enjoy a smarter way to learn.</p>
                        <h3 style="color: #cececeff;">Join Us Now.</h3>
                    </div>
                </div>

                <div class="form_container">
                    <div class="steps">
                        <div class="step active">
                            <div class="number">1</div>
                            <p>معلومات المستخدم .</p>
                        </div>
                        <div class="step">
                            <div class="number">2</div>
                            <p>أختبار أنماط التعلم .</p>
                        </div>
                        <div class="step">
                            <div class="number">3</div>
                            <p>إكتشاف إهتماماتك .</p>
                        </div>
                    </div>

                    <form class="form" action="" method="POST">
                        <p class="title">تسجيل جديد</p>
                        <p class="message">سجل الآن واحصل على وصول كامل إلى التطبيق.</p>

                        <div class="flex">
                            <input class="input" type="text" name="first_name" placeholder="الاسم الأول" required>

                            <input class="input" type="text" name="last_name" placeholder="اسم العائلة" required>
                        </div>

                        <input class="input" type="email" name="email" placeholder="البريد الإلكتروني" required>

                        <div class="flex">
                            <select class="input" id="education" name="educational_level" required>
                                <option value="" disabled selected>اختر مستواك التعليمي</option>
                                <option value="prep">متم للشهادة الإعدادية</option>
                                <option value="secondary">متم للشهادة الثانوية</option>
                                <option value="college">الجامعة / الكلية</option>
                            </select>

                            <input class="input" type="number" name="age" placeholder="أدخل عمرك" required>
                        </div>


                        <input class="input" type="password" name="password" placeholder="كلمة المرور" required>
                        <input class="input" type="password" name="confirm_password" placeholder="تأكيد كلمة المرور" required>
                        <button class="submit">انشاء الحساب</button>


                        <p class="signin" style="display: flex;justify-content: center; gap: 1rem;">هل لديك حساب ؟ <a href="signin.php"> تسجيل الدخول</a></p>
                    </form>
                </div>
            </div>
        </main>

        <script src="./assets/js/script.js" defer></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>

</html>