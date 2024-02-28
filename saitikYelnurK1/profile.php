<?php
session_start(); // Start the session

if (!isset($_SESSION['username'])) {
    // Redirect to login page if user is not logged in
    header('Location: login.html');
    exit();
}

// Include the database connection file
include('connection.php');

// Retrieve user data from the session
$username = $_SESSION['username'];

// Retrieve user data from the database based on the email
$sql = "SELECT * FROM users WHERE username = '$username'";

$mysqli = new mysqli($hostname, $db_username, $db_password, $db_name);


$result = $mysqli->query($sql);

if ($result && $result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    // Handle the case where user data is not found
    echo "User data not found!";
    exit();
}
if(isset($_POST['logout'])){
    session_destroy();
    header('Location:login.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .profile-info {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-info img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .profile-info p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-info">
            <img src="profile-picture.jpg" alt="Profile Picture">
            <h2>User Profile</h2>
            <p><strong>Username:</strong> <?php echo isset($userData['username']) ? $userData['username'] : 'N/A'; ?></p>
            <p><strong>Email:</strong> <?php echo isset($userData['email']) ? $userData['email'] : 'N/A'; ?></p>
            <!-- You can display additional user information here -->
            <form method="post">
                <button type="submit" name='logout' >End session</button>
            </form>
        </div>
    </div>
</body>
</html>
