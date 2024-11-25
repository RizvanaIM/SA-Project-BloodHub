<?php
ob_start();
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');

if (isset($_GET['id'])) {
    $donor_id = $_GET['id'];

    // Retrieve donor details from the database
    $query = "SELECT * FROM donor_history WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $donor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $donor = $result->fetch_assoc();

        // Check if last donation date is empty
        if (empty($donor['last_donation_date'])) {
            // Allow scheduling since the donor has never donated before
            // Optionally, you can set a message indicating that this is the first donation
            $_SESSION['message'] = "Donor is eligible to schedule a donation as this is their first donation.";
        } else {
            // Calculate the next eligible date
            $lastDonationDate = new DateTime($donor['last_donation_date']);
            $nextEligibleDate = $lastDonationDate->modify('+56 days');

            // Check if the donor is eligible to donate blood
            if (new DateTime() < $nextEligibleDate) {
                $_SESSION['message'] = "Donor is not eligible to donate blood yet. Next eligible date: " . $nextEligibleDate->format('Y-m-d') . ".";
                header("Location: donor_history.php");
                exit(0);
            }
        }
    } else {
        $_SESSION['message'] = "Donor not found.";
        header("Location: donor_history.php");
        exit(0);
    }
} else {
    $_SESSION['message'] = "No donor ID provided.";
    header("Location: donor_history.php");
    exit(0);
}
?>


<div class="container-fluid px-4">
    <h3 class="mt-4">Schedule Donation</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item active">Schedule Donation</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <!-- Show session messages -->
            <?php include('../message.php'); ?>

            <div class="card">
                <div class="card-header">
                    <h4>Schedule Donation for <?= htmlspecialchars($donor['donor_name']); ?></h4>
                </div>
                <div class="card-body">
                    <form action="process_schedule.php" method="POST">
                        <input type="hidden" name="donor_id" value="<?= htmlspecialchars($donor['id']); ?>">

                        <div class="form-group mb-3">
                            <label for="scheduled_date">Scheduled Date:</label>
                            <input type="date" id="scheduled_date" name="scheduled_date" class="form-control" required
                                min="<?= date('Y-m-d'); ?>"> <!-- Prevent past date -->
                        </div>

                        <div class="form-group mb-3">
                            <label for="time_slot_category">Select Time Slot Category:</label>
                            <select id="time_slot_category" class="form-control" onchange="showTimeSlots()">
                                <option value="" disabled selected>Select a category</option>
                                <option value="morning">Morning</option>
                                <option value="afternoon">Afternoon</option>
                                <option value="evening">Evening</option>
                            </select>
                        </div>

                        <div class="form-group mb-3" id="time_slot_container" style="display: none;">
                            <label for="time_slot">Time Slot:</label>
                            <select id="time_slot" name="time_slot" class="form-control" required>
                                <option value="" disabled selected>Select a time slot</option>
                                <!-- Time slots will be populated here -->
                            </select>
                        </div>

                        <script>
                            function showTimeSlots() {
                                const category = document.getElementById('time_slot_category').value;
                                const timeSlotContainer = document.getElementById('time_slot_container');
                                const timeSlotSelect = document.getElementById('time_slot');

                                // Clear previous options
                                timeSlotSelect.innerHTML = '<option value="" disabled selected>Select a time slot</option>';

                                let timeSlots = [];

                                if (category === 'morning') {
                                    timeSlots = [
                                        "08:00 AM - 09:00 AM",
                                        "09:00 AM - 10:00 AM",
                                        "10:00 AM - 11:00 AM",
                                        "11:00 AM - 12:00 PM"
                                    ];
                                } else if (category === 'afternoon') {
                                    timeSlots = [
                                        "12:00 PM - 01:00 PM",
                                        "01:00 PM - 02:00 PM",
                                        "02:00 PM - 03:00 PM",
                                        "03:00 PM - 04:00 PM"
                                    ];
                                } else if (category === 'evening') {
                                    timeSlots = [
                                        "04:00 PM - 05:00 PM",
                                        "05:00 PM - 06:00 PM",
                                        "06:00 PM - 07:00 PM",
                                        "07:00 PM - 08:00 PM"
                                    ];
                                }

                                // Populate time slots
                                timeSlots.forEach(slot => {
                                    const option = document.createElement('option');
                                    option.value = slot;
                                    option.textContent = slot;
                                    timeSlotSelect.appendChild(option);
                                });

                                // Show the time slot container
                                timeSlotContainer.style.display = 'block';
                            }
                        </script>

                        <div class="form-group mb-3">
                            <label for="location">Location:</label>
                            <select id="location" name="location" class="form-control" required>
                                <option value="" disabled selected>Select a Location</option>
                                <option value="Kandy Central Blood Donation Center">Kandy Central Blood Donation Center - 34 Dalada Vidiya, Kandy, Sri Lanka</option>
                                <option value="Peradeniya Blood Donation Hub">Peradeniya Blood Donation Hub - 56 Peradeniya Road, Peradeniya, Kandy, Sri Lanka</option>
                                <option value="Gampola Blood Donation Center">Gampola Blood Donation Center - 12 Main Street, Gampola, Kandy, Sri Lanka</option>
                                <option value="Mahiyangana Blood Donation Center">Mahiyangana Blood Donation Center - 78 Mahiyangana Road, Mahiyangana, Kandy, Sri Lanka</option>
                                <option value="Teldeniya Community Blood Bank">Teldeniya Community Blood Bank - 23 Teldeniya Town, Kandy, Sri Lanka</option>
                            </select>
                        </div>

                        <button type="submit" name="schedule_btn" class="btn btn-primary mt-2">Schedule Donation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>