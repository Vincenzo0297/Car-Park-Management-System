<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
        session_start();
        require '../Database Connection/Connection.php';

        $message = "";

        // handle form submission on POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $identifier = trim($_POST['email']);
            $userpassword = $_POST['password'];

            // check credentials with prepared statement against email column
            $stmt = mysqli_prepare($con,
                "SELECT userID, userName, userRole
                 FROM users
                 WHERE userEmail = ? AND userPassword = ?");
            mysqli_stmt_bind_param($stmt, "ss", $identifier, $userpassword);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) === 1) {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['username'] = $user['userName'];
                $_SESSION['userID'] = $user['userID'];
                $userType = $user['userRole'];
                // save role in session for later checks
                $_SESSION['userRole'] = $userType;

                if ($userType === 'admin') {
                    header('Location: ../Users/Admin.php');
                } else {
                    header('Location: ../Users/User.php');
                }
                exit();
            } else {
                $message = "Invalid email or password";
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
            <form action="Login.php" method="POST">
                <div class="form">
                    <h2>Please Login to Your Account</h2>
                        <div class="box">
                            <input type="email" name="email" placeholder="Enter your Email" required />
                        </div>

                        <div class="box">
                            <input type="password" name="password" placeholder="Enter your Password" required />
                        </div>

                        <button type="submit" name="submit">Sign In Your Account</button>
                        <?php echo $message ?> <!--Display error message if login fails -->
                        <p>Don't have an account? <a href="../Registration/Register.php" style = "color: #007bff; font-size: 14px;">Register Account</a></p>
                    </div>
            </form>
        </div>
    </section>

    <footer>
        <p>Car Park Management System &nbsp;&nbsp;|&nbsp;&nbsp; © Copyright: Foolish Developer &nbsp;&nbsp;|&nbsp;&nbsp; SchoolManagement@gmail.com</p>
    </footer>
</body>
</html>