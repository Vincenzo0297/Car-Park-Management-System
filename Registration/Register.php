<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register form</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php
        // Include the database connection file
        require '../Database Connection/Connection.php';

        // Initialize variables for error messages and success message  
        $message = $namemessage = $emailmessage = $passwordmessage = $confirmPasswordMessage = $numbermessage =  "";
        
        // Check if the form is submitted
        if(isset($_POST['submit'])) { 

            // Retrieve and sanitize form data
            $username = trim($_POST['userName']);
            $useremail = trim($_POST['userEmail']);
            $userpassword = $_POST['userPassword'];
            $userConfirmPassword = $_POST['userConfirmPassword'];
            $usernumber = trim($_POST['userNumber']);
            $userRole = $_POST['userRole'];

            // Validate form data
            if (!preg_match("/^[a-zA-Z ]*$/", $username)) {
                $namemessage = "Only letters and white space allowed in name field";
            } else if(!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $useremail)) {
                $emailmessage = "Invalid email format";
            } elseif (!preg_match("/^[a-zA-Z0-9!@#$%^&*]+$/", $userpassword)) {
                $passwordmessage = "Password must contain only letters (both uppercase and lowercase), numbers, and special characters";
            } elseif ($userpassword !== $userConfirmPassword) {
                $confirmPasswordMessage = "Passwords do not match";
            } elseif (!preg_match("/^\d{9}$/", $usernumber)) {
                $numbermessage = "Phone number must be 9 digits long";
            }  else {
            
                // prepared statement to prevent injection
                $stmt = $con->prepare("INSERT INTO users (userName, userEmail, userPassword, userNumber, userRole) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param('sssss', $username, $useremail, $userpassword, $usernumber, $userRole);

                if ($stmt->execute()) {
                    $message = "Account registered successfully";
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
                <li class="nav-item"><a href="/" class="nav-link">Features</a></li>
                <li class="nav-item"><a href="/" class="nav-link">Blog</a></li>
                <li class="nav-item"><a href="/" class="nav-link">About &amp; Contact Us</a></li>
                <li class="nav-item"><a href="/" class="nav-link">Location</a></li>              
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
            <form action="Register.php" method="POST">
                <div class="form">
                    <h2>Please Register Your Account</h2>
                    <div class="box">
                        <input type="text" id="userName" name="userName" placeholder="Barack Hussein">
                        <span><?php echo $namemessage; ?></span> <!--Display validation error messages -->
                    </div>

                    <div class="box">
                        <input type="email" id="userEmail" name="userEmail" placeholder="Obama69@gmail.com">
                        <span><?php echo $emailmessage; ?></span> <!--Display validation error messages -->
                    </div>

                    <div class="box">
                        <input type="password" id="userPassword" name="userPassword" placeholder="Enter password">
                        <span><?php echo $passwordmessage; ?></span> <!--Display validation error messages -->
                    </div>

                    <div class="box">
                        <input type="password" id="userConfirmPassword" name="userConfirmPassword" placeholder="Confirm Password" >
                        <span><?php echo $confirmPasswordMessage; ?></span> <!--Display validation error messages -->
                    </div>

                    <div class="box">
                        <input type="tel" id="userNumber" name="userNumber" placeholder="123456789" pattern="\d{9}">
                        <span><?php echo $numbermessage; ?></span>
                    </div>

                    <div class="box">
                        <select name="userRole">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                    <input type="submit" id="submit" name="submit" value="Register">
                     <span><?php echo $message ?></span> <!--Display validation error messages -->
                    <p>Already Have Account? <a href="../Login/Login.php" style = "color: #007bff; font-size: 14px;">Login Here!</a></p>
                </div>
            </form>
        </div>
    </section>

    <footer>
        <p>Car Park Management System &nbsp;&nbsp;|&nbsp;&nbsp; © Copyright: Foolish Developer &nbsp;&nbsp;|&nbsp;&nbsp; SchoolManagement@gmail.com</p>
    </footer>
</body>
</html>