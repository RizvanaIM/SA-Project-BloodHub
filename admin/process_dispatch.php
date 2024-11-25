<?php
session_start();
include('config/dbcon.php'); // Include the database connection file
require '../vendor/autoload.php'; // Load PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['dispatch_blood_btn'])) {
    // Step 1: Retrieve and sanitize form data
    $request_id = intval($_POST['request_id']);
    $hospital_name = htmlspecialchars($_POST['hospital_name']);
    $hospital_address = htmlspecialchars($_POST['hospital_address']);
    $contact_number = htmlspecialchars($_POST['contact_number']);
    $blood_group = htmlspecialchars($_POST['blood_group']);
    $quantity = intval($_POST['quantity']); // Quantity requested
    $dispatch_date = $_POST['dispatch_date']; // Dispatch date
    $driver_id = intval($_POST['driver']); // Driver ID

    // Step 2: Fetch hospital email using the hospital name
    $hospital_query = "SELECT email FROM blood_requests WHERE hospital_name = ?";
    $hospital_stmt = $con->prepare($hospital_query);
    $hospital_stmt->bind_param("s", $hospital_name);
    $hospital_stmt->execute();
    $hospital_result = $hospital_stmt->get_result();

    if ($hospital_result->num_rows > 0) {
        $hospital = $hospital_result->fetch_assoc();
        $hospital_email = $hospital['email'];
    } else {
        $_SESSION['error_message'] = "Hospital information could not be retrieved for email.";
        header('Location: dispatch_blood.php');
        exit();
    }

    // Step 3: Fetch blood inventory sorted by collection date (FIFO)
    $inventory_query = "SELECT id, blood_quantity, dispatch_units, collection_date FROM blood_inventory 
    WHERE blood_type = ? ORDER BY collection_date ASC";
    $inventory_stmt = $con->prepare($inventory_query);
    $inventory_stmt->bind_param("s", $blood_group);
    $inventory_stmt->execute();
    $inventory_result = $inventory_stmt->get_result();

    // Step 3.1: Check if any inventory exists for the requested blood group
    if ($inventory_result->num_rows === 0) {
        $_SESSION['error_message'] = "No available inventory for the requested blood group ($blood_group).";
        header('Location: dispatch_blood.php');
        exit();
    }

    $total_quantity_available = 0; // Total available quantity of the blood group

    // Calculate total available quantity
    while ($row = $inventory_result->fetch_assoc()) {
        $available_quantity = $row['blood_quantity'] - $row['dispatch_units'];
        $total_quantity_available += $available_quantity;
    }

    // Step 4: Check if requested quantity is available
    if ($total_quantity_available < $quantity) {
        $_SESSION['error_message'] = "Insufficient blood quantity available for dispatch.";
        include('dispatch_blood.php'); // Include the current page to display the error message
        exit();
    }

    // Reset pointer for inventory result to reuse for dispatch logic
    $inventory_result->data_seek(0);

    $total_quantity_dispatched = 0; // Total quantity dispatched so far

    // Step 5: Gather blood units for dispatch
    while ($row = $inventory_result->fetch_assoc()) {
        $available_quantity = $row['blood_quantity'] - $row['dispatch_units'];
        $blood_id = $row['id'];

        // Dispatch blood from this unit if sufficient
        if ($total_quantity_dispatched + $available_quantity <= $quantity) {
            $dispatch_quantity = $available_quantity;
        } else {
            $dispatch_quantity = $quantity - $total_quantity_dispatched;
        }

        // Update the dispatch_units column for the dispatched quantity
        $update_dispatch_query = "UPDATE blood_inventory SET dispatch_units = dispatch_units + ? WHERE id = ?";
        $update_dispatch_stmt = $con->prepare($update_dispatch_query);
        $update_dispatch_stmt->bind_param("ii", $dispatch_quantity, $blood_id);
        $update_dispatch_stmt->execute();

        $total_quantity_dispatched += $dispatch_quantity;

        if ($total_quantity_dispatched >= $quantity) {
            break; // Dispatch complete
        }
    }

    // Step 6: Insert the dispatch details into the database
    $query = "INSERT INTO blood_dispatches (request_id, driver_id, hospital_name, hospital_address, contact_number, blood_group, dispatch_units, dispatch_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("iissssis", $request_id, $driver_id, $hospital_name, $hospital_address, $contact_number, $blood_group, $quantity, $dispatch_date);

    if ($stmt->execute()) {
        // Step 7: Update blood request status to dispatched
        $update_query = "UPDATE blood_requests SET status = 'dispatched' WHERE id = ?";
        $update_stmt = $con->prepare($update_query);
        $update_stmt->bind_param("i", $request_id);

        if ($update_stmt->execute()) {
            // Step 8: Send email to the hospital
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->SMTPAuth   = true;
                $mail->Host       = 'smtp.gmail.com';
                $mail->Username   = 'aathief01@gmail.com';
                $mail->Password   = 'fhkbwdzlzqipbhea';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                // Recipients
                $mail->setFrom('aathief01@gmail.com', 'BloodHub Dispatch Center');
                $mail->addAddress($hospital_email, $hospital_name);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Blood Dispatch Confirmation - Order ID: ' . $request_id;
                $mail->Body    = "
                <h3>Dear $hospital_name,</h3>
                <p>Your blood request has been processed successfully.</p>
                <ul>
                    <li><strong>Blood Group:</strong> $blood_group</li>
                    <li><strong>Quantity Dispatched:</strong> $quantity units</li>
                    <li><strong>Dispatch Date:</strong> $dispatch_date</li>
                </ul>
                <p>Thank you for trusting BloodHub.</p>";

                $mail->send();
                $_SESSION['message'] = "Blood dispatched, and email sent to hospital.";
            } catch (Exception $e) {
                $_SESSION['message'] = "Blood dispatched, but email failed to send: {$mail->ErrorInfo}";
            }

            // Step 9: Change the driver's status to '0' for 30 minutes
            $current_time = date('Y-m-d H:i:s'); // Current timestamp
            $expire_time = date('Y-m-d H:i:s', strtotime('+30 minutes')); // 30 minutes from now

            $update_driver_status_query = "UPDATE driver_details SET status = 0, status_expiration = ? WHERE driver_id = ?";
            $update_driver_status_stmt = $con->prepare($update_driver_status_query);
            $update_driver_status_stmt->bind_param("si", $expire_time, $driver_id);
            $update_driver_status_stmt->execute();

            // Redirect to the blood requests page after dispatching
            header('Location: blood_requests.php');
            exit();
        } else {
            $_SESSION['error_message'] = "Failed to update blood request status.";
            include('dispatch_blood.php');
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Failed to dispatch blood.";
        include('dispatch_blood.php');
        exit();
    }
} else {
    $_SESSION['error_message'] = "Invalid access.";
    include('dispatch_blood.php');
    exit();
}
