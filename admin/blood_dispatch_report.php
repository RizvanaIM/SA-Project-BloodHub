<?php
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid px-4">
    <h3 class="mt-4">Dispatched Blood</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item active">Blood Sent to Hospitals</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <!-- Show session messages -->
            <?php include('../message.php'); ?>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Blood Units Sent to Hospitals</h4>
                    <a href="../driver_register.php" class="btn btn-primary btn-sm">Generate Report</a>
                </div>
                <div class="card-body">
                    <!-- Search Filters -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <input type="text" id="hospitalNameFilter" class="form-control" placeholder="Search by Hospital Name" onkeyup="filterTable()">
                        </div>
                        <div class="col-md-2">
                            <select id="bloodTypeFilter" class="form-select" onchange="filterTable()">
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

                    <table class="table table-bordered table-striped" id="bloodDispatchTable">
                        <thead>
                            <tr>
                                <th>Hospital ID</th>
                                <th>Hospital Name</th>
                                <th>Hospital Address</th>
                                <th>Blood Type</th>
                                <th>Dispatch (Units)</th>
                                <th>Date of Dispatch</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch blood dispatch details from the database  
                            $query = "SELECT id, hospital_name, hospital_address, blood_group, dispatch_units, DATE_FORMAT(dispatch_date, '%Y-%m-%d') as dispatch_date FROM blood_dispatches";
                            $query_run = mysqli_query($con, $query);

                            if ($query_run) {
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                            ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['id']); ?></td>
                                            <td><?= htmlspecialchars($row['hospital_name']); ?></td>
                                            <td><?= htmlspecialchars($row['hospital_address']); ?></td>
                                            <td><?= htmlspecialchars($row['blood_group']); ?></td>
                                            <td><?= htmlspecialchars($row['dispatch_units']); ?></td>
                                            <td><?= htmlspecialchars($row['dispatch_date']); ?></td>
                                        </tr>
                            <?php
                                    }
                                } else {
                                    // If no records found  
                                    echo '<tr><td colspan="6">No Record Found!</td></tr>';
                                }
                            } else {
                                // Handle query execution failure  
                                echo '<tr><td colspan="6">Error fetching records: ' . htmlspecialchars(mysqli_error($con)) . '</td></tr>';
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
        var hospitalFilter = document.getElementById('hospitalNameFilter').value.toLowerCase();
        var bloodTypeFilter = document.getElementById('bloodTypeFilter').value.toUpperCase();
        var table = document.getElementById('bloodDispatchTable');
        var rows = table.getElementsByTagName('tr');

        // Loop through all table rows  
        for (var i = 1; rows.length; i++) {
            var tdHospitalName = rows[i].getElementsByTagName('td')[1];
            var tdBloodType = rows[i].getElementsByTagName('td')[3];

            // If any of the cells match the search filter, show the row  
            if (tdHospitalName && tdBloodType) {
                var hospitalNameText = tdHospitalName.textContent || tdHospitalName.innerText;
                var bloodTypeText = tdBloodType.textContent || tdBloodType.innerText;

                // Display the row if it matches the filters  
                rows[i].style.display =
                    (hospitalNameText.includes(hospitalFilter) || !hospitalFilter) &&
                    (bloodTypeText === bloodTypeFilter || !bloodTypeFilter) ?
                    '' : 'none';
            }
        }
    }
</script>

<?php
include('includes/footer.php');
?>