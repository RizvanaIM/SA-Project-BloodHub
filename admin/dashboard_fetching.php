<?php
// Fetch total number of requests
$total_requests_query = "SELECT COUNT(*) AS total_requests FROM blood_requests";
$total_requests_result = mysqli_query($con, $total_requests_query);
$total_requests_data = mysqli_fetch_assoc($total_requests_result);
$total_requests = $total_requests_data['total_requests'];

// Fetch total number of donors
$total_donors_query = "SELECT COUNT(*) AS total_donors FROM donor_history";
$total_donors_result = mysqli_query($con, $total_donors_query);
$total_donors_data = mysqli_fetch_assoc($total_donors_result);
$total_donors = $total_donors_data['total_donors'];

// Fetch total number of approved requests
$total_approved_query = "SELECT COUNT(*) AS total_approved FROM blood_requests WHERE status IN ('dispatched', 'accepted')";
$total_approved_result = mysqli_query($con, $total_approved_query);
$total_approved_data = mysqli_fetch_assoc($total_approved_result);
$total_approved = $total_approved_data['total_approved'];

// Fetch total blood units for the specific blood type
$total_blood_units_query = "SELECT SUM(blood_quantity) AS total_blood_units FROM blood_inventory";
$total_blood_units_result = mysqli_query($con, $total_blood_units_query);
$total_blood_units_data = mysqli_fetch_assoc($total_blood_units_result);
$total_blood_units = $total_blood_units_data['total_blood_units'] ?? 0;

// Query for A+ blood type units
$a_plus_query = "SELECT SUM(blood_quantity) AS total_units FROM blood_inventory WHERE blood_type = 'A+'";
$a_plus_result = mysqli_query($con, $a_plus_query);
$a_plus_data = mysqli_fetch_assoc($a_plus_result);
$a_plus_units = $a_plus_data['total_units'] ?? 0; // Default to 0 if no data

// Query for A- blood type units
$a_minus_query = "SELECT SUM(blood_quantity) AS total_units FROM blood_inventory WHERE blood_type = 'A-'";
$a_minus_result = mysqli_query($con, $a_minus_query);
$a_minus_data = mysqli_fetch_assoc($a_minus_result);
$a_minus_units = $a_minus_data['total_units'] ?? 0; // Default to 0 if no data

// Query for B+ blood type units
$b_plus_query = "SELECT SUM(blood_quantity) AS total_units FROM blood_inventory WHERE blood_type = 'B+'";
$b_plus_result = mysqli_query($con, $b_plus_query);
$b_plus_data = mysqli_fetch_assoc($b_plus_result);
$b_plus_units = $b_plus_data['total_units'] ?? 0; // Default to 0 if no data

// Query for B- blood type units
$b_minus_query = "SELECT SUM(blood_quantity) AS total_units FROM blood_inventory WHERE blood_type = 'B-'";
$b_minus_result = mysqli_query($con, $b_minus_query);
$b_minus_data = mysqli_fetch_assoc($b_minus_result);
$b_minus_units = $b_minus_data['total_units'] ?? 0; // Default to 0 if no data

// Query for AB+ blood type units
$ab_plus_query = "SELECT SUM(blood_quantity) AS total_units FROM blood_inventory WHERE blood_type = 'AB+'";
$ab_plus_result = mysqli_query($con, $ab_plus_query);
$ab_plus_data = mysqli_fetch_assoc($ab_plus_result);
$ab_plus_units = $ab_plus_data['total_units'] ?? 0; // Default to 0 if no data

// Query for AB- blood type units
$ab_minus_query = "SELECT SUM(blood_quantity) AS total_units FROM blood_inventory WHERE blood_type = 'AB-'";
$ab_minus_result = mysqli_query($con, $ab_minus_query);
$ab_minus_data = mysqli_fetch_assoc($ab_minus_result);
$ab_minus_units = $ab_minus_data['total_units'] ?? 0; // Default to 0 if no data

// Query for O+ blood type units
$o_plus_query = "SELECT SUM(blood_quantity) AS total_units FROM blood_inventory WHERE blood_type = 'O+'";
$o_plus_result = mysqli_query($con, $o_plus_query);
$o_plus_data = mysqli_fetch_assoc($o_plus_result);
$o_plus_units = $o_plus_data['total_units'] ?? 0; // Default to 0 if no data

// Query for O- blood type units
$o_minus_query = "SELECT SUM(blood_quantity) AS total_units FROM blood_inventory WHERE blood_type = 'O-'";
$o_minus_result = mysqli_query($con, $o_minus_query);
$o_minus_data = mysqli_fetch_assoc($o_minus_result);
$o_minus_units = $o_minus_data['total_units'] ?? 0; // Default to 0 if no data