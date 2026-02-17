<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car Park Location</title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>

<body>
    <?php
        require '../../../Database Connection/Connection.php';

         // Initialize variables for error messages and success message
         $LocationNameMessage = $DescriptionMessage = $ParkingSpaceMessage = $CostPerHrMessage = $LateCostPerHrMessage = $message = "";
        
         // Check if the form is submitted
        if(isset($_POST['submit'])) { 

            // Retrieve and sanitize form data
            $locationName = $_POST['LocationName'];
            $LocationDescriptions = $_POST['LocationDescription'];
            $parkingSpace = $_POST['ParkingSpace'];
            $costPerHr = $_POST['CostPerHr'];
            $lateCostPerHr = $_POST['LateCostPerHr'];

            // Validate form data
            if (!preg_match("/^[a-zA-Z0-9 ]*$/", $locationName)) {
                $LocationNameMessage = "Only letters, numbers, and white space allowed in location name field";
            } elseif (!preg_match("/^[a-zA-Z0-9 .,!?]*$/", $LocationDescriptions)) {
                $DescriptionMessage = "Only letters, numbers, spaces, and basic punctuation allowed in description field";
            } elseif (!is_numeric($parkingSpace) || $parkingSpace < 0) {
                $ParkingSpaceMessage = "Parking space must be a non-negative number";
            } elseif (!is_numeric($costPerHr) || $costPerHr < 0) {
                $CostPerHrMessage = "Cost per hour must be a non-negative number";
            } elseif (!is_numeric($lateCostPerHr) || $lateCostPerHr < 0) {
                $LateCostPerHrMessage = "Late cost per hour must be a non-negative number";
            } else {
            
                // prepared statement to prevent injection
                $stmt = $con->prepare("INSERT INTO locations (LocationName, LocationDescription, parkingSpace, Capacity, costPerHr, lateCostPerHr) VALUES (?, ?, ?, ?, ?, ?)");
               
                // Set initial capacity to 0 when adding a new location
                $currentCapacity = 0; 
                $stmt->bind_param('ssiiid', $locationName, $LocationDescriptions, $parkingSpace, $currentCapacity, $costPerHr, $lateCostPerHr);
            
                // Execute the statement and check for success
                if ($stmt->execute()) {
                    $message = "Location added successfully";
                } else {
                    $message = "Error: " . $stmt->error;
                }
                $stmt->close();
            }
        }
    ?>

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
            <form action="AddLocation.php" method="POST">
                <div class="form">
                    <h2>Add New Location</h2>
                    <div class="box">
                        <input type="text" id="LocationName" name="LocationName" placeholder="Location Name">
                         <span><?php echo $LocationNameMessage; ?></span> <!--Display validation error messages -->
                    </div>

                    <div class="box">
                         <textarea id="LocationDescription" name="LocationDescription" required rows="3" cols="40" placeholder="Enter location description"></textarea>
                         <span><?php echo $DescriptionMessage; ?></span> <!--Display validation error messages -->
                    </div>

                    <div class="box">
                         <input type="number" id="ParkingSpace" name="ParkingSpace" placeholder="Parking Space (Capacity):" required min="0">
                         <span><?php echo $ParkingSpaceMessage; ?></span> <!--Display validation error messages -->
                    </div>

                    <div class="box">
                        <input type="text" id="CostPerHr" name="CostPerHr" placeholder="Cost per hour ($)" required>
                        <span><?php echo $CostPerHrMessage; ?></span> <!--Display validation error messages -->
                    </div>

                    <div class="box">
                        <input type="text" id="LateCostPerHr" name="LateCostPerHr" placeholder="Late cost per hour ($)" required>
                        <span><?php echo $LateCostPerHrMessage; ?></span> <!--Display validation error messages -->
                    </div>

                    <input type="submit" id="submit" name="submit" value="Submit"> 
                    
                    <input type="reset" id="reset" name="reset" value="Reset">
                    <input type="button" id="back" name="back" value="Back" onclick="window.location.href='CarParkList.php'">
                    
                </div>
                 <span><?php echo $message; ?></span> <!--Display success or error message -->
            </form>
           
        </div>
    </section>


    <footer>
        <p>Car Park Management System &nbsp;&nbsp;|&nbsp;&nbsp; © Copyright: Foolish Developer &nbsp;&nbsp;|&nbsp;&nbsp; SchoolManagement@gmail.com</p>
    </footer>
</body>
</html>