<?php
    require_once("secure.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="links.css">
    <title>Policies</title>
    <link rel="icon" type="image/x-icon" href="pictures/resque-logo.png">
</head>

<body>
    <header>
        <h1>Welcome!<span class="username"></span></h1>
        <!-- the image on the top right corner -->
        <img src="images/resque-logo.png" alt="images">
        <p>Learn more about our policies.</p>
    </header>

    <main>
        <section>
            <div id="integrity-and-constraints" class="hr"><hr id="hr"></div>
            <h2>Integrity & Compliance</h2>
            <!-- <div class="hr"><hr id="hr"></div> -->
            <ul>
                <li>Data Integrity
                    Accurate and Complete Data: All data entered into the system, including fault descriptions,
                    locations, and user information, must be accurate and complete. Data validation checks should be
                    implemented to prevent errors.
                    Data Security: Sensitive user data (e.g., personal information, contact details) must be encrypted
                    and protected from unauthorized access.
                    Data Backup: Regular backups of system data will be performed to prevent data loss in case of system
                    failures or disasters.</li>
                <li>System Integrity
                    Reliability: The system should be designed to be reliable and accessible to users at all times.
                    Redundancy and failover mechanisms can be implemented to ensure uninterrupted service.
                    Security: The system should have robust security measures to protect against unauthorized access,
                    data breaches, and cyberattacks.
                    Performance: The system should be optimized for performance to ensure efficient fault reporting and
                    resolution.</li>
                <li>Compliance
                    Data Protection Regulations: The system must comply with relevant data protection laws (e.g., POPI
                    Act of 2019) to protect user privacy.
                    Accessibility Standards: The system should be accessible to users with disabilities, adhering to
                    accessibility standards.
                    Consumer Protection Laws: The system should comply with consumer protection laws, ensuring fair
                    treatment of users and transparent communication.
                    Fairness and Non-Discrimination: The system should be designed to avoid bias and discrimination in
                    fault resolution processes.</li>
                <li>Specific Considerations
                    Transparency: Clear communication channels should be established to keep users informed about fault
                    status and resolution progress.
                    Accountability: The system should track fault reports, assigned technicians, and resolution times to
                    ensure accountability.
                    Efficiency: The system should be designed to streamline fault reporting and resolution processes to
                    minimize inconvenience for users.
                    User Feedback: Mechanisms should be in place to gather user feedback and continuously improve the
                    system.</li>
                <li>Additional Considerations
                    Third-Party Integrations: If the system integrates with other systems (e.g., payment gateways,
                    maintenance management systems), ensure compliance with their terms and conditions.
                    Disaster Recovery: Develop a comprehensive disaster recovery plan to protect system data and ensure
                    business continuity.
                    Regular Audits: Conduct regular audits and security assessments to identify and address potential
                    vulnerabilities.</li>
            </ul>
        </section>

        <section>
            <div id="legal" class="hr"><hr id="hr"></div>
            <h2>Legal</h2>
            <ul>
                <li>Data protection and privacy
                    POPI ACT 2019: All data will be processed lawfully and in a reasonable manner that does not infringe
                    the privacy of the user. Section 9 subsection 1(a)(b)
                    POPI ACT 2019: System Surgeons will take reasonably practicable steps to ensure that the personal
                    information is complete, accurate, not misleading and updated where necessary. Section 16 subsection
                    1
                </li>
                <li>Other regional data protection laws: ResQue system will consider data protection laws applicable to
                    other jurisdictions where ResQue operates.</li>
                <li>Protection of Personal Information Act(POPI): ResQue collects personal information from Rhodes
                    University residents, the system complies with the POPI Act of 2019, which provides consumers with
                    specific rights regarding their data.</li>
            </ul>
        </section>

        <section>
            <div id="manage-cookies" class="hr"><hr id="hr"></div>
            <h2>Manage Cookies</h2>
            <ul>
                <li>Accept all cookies: This option implies consent to all cookies used on the website, including
                    essential, functional, performance, and advertising cookies.
                </li>
                <li>Reject all cookies: This option disables all non-essential cookies, but essential cookies required
                    for website functionality remain active.
                </li>
                <li> Customize cookie settings: This option allows users to selectively accept or reject different
                    categories of cookies.
                </li>
                <li>Cookie Consent Management Platform (CMP): This is a software solution that handles the technical
                    aspects of cookie management, including:
                    Storing user preferences.
                    Setting and deleting cookies based on preferences.
                    Providing information about cookie usage.
                    Ensuring compliance with data protection regulations.
                </li>
            </ul>
        </section>

        <section>
            <div id="privacy-policy" class="hr"><hr id="hr"></div>
            <h2>Privacy Policy</h2>
            <ul>
                <li>Information We Collect

                    Basic Information: We may collect basic information such as your name, email address, and location
                    when you create an account or contact our support team.
                    Usage Data: We may collect information about how you use our services, such as your IP address,
                    browser type, device information, and pages visited. This information is used to improve our
                    services and provide a better user experience.
                    Cookies and Similar Technologies: We use cookies and similar technologies to collect information
                    about

                    your browsing behavior. These cookies are essential for the website to function properly and help us
                    understand how users interact with our site
                </li>
                <li>Sharing Your Information: We may share your information with trusted third-party service providers
                    who assist us in operating

                    our business and providing our services. We require these third parties to comply with strict
                    confidentiality obligations.

                </li>
                <li>You have the right to access,

                    correct, or delete your personal information. You can also request to restrict the processing of
                    your data or object to certain processing activities</li>
                <li>If you have any questions about this Privacy Policy, please contact us at:

                    <a href="mailto:systemsurgeonsitdep@gmail.com"><strong>systemsurgeonsitdep@gmail.com</strong></a></li>
            </ul>
        </section>
        <a id="back-link" href="../landing_page/home.php">Back to Home</a>
    </main>

    <footer>
        <p>&copy; ResQue <time datetime="">2024</time></p>
    </footer>

</body>
</html>