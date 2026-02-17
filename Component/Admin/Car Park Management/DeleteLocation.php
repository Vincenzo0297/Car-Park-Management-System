<?php
    // Include the database connection file
     require '../../../Database Connection/Connection.php';

    // Get the LocationID from the URL parameter
    if (isset($_GET['LocationID'])) {

        $locationID = $_GET['LocationID'];

        // Delete the location from the database
        $deleteLocation = "DELETE FROM locations WHERE LocationID = '$locationID'";
        
        if (mysqli_query($con, $deleteLocation)) {
            // Redirect back to the car park list page with a success message
            header("Location: CarParkList.php?message=Location deleted successfully");
            exit();
        } else {
            // If deletion fails, show an error message
            echo "Error deleting location: " . mysqli_error($con);
        }
    } else {
        // If no LocationID is provided, redirect back to the car park list page
        header("Location: CarParkList.php?message=Invalid location ID");
        exit();
    }

?>
