<?php
session_start(); // Start the session

if (isset($_POST['loginSubmit'])) {
    include('connection.php');  

    $mysqli = new mysqli($hostname, $db_username, $db_password, $db_name); 
    
    $username = $_POST['username'];  
    $password = $_POST['password'];  
      
    // To prevent from mysqli injection  
    $username = $mysqli->real_escape_string($username); 
    $password = $mysqli->real_escape_string($password);  
      
    $sql = "SELECT username , password  FROM users WHERE BINARY username = '$username' AND BINARY password = '$password'";

    $result = $mysqli->query($sql);  
    $count = $result->num_rows;  
    
    if ($count == 1) {  
        $row = $result->fetch_assoc();
        $_SESSION["username"] = $row['username'];
         // Assuming 'username' is the column name for the user's username
        echo "success";
        header('Location: profile.php');
        exit(); // Stop further execution
    } else {  
        echo "<h1> Login failed. Invalid username or password.</h1>";  
    }   
}  
?>
