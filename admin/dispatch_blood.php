<?php
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');

// Check if 'request_id' is present in the POST data (from blood_requests page)
if (isset($_POST['dispatch_btn'])) {
    $request_id = $_POST['request_id'];

    // Fetch request details from the database
    $query = "SELECT * FROM blood_requests WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $request_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $request = $result->fetch_assoc();
    } else {
        echo '<div class="alert alert-danger">Request not found.</div>';
        exit();
    }
} else {
    echo '<div class="alert alert-warning">No request ID provided.</div>';
    exit();
}
?>

<div class="container-fluid px-4">
    <h3 class="mt-4">Dispatch Blood</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item active">Dispatch Blood</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <?php include('../message.php'); ?>

            <div class="card">
                <div class="card-header">
                    <h4>Dispatch Blood to <?= htmlspecialchars($request['hospital_name']); ?></h4>
                </div>
                <div class="card-body">
                    <form action="process_dispatch.php" method="POST">
                        <input type="hidden" name="request_id" value="<?= htmlspecialchars($request['id']); ?>">

                        <!-- Automatically filled details from the blood request -->
                        <div class="form-group mb-3">
                            <label for="hospital_name">Hospital Name:</label>
                            <input type="text" id="hospital_name" name="hospital_name" class="form-control"
                                value="<?= htmlspecialchars($request['hospital_name']); ?>" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="hospital_address">Hospital Address:</label>
                            <input type="text" id="hospital_address" name="hospital_address" class="form-control"
                                value="<?= htmlspecialchars($request['hospital_address']); ?>" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="contact_number">Contact Number:</label>
                            <input type="text" id="contact_number" name="contact_number" class="form-control"
                                value="<?= htmlspecialchars($request['contact_number']); ?>" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="blood_group">Blood Group:</label>
                            <input type="text" id="blood_group" name="blood_group" class="form-control"
                                value="<?= htmlspecialchars($request['blood_group']); ?>" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="quantity">Quantity (Units):</label>
                            <input type="number" id="quantity" name="quantity" class="form-control"
                                value="<?= htmlspecialchars($request['quantity']); ?>" readonly>
                        </div>

                        <!-- Automatically set today's date as dispatch date -->
                        <div class="form-group mb-3">
                            <label for="dispatch_date">Dispatch Date:</label>
                            <input type="date" id="dispatch_date" name="dispatch_date" class="form-control"
                                value="<?= date('Y-m-d'); ?>" readonly>
                        </div>

                        <!-- Driver details to be selected -->
                        <div class="form-group mb-3">
                            <label for="driver">Assign Driver:</label>
                            <select id="driver" name="driver" class="form-control" required>
                                <option value="" disabled selected>Select a Driver</option>
                                <?php
                                // Fetch available drivers from the database (example driver table)
                                $driver_query = "SELECT * FROM driver_details WHERE status = 1";
                                $driver_query_run = mysqli_query($con, $driver_query);

                                if (mysqli_num_rows($driver_query_run) > 0) {
                                    foreach ($driver_query_run as $driver) {
                                        echo '<option value="' . $driver['driver_id'] . '">' . $driver['driver_name'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No available drivers</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Dispatch button -->
                        <button type="submit" name="dispatch_blood_btn" class="btn btn-primary mt-2">Dispatch Blood</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>