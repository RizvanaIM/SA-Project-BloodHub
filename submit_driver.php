<?php
session_start();
include('admin/config/dbcon.php');

if (isset($_POST['submit_driver'])) {
    $driver_name = mysqli_real_escape_string($con, $_POST['driver_name']);
    $contact_number = mysqli_real_escape_string($con, $_POST['contact_number']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $license_number = mysqli_real_escape_string($con, $_POST['license_number']);
    $emergency_contact_number = mysqli_real_escape_string($con, $_POST['emergency_contact_number']);
    $work_days = mysqli_real_escape_string($con, implode(',', $_POST['work_days'])); // Assuming work_days is a checkbox array

    // Insert the data into the driver_details table
    $query = "INSERT INTO driver_details (driver_name, contact_number, email, license_number, emergency_contact_number, work_days) 
              VALUES ('$driver_name', '$contact_number', '$email', '$license_number', '$emergency_contact_number' , '$work_days')";

    if (mysqli_query($con, $query)) {
        $_SESSION['message'] = "Driver information has been submitted successfully!";
        header('Location: driver_register.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Failed to submit driver information: " . mysqli_error($con);
        header('Location: driver_register.php');
        exit(0);
    }
} else {
    $_SESSION['message'] = "Invalid request method!";
    header('Location: driver_register.php');
    exit(0);
}
