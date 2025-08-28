<!-- 
    - #HEADER
  -->
    <style>
        .navbar{
            margin: 0 auto;
        }
        .header .logo{
            position: absolute;
            display: flex;
            align-items: center;
            gap: .8rem;
        }
        .header .logo img{
            width: 60px;
        }
    </style>
    <header class="header" data-header>
        <div class="container" dir="ltr">

            <a href="#" class="logo">
                <img src="./assets/images/logo.png" width="162" height="50" alt="Logo">
                <h2>Edu-Think</h2>
            </a>

            <nav class="navbar" dir="rtl" data-navbar>

                <div class="wrapper">
                    <a href="#" class="logo">
                        <img src="./assets/images/logo.svg" width="162" height="50" alt="شعار EduWeb">
                    </a>

                    <button class="nav-close-btn" aria-label="إغلاق القائمة" data-nav-toggler>
                        <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
                    </button>
                </div>

                <ul class="navbar-list">

                    <li class="navbar-item">
                        <a href="index.html" class="navbar-link" data-nav-link>الرئيسية</a>
                    </li>

                    <li class="navbar-item">
                        <a href="about.html" class="navbar-link" data-nav-link>من نحن</a>
                    </li>

                    <li class="navbar-item">
                        <a href="courses.html" class="navbar-link" data-nav-link>الدورات</a>
                    </li>

                    <li class="navbar-item">
                        <a href="blog.html" class="navbar-link" data-nav-link>المدونة</a>
                    </li>

                    <li class="navbar-item">
                        <a href="cc.html" class="navbar-link" data-nav-link>اتصل بنا</a>
                    </li>

                </ul>

            </nav>

            <div class="header-actions">
                <button class="header-action-btn" aria-label="فتح القائمة" data-nav-toggler>
                    <ion-icon name="menu-outline" aria-hidden="true"></ion-icon>
                </button>
            </div>

            <div class="overlay" data-nav-toggler data-overlay></div>

        </div>
    </header>