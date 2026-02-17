<?php
    // Start the session and retrieve user information
    session_start();
    $userName = $_SESSION['username'];
    $userRole = $_SESSION['userRole'];

    // Include the database connection file
    require '../../../Database Connection/Connection.php';

    // search term from POST, default to empty string
    $search = '';
    if (!empty($_POST['search']) && strlen(trim($_POST['search'])) > 0) {
        $search = $_POST['search'];
        $sql = "SELECT userID,userName,userEmail,userNumber,userRole FROM users
                WHERE userName LIKE '%$search%' OR userEmail LIKE '%$search%'";
    } else {
        $sql = "SELECT userID,userName,userEmail,userNumber,userRole FROM users";
    }

    // execute the query
    $result =  mysqli_query($con, $sql);

    // fetch all results as an associative array
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of User Accounts</title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>

<body>
    <header class="header" id="header">
        <nav class="nav container">
            <a href="#" class="nav-logo"> <h2>Management System</h2> </a>

            <div class="user-info">
                <p>Welcome, <?php echo $userName; ?> (<?php echo $userRole; ?>) 
              </p>
            </div>

            <div class="nav-menu" id="nav-menu">
              <ul class="nav-list">
                 <li class="nav-item"><a href="../../../Users/Admin.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="../Car Park Management/CarParkList.php" class="nav-link">List of Car Park Locations</a></li>
                <li class="nav-item">
                  <form action="../../../Logout/Logout.php" method="POST">
                    <button type="submit" name="Logout" class="nav-link logout-button">Logout</button>
                  </form>
                </li>               
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
                         <input type="text" name="search" placeholder="Search users">
                         <button>Search</button>
                         <p>Total: <?= count($users) ?></p>
                    </div>
                </form>

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Number</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <td><?= $user['userID'] ?></td>
                                <td><?= $user['userName'] ?></td>
                                <td><?= $user['userEmail'] ?></td>
                                <td><?= $user['userNumber'] ?></td>
                                <td><?= $user['userRole'] ?></td>
                            </tr>
                        <?php } ?>
                        
                        <?php if (count($users) === 0) { ?>
                            <tr>
                                <td colspan="5">No users found.</td>
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