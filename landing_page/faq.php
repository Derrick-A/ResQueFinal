<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="faq.css">
    <link rel="shortcut icon" href="pictures/fake logo(1).png" type="image/x-icon">
    <title>FAQ</title>
</head>

<body>

    <!-- the header background image -->
    <section class="hero">
        <!-- obtained from the landing page -->
        <header>
            <img src="pictures/fake logo(1).png" alt="the logo" class="logo">
            </div>

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
                <a href="../landing_page/home.php">Home</a>
                <a href="../landing_page\aboutus.html">About Us</a>
                <a href="review.html">Reviews</a>
                <a href="help.html">Help</a>
            </div>
        </header>

    </section>

<h2>Frequently Asked Questions</h2>

    <section class="faq">
        <h2>General Questions</h2>
        <div class="faq-grid">
            <div class="faq-item">
                <h3>How to Sign-up</h3>
                <p>Registering for a ResQue account is even easier with a choice of various ways to register, you can use our home page,
                    navigate to the home page, press sign-up, enter credentials, and proceed on. </p>
            </div>

            <div class="faq-item">
                <h3>How to login</h3>
                <p>Logging in for a ResQue account is even easier with a choice of various ways to login, you can use our home page,
                    navigate to the home page, press login, enter credentials, and proceed on.</p>
            </div>


            <div class="faq-item">
                <h3>Set Up Account</h3>
                <p>Registering for a Stuffsus account is even easier with a choice of various ways to register, you can use Google, Facebook, etc.</p>
            </div>

            <div class="faq-item">
                <h3>Why is my website down?</h3>
                <p>This might occur due to several reasons. The site is undergoing routine update, there are secutriy vulnerabilites being addressed, or a new feature is being implemented.</p>
            </div>

            <div class="faq-item">
                <h3>How can I contact your customer support team?</h3>
                <p>Good day valued customer, if you'd like to enquire about anything please send an email to systemsurgeonsit@gmail.com.</p>
            </div>

            <div class="faq-item">
                <h3>how do i reset my password?</h3>
                <p>If you forgot your password, please press on "forgot password" on the login/sign up page.</p>
            </div>

            <div class="faq-item">
                <h3>Do you offer technical support?</h3>
                <p>Yes we do, please do not hesitate to drop us an email on anything else at systemsurgeonsit@gmail.com.</p>
            </div>

            <div class="faq-item">
                <h3>Any alternative way to access the site, while undergoing maintenance?</h3>
                <p>unfortunately there isn't another way, hwoever please be aware of any maintenance underway, we will tell you in due time if anything big.</p>
            </div>

            <div class="faq-item">
                <h3>How will I be notified of any changes on my ticket?</h3>
                <p>On your sidebar there will be a number, which indicates the changes to your ticket, or any comment added.</p>
            </div>

            <div class="faq-item">
                <h3>How do I create a ticket as a student?</h3>
                <p>Please refer to the help section, and the videos uploaded on any naviagtion issues surrounding our website.</p>
            </div>


        </div>

        <br>
        <br>

        </div>
        <br><br>

        <h2>Student Support Questions</h2>
        <div class="faq-grid">
            <div class="faq-item">
                <h3>How to Manage Stress</h3>
                <p>Ensure you contact on RU psychologists on campus, to deal with the matter if urgent.</p>
            </div>
            <div class="faq-item">
                <h3>How does the system work?</h3>
                <p>Please refer to the help button on the home page, as there are vidoes to assist you, on how to navigate the system .</p>
            </div>
            <div class="faq-item">
                <h3>How do I contact the admin office, my email says invalid</h3>
                <p>Please send an email to systemsurgeonsit@gmail.com, and a admin officer will be in contact with you soon.</p>
            </div>

            <div class="faq-item">
                <h3>Are there any fees associated with my credentials when I login</h3>
                <p>Good day fellow student, there aren't any fees associated with your credentials being used to login or sign up</p>
            </div>

            <div class="faq-item">
                <h3>How do I contact the admin office, my email says invalid</h3>
                <p>Please send an email to systemsurgeonsit@gmail.com, and a admin officer will be in contact with you soon.</p>
            </div>

            <div class="faq-item">
                <h3>How do I schedule an appointment for counselling or mental health sercvices</h3>
                <p>Please refer to the dropdown on 'Resources' as the emergency contact for them are there.</p>
            </div>

            <div class="faq-item">
                <h3>Is there a crisis hotline?</h3>
                <p>Please refer to the back of your student card for these details, and take note of them</p>
            </div>

            <div class="faq-item">
                <h3>Do you offer IT career traning for students?</h3>
                <p>Please refer to the IT department (Hamilton Building) to hear what courses they offer, and any short courses.</p>
            </div>
        </div>
    </section>

    <section>
        <!-- Login Modal Structure -->
        <div class="login-body">
            <div id="login-modal" class="modal">
                <div class="modal-content">
                    <span class="close-btn">&times;</span>
                    <div class="login-form">
                        <h1>Welcome Back 👋</h1>
                        <p>Please enter your login credentials. Please ensure that login credentials are typed correctly.</p>
                        <form action="login.php" method="post">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" placeholder="Username" required maxlength="8">

                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Password" required>

                            <a href="#" class="forgot-password">Forgot Password?</a>

                            <input type="submit" id="login-submit-btn" name="submit" value="Sign in">
                        </form>
                        <p>Don't have an account? <a href="../landing_page/home.php">Sign up</a></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sign-up section -->
        <div id="signup-section" class="signup-section">
            <span class="close-btn1">&times;</span>
            <div class="container">
                <h1>Welcome 👋</h1>
                <div>
                    <p>Please enter your credentials. Ensure that the credentials are typed correctly.</p>
                </div>

                <form action="signup.php" method="POST">
                    <label for="role">Role</label>
                    <select name="role" id="role" required>
                        <option value="">Select Role</option>
                        <option value="student">Student</option>
                        <option value="house warden">House Warden</option>
                        <option value="hall secretary">Hall Secretary</option>
                    </select>

                    <!-- genetal field -->
                    <div id="generalFields" class="hidden">
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" placeholder="John" name="fname" required>

                        <label for="lname">Surname</label>
                        <input type="text" id="lname" placeholder="Smith" name="lname" required>

                        <label for="username">Username</label>
                        <input type="text" id="username" placeholder="g12s3456" name="username" maxlength="8" required>

                        <label for="password">Password</label>
                        <input type="password" id="password" placeholder="*******" name="password" required>

                        <label for="email">Email</label>
                        <input type="email" id="email" placeholder="g12s3456@campus.ru.ac.za" name="email" required>
                    </div>

                    <!-- the student area -->
                    <div id="studentFields">

                        <label for="hall">Hall Name</label>
                        <select name="studentHall" id="studentHall">
                            <option value="">Select Hall Name</option>
                            <option value="Mandela Hall">Nelson Mandela Hall</option>
                            <option value="Hobson Hall">Hobson Hall</option>
                            <option value="Drostdy Hall">Drostdy Hall</option>
                            <option value="Founders Hall">Founders Hall</option>
                        </select>

                        <label for="resName">Residence Name</label>
                        <input type="text" id="resName" placeholder="Enter resident name" name="resName">

                        <label for="roomNumber">Room Number</label>
                        <input type="text" id="roomNumber" placeholder="Enter room number" name="roomNumber" pattern="\d{1,3}">

                    </div>

                    <!-- House Warden Fields -->
                    <div id="houseWardenFields" class="hidden">

                        <label for="hall">Hall Name</label>
                        <select name="hw-hall" id="hw-hall">
                            <option value="">Select Hall Name</option>
                            <option value="Mandela Hall">Nelson Mandela Hall</option>
                            <option value="Hobson Hall">Hobson Hall</option>
                            <option value="Drostdy Hall">Drostdy Hall</option>
                            <option value="Founders Hall">Founders Hall</option>
                        </select>

                        <label for="hw-resName">Residence Name</label>
                        <input type="text" id="hw-resName" placeholder="Enter resident name" name="hw_resName">
                    </div>

                    <!-- Hall Secretary Fields -->
                    <div id="hallSecretaryFields" class="hidden">

                        <label for="hallSecretaryHall">Hall Name</label>
                        <select name="hallSecretaryHall" id="hallSecretaryHall">
                            <option value="">Select Hall Name</option>
                            <option value="Mandela Hall">Nelson Mandela Hall</option>
                            <option value="Hobson Hall">Hobson Hall</option>
                            <option value="Drostdy Hall">Drostdy Hall</option>
                            <option value="Founders Hall">Founders Hall</option>
                        </select>
                    </div>
                    <input type="submit" id="signup-submit-btn" name="submit" value="Signup">
                </form>

                <p>Already have an account? <a href="../landing_page/home.php">Login</a></p>
            </div>
        </div>
    </section>
    </div>


    <script>
        // Get the sign-up section element
        let signupSection = document.getElementById('signup-section');
        // Get the button that triggers the sign-up section
        let signupButton = document.getElementById('sign-up-btn');
        // Get the close button inside the sign-up section
        let closeSignupBtn = document.querySelector('.signup-section .close-btn1');

        // Get the login modal and button elements
        let loginModal = document.getElementById('login-modal');
        let loginBtn = document.getElementById('login-btn');
        let closeLoginBtn = document.querySelector('.login-body .close-btn');

        // Show the sign-up section when the sign-up button is clicked
        signupButton.onclick = function() {
            signupSection.classList.add('show'); // Show the sign-up section
            document.getElementById('generalFields').classList.add('hidden');
            document.getElementById('studentFields').classList.add('hidden');

            // Add a small delay to ensure the section is visible before scrolling
            setTimeout(function() {
                signupSection.scrollIntoView({
                    behavior: 'smooth'
                });
            }, 100); // Delay for 100ms
        };

        // Close the sign-up section when the close button is clicked
        closeSignupBtn.onclick = function() {
            signupSection.classList.remove('show'); // Hide the sign-up section
        };

        // Show the login modal when the login button is clicked
        loginBtn.onclick = function() {
            loginModal.style.display = 'block'; // Show the login modal
        };

        // Close the login modal when the close button is clicked
        closeLoginBtn.onclick = function() {
            loginModal.style.display = 'none'; // Hide the login modal
        };

        // Close the login modal when clicking outside the modal
        window.onclick = function(event) {
            if (event.target === loginModal) {
                loginModal.style.display = 'none';
            }
        };


        document.getElementById('role').addEventListener('change', function() {
            const role = this.value;

            // Hide all role-specific field sections and remove 'required' from their inputs
            document.getElementById('studentFields').classList.add('hidden');
            document.getElementById('houseWardenFields').classList.add('hidden');
            document.getElementById('hallSecretaryFields').classList.add('hidden');

            // Remove 'required' from all role-specific inputs
            document.querySelectorAll('#studentFields input, #houseWardenFields input, #hallSecretaryFields input, #studentFields select, #houseWardenFields select, #hallSecretaryFields select').forEach(input => {
                input.required = false; // Remove required from inputs
            });

            // Ensure the general fields are always visible and required
            document.getElementById('generalFields').classList.remove('hidden');
            document.querySelectorAll('#generalFields input').forEach(input => input.required = true); // Set general fields to required

            // Show the relevant role-specific fields and set them to required
            if (role === 'student') {
                document.getElementById('studentFields').classList.remove('hidden');
                document.querySelectorAll('#studentFields input').forEach(input => input.required = true);
                document.getElementById('studentHall').required = true; // Ensure student hall is required and visible

            } else if (role === 'house warden') {
                document.getElementById('houseWardenFields').classList.remove('hidden');
                document.querySelectorAll('#houseWardenFields input').forEach(input => input.required = true);
                document.getElementById('houseWardenHall').required = true; // Ensure house warden hall is required

            } else if (role === 'hall secretary') {
                document.getElementById('hallSecretaryFields').classList.remove('hidden');
                document.querySelectorAll('#hallSecretaryFields input').forEach(input => input.required = false); // Ensure inputs in hall secretary are not required
                document.getElementById('hallSecretaryHall').required = true; // Ensure hall secretary hall is required
            }
        });
    </script>

    <!-- should user back to landing page -->
    <a href="../landing_page/home.php" class="back-home" id="login-btn">Back Home</a>

    <!-- obtained from the landing page -->
    <footer class="footer">
        <div class="footer-links">
            <a href="../footer_links/links.html#integrity-and-constraints">Integrity & Compliance</a>
            <a href="../footer_links/links.html#legal">Legal</a>
            <a href="../footer_links/links.html#manage-cookies">Manage Cookies</a>
            <a href="../footer_links/links.html#privacy-policy">Privacy Policy</a>
        </div>
        <p>&copy; <time datetime="">2024</time> ResQue </p>
    </footer>
</body>

</html>