<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="BloodHub - A platform to manage blood donations and requests." />
    <meta name="author" content="BloodHub Team" />

    <title>BloodHub - Dashboard</title>

    <!-- CSS Links -->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/custom.css" rel="stylesheet" />
    <link href="css/dataTables.bootstrap5.min.css" rel="stylesheet" />

    <!-- Font Awesome for Icons -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Summernote CSS - CDN Link -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- //Summernote CSS - CDN Link -->

    <!-- Additional CSS for DataTables -->
    <link href="css/jquery.dataTables.min.css" rel="stylesheet" />

    <style>
        /* Custom styles can be added here */
        body {
            background-color: #f8f9fa;
            /* Light background for better readability */
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <?php include('includes/navbar-top.php'); ?>
    <div id="layoutSidenav">
        <?php include('includes/sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>