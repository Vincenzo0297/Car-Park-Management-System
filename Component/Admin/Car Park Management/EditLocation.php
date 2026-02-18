<?php
    // Start the session and retrieve user information
    session_start();
    $userName = $_SESSION['username'];
    $userRole = $_SESSION['userRole'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car Park Location</title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>

<body>
    <?php
        require '../../../Database Connection/Connection.php';

        // Initialize variables
        $LocationNameMessage = $DescriptionMessage = $ParkingSpaceMessage = 
        $CostPerHrMessage = $LateCostPerHrMessage = $message = "";
        $locationRow = [];

        if (isset($_GET['LocationID'])) {
            $LocationID = intval($_GET['LocationID']);
            $stmt = $con->prepare("SELECT * FROM locations WHERE LocationID = ?");
            $stmt->bind_param("i", $LocationID);
            $stmt->execute();
            $result = $stmt->get_result();
            $locationRow = $result->fetch_assoc();
            $stmt->close();
        }

        if (isset($_POST['submit'])) {

            $LocationID = intval($_POST['LocationID']);
            $locationName = $_POST['LocationName'];
            $LocationDescriptions = $_POST['LocationDescription'];
            $parkingSpace = $_POST['ParkingSpace'];
            $costPerHr = $_POST['CostPerHr'];
            $lateCostPerHr = $_POST['LateCostPerHr'];

            if (!preg_match("/^[a-zA-Z0-9 ]*$/", $locationName)) {
                $LocationNameMessage = "Only letters, numbers, and white space allowed in location name field";
            } elseif (!preg_match("/^[a-zA-Z0-9 .,!?]*$/", $LocationDescriptions)) {
                $DescriptionMessage = "Only letters, numbers, spaces, and basic punctuation allowed in description field";
            } elseif (!preg_match("/^\d+(\.\d{1,2})?$/", $costPerHr)) {
                $CostPerHrMessage = "Please enter a valid cost per hour (up to 2 decimal places)";
            } elseif (!preg_match("/^\d+(\.\d{1,2})?$/", $lateCostPerHr)) {
                $LateCostPerHrMessage = "Please enter a valid late cost per hour (up to 2 decimal places)";
            } elseif (!preg_match("/^\d+$/", $parkingSpace)) {
                $ParkingSpaceMessage = "Parking space (capacity) cannot be negative";
            } else {

                $stmt = $con->prepare("UPDATE locations SET LocationName = ?, LocationDescription = ?, ParkingSpace = ?, CostPerHr = ?, LateCostPerHr = ? WHERE LocationID = ?");
                $stmt->bind_param("ssiddi", $locationName, $LocationDescriptions, $parkingSpace, $costPerHr, $lateCostPerHr, $LocationID);

                if ($stmt->execute()) {
                    $message = "Location successfully updated";
                } else {
                    $message = "Error: " . $stmt->error;
                }

                $stmt->close();
            }
        }
    ?>

    <header class="header" id="header">
        <nav class="nav container">
            <a href="#" class="nav-logo"><h2>Management System</h2></a>

            <div class="user-info">
                <p>Welcome, <?php echo $userName; ?> (<?php echo $userRole; ?>)</p>
            </div>

            <div class="nav-menu" id="nav-menu">
                <ul class="nav-list">
                    <li class="nav-item"><a href="../../../Users/Admin.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="../User Management/UserList.php" class="nav-link">List of User Account</a></li>
                    <li class="nav-item">
                        <form action="../../../Logout/Logout.php" method="POST">
                            <button type="submit" name="Logout" class="nav-link logout-button">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <section>
        <div class="login-container"> 
            <form action="EditLocation.php" method="POST">
                <div class="form">
                    <h2>Edit Location</h2>

                    <!-- Hidden LocationID (VERY IMPORTANT) -->
                    <input type="hidden" name="LocationID" value="<?php echo isset($locationRow['LocationID']) ? $locationRow['LocationID'] : ''; ?>">

                    <div class="box">
                        <input type="text" name="LocationName" value="<?php echo isset($locationRow['LocationName']) ? $locationRow['LocationName'] : ''; ?>" placeholder="Location Name">
                        <span><?php echo $LocationNameMessage; ?></span>
                    </div>

                    <div class="box">
                        <textarea name="LocationDescription" rows="3" cols="40" placeholder="Enter location description"><?php echo isset($locationRow['LocationDescription']) ? $locationRow['LocationDescription'] : ''; ?></textarea>
                        <span><?php echo $DescriptionMessage; ?></span>
                    </div>

                    <div class="box">
                        <input type="number" name="ParkingSpace" min="0" value="<?php echo isset($locationRow['ParkingSpace']) ? $locationRow['ParkingSpace'] : ''; ?>"placeholder="Parking Space (Capacity)">
                        <span><?php echo $ParkingSpaceMessage; ?></span>
                    </div>

                    <div class="box">
                        <input type="text" name="CostPerHr" value="<?php echo isset($locationRow['CostPerHr']) ? $locationRow['CostPerHr'] : ''; ?>" placeholder="Cost per hour ($)">
                        <span><?php echo $CostPerHrMessage; ?></span>
                    </div>

                    <div class="box">
                        <input type="text" name="LateCostPerHr" value="<?php echo isset($locationRow['LateCostPerHr']) ? $locationRow['LateCostPerHr'] : ''; ?>" placeholder="Late cost per hour ($)">
                        <span><?php echo $LateCostPerHrMessage; ?></span>
                    </div>

                    <div class="box">
                        <input type="submit" name="submit" value="Update Location">
                    </div>

                    <input type="button" value="Back" onclick="window.location.href='CarParkList.php'">
                    <span><?php echo $message; ?></span>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
