<?php
include_once 'db_connect.php';

session_start();
if (isset($_POST['email'], $_POST['password'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    if ($stmt = $mysqli->prepare("SELECT name, user_type, password, school FROM User WHERE email = ? LIMIT 1")) {
        $stmt->bind_param('s', $email); 
        $stmt->execute();    
        $stmt->store_result();

        $stmt->bind_result($name, $user_type, $db_password, $school);
        $stmt->fetch();
        if ($stmt->num_rows == 1) {
        	if ($db_password == $password) {

                $_SESSION['name'] = $name;
                $_SESSION['user_type'] = $user_type;
                $_SESSION['school'] = $school;

                header("Location: ../users/$user_type". ".php"); // Simple statement that works for all user types

        	} else {
                $_SESSION['err'] = "Wrong Email or Password";
        		header("Location: ../index.php");
        	}
        } else {
            $_SESSION['err'] = "No Such User";
            header("Location: ../index.php");
        }
    } else {
        $_SESSION['err'] = "Database error: cannot prepare statement";
        header("Location: ../index.php");
    }

} else { 
    $_SESSION['err'] = "Could not process login";
    header("Location: ../index.php");
} 