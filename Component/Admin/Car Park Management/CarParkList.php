<?php
     // Include the database connection file
     require '../../../Database Connection/Connection.php';

    // search location from POST, default to empty string
    $searchLocation = '';
    if (!empty($_POST['search']) && strlen(trim($_POST['search'])) > 0) {
        $searchLocation = $_POST['search'];
        $sql = "SELECT * FROM locations
                WHERE locationName LIKE '%$searchLocation%' or costPerHr LIKE '%$searchLocation%' or lateCostPerHr LIKE '%$searchLocation%'";
    } else {
        $sql = "SELECT * FROM locations";
    }

    // execute the query
    $result =  mysqli_query($con, $sql);

    // fetch all results as an associative array
    $locationDetails = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Park Management List</title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>

<body>
    <header class="header" id="header">
        <nav class="nav container">
            <a href="#" class="nav-logo"> <h2>Management System</h2> </a>

            <div class="nav-menu" id="nav-menu">
              <ul class="nav-list">
                <li class="nav-item"><a href="../../../Users/Admin.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="../User Management/UserList.php" class="nav-link">List of User Account</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Logout</a></li>              
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

    <section>
        <div class="login-container">
            <div class="search-form"> 
                <form method="POST">
                    <div class="box">
                         <input type="text" name="search" placeholder="Search car park locations">
                         <button>Search</button>
                         <button><a href="../../Admin/Car Park Management/AddLocation.php">Add Location</a></button>
                        <p>Total: <?= count($locationDetails) ?></p>    
                    </div>
                </form>

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Location Name</th>
                            <th>Description</th>
                            <th>Total Capacity</th>
                            <th>Parking Space (Capacity)</th>
                            <th>Cost per hour ($)</th>
                            <th>Late cost per hour ($)</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($locationDetails as $location) { ?>
                            <tr>
                                <td><?= $location['LocationID'] ?></td>
                                <td><?= $location['LocationName'] ?></td>
                                <td><?= $location['LocationDescription'] ?></td>
                                <td><?= $location['Capacity'] ?></td>
                                <td><?= $location['ParkingSpace'] ?></td>
                                <td><?= $location['CostPerHr'] ?></td>
                                <td><?= $location['LateCostPerHr'] ?></td>
                            </tr>
                        <?php } ?>
                        
                        <?php if (count($locationDetails) === 0) { ?>
                            <tr>
                                <td colspan="8">No car park locations found.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div> 
        </div>
    </section>

      <footer>
        <p>Car Park Management System &nbsp;&nbsp;|&nbsp;&nbsp; © Copyright: Foolish Developer &nbsp;&nbsp;|&nbsp;&nbsp; SchoolManagement@gmail.com</p>
    </footer>
</body>
</html>