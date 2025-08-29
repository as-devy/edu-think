<?php
session_start();

if (isset($_SESSION['user_id'])) {
    // Redirect to signin if not logged in
    header("Location: index.php");
    exit();
}

require_once "db.php"; // include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            header("Location: main.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this email.";
    }

    $stmt->close();
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>إديوويب - تسجيل الدخول</title>
    <meta name="title" content="إديوويب - تسجيل الدخول">
    <meta name="description" content="تسجيل الدخول إلى منصة إديوويب">

    <!-- 
    - أيقونة الموقع
  -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!-- 
    - رابط CSS المخصص
  -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/auth.css">

    <!-- 
    - خطوط جوجل
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&display=swap" rel="stylesheet">



</head>

<body id="top">
    <?php require_once "./layout/header.php" ?>

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
                <form class="form" action="/" method="POST">
                    <p class="title">تسجيل الدخول</p>
                    <p class="message">أدخل بياناتك لتسجيل الدخول إلى حسابك.</p>

                    <label>
                        <input class="input" type="email" name="email" placeholder="البريد الإلكتروني" required>
                    </label>

                    <label>
                        <input class="input" type="password" name="password" placeholder="كلمة المرور" required>
                    </label>

                    <button class="submit">تسجيل الدخول</button>

                    <p class="signin"> <a href="for.html">إعادة تعيين كلمة المرور</a></p>

                    <p class="signin"> <a href="register.php">إنشاء حساب جديد</a></p>
                </form>
            </div>
        </div>
    </main>
</body>

</html>