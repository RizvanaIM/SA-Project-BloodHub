<?php
include('config/dbcon.php');

// Load Composer's autoload file to enable the use of external libraries
require '../vendor/autoload.php';

// Import PHPMailer classes for sending emails
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['schedule_btn'])) {
    // Retrieve and sanitize form data
    $donor_id = intval($_POST['donor_id']);
    $scheduled_date = $_POST['scheduled_date'];
    $time_slot_category = htmlspecialchars($_POST['time_slot_category']);
    $time_slot = $_POST['time_slot'];
    $location = htmlspecialchars($_POST['location']);

    // Insert schedule details into the donation_schedule table
    $query = "INSERT INTO donation_schedule (donor_id, scheduled_date, time_slot_category, time_slot,  location) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("issss", $donor_id, $scheduled_date, $time_slot_category, $time_slot,  $location);


    if ($stmt->execute()) {
        // Update donation status in donor_history table
        $update_query = "UPDATE donor_history SET donation_status = 1 WHERE id = ?";
        $update_stmt = $con->prepare($update_query);
        $update_stmt->bind_param("i", $donor_id);

        if ($update_stmt->execute()) {
            // Fetch the donor's email and name
            $donor_query = "SELECT donor_name, email FROM donor_history WHERE id = ?";
            $donor_stmt = $con->prepare($donor_query);
            $donor_stmt->bind_param("i", $donor_id);
            $donor_stmt->execute();
            $donor_result = $donor_stmt->get_result();

            if ($donor_result->num_rows > 0) {
                $donor = $donor_result->fetch_assoc();
                $donor_name = $donor['donor_name'];
                $donor_email = $donor['email'];

                // Send confirmation email
                $mail = new PHPMailer(true);

                try {
                    // Server settings
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->SMTPAuth   = true;                                 // Enable SMTP authentication
                    $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server
                    $mail->Username   = 'aathief01@gmail.com';               // SMTP username
                    $mail->Password   = 'fhkbwdzlzqipbhea';                  // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;      // Enable SSL encryption
                    $mail->Port       = 587;                                  // TCP port to connect to

                    // Recipients
                    $mail->setFrom('aathief01@gmail.com', 'BloodHub Donation Center');
                    $mail->addAddress($donor_email, $donor_name);             // Add the donor's email

                    // Content
                    $mail->isHTML(true);                                      // Set email format to HTML
                    $mail->Subject = 'Donation Schedule Confirmation';
                    $mail->Body    = "
                    <h3>Dear $donor_name,</h3>
                    <p>We are pleased to confirm your blood donation appointment.</p>
                    
                    <p><strong>Appointment Details:</strong></p>
                    <ul>
                        <li><strong>Date:</strong> $scheduled_date</li>
                        <li><strong>Time Slot:</strong> $time_slot</li>
                        <li><strong>Time Slot Category:</strong> $time_slot_category</li>
                        <li><strong>Location:</strong> $location</li>
                    </ul>
                    
                    <p>You can view the location on Google Maps by clicking the link below:</p>
                    <p><a href='https://www.google.com/maps/search/?api=1&query=$map_location' target='_blank'>View Location on Google Maps</a></p>
                    
                    <p>Your generous contribution is vital in saving lives, and we greatly appreciate your commitment to helping those in need.</p>
                    
                    <p>If you have any questions or need to reschedule your appointment, please do not hesitate to contact us.</p>
                    
                    <p>Thank you once again for your willingness to donate blood. We look forward to seeing you!</p>
                    
                    <p>Best regards,<br>
                    <strong>Blood Donation Center</strong><br>
                    Phone: (012) 345-6789<br>
                    Email: contact@blooddonationcenter.com<br>
                    Website: www.blooddonationcenter.com
                    </p> ";

                    // Send the email
                    $mail->send();
                    $_SESSION['message'] = "Donation scheduled, status updated, and email sent to donor.";
                } catch (Exception $e) {
                    // Handle email sending failure
                    $_SESSION['message'] = "Donation scheduled, status updated, but email failed to send: {$mail->ErrorInfo}";
                }
            } else {
                $_SESSION['message'] = "Donation scheduled and status updated, but donor information could not be retrieved for email.";
            }

            header('Location: donor_history.php');
            exit;
        } else {
            // Error handling for updating donation status
            $_SESSION['message'] = "Failed to update donation status: " . $update_stmt->error;
            header('Location: schedule.php?id=' . $donor_id);
            exit;
        }
    } else {
        // Error handling for scheduling donation
        $_SESSION['message'] = "Failed to schedule donation: " . $stmt->error;
        header('Location: schedule.php?id=' . $donor_id);
        exit;
    }
} else {
    // Invalid access handling
    $_SESSION['message'] = "Invalid access.";
    header('Location: donor_history.php');
    exit;
}
