<?php
session_start();
include('admin/config/dbcon.php');

if (isset($_POST['register_btn'])) {
    $role = mysqli_real_escape_string($con, $_POST['role']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']); // corrected variable name

    if ($password == $confirm_password) {
        //check Email
        $check_email = "SELECT email FROM user WHERE email='$email' ";
        $check_email_run = mysqli_query($con, $check_email);

        if (mysqli_num_rows($check_email_run) > 0) {
            //Already Email Exists
            $_SESSION['message'] = "Already Email Exists";
            header("Location: register.php");
            exit(0);
        } else {
            $user_query = "INSERT INTO user (name, email, password, role) VALUES ('$name' , '$email' , '$password' , '$role')";
            $user_query_run = mysqli_query($con, $user_query);

            if ($user_query_run) {
                //Registered Message
                $_SESSION['message'] = "Registered Successfully";
                header("Location: login.php");
                exit(0);
            } else {
                $_SESSION['message'] = "Something Went Wrong";
                header("Location: register.php");
                exit(0);
            }
        }
    } else {
        $_SESSION['message'] = "Password and Confirm Password do not Match";
        header("Location: register.php");
        exit(0);
    }
} else {
    header("Location: register.php");
    exit(0);
}
