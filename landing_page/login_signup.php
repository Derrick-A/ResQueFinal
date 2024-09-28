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
                <div><p>Please enter your credentials. Ensure that the credentials are typed correctly.</p></div>

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