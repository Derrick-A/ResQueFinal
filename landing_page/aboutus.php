<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
    <link rel="shortcut icon" href="pictures/fake logo(1).png" type="image/x-icon">
    <link rel="stylesheet" href="aboutus.css">
</head>

<body>
    <header>
        <!-- move to the left side of alles -->
    <a id="back-home" href="../landing_page/home.php">Back to Home</a>

        <h1>Meet Our Fully Remote Team</h1>
        <h2>Ready to Save Your Day, One Fix at a Time.
            It takes a group of passionate operators to run the system
        </h2>
    </header>

   
    <!-- thoko -->
    <div class="team-container">
        <div class="team-member" id="member-1">
            <img src="../landing_page/pictures/thokozile.JPG" alt="Thokozile Tshabalala">
            <h3>Thokozile Tshabalala</h3>
            <p>Position: Project Manager
                <br>
                Former education: Business Science Honours
                <br>at Rhodes University
                <br>in Information system
            </p>
        </div>


        <!-- derrick  -->
        <div class="team-member" id="member-2">
            <img src="../landing_page/pictures/derrick.JPG" alt="Derrick Abogaye">
            <h3>Derrick Abogaye</h3>
            <p>Position: Software Engineer
                <br>
                Former education: Bachelor of Science Honours
                <br>at Rhodes Univeristy
                <br>in Computer Science
            </p>
        </div>


        <!-- yuki -->
        <div class="team-member highlighted" id="member-3">
            <img src="../landing_page/pictures/yeukai.JPG" alt="Yeukai Runyowa">
            <h3>Yeukai Runyowa</h3>
            <p>Position: Software Quality Expert
                <br>
                Former education: Bachelor of Science Honours
                <br>at Rhodes Univeristy
                <br>in Computer Science
            </p>
        </div>


        <!-- amo -->
        <div class="team-member" id="member-4">
            <img src="../landing_page/pictures/amogelang.JPG" alt="Amogelang Mphela">
            <h3>Amogelang Mphela</h3>
            <p>Position: UI/UX Expert
                <br>
                Former education: Bachelor of Science Honours
                <br>at Rhodes Univeristy
                <br>in Computer Science
                <br>and User Experience
            </p>
        </div>


        <!-- akhona -->
        <div class="team-member" id="member-5">
            <img src="../landing_page/pictures/akhona.JPG" alt="Akhona Mdluli">
            <h3>Akhona Mdluli</h3>
            <p>Position: AI prompt expert
                <br>
                Former education: Bachelor of Science Honours
                <br>at Rhodes Univeristy
                <br>in Computer Science
                <br>and Git expert
            </p>
        </div>
    </div>

    <div class="buttons">
        <button onclick="prevMember()">Previous</button>
        <button onclick="nextMember()">Next</button>
    </div>

    <script>
        let currentMember = 3; // Starting with Yeukai Runyowa highlighted

        function highlightMember(memberId) {
            // Remove highlight from the current member
            document.querySelector('.highlighted').classList.remove('highlighted');

            // Highlight the new member
            document.getElementById(`member-${memberId}`).classList.add('highlighted');
        }

        function prevMember() {
            currentMember = (currentMember - 1 < 1) ? 5 : currentMember - 1;
            highlightMember(currentMember);
        }

        function nextMember() {
            currentMember = (currentMember + 1 > 5) ? 1 : currentMember + 1;
            highlightMember(currentMember);
        }

    </script>



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