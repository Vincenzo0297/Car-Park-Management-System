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
        $message = $namemessage = $surnamemessage = $passwordmessage = $confirmPasswordMessage = $numbermessage = $emailmessage =  ""; //Initlize for error messages;
        
        if(isset($_POST['submit'])) { //Check before Submitting

            //Initilize the variables 
            $username = $_POST['userName'];
            $useremail = $_POST['userEmail'];
            $userpassword = $_POST['userPassword'];
            $userConfirmPassword = $_POST['userConfirmPassword'];
            $usernumber = $_POST['userNumber'];

            //Form validation check 
            if (!preg_match("/^[a-zA-Z]*$/", $username)) {
                $namemessage = "Only letters and white space allowed in name field";
            } else if(!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $useremail)) {
                $emailmessage = "Invalid email format";
            } elseif (!preg_match("/^[a-zA-Z0-9!@#$%^&*]+$/", $userpassword)) {
                $passwordmessage = "Password must contain only letters (both uppercase and lowercase), numbers, and special characters";
            } elseif ($userpassword !== $userConfirmPassword) {
                $passwordmessage = "Passwords do not match";
            }elseif (!preg_match("/^\d{9}$/", $usernumber)) {
                $numbermessage = "Phone number must be 9 digits long";
            }  else {
                $message = "Registration successful!";
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
                        <input type="text" id="userName" name="userName" placeholder="Barack Hussein" required>
                        <span><?php echo $namemessage; ?></span> <!--Display validation error messages -->
                    </div>

                    <div class="box">
                        <input type="email" id="userEmail" name="userEmail" placeholder="Obama69@gmail.com" required>
                        <span><?php echo $emailmessage; ?></span> <!--Display validation error messages -->
                    </div>

                    <div class="box">
                        <input type="text" id="userPassword" name="userPassword" placeholder="Obama123!" required>
                        <span><?php echo $passwordmessage; ?></span> <!--Display validation error messages -->
                    </div>

                    <div class="box">
                        <input type="text" id="userConfirmPassword" name="userConfirmPassword" placeholder="Confirm Password" required>
                        <span><?php echo $confirmPasswordMessage; ?></span> <!--Display validation error messages -->
                    </div>

                    <div class="box">
                        <select name="userRole">
                            <option value="admin">Adminstrator</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                     <button type="submit">Sign In Your Account</button>
                    <p>Already Have Account? <a href="../Login/Login.php" style = "color: #007bff; font-size: 14px;">Login Here!</a></p>
                </div>
            </form>
        </div>
    </section>

    <footer>
        <p>School Management System &nbsp;&nbsp;|&nbsp;&nbsp; © Copyright: Foolish Developer &nbsp;&nbsp;|&nbsp;&nbsp; SchoolManagement@gmail.com</p>
    </footer>
</body>
</html>