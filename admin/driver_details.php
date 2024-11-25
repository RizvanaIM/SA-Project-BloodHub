<?php
include('authentication.php');
include('middleware/admin_auth.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h3 class="mt-4">Drivers</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item active">Drivers</li>
    </ol>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h4>Registered Drivers
                        <a href="../driver_register.php" class="btn btn-primary float-end">Add Driver</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- Driver Name Filter -->
                        <div class="col-md-2">
                            <input type="text" id="driverNameFilter" class="form-control" style="max-width: 300px;" placeholder="Search by Driver Name">
                        </div>

                        <!-- Status Filter -->
                        <div class="col-md-2">
                            <select id="statusFilter" class="form-control" style="max-width: 300px;">
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <table class="table table-bordered" id="driverTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Driver Name</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <th>License Number</th>
                                <th>Emergency Contact Number</th>
                                <th>Work Days</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch drivers from database
                            $query = "SELECT * FROM driver_details";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $row) {
                                    // Check if the driver is inactive and if 30 minutes have passed since the last status change
                                    if ($row['status'] == 0 && strtotime($row['status_change_timestamp']) < strtotime('-30 minutes')) {
                                        // Revert the status to active if more than 30 minutes have passed
                                        $update_query = "UPDATE driver_details SET status = 1 WHERE driver_id = ?";
                                        $stmt = mysqli_prepare($con, $update_query);
                                        mysqli_stmt_bind_param($stmt, "i", $row['driver_id']);
                                        mysqli_stmt_execute($stmt);
                                    }
                            ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['driver_id']); ?></td>
                                        <td><?= htmlspecialchars($row['driver_name']); ?></td>
                                        <td><?= htmlspecialchars($row['contact_number']); ?></td>
                                        <td><?= htmlspecialchars($row['email']); ?></td>
                                        <td><?= htmlspecialchars($row['license_number']); ?></td>
                                        <td><?= htmlspecialchars($row['emergency_contact_number']); ?></td>
                                        <td style="word-wrap: break-word; white-space: normal; max-width: 200px;">
                                            <?= htmlspecialchars($row['work_days']); ?>
                                        </td>
                                        <td>
                                            <?php if ($row['status'] == 1): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="edit_driver.php?driver_id=<?= htmlspecialchars($row['driver_id']); ?>" class="btn btn-success btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                            <a href="delete_driver.php?driver_id=<?= htmlspecialchars($row['driver_id']); ?>" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="9" class="text-center">No Record Found!</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript for Filtering the Table
    document.addEventListener('input', function() {
        const driverNameFilter = document.getElementById('driverNameFilter').value.toLowerCase();
        const statusFilter = document.getElementById('statusFilter').value;

        const rows = document.querySelectorAll('#driverTable tbody tr');

        rows.forEach(row => {
            const driverName = row.children[1].textContent.toLowerCase();
            const status = row.children[7].textContent.toLowerCase();

            row.style.display =
                (driverName.includes(driverNameFilter) || !driverNameFilter) &&
                (status.includes(statusFilter) || !statusFilter) ?
                '' :
                'none';
        });
    });
</script>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>