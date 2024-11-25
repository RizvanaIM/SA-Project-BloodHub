<?php
include('authentication.php');
include('middleware/admin_auth.php');
include('includes/header.php');
?>

<style>
    .form-container {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .form-container input,
    .form-container select {
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 8px;
        font-size: 14px;
        width: 200px;
    }

    .form-container input:focus,
    .form-container select:focus {
        border-color: #007bff;
        outline: none;
    }
    
</style>

<div class="container-fluid px-4">
    <h3 class="mt-4">Users</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item active">Users</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <?php include('../message.php'); ?>



            <div class="card">
                <div class="card-header">
                    <h4>Registered Users</h4>
                </div>
                <div class="card-body">
                    <!-- Search Filters -->
                    <div class="form-container">
                        <input type="text" id="nameFilter" placeholder="Search by Name">
                        <select id="roleFilter">
                            <option value="">Select Role</option>
                            <option value="Admin">Admin</option>
                            <option value="Staff">Staff</option>
                            <option value="Hospital">Hospital</option>
                            <option value="Driver">Driver</option>
                            <option value="Donor">Donor</option>
                        </select>
                    </div>
                    <table class="table table-bordered" id="userTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM user";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $row) {
                            ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= $row['name']; ?></td>
                                        <td><?= $row['email']; ?></td>
                                        <td><?= $row['role']; ?></td>
                                        <td class="text-center"><a href="register-edit.php?id=<?= $row['id']; ?>" class="btn btn-success" title="Edit"><i class="fas fa-edit"></i></a>
                                            <form action="code.php" method="POST">
                                                <button type="submit" name="user_delete" value="<?= $row['id']; ?>" class="btn btn-danger" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6" class="text-center">No Record Found!</td>
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
    // JavaScript for Filtering the Users Table
    document.addEventListener('input', function() {
        const nameFilter = document.getElementById('nameFilter').value.toLowerCase();
        const roleFilter = document.getElementById('roleFilter').value;

        const rows = document.querySelectorAll('#userTable tbody tr');

        rows.forEach(row => {
            const name = row.children[1].textContent.toLowerCase(); // Name column
            const role = row.children[3].textContent; // Role column

            row.style.display =
                (name.includes(nameFilter) || !nameFilter) &&
                (role === roleFilter || !roleFilter) ?
                '' :
                'none';
        });
    });
</script>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>