<?php
ob_start();
include('authentication.php'); // Authentication check
include('includes/header.php');
include('includes/navbar.php');

// Check if the ID is provided via GET request
if (isset($_GET['id'])) {
    $donor_id = $_GET['id'];

    // Fetch donor information from the database
    $query = "SELECT * FROM donor_history WHERE id = '$donor_id'";
    $query_run = mysqli_query($con, $query);

    // Check if donor record is found
    if (mysqli_num_rows($query_run) > 0) {
        $donor = mysqli_fetch_array($query_run);

        // Ensure the donor's donation status is scheduled (1)
        if ($donor['donation_status'] != '1') {
            $_SESSION['message'] = "This donor has not been scheduled for donation!";
            header("Location: donor_history.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "No Donor Found with the given ID!";
        header("Location: donor_history.php");
        exit(0);
    }
} else {
    $_SESSION['message'] = "No Donor ID Provided!";
    header("Location: donor_history.php");
    exit(0);
}

// Handle form submission for adding blood details
if (isset($_POST['add_blood'])) {
    $blood_quantity = $_POST['blood_quantity'];
    $blood_type = $_POST['blood_type'];
    $collection_date = $_POST['collection_date'];
    $expiry_date = $_POST['expiry_date'];
    $donor_name = $donor['donor_name']; // Fetch donor name

    // Insert blood details into the blood_inventory table
    $insert_query = "INSERT INTO blood_inventory 
                     (blood_type, blood_quantity, collection_date, expiry_date, donor_id, donor_name) 
                     VALUES ('$blood_type', '$blood_quantity', '$collection_date', '$expiry_date', '$donor_id', '$donor_name')";

    $insert_query_run = mysqli_query($con, $insert_query);

    if ($insert_query_run) {
        // Update donor history after successful blood entry
        $update_query = "UPDATE donor_history 
                         SET donation_status = '2', 
                             last_donation_date = '$collection_date' 
                         WHERE id = '$donor_id'";

        mysqli_query($con, $update_query);

        $_SESSION['message'] = "Blood details added successfully!";
        header("Location: donor_history.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Failed to add blood details!";
    }
}


// Retrieve the scheduled date from the donation_schedule table
$query = "SELECT scheduled_date FROM donation_schedule WHERE donor_id = '$donor_id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$scheduled_date = $row['scheduled_date'];
?>


<div class="container-fluid px-4">
    <h4 class="mt-4">Add Blood Details for <?= htmlspecialchars($donor['donor_name']); ?></h4>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item active">Donor History</li>
        <li class="breadcrumb-item active">Add Blood</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <!-- Show session messages -->
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-info">
                    <?= htmlspecialchars($_SESSION['message']); ?>
                </div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>

            <!-- Add Blood Form -->
            <div class="card">
                <div class="card-header">
                    <h4>Add Blood Details</h4>
                </div>
                <div class="card-body">
                    <form action="add_blood.php?id=<?= htmlspecialchars($donor['id']); ?>" method="POST">
                        <div class="form-group mb-3">
                            <label for="blood_quantity">Blood Quantity (in Unit)</label>
                            <input type="number" name="blood_quantity" class="form-control" required placeholder="Enter Blood Quantity">
                        </div>

                        <div class="form-group mb-3">
                            <label for="blood_type">Blood Type</label>
                            <input type="text" name="blood_type" class="form-control" value="<?= htmlspecialchars($donor['blood_group']); ?>" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="collection_date">Collection Date</label>
                            <input type="date" name="collection_date" class="form-control" value="<?= htmlspecialchars($scheduled_date); ?>" readonly> <!-- Auto-generate scheduled date -->
                        </div>

                        <div class="form-group mb-3">
                            <label for="expiry_date">Blood Expiry Date</label>
                            <?php
                            $blood_type = $donor['blood_group'];
                            $expiry_date = '';
                            if (
                                $blood_type == 'A+' || $blood_type == 'A-' || $blood_type == 'B+' ||
                                $blood_type == 'B-' || $blood_type == 'AB+' || $blood_type == 'AB-' ||
                                $blood_type == 'O+' || $blood_type == 'O-'
                            ) {
                                $expiry_date = date('Y-m-d', strtotime('+42 days')); // Whole blood lasts up to 42 days
                            } elseif ($blood_type == 'Plasma') {
                                $expiry_date = date('Y-m-d', strtotime('+1 year')); // Plasma can be stored for up to 1 year
                            }
                            ?>
                            <input type="date" name="expiry_date" class="form-control" value="<?= $expiry_date; ?>" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" name="add_blood" class="btn btn-success">Add Blood</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
