<style>
    .hidden {
        display: none;
        /* Hide the sidebar */
    }

    /* Adjust main content when sidebar is hidden */
    #layoutSidenav_content {
        transition: margin-left 0.3s;
        /* Smooth transition */
    }

    .sidebar-visible #layoutSidenav_content {
        margin-left: 250px;
        /* Space for the sidebar */
    }

    .sidebar-hidden #layoutSidenav_content {
        margin-left: 0;
        /* Full width when sidebar is hidden */
    }
</style>

<div id="layoutSidenav_nav" class="sidenav-hidden">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav">
                    <a class="nav-link" href="index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tint"></i></div>
                        Dashboard
                    </a>
                </div>
                <!-- Admin Section -->
                <div class="sb-sidenav-menu-heading">Admin Management</div>
                <a class="nav-link" href="viewregister.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-users-cog"></i></div>
                    Manage Users
                </a>
                <a class="nav-link" href="driver_details.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                    Driver Management
                </a>

                <!-- Staff Section -->
                <div class="sb-sidenav-menu-heading">Staff Operations</div>
                <a class="nav-link" href="blood_requests.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-hand-holding-heart"></i></div>
                    View Blood Requests
                </a>
                <a class="nav-link" href="donor_history.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-medical"></i></div>
                    Access Donor History
                </a>
                <a class="nav-link" href="blood_inventory.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tint"></i></div>
                    Check Blood Inventory
                </a>

                <!-- Analyze Section -->
                <div class="sb-sidenav-menu-heading">Generate Reports</div>
                <a class="nav-link" href="blood_donation_report.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-bar"></i></div>
                    Blood Receive
                </a>
                <a class="nav-link" href="blood_dispatch_report.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-pie"></i></div>
                    Blood Dispatch
                </a>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <strong><?= $_SESSION['auth_user']['user_name'] ?></strong>
        </div>
    </nav>
</div>