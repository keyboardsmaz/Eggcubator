<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

// Retrieve user information from session
$fullname = $_SESSION['fullname'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egg Incubation Dashboard</title>
    <link rel="icon" href="images/logoh.png" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f3e5f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        h1, h2 {
            color: #7B1FA2;
            margin: 0;
            text-align: center;
        }
        p, .card h2, .card p {
            color: #4A148C;
        }
        .welcome-line {
            font-size: 1.2em;
            color: #4A148C;
            text-align: center;
            margin-bottom: 20px;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .action-btn {
            background: #7B1FA2;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.3s;
        }
        .action-btn:hover {
            background: #4A148C;
        }
        .dashboard {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .card {
            background: #EDE7F6;
            border-radius: 8px;
            padding: 20px;
            flex: 1;
            min-width: 300px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            text-align: center;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        footer {
            text-align: center;
            color: #7B1FA2;
            margin-top: 20px;
            font-size: 0.9em;
        }
        .graph-container {
            position: relative;
            margin: 10px auto;
            height: 200px;
            width: 100%;
            max-width: 300px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        canvas {
            width: 100% !important;
            height: 100% !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Egg Incubation Monitoring Dashboard</h1>
            <p class="welcome-line">Welcome, <?php echo htmlspecialchars($fullname); ?>!</p>
        </header>

        <!-- Button container for Calendar and Log Out -->
        <div class="button-container">
            <button class="action-btn" id="calendarBtn">Calendar</button>
            <a href="logout.php">
                <button class="action-btn">Log Out</button>
            </a>
        </div>

        <!-- Dashboard content -->
        <div class="dashboard">
            <div class="card">
                <h2>Current Temperature</h2>
                <div class="graph-container">
                    <canvas id="temperatureChart"></canvas>
                </div>
            </div>
            <div class="card">
                <h2>Current Humidity</h2>
                <div class="graph-container">
                    <canvas id="humidityChart"></canvas>
                </div>
            </div>
            <div class="card">
                <h2>Recent Hatchings</h2>
                <p>Latest hatchings data will go here...</p>
            </div>
            <div class="card">
                <h2>Alerts</h2>
                <p>No alerts at this time.</p>
            </div>
            <div class="card">
                <h2>Current Egg Candling Readings</h2>
                <div class="graph-container">
                    <canvas id="candlingChart"></canvas>
                </div>
            </div>
        </div>

        <footer>
            <p>&copy; 2024 Egg Incubator. All Rights Reserved.</p>
        </footer>
    </div>

    <script>
        // Temperature Chart
        const tempCtx = document.getElementById("temperatureChart").getContext("2d");
        new Chart(tempCtx, {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
                datasets: [{
                    label: "Temperature (°C)",
                    data: [25, 26, 24, 25, 27, 26],
                    borderColor: "#7B1FA2",
                    backgroundColor: "rgba(123, 31, 162, 0.2)",
                    fill: true
                }]
            },
            options: { responsive: true }
        });

        // Humidity Chart
        const humCtx = document.getElementById("humidityChart").getContext("2d");
        new Chart(humCtx, {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
                datasets: [{
                    label: "Humidity (%)",
                    data: [70, 75, 80, 85, 90, 95],
                    backgroundColor: "#4A148C"
                }]
            },
            options: { responsive: true }
        });

        // Egg Candling Chart - Resized for smaller visual graph
        const candlingCtx = document.getElementById("candlingChart").getContext("2d");
        new Chart(candlingCtx, {
            type: "pie",
            data: {
                labels: ["Fertile", "Infertile", "Uncertain"],
                datasets: [{
                    label: "Egg Candling Readings",
                    data: [10, 3, 2],
                    backgroundColor: ["#7B1FA2", "#FF6384", "#36A2EB"]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true, position: "top" }
                }
            }
        });
    </script>
</body>
</html>
