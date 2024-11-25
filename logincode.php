<?php
session_start();
include('admin/config/dbcon.php');

// Step 1: Check if the user is already logged in
if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
    // Step 2: Redirect based on the role
    if ($_SESSION['auth_role'] == 'Staff') {
        header("Location: admin/index.php"); // Redirect to Admin dashboard
        exit(0);
    } elseif (in_array($_SESSION['auth_role'], ['Donor', 'Hospital', 'Driver'])) {
        header("Location: index.php"); // Redirect to Donor, Hospital, or Driver dashboard
        exit(0);
    }
}

// Step 3: If the user is not logged in, proceed with the login process
if (isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $login_query = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    $login_query_run = mysqli_query($con, $login_query);

    if (mysqli_num_rows($login_query_run)) {
        // User found, get user details
        foreach ($login_query_run as $data) {
            $user_id = $data['id'];
            $user_name = $data['name'];
            $user_email = $data['email'];
            $role_as = $data['role']; // Assuming 'role_as' holds the role value (like "Staff", "Donor", etc.)
        }

        // Set session variables
        $_SESSION['auth'] = true;
        $_SESSION['auth_role'] = "$role_as"; // Set the role value in the session
        $_SESSION['auth_user'] = [
            'user_id' => $user_id,
            'user_name' => $user_name,
            'user_email' => $user_email,
        ];

        // Step 4: Role-based redirection
        if ($role_as == 'Admin') {
            $_SESSION['message'] = "Welcome to the Admin Dashboard";
            header("Location: admin/index.php"); // Redirect to Admin dashboard
            exit(0);
        }
        if ($role_as == 'Staff') {
            $_SESSION['message'] = "Welcome to the Admin Dashboard";
            header("Location: admin/index.php"); // Redirect to Admin dashboard
            exit(0);
        } elseif (in_array($role_as, ['Donor', 'Hospital', 'Driver'])) {
            $_SESSION['message'] = "You are Logged in as $role_as";
            header("Location: index.php"); // Redirect to Donor, Hospital, or Driver dashboard
            exit(0);
        } else {
            $_SESSION['message'] = "Invalid Role or Access Denied";
            header("Location: login.php"); // Redirect to login page if invalid role
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Invalid Email or Password";
        header("Location: login.php"); // Redirect to login page if credentials are incorrect
        exit(0);
    }
} else {
    // Redirect to login if the login form is not submitted
    $_SESSION['message'] = "You are not allowed to access this file directly";
    header("Location: login.php"); // Redirect to login page
    exit(0);
}
