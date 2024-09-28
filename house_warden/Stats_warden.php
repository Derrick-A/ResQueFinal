<?php
        require_once("secure.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics | ResQue</title>
    <link rel="icon" type="image/x-icon" href="pictures/fake logo(1).png">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Link to the FontAwesome library for icons -->
    <script src="https://kit.fontawesome.com/ddbf4d6190.js" crossorigin="anonymous"></script>
</head>
<body>

    <?php
        $warden_userName = $_SESSION['username'];
        
        // include database details from config.php file
        require_once("config.php");

        // attempt to make database connection
        $connection = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

        // Check if connection was successful
        if ($connection->connect_error) {
            die("<p class=\"error\">Connection failed: Incorrect credentials or Database not available!</p>");
        }

        $warden_res_query =
            "SELECT resName, concat(f_Name, ' ', l_Name) as 'Name', f_Name as 'firstName', CONCAT(LEFT(house_warden.f_Name, 1), LEFT(house_warden.l_Name, 1)) AS initials
            FROM house_warden WHERE userName = '$warden_userName';";
        $warden_res_query_result = $connection->query($warden_res_query);

        if ($warden_res_query_result === FALSE) {
            die("<p class=\"error\">Query was Unsuccessful!</p>");
        }

        $resnamel = $warden_res_query_result->fetch_assoc();
        $resname = $resnamel['resName'];
        $wardeName = $resnamel['Name'];
        $initials = $resnamel['initials'];
    ?>

    <div class="container">
        <!-- SIDE BAR!! -->
        <?php require_once("sidebarWarden.php"); ?>

    <main class="content">
        <header class="header">
            <h1>Statistics</h1>
        </header>
        
        <div class="stats-overview">

            <?php 
                $ticket_status = array("Opened", "Confirmed", "Closed");
                $icons = array("pictures/layer.svg", "pictures/clipboard-tick.svg", "pictures/task.svg");
                $class_names = array("card-icon", "card-icon1", "card-icon2");
                $names = array("Opened Tickets", "Confirmed Tickets", "Closed Tickets");
                $ticketTotals = array(0,0,0);
                $index = 0;
                $total = 0;
                
               //for each loop for rendering the Pending, Processing, Closed and Total tickets
                foreach($ticket_status as $status){
                    $sql = "SELECT * FROM ticket WHERE ticket_status = '$status' AND resName = '$resname'";
                    $result = $connection->query($sql);

                    // Check if query successfull
                    if ($result === FALSE) {
                        die("<p class=\"error\">Query was Unsuccessful!</p>");
                    }
                    
                    echo "<div class=\"card\" >";

                    echo      "<div class= {$class_names[$index]}>";
                    echo           "<img src={$icons[$index]} alt = 'Icon' >";
                    echo      "</div>";

                    echo      "<div class= \"card-info\" >";

                    echo          "<div class= \"card-number\">";
                    echo             $result -> num_rows;
                    echo           "</div>";

                    echo           "<div class=\"card-text\">";
                    echo             $names[$index];
                    echo           "</div>";
                    
                    echo       "</div>";

                    echo "</div>";

                    $ticketTotals[$index] = $result -> num_rows;
                    $index++;
                    $total += $result -> num_rows;
                }
            ?>

            <div class="card">
                <div class="card-icon3">
                    <img src="pictures/clipboard-text.svg" alt="Icon">
                </div>
                <div class="card-info">
                    <div class="card-number"><?php //echo $total; ?></div>
                    <div class="card-text">Total Tickets</div>
                </div>
            </div>

            </div>

        <div class="chartlayout">
            <div class="charts">
                <canvas id="ticketsChart"></canvas>
            </div>
            <div class="charts">
                <canvas id="ticketStatusChart"></canvas>
            </div>
        </div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('ticketsChart').getContext('2d');

    const myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            datasets: [{
                label: 'Tickets',
                data: [
                    <?php
                        $num = 1;
                        while($num <= 9){
                            if(isset($_REQUEST['res_name'])){
                                $resname = $_REQUEST['res_name'];
                                $sql = "SELECT * FROM ticket WHERE MONTH(ticketDate) = '$num' AND resName = '$resname' ";
                            }
                            else{
                                $sql = "SELECT * FROM ticket WHERE MONTH(ticketDate) = '$num' AND resName = '$defaulthouse' ";
                                
                            }
                            $result = $connection -> query($sql);
                            // Check if query successfull
                            if ($result === FALSE) {
                                die("<p class=\"error\">Query was Unsuccessful!</p>");
                            }

                            echo ($result -> num_rows).",";

                            $num++;
                        }
                    ?>
                    ],
                fill: true,
                borderColor: '#7e5bef',
                backgroundColor: 'rgba(126, 91, 239, 0.1)',
                pointBackgroundColor: '#fff',
                pointBorderColor: '#7e5bef',
                pointHoverBackgroundColor: '#7e5bef',
                pointHoverBorderColor: '#fff',
                pointRadius: 6,
                pointHoverRadius: 8,
                lineTension: 0.4
            }]
        },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                max: 50,
            },

        x: {
            grid:{
                display: false
            }
        }     
            },
            plugins: {

                legend: {
                    display: false  
                },

                title: {
                    display: true,  
                    text: 'Total Number of Tickets per Month',  
                    align: 'start',  
                    font: {
                    size: 18,  
                    weight: 'bold'  
                    },
                    padding: {
                        top: 10,
                        bottom: 30
                    }
                },

                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `Tickets: ${context.raw}`;
                        }
                    }
                }
            }
        }
    });

    const thechart = document.getElementById('ticketStatusChart').getContext('2d');
    const ticketStatusChart = new Chart(thechart, {
        type: 'doughnut', // Use 'doughnut' for the circular chart
        data: {
            labels: ['Pending', 'Processing', 'Completed'],
            datasets: [{
                data: [
                    <?php 
                        foreach($ticketTotals as $total){
                            echo $total.",";
                        }
                        // close connection
                        $connection->close();
                    ?>
                ], // Data points
                backgroundColor: ['#444444', '#A2D9CE', '#85C1E9'], // Colors for each section
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right', // Position legend to the right
                    labels: {
                        usePointStyle: true, // Use dots as legend markers
                        boxWidth: 10,
                        padding: 20,
                        color: '#000'
                    }
                },
                title: {
                    display: true,  
                    text: 'Distribution of Current Tickets',  
                    align: 'start',  
                    font: {
                    size: 18,  
                    weight: 'bold'  
                    },
                    padding: {
                        top: 10,
                        bottom: 30
                    }
                }
            }
        }
    });
    </script>   
        </main>
    </div>
</body>
</html>