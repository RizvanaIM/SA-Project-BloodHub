<?php
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');

// Get the filter values from the form if set
$donor_name = isset($_POST['donor_name']) ? $_POST['donor_name'] : '';
$blood_group = isset($_POST['blood_group']) ? $_POST['blood_group'] : '';
$date_from = isset($_POST['date_from']) ? $_POST['date_from'] : '';
$date_to = isset($_POST['date_to']) ? $_POST['date_to'] : '';

// Build the SQL query based on filters
$query = "SELECT * FROM donor_history WHERE 1=1";

// Filter by donor name
if ($donor_name) {
    $query .= " AND donor_name LIKE '%$donor_name%'";
}

// Filter by blood type
if ($blood_group) {
    $query .= " AND blood_group = '$blood_group'";
}

// Filter by date range (Last 3 months)
if ($date_from && $date_to) {
    $query .= " AND last_donation_date BETWEEN '$date_from' AND '$date_to'";
} elseif ($date_from) {
    $query .= " AND last_donation_date >= '$date_from'";
} elseif ($date_to) {
    $query .= " AND last_donation_date <= '$date_to'";
}

$query_run = mysqli_query($con, $query);
?>

<style>
    /* Container for the form */
    .form-container {
        background-color: #f8f9fa;
        /* Light gray background */
        border-radius: 8px;
        /* Rounded corners */
        padding: 20px;
        /* Padding around the form */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        /* Subtle shadow */
        margin-bottom: 20px;
        /* Space below the form */
    }

    /* Form header */
    .form-header {
        margin-bottom: 20px;
        /* Space below the header */
    }

    /* Styling for input fields and select elements */
    .form-control {
        border: 1px solid #ced4da;
        /* Light border */
        border-radius: 5px;
        /* Rounded corners */
        padding: 8px;
        /* Reduced padding for smaller size */
        font-size: 14px;
        /* Reduced font size */
        transition: border-color 0.3s;
        /* Smooth transition for border color */
    }

    /* Focus state for input fields */
    .form-control:focus {
        border-color: #007bff;
        /* Change border color on focus */
        outline: none;
        /* Remove default outline */
    }

    /* Styling for labels */
    label {
        font-size: 14px;
        /* Reduced font size for labels */
        margin-right: 10px;
        /* Space between label and input */
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .form-control {
            font-size: 12px;
            /* Further reduce font size on smaller screens */
        }
    }
</style>

<div class="container-fluid px-4">
    <h3 class="mt-4">Donor History</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item active">Donor History</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <!-- Show session messages -->
            <?php include('../message.php'); ?>

            <!-- Filter Form -->
            <form method="POST" class="card-header d-flex align-items-center">

                <input type="text" name="donor_name" class="form-control me-2" style="max-width: 200px;" placeholder="Donor Name" value="<?= htmlspecialchars($donor_name); ?>">

                <select name="blood_group" class="form-control me-2" style="max-width: 200px;">
                    <option value="">Select Blood Group</option>
                    <option value="A+" <?= ($blood_group == 'A+') ? 'selected' : ''; ?>>A+</option>
                    <option value="B+" <?= ($blood_group == 'B+') ? 'selected' : ''; ?>>B+</option>
                    <option value="O+" <?= ($blood_group == 'O+') ? 'selected' : ''; ?>>O+</option>
                    <option value="AB+" <?= ($blood_group == 'AB+') ? 'selected' : ''; ?>>AB+</option>
                    <option value="A-" <?= ($blood_group == 'A-') ? 'selected' : ''; ?>>A-</option>
                    <option value="B-" <?= ($blood_group == 'B-') ? 'selected' : ''; ?>>B-</option>
                    <option value="O-" <?= ($blood_group == 'O-') ? 'selected' : ''; ?>>O-</option>
                    <option value="AB-" <?= ($blood_group == 'AB-') ? 'selected' : ''; ?>>AB-</option>

                    <input type="text" name="date_from" class="form-control datepicker me-2" style="max-width: 200px;" placeholder="From Date" value="<?= htmlspecialchars($date_from); ?>">
                    <input type="text" name="date_to" class="form-control datepicker me-2" style="max-width: 200px;" placeholder="To Date" value="<?= htmlspecialchars($date_to); ?>">

                    <button type="submit" class="btn btn-primary me-2">Search</button> <!-- Search Button -->
            </form>

            <script>
                // Initialize Flatpickr on the input fields
                flatpickr(".datepicker", {
                    dateFormat: "Y-m-d", // Set the date format
                    allowInput: true, // Allow manual input
                    onReady: function(selectedDates, dateStr, instance) {
                        instance.input.setAttribute('placeholder', 'Select Date'); // Set placeholder
                    }
                });
            </script>

            <div class="card mt-3">
                <div class="card-header">
                    <h4>All Donor Details</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Donor Name</th>
                                <th>Date of Birth</th>
                                <th>Gender</th>
                                <th>Blood Group</th>
                                <th>Contact Information</th>
                                <th>Last Donation Date</th>
                                <th>Donation Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($query_run) {
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                            ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['id']); ?></td>
                                            <td><?= htmlspecialchars($row['donor_name']); ?></td>
                                            <?php
                                            $dob = new DateTime($row['dob']);
                                            $today = new DateTime();
                                            $age = $today->diff($dob)->y; // Calculate age in years
                                            ?>
                                            <td><?= htmlspecialchars($row['dob']); ?> (<?= $age; ?> years)</td>
                                            <td><?= ucfirst(htmlspecialchars($row['gender'])); ?></td>
                                            <td><?= htmlspecialchars($row['blood_group']); ?></td>
                                            <td><?= htmlspecialchars($row['contact_number']); ?><br><?= htmlspecialchars($row['email']); ?>
                                            </td>
                                            <td><?= htmlspecialchars($row['last_donation_date']); ?></td>

                                            <!-- Show human-readable donation status -->
                                            <td class="text-center">
                                                <?php
                                                if ($row['donation_status'] == 0) {
                                                    echo '<span class="badge bg-warning">Pending</span>';
                                                } elseif ($row['donation_status'] == 1) {
                                                    echo '<span class="badge bg-secondary">Scheduled</span>';
                                                } elseif ($row['donation_status'] == 2) {
                                                    echo '<span class="badge bg-success">Donated</span>';
                                                } elseif ($row['donation_status'] == 3) {
                                                    echo '<span class="badge bg-danger">Canceled</span>';
                                                }
                                                ?>
                                            </td>

                                            <td>
                                                <div class="action-buttons">
                                                    <?php if ($row['donation_status'] == 0): ?>
                                                        <a href="schedule.php?id=<?= htmlspecialchars($row['id']); ?>" class="btn btn-primary btn-sm" title="Schedule Donation">
                                                            <i class="fas fa-calendar-alt"></i>
                                                        </a>
                                                    <?php elseif ($row['donation_status'] == 1): ?>
                                                        <a href="add_blood.php?id=<?= htmlspecialchars($row['id']); ?>" class="btn btn-success btn-sm" title="Add Blood">
                                                            <i class="fas fa-plus"></i>
                                                        </a>
                                                    <?php elseif ($row['donation_status'] == 2): ?>
                                                        <a href="schedule.php?id=<?= htmlspecialchars($row['id']); ?>" class="btn btn-warning btn-sm" title="Reschedule Donation">
                                                            <i class="fas fa-calendar-alt"></i>
                                                        </a>
                                                    <?php elseif ($row['donation_status'] == 3): ?>
                                                        <a href="schedule.php?id=<?= htmlspecialchars($row['id']); ?>" class="btn btn-info btn-sm" title="View Donation Status">
                                                            <i class="fas fa-calendar-alt"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </td>

                                        </tr>
                            <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="10">No Record Found!</td></tr>';
                                }
                            } else {
                                echo '<tr><td colspan="10">Error fetching records: ' . htmlspecialchars(mysqli_error($con)) . '</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>