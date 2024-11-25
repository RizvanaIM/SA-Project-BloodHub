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
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background: rgba(255, 255, 255, 0.95);
        -webkit-backdrop-filter: blur(10px);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.475);
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

    .form-wrapper input {
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

    .work-days-checkboxes {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .work-days-checkboxes input[type="checkbox"] {
        display: none;
        /* Hide the default checkboxes */
    }

    .work-days-checkboxes label {
        position: relative;
        padding-left: 25px;
        margin-right: 20px;
        margin-bottom: 10px;
        cursor: pointer;
    }

    .work-days-checkboxes label:before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        width: 18px;
        height: 18px;
        border: 1px solid #ddd;
        border-radius: 2px;
        background-color: #fff;
    }

    .work-days-checkboxes input[type="checkbox"]:checked+label:before {
        background-color: #2ecc71;
        border-color: #2ecc71;
    }

    .work-days-checkboxes input[type="checkbox"]:checked+label:after {
        content: "";
        position: absolute;
        left: 5px;
        top: 2px;
        width: 10px;
        height: 10px;
        background-color: #fff;
        border-radius: 2px;
    }
</style>

<!-- Driver Form Content -->
<section class="form-section">
    <div class="container mt-5">
        <?php include('message.php') ?>
        <div class="form-wrapper">
            <h2>Register Driver</h2>
            <form action="submit_driver.php" method="POST">

                <!-- Full Name -->
                <label for="driver-name">Full Name</label>
                <input type="text" id="driver-name" name="driver_name" required>

                <!-- Contact Number -->
                <label for="contact-number">Contact Number</label>
                <input type="text" id="contact-number" name="contact_number" required>

                <!-- Email Address (optional) -->
                <label for="email">Email Address (Optional)</label>
                <input type="email" id="email" name="email">

                <!-- Driver License Number -->
                <label for="license-number">Driver License Number</label>
                <input type="text" id="license-number" name="license_number" required>

                <label for="license-number">Emergency Contact Number</label>
                <input type="text" id="emergency-contact-number" name="emergency_contact_number" required>

                <!-- Work Days (5 Days Must) -->
                <label for="work-days">Work Days (5 Days Must)</label>
                <div class="work-days-checkboxes">
                    <input type="checkbox" name="work_days[]" value="monday" id="monday">
                    <label for="monday">Monday</label>

                    <input type="checkbox" name="work_days[]" value="tuesday" id="tuesday">
                    <label for="tuesday">Tuesday</label>

                    <input type="checkbox" name="work_days[]" value="wednesday" id="wednesday">
                    <label for="wednesday">Wednesday</label>

                    <input type="checkbox" name="work_days[]" value="thursday" id="thursday">
                    <label for="thursday">Thursday</label>

                    <input type="checkbox" name="work_days[]" value="friday" id="friday">
                    <label for="friday">Friday</label>

                    <input type="checkbox" name="work_days[]" value="saturday" id="saturday">
                    <label for="saturday">Saturday</label>

                    <input type="checkbox" name="work_days[]" value="sunday" id="sunday">
                    <label for="sunday">Sunday</label>
                </div>


                <p id="error-message" style="color: red; display: none;">Please select exactly 5 days.</p>

                <script>
                    const checkboxes = document.querySelectorAll('input[name="work_days[]"]');
                    const errorMessage = document.getElementById('error-message');

                    checkboxes.forEach(checkbox => {
                        checkbox.addEventListener('change', function() {
                            const checkedBoxes = document.querySelectorAll('input[name="work_days[]"]:checked').length;

                            if (checkedBoxes === 5) {
                                checkboxes.forEach(box => {
                                    if (!box.checked) {
                                        box.disabled = true; // Disable unchecked boxes when 5 are selected
                                    }
                                });
                                errorMessage.style.display = 'none';
                            } else if (checkedBoxes < 5) {
                                checkboxes.forEach(box => box.disabled = false); // Re-enable all boxes if less than 5 are selected
                                errorMessage.style.display = 'none';
                            } else {
                                errorMessage.style.display = 'block'; // Show error if more than 5 are checked
                            }
                        });
                    });
                </script>

                <!-- Submit Button -->
                <button type="submit" name="submit_driver" class="btn btn-success">Register Driver</button>
            </form>
        </div>
    </div>
</section>

<?php
include('includes/footer.php');
?>