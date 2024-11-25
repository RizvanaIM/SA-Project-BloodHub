<?php
session_start();
include('admin/config/dbcon.php');

if (isset($_POST['submit_detail'])) {
    $donor_name = mysqli_real_escape_string($con, $_POST['donor-name']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $blood_group = mysqli_real_escape_string($con, $_POST['blood-type']);
    $contact_number = mysqli_real_escape_string($con, $_POST['contact-number']);
    $last_donation_date = mysqli_real_escape_string($con, $_POST['last-donation']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    // Insert the data into the donor_history table
    $query = "INSERT INTO donor_history (donor_name, dob, gender, blood_group, contact_number, email, last_donation_date, donation_status) 
    VALUES ('$donor_name', '$dob', '$gender', '$blood_group', '$contact_number', '$email', NULL, 0)";


    if (mysqli_query($con, $query)) {
        $_SESSION['message'] = "Donation information has been submitted successfully!";
        header('Location: donate-blood.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Failed to submit donation information: " . mysqli_error($con);
        header('Location: donate-blood.php');
        exit(0);
    }
} else {
    $_SESSION['message'] = "Invalid request method!";
    header('Location: donate-blood.php');
    exit(0);
}
