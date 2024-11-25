<?php
include('authentication.php');
include('includes/header.php');
include('dashboard_fetching.php');
?>

<style>
    * {
        text-transform: capitalize;
    }

    /* Global Styles */
    .container-fluid {
        padding: 0 20px;
    }

    .mt-4 {
        margin-top: 1.5rem;
    }

    .mb-4 {
        margin-bottom: 1.5rem;
    }

    /* Card Styles */
    .card {
        border: none;
        border-radius: 10px;
        background: linear-gradient(to bottom, #780606, #b92b27);
        color: #fff;
        transition: transform 0.5s ease, box-shadow 0.5s ease;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .card-total {
        border: none;
        border-radius: 10px;
        border: 1px solid #ccc;
        background: linear-gradient(to bottom, #b92b27, #780606);
        color: #fff;
        transition: transform 0.5s ease, box-shadow 0.5s ease;
    }

    .card-total:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }


    .card-body {
        padding: 0.5rem;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
        text-align: center;
        margin-bottom: 1.0rem;
    }

    .progress {
        height: 20px;
        margin-bottom: 1rem;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-bar {
        background-color: #e38e00;
        height: 100%;
        border-radius: 10px;
    }

    .card-footer {
        background-color: #b92b27;
        padding: 0.5rem 1.5rem;
        border-top: none;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .small {
        font-size: 0.8rem;
    }

    .stretched-link {
        color: #fff;
        text-decoration: none;
    }

    .stretched-link:hover {
        color: #fff;
        text-decoration: none;
    }

    /* Icon Styles */
    .card i {
        font-size: 1.5rem;
        margin-right: 0.5rem;
    }

    .card i:hover {
        transform: rotate(360deg);
        transition: transform 0.5s ease-in-out;
    }

    /* Link Styles */
    a {
        text-decoration: none;
        color: #fff;
    }

    a:hover {
        color: #fff;
        text-decoration: none;
</style>

<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">BloodHub Stock Levels</li>
    </ol>

    <?php include('../message.php'); ?>

    <div class="row mb-3">
        <!-- A+ Blood Type -->
        <div class="col-xl-3 col-md-6 ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fas fa-tint"></i> A+ Blood</h4>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                    </div>
                    <p><?= $a_plus_units ?> units available</p>
                    </p>
                </div>
                <div class="card-footer">
                    <a class="small stretched-link" href="blood_inventory.php?blood_type=<?= urlencode('A+') ?>">View Details <i class="fas fa-angle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- A- Blood Type -->
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fas fa-tint"></i> A- Blood</h4>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                    </div>
                    <p><?= $a_minus_units ?> units available</p>
                </div>
                <div class="card-footer">
                    <a class="small stretched-link" href="blood_inventory.php?blood_type=<?= urlencode('A-') ?>">View Details <i class="fas fa-angle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- B+ Blood Type -->
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fas fa-tint"></i> B+ Blood</h4>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                    </div>
                    <p><?= $b_plus_units ?> units available</p>
                </div>
                <div class="card-footer">
                    <a class="small stretched-link" href="blood_inventory.php?blood_type=<?= urlencode('B+') ?>">View Details <i class="fas fa-angle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- B- Blood Type -->
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fas fa-tint"></i> B- Blood</h4>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">80%</div>
                    </div>
                    <p><?= $b_minus_units ?> units available</p>
                </div>
                <div class="card-footer">
                    <a class="small stretched-link" href="blood_inventory.php?blood_type=<?= urlencode('B-') ?>">View Details <i class="fas fa-angle-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <!-- AB+ Blood Type -->
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fas fa-tint"></i> AB+ Blood</h4>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                    </div>
                    <p><?= $ab_plus_units ?> units available</p>
                </div>
                <div class="card-footer">
                    <a class="small stretched-link" href="blood_inventory.php?blood_type=<?= urlencode('AB+') ?>">View Details <i class="fas fa-angle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- AB- Blood Type -->
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fas fa-tint"></i> AB- Blood</h4>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">30%</div>
                    </div>
                    <p><?= $ab_minus_units ?> units available</p>
                </div>
                <div class="card-footer">
                    <a class="small stretched-link" href="blood_inventory.php?blood_type=<?= urlencode('AB-') ?>">View Details <i class="fas fa-angle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- O+ Blood Type -->
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fas fa-tint"></i> O+ Blood</h4>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">90%</div>
                    </div>
                    <p><?= $o_plus_units ?> units available</p>
                </div>
                <div class="card-footer">
                    <a class="small stretched-link" href="blood_inventory.php?blood_type=<?= urlencode('O+') ?>">View Details <i class="fas fa-angle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- O- Blood Type -->
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fas fa-tint"></i> O- Blood</h4>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 55%;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100">55%</div>
                    </div>
                    <p><?= $o_minus_units ?> units available</p>
                </div>
                <div class="card-footer">
                    <a class="small stretched-link" href="blood_inventory.php?blood_type=<?= urlencode('O-') ?>">View Details <i class="fas fa-angle-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4 mt-4">
        <!-- Total Donors -->
        <div class="col-xl-3 col-md-6">
            <a href="donor_history.php" style="text-decoration: none; color: #fff;">
                <div class="card-total">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-users"></i> Total Donors</h4>
                        <p><?php echo $total_donors; ?> donors registered</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Requests -->
        <div class="col-xl-3 col-md-6">
            <a href="blood_requests.php" style="text-decoration: none; color: #fff;">
                <div class="card-total">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-clipboard-list"></i> Total Requests</h4>
                        <p><?php echo $total_requests; ?> requests submitted</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Approved -->
        <div class="col-xl-3 col-md-6">
            <a href="blood_requests.php" style="text-decoration: none; color: #fff;">
                <div class="card-total">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-check-circle"></i> Total Approved</h4>
                        <p><?php echo $total_approved; ?> requests approved</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Blood Units -->
        <div class="col-xl-3 col-md-6">
            <a href="blood_inventory.php" style="text-decoration: none; color: #fff;">
                <div class="card-total">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-tint"></i> Total Blood Units</h4>
                        <p><?php echo $total_blood_units; ?> units available</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>


<?php
include('includes/footer.php');
include('includes/scripts.php');
?>