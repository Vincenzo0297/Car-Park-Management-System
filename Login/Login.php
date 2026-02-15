<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
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
                            <input type="email" name="email" placeholder="Add your Email" />
                        </div>

                        <div class="box">
                            <input type="password" name="password" placeholder="Enter your Password" />
                        </div>

                        <button type="submit">Sign In Your Account</button>
                        <p>Don't have an account? <a href="../Registration/Register.php" style = "color: #007bff; font-size: 14px;">Register Account</a></p>
                </div>
            </form>
        </div>
    </section>

    <footer>
        <p>School Management System &nbsp;&nbsp;|&nbsp;&nbsp; © Copyright: Foolish Developer &nbsp;&nbsp;|&nbsp;&nbsp; SchoolManagement@gmail.com</p>
    </footer>
</body>
</html>