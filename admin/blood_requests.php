<?php
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid px-4">
    <h3 class="mt-4">Blood Requests</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item active">Blood Requests</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <?php include('../message.php'); ?>
            <div class="card">
                <div class="card-header">
                    <h4>All Blood Requests
                        <a href="../request-blood.php" class="btn btn-primary float-end">Request</a>
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Search Filter -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <input type="text" id="hospitalNameFilter" class="form-control" placeholder="Search by Hospital Name">
                        </div>
                        <div class="col-md-2">
                            <select id="bloodTypeFilter" class="form-select">
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
                        <div class="col-md-2">
                            <select id="urgencyLevelFilter" class="form-select">
                                <option value="">Select Urgency Level</option>
                                <option value="routine">Routine</option>
                                <option value="urgent">Urgent</option>
                                <option value="emergency">Emergency</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select id="statusFilter" class="form-select">
                                <option value="">Select Status</option>
                                <option value="pending">Pending</option>
                                <option value="accepted">Accepted</option>
                                <option value="dispatched">Dispatched</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                    </div>

                    <table class="table table-bordered" id="bloodRequestTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Hospital Name</th>
                                <th>Hospital Address</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <th>Blood Group</th>
                                <th>Quantity (Units)</th>
                                <th>Urgency Level</th>
                                <th>Date Needed</th>
                                <th>Additional Information</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM blood_requests";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $row) {
                            ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= $row['hospital_name']; ?></td>
                                        <td><?= $row['hospital_address']; ?></td>
                                        <td><?= $row['contact_number']; ?></td>
                                        <td><?= $row['email']; ?></td>
                                        <td><?= $row['blood_group']; ?></td>
                                        <td><?= $row['quantity']; ?> Units</td>
                                        <td><?= $row['urgency_level']; ?></td>
                                        <td><?= $row['date_needed']; ?></td>
                                        <td><?= $row['additional_info']; ?></td>
                                        <td>
                                            <span class="badge 
    <?= $row['status'] == 'pending' ? 'bg-warning text-dark' : ($row['status'] == 'accepted' ? 'bg-success text-white' : ($row['status'] == 'dispatched' ? 'bg-secondary text-white' : 'bg-danger text-white')) ?>">
                                                <?= ucfirst($row['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($row['status'] == 'pending'): ?>
                                                <form action="process_request.php" method="POST" style="display:inline;">
                                                    <input type="hidden" name="request_id" value="<?= $row['id']; ?>">
                                                    <button type="submit" name="accept_btn" class="btn btn-success" title="Accept Request">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                                <form action="process_request.php" method="POST" style="display:inline;">
                                                    <input type="hidden" name="request_id" value="<?= $row['id']; ?>">
                                                    <button type="submit" name="reject_btn" class="btn btn-danger" title="Reject Request">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            <?php elseif ($row['status'] == 'accepted'): ?>
                                                <form action="dispatch_blood.php" method="POST" style="display:inline;">
                                                    <input type="hidden" name="request_id" value="<?= $row['id']; ?>">
                                                    <button type="submit" name="dispatch_btn" class="btn btn-warning" title="Dispatch Blood">
                                                        <i class="fas fa-truck"></i>
                                                    </button>
                                                </form>
                                            <?php elseif ($row['status'] == 'dispatched'): ?>
                                                <form action="blood_dispatch_report.php" method="POST" style="display:inline;">
                                                    <input type="hidden" name="request_id" value="<?= $row['id']; ?>">
                                                    <button type="submit" name="dispatch_report_btn" class="btn btn-primary" title="View Dispatch Report">
                                                        <i class="fas fa-file-alt"></i>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="12">No Record Found!</td>
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
        const hospitalFilter = document.getElementById('hospitalNameFilter').value.toLowerCase();
        const bloodTypeFilter = document.getElementById('bloodTypeFilter').value;
        const urgencyFilter = document.getElementById('urgencyLevelFilter').value;
        const statusFilter = document.getElementById('statusFilter').value;

        const rows = document.querySelectorAll('#bloodRequestTable tbody tr');

        rows.forEach(row => {
            const hospitalName = row.children[1].textContent.toLowerCase();
            const bloodType = row.children[5].textContent;
            const urgency = row.children[7].textContent;
            const status = row.children[10].textContent.toLowerCase();

            row.style.display =
                (hospitalName.includes(hospitalFilter) || !hospitalFilter) &&
                (bloodType === bloodTypeFilter || !bloodTypeFilter) &&
                (urgency === urgencyFilter || !urgencyFilter) &&
                (status.includes(statusFilter) || !statusFilter) ?
                '' :
                'none';
        });
    });
</script>

<?php
include('includes/footer.php');
?>