<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | ResQue</title>
    <link rel="shortcut icon" href="pictures/3-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="home.css">
</head>

<body>
    <div class="container">
        <header>
            <img src="pictures/fake logo(1).png" alt="Syntax On Air Logo" class="logo">

            <!-- navigation bar -->
            <nav>
                <ul class="nav-links">
                    <li><a href="../landing_page/faq.php">FAQ</a></li>
                    <li><a href="../landing_page/aboutus.php">About Us</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Resources</a></li>
                </ul>
                <div class="user-actions">
                    <a href="#" class="login-btn" id="login-btn">Login</a>
                    <a href="#" class="signup-btn" id="sign-up-btn">Sign up</a>
                </div>
            </nav>

            <!-- for when switching to a smaller screen -->
            <!-- for burger menu for mobile -->
            <input type="checkbox" id="burger-toggle" />
            <label for="burger-toggle" class="burger">
                <div></div>
                <div></div>
                <div></div>
            </label>

            <div class="mobile-menu">
                <a href="index.html">Home</a>
                <a href="about.html">About Us</a>
                <a href="review.html">Reviews</a>
                <a href="help.html">Help</a>
            </div>
        </header>

        <!-- the head of the page -->
        <section class="hero">
            <div class="hero-content">
                <div>
                <h2>Saving Your Day, One Fix at a Time</h2>
                <p>Easily report your maintenance issues and have them resolved without any hassle.</p>
                </div>
            </div>
        </section>
        <br>

       <!-- Card Section -->
    <section class="card-section">
        
        <div class="card about">
            <h4 class="card-title">About ResQue<h4/>
            <img src="../landing_page/pictures/aboutresque.JPG" alt="about the team"><br>
            <h4>We are a website that ensures maintenance is made faster
                and much more efficent. Real time communication, faster maintenance issues, 
                reliable staff, and friendly residence mates too.
            </h4>
        
        </div>

        <div class="card what-wedo">
            <h4 class="card-title">What does ResQue do?<h4/>
            <img src="../landing_page/pictures/maintenance.png" alt="maintenance">
            <h4>Maintain residence faults <br>
        Ensure a room is a home <br>
    Offer real time communicationbr
Every student is a customer to us</h4>
        </div>

        <div class="card contact">
        <h4 class="card-title">How to contact us?<h4/>
            <h4>Email: systemsurgeons@gmail.com <br>
        Telephone: +27 62 020 2020 <br>
    Office: Rhodes University Hamilton third floor office 22</h4>

        </div>
    </section>

        <!-- the login and sign up area -->
        <?php
        require_once('login_signup.php');
        ?>
        <script src="home.js"></script>

        <footer class="footer">
            <div class="footer-links">
                <a href="../footer_links/links.html#integrity-and-constraints">Integrity & Compliance</a>
                <a href="../footer_links/links.html#legal">Legal</a>
                <a href="../footer_links/links.html#manage-cookies">Manage Cookies</a>
                <a href="../footer_links/links.html#privacy-policy">Privacy Policy</a>
            </div>
            <p>&copy; <time datetime="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></time> ResQue </p>
        </footer>
        <script src="home.js"></script>
</body>

</html>