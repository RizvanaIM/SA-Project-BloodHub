<?php
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');

// Get blood_type from GET parameters or set it to null for all types
$blood_type = isset($_GET['blood_type']) ? $_GET['blood_type'] : null; // Use null for all types
?>

<div class="container-fluid px-4">
    <h3 class="mt-4">Blood Inventory</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item active">Blood Inventory</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <!-- Show session messages -->
            <?php include('../message.php'); ?>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>All Blood Inventory Details <?= $blood_type ? "($blood_type)" : "" ?></h4>
                    <div class="d-flex">
                        <a href="blood_donation_report.php" class="btn btn-primary btn-sm me-2">Generate Report</a>
                        <a href="add_blood.php" class="btn btn-primary btn-sm">Add Blood</a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Search Filters -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <input type="text" id="searchDonorName" class="form-control me-2" placeholder="Search by Donor Name" onkeyup="filterTable()">
                        </div>
                        <div class="col-md-2">
                            <select id="searchBloodType" class="form-control" onchange="filterTable()">
                                <option value="">Select Blood Type</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                    </div>

                    <table class="table table-bordered table-striped" id="bloodInventoryTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Donor Name</th>
                                <th>Blood Type</th>
                                <th>Received Units</th>
                                <th>Dispatched Units</th>
                                <th>Collection Date</th>
                                <th>Expiry Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch blood inventory records from the database
                            // If $blood_type is null, fetch all records
                            $query = $blood_type ? "SELECT * FROM blood_inventory WHERE blood_type = '$blood_type'" : "SELECT * FROM blood_inventory";
                            $query_run = mysqli_query($con, $query);

                            if ($query_run) {
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                            ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['id']); ?></td>
                                            <td><?= htmlspecialchars($row['donor_name']); ?></td>
                                            <td><?= htmlspecialchars($row['blood_type']); ?></td>
                                            <td><?= htmlspecialchars($row['blood_quantity']); ?></td>
                                            <td><?= htmlspecialchars($row['dispatch_units']); ?></td>
                                            <td><?= htmlspecialchars($row['collection_date']); ?></td>
                                            <td><?= htmlspecialchars($row['expiry_date']); ?></td>

                                            <!-- Calculate and show blood status based on expiry date -->
                                            <td>
                                                <?php
                                                $expiry_date = new DateTime($row['expiry_date']);
                                                $current_date = new DateTime();

                                                if ($expiry_date < $current_date) {
                                                    echo '<span class="badge bg-danger">Expired</span>';
                                                } else {
                                                    echo '<span class="badge bg-success">Valid</span>';
                                                }
                                                ?>
                                            </td>

                                            <td class="text-center"><a href="#" class="btn btn-success" title="Edit"><i class="fas fa-edit"></i></a>
                                                <form action="code.php" method="POST">
                                                    <button type="submit" name="user_delete" value="" class="btn btn-danger" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                            <?php
                                    }
                                } else {
                                    // If no records found
                                    echo '<tr><td colspan="8">No Record Found for ' . ($blood_type ? $blood_type : 'all blood types') . '!</td></tr>';
                                }
                            } else {
                                // Handle query execution failure
                                echo '<tr><td colspan="8">Error fetching records: ' . htmlspecialchars(mysqli_error($con)) . '</td></tr>';
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
    // JavaScript function for automatic search filter
    function filterTable() {
        const searchDonorName = document.getElementById('searchDonorName').value.toLowerCase();
        const searchBloodType = document.getElementById('searchBloodType').value.toLowerCase();
        const table = document.getElementById('bloodInventoryTable');
        const rows = table.getElementsByTagName('tr');

        // Loop through all table rows (skip the header row)
        for (let i = 1; i < rows.length; i++) {
            let row = rows[i];
            const donorName = row.cells[1].textContent.toLowerCase();
            const bloodType = row.cells[2].textContent.toLowerCase();

            // Show the row if it matches the search criteria
            if ((donorName.includes(searchDonorName) || searchDonorName === '') &&
                (bloodType.includes(searchBloodType) || searchBloodType === '')) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    }
</script>

<?php
include('includes/footer.php');
?>