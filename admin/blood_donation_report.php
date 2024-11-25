<?php
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid px-4">
    <h3 class="mt-4">Blood Received from Donors</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item active">Blood Received from Donors</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <!-- Show session messages -->
            <?php include('../message.php'); ?>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>All Blood Received Details</h4>
                    <div class="d-flex">
                        <a href="../driver_register.php" class="btn btn-primary btn-sm float-end">Generate Report</a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Search Filters -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <input type="text" id="donorSearch" class="form-control me-2" placeholder="Search by Donor Name" onkeyup="filterTable()">
                        </div>
                        <div class="col-md-2">
                            <select id="bloodTypeSearch" class="form-control" onchange="filterTable()">
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
                                <th>Donor ID</th>
                                <th>Donor Name</th>
                                <th>Blood Type</th>
                                <th>Received Units</th>
                                <th>Collection Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch blood received details from the database
                            $query = "SELECT * FROM blood_inventory";
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
                                            <td><?= htmlspecialchars($row['collection_date']); ?></td>
                                        </tr>
                            <?php
                                    }
                                } else {
                                    // If no records found
                                    echo '<tr><td colspan="5">No Record Found!</td></tr>';
                                }
                            } else {
                                // Handle query execution failure
                                echo '<tr><td colspan="5">Error fetching records: ' . htmlspecialchars(mysqli_error($con)) . '</td></tr>';
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
    function filterTable() {
        var donorInput = document.getElementById('donorSearch').value.toUpperCase();
        var bloodTypeInput = document.getElementById('bloodTypeSearch').value.toUpperCase();
        var table = document.getElementById('bloodInventoryTable');
        var rows = table.getElementsByTagName('tr');

        // Loop through all table rows
        for (var i = 1; i < rows.length; i++) {
            var tdDonor = rows[i].getElementsByTagName('td')[1];
            var tdBloodType = rows[i].getElementsByTagName('td')[2];

            // If any of the cells match the search filter, show the row
            if (tdDonor && tdBloodType) {
                var donorText = tdDonor.textContent || tdDonor.innerText;
                var bloodTypeText = tdBloodType.textContent || tdBloodType.innerText;

                // Check if the donor name and blood type match the input
                if (donorText.toUpperCase().indexOf(donorInput) > -1 &&
                    (bloodTypeInput === "" || bloodTypeText.toUpperCase().indexOf(bloodTypeInput) > -1)) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
    }
</script>

<?php
include('includes/footer.php');
?>