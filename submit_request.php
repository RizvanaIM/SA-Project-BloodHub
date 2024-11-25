<?php
session_start();
include('admin/config/dbcon.php');

if (isset($_POST['submit_btn'])) {
    $hospital_name = mysqli_real_escape_string($con, $_POST['hospital_name']);
    $hospital_address = mysqli_real_escape_string($con, $_POST['hospital_address']);
    $contact_number = mysqli_real_escape_string($con, $_POST['contact_number']); // Add this line
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $blood_group = mysqli_real_escape_string($con, $_POST['blood_group']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
    $urgency_level = mysqli_real_escape_string($con, $_POST['urgency_level']);
    $date_needed = mysqli_real_escape_string($con, $_POST['date_needed']);
    $additional_info = mysqli_real_escape_string($con, $_POST['additional_info']);

    // Prepare the SQL query
    $request_query = "INSERT INTO blood_requests (hospital_name, hospital_address, contact_number, email, blood_group, quantity, urgency_level, date_needed, additional_info) 
                      VALUES ('$hospital_name', '$hospital_address', '$contact_number', '$email', '$blood_group', '$quantity', '$urgency_level', '$date_needed', '$additional_info')";
    $request_query_run = mysqli_query($con, $request_query);

    if ($request_query_run) {
        $_SESSION['message'] = "Request Submitted Successfully";
        header("Location: request-blood.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Something Went Wrong: " . mysqli_error($con); // Display database error
        header("Location: request-blood.php");
        exit(0);
    }
} else {
    header("Location: request-blood.php");
    exit(0);
}