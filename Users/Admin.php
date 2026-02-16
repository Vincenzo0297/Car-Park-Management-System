<?php
    session_start();
    $userID = $_SESSION['userID'];
    $userName = $_SESSION['username'];
    $userRole = $_SESSION['userRole'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header class="header" id="header">
        <nav class="nav container">
            <a href="#" class="nav-logo"> <h2>Management System</h2> </a>

            <div class="nav-menu" id="nav-menu">
              <ul class="nav-list">
                <li class="nav-item"><a href="/" class="nav-link">Account</a></li>
                <li class="nav-item"><a href="/" class="nav-link">List of Car Park Location</a></li>
                <li class="nav-item"><a href="/" class="nav-link">Logout</a></li>              
              </ul> 

              <div class="nav-close" id="nav-close">
                <!-- icon placeholder -->
                &times;
              </div>
            </div>

            <div class="nav-btn">
              <div class="nav-toggle" id="nav-toggle">
                <!-- icon placeholder -->
                &#9776;
              </div>
            </div>
        </nav>
    </header>

      <footer>
        <p>Car Park Management System &nbsp;&nbsp;|&nbsp;&nbsp; © Copyright: Foolish Developer &nbsp;&nbsp;|&nbsp;&nbsp; SchoolManagement@gmail.com</p>
    </footer>
</body>
</html>