<?php
session_start();
include('includes/navbar.php');
include('includes/header.php');
?>

<style>
    @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap");

    body {
        background-color: #ecebf3;
        /* Updated background color */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        font-family: 'Montserrat', sans-serif;
    }

    .signup-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        opacity: 0.9;
    }

    .signup-card {
        width: 100%;
        max-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
        padding: 20px;
        background: #ffffff;
        /* Updated form color */
        -webkit-backdrop-filter: blur(15px);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.225);
        -webkit-box-shadow: 0 -1px 12.5px -1.5px #d5bfbf;
        -moz-box-shadow: 0 -1px 12.5px -1.5px #d5bfbf;
        box-shadow: 0 -1px 12.5px -1.5px #d5bfbf;
    }

    .card-header {
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 1px;
        text-align: center;
        margin-top: 20px;
        margin-bottom: 20px;
        color: #ffffff;
        /* White text for better contrast */
    }

    .card-header h4 {
        color: #c23321;
        margin: 0;
        font-size: 1.6rem;
    }

    .span-color {
        color: #000;
    }

    .card-body {
        padding: 10px;
    }

    .form-group label {
        font-weight: bold;
        font-size: 16px;
        color: #000;
        /* White label text for better contrast */
    }

    .form-group input {
        font-size: 16px;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-top: 5px;
        width: 100%;
        background-color: #f0f0f0;
        color: #333;
    }

    .btn-block {
        display: block;
        margin: 0 auto;
        font-size: 14px;
        font-weight: 500;
        text-transform: uppercase;
        padding: 10px 16px;
        border-radius: 5px;
        width: 100%;
        cursor: pointer;
    }

    .btn-primary {
        background-color: transparent;
        color: #000;
        margin-bottom: 10px;
        transition: background-color 0.3s ease;
        border-color: #000;
    }

    .btn-primary:hover {
        background-color: #000;
        border-color: #fff;
    }

    .form-group a {
        text-decoration: none;
        font-size: 14px;
        color: #000;
        display: inline-block;
        margin-top: 10px;
    }

    .form-group a:hover {
        color: #921d1d;
    }

    ::placeholder {
        color: #888;
        font-weight: 300;
        letter-spacing: 0.5px;
        font-size: 13px;
    }

    input:focus::placeholder {
        color: #aaa;
        opacity: 0.7;
    }

    @media only screen and (max-width: 767px) {
        .signup-card {
            padding: 15px;
        }

        .card-header h4 {
            font-size: 1.25rem;
        }

        .form-group input {
            font-size: 14px;
        }

        .btn-block {
            font-size: 14px;
        }
    }
</style>


<div class="signup_container">
    <div class="signup-card">
        <div class="row justify-content-center">
            <div class="card-header text-center">
                <h4>Register to <a class="navbar-brand" href="#"><span class="span-color">Blood</span>Hub</a></h4>
            </div>
            <div class="card-body">

                <?php include('message.php'); ?>

                <form action="registercode.php" method="POST">
                    <!-- User Role Selection -->
                    <div class="form-group mb-3">
                        <label>Select User Role</label>
                        <select id="userRole" name="role" class="form-control" required onchange="updateFormFields()">
                            <option value="Donor" selected>Donor</option>
                            <option value="Hospital">Hospital</option>
                            <option value="Staff">Staff</option>
                            <option value="Driver">Driver</option>
                        </select>
                    </div>

                    <!-- Dynamic Fields -->
                    <div id="dynamicFields">
                        <!-- Fields will be dynamically injected here based on the selected role -->
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group mb-3 mt-3">
                        <button type="submit" name="register_btn" class="btn btn-primary btn-block">Register Now</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    // Function to dynamically update the form fields based on the selected user role
    function updateFormFields() {
        const userRole = document.getElementById('userRole').value;
        const dynamicFields = document.getElementById('dynamicFields');

        // Clear existing fields
        dynamicFields.innerHTML = '';

        if (userRole === 'Donor') {
            dynamicFields.innerHTML = `
                <div class="form-group mb-3">
                    <label>Donor Name</label>
                    <input required type="text" name="name" placeholder="Enter Donor Name" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Email Address</label>
                    <input required type="email" name="email" placeholder="Enter Email Address" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Password</label>
                    <input required type="password" name="password" placeholder="Enter Password" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Confirm Password</label>
                    <input required type="password" name="confirm_password" placeholder="Enter Password Again" class="form-control">
                </div>`;
        } else if (userRole === 'Hospital') {
            dynamicFields.innerHTML = `
                <div class="form-group mb-3">
                    <label>Hospital Name</label>
                    <input required type="text" name="name" placeholder="Enter Hospital Name" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Email Address</label>
                    <input required type="email" name="email" placeholder="Enter Email Address" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Password</label>
                    <input required type="password" name="password" placeholder="Enter Password" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Confirm Password</label>
                    <input required type="password" name="confirm_password" placeholder="Enter Password Again" class="form-control">
                </div>`;
        } else if (userRole === 'Staff') {
            dynamicFields.innerHTML = `
                <div class="form-group mb-3">
                    <label>BloodHub Staff ID</label>
                    <input required type="text" name="staff_id" placeholder="Enter Staff BHS00###" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Staff Name</label>
                    <input required type="text" name="name" placeholder="Enter Staff Name" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Email Address</label>
                    <input required type="email" name="email" placeholder="Enter Email Address" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Password</label>
                    <input required type="password" name="password" placeholder="Enter Password" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Confirm Password</label>
                    <input required type="password" name="confirm_password" placeholder="Enter Password Again" class="form-control">
                </div>`;
        } else if (userRole === 'Driver') {
            dynamicFields.innerHTML = `
                <div class="form-group mb-3">
                    <label>Driver Name</label>
                    <input required type="text" name="name" placeholder="Enter Driver Name" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Email Address</label>
                    <input required type="email" name="email" placeholder="Enter Email Address" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Password</label>
                    <input required type="password" name="password" placeholder="Enter Password" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Confirm Password</label>
                    <input required type="password" name="confirm_password" placeholder="Enter Password Again" class="form-control">
                </div>`;
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        updateFormFields();
    });
</script>