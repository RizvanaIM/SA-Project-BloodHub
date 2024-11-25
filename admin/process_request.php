<?php
include('config/dbcon.php');

if (isset($_POST['accept_btn'])) {
    $request_id = $_POST['request_id'];

    $query = "UPDATE blood_requests SET status = 'accepted' WHERE id = '$request_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Blood request accepted successfully!";
        header("Location: blood_requests.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Failed to accept blood request!";
        header("Location: blood_requests.php");
        exit(0);
    }
}

if (isset($_POST['reject_btn'])) {
    $request_id = $_POST['request_id'];

    $query = "UPDATE blood_requests SET status = 'rejected' WHERE id = '$request_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Blood request rejected successfully!";
        header("Location: blood_requests.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Failed to reject blood request!";
        header("Location: blood_requests.php");
        exit(0);
    }
}
