<?php
include('admin/authentication.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<style>
    /* Form Section Styles */
    .form-section {
        padding: 40px 0;
        background: #ecebf3;
    }

    .form-wrapper {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.95);
        -webkit-backdrop-filter: blur(10px);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.475);
        -webkit-box-shadow: 1px 0.5px 31.5px -2.5px #333333;
        -moz-box-shadow: 1px 0.5px 31.5px -2.5px #333333;
        box-shadow: 1px 0.5px 31.5px -2.5px #333333;
    }

    .form-wrapper h2 {
        text-transform: uppercase;
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .form-wrapper label {
        display: block;
        margin-bottom: 5px;
        color: #555;
    }

    .form-wrapper input,
    .form-wrapper select,
    .form-wrapper textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }

    .form-wrapper button {
        display: block;
        width: 100%;
        padding: 12px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        color: #fff;
        background-color: #28a745;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .form-wrapper button:hover {
        background-color: #218838;
    }

    /* Style the checkbox container */
    .ec-checkboxes {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    /* Custom label style for checkboxes */
    .ec-checkboxes label {
        display: inline-flex;
        margin-right: 15px;
        margin-bottom: 10px;
        font-size: 16px;
        cursor: pointer;
    }

    /* Custom checkbox style */
    .ec-checkboxes input[type="checkbox"] {
        width: 18px;
        height: 18px;
        border: 2px solid #ddd;
        border-radius: 5px;
        margin-right: 10px;
        position: relative;
        cursor: pointer;
        background-color: #fff;
        transition: background-color 0.3s ease, border-color 0.3s ease;
        appearance: none;
        /* Remove default checkbox style */
    }

    /* When the checkbox is checked, change the background and border color */
    .ec-checkboxes input[type="checkbox"]:checked {
        background-color: #2ecc71;
        /* Green background when checked */
        border-color: #2ecc71;
        /* Green border when checked */
    }

    /* Add checkmark inside the checkbox when checked */
    .ec-checkboxes input[type="checkbox"]:checked::after {
        content: "";
        position: absolute;
        top: 2px;
        left: 5px;
        width: 10px;
        height: 10px;
        background-color: #fff;
        /* White checkmark */
        border-radius: 50%;
    }

    /* Focus state when clicking on the checkbox */
    .ec-checkboxes input[type="checkbox"]:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(46, 204, 113, 0.5);
        /* Soft green glow */
    }

    /* Error Message Style */
    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 10px;
    }
</style>

<!-- Donate Blood Content -->
<section class="form-section">
    <div class="container mt-5">
        <?php include('message.php') ?>
        <div class="form-wrapper">
            <h2>Donate Blood</h2>
            <form action="submit_donation.php" method="POST" id="donation-form">

                <!-- Name -->
                <label for="donor-name">Full Name</label>
                <input type="text" id="donor-name" name="donor-name" required>

                <!-- Date of Birth -->
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" required>

                <!-- Gender -->
                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>

                <!-- Blood Type -->
                <label for="blood-type">Blood Type</label>
                <select id="blood-type" name="blood-type" required>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>

                <!-- Contact Information -->
                <label for="contact-number">Contact Information</label>
                <input type="tel" id="contact-number" name="contact-number" placeholder="Phone Number" required>
                <input type="email" id="email" name="email" placeholder="Email Address" required>

                <!-- Eligibility Criteria Section -->
                <label for="eligibility-criteria">Eligibility Criteria</label>
                <div class="ec-checkboxes">
                    <label>
                        <input type="checkbox" name="healthy">
                        I am healthy and feeling well on the day of donation.
                    </label>
                    <label>
                        <input type="checkbox" name="weight-requirement">
                        I meet the weight requirement for safe donation (at least 50 kg).
                    </label>
                    <label>
                        <input type="checkbox" name="donation-frequency">
                        I have not donated blood in the last 56 days.
                    </label>
                    <label>
                        <input type="checkbox" name="pregnancy-breastfeeding">
                        I am not pregnant or breastfeeding.
                    </label>
                </div>

                <!-- Last Donation Date -->
                <label for="last-donation">Last Donation Date</label>
                <input type="date" id="last-donation" name="last-donation">

                <!-- Error Message -->
                <div id="error-message" class="error-message" style="display:none;">
                    Please ensure all eligibility criteria are met.
                </div>

                <!-- Submit Button -->
                <button type="submit" name="submit_detail" class="btn btn-danger">Submit Donation</button>
            </form>
        </div>
    </div>
</section>

<script>
    // JavaScript form validation
    document.getElementById('donation-form').addEventListener('submit', function(event) {
        // Get all the checkboxes
        const checkboxes = document.querySelectorAll('input[type="checkbox"][name="healthy"], input[type="checkbox"][name="weight-requirement"], input[type="checkbox"][name="donation-frequency"], input[type="checkbox"][name="pregnancy-breastfeeding"]');
        let allChecked = true;

        // Check if all checkboxes are checked
        checkboxes.forEach(function(checkbox) {
            if (!checkbox.checked) {
                allChecked = false;
            }
        });

        // If not all checkboxes are checked, show error message and prevent form submission
        if (!allChecked) {
            document.getElementById('error-message').style.display = 'block';
            event.preventDefault(); // Prevent form submission
        } else {
            document.getElementById('error-message').style.display = 'none';
        }
    });
</script>

<?php
include('includes/footer.php');
?>