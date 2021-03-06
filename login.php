<?php
/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$u_mail = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM users WHERE email ='$u_mail'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that e-mail doesn't exist!";
    header("location: error.php");
}
else { // User exists
    $user = $result->fetch_assoc();

    if ($_POST['password'] == $user['password']) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['active'] = $user['active'];
        
        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;
        $_SESSION['active'] = 1;

        header("location: profile.php");
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
    }
}

