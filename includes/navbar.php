<style>
    /* Navbar */
    .navbar {

        /* Increased blur for a more modern feel */
        transition: background-color 0.3s ease;
        -webkit-box-shadow: -1.5px 5.5px 10.5px -2px #d5bfbf;
        -moz-box-shadow: -1.5px 5.5px 10.5px -2px #d5bfbf;
        box-shadow: -1.5px 5.5px 10.5px -2px #d5bfbf;
        background: rgba(255, 255, 255, 0.7);
        -webkit-backdrop-filter: blur(13px);
        backdrop-filter: blur(13px);
        border: 1px solid rgba(255, 255, 255, 0.35);

    }

    .navbar.scrolled {
        background-color: rgba(255, 255, 255, 1);
        /* Fully opaque when scrolled */
    }

    .navbar .navbar-brand {
        color: #000;
        font-size: 26px;
        /* Slightly smaller font size for a cleaner look */
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 2px;
        transition: color 0.3s ease;
    }

    .navbar .navbar-brand:focus,
    .navbar .navbar-brand:hover {
        color: #C20114;
        /* Primary color for hover */
    }

    .navbar .navbar-nav .nav-link {
        color: #333;
        font-size: 14px;
        /* Slightly larger font size */
        text-transform: capitalize;
        font-weight: 500;
        margin-right: 15px;
        /* Increased spacing for a more spacious look */
        transition: color 0.3s ease;
        position: relative;
    }

    .navbar .navbar-nav .nav-link:focus,
    .navbar .navbar-nav .nav-link:hover {
        color: #C20114;
        /* Primary color for hover */
    }

    /* Underline animation on hover */
    .navbar .navbar-nav .nav-link:after {
        content: '';
        display: block;
        width: 0;
        height: 2px;
        background: #C20114;
        /* Primary color for underline */
        transition: width 0.3s;
        position: absolute;
        bottom: -5px;
        left: 0;
    }

    .navbar .navbar-nav .nav-link:hover:after {
        width: 100%;
        /* Full width underline on hover */
    }

    /* Get Started Button */
    .navbar .getstarted {
        background: linear-gradient(90deg, #C20114, #a0153e);
        /* Gradient background */
        margin-left: 30px;
        /* Spacing on the left */
        border-radius: 30px;
        /* Rounded edges */
        font-weight: 600;
        color: #fff;
        /* White text color */
        text-decoration: none;
        /* Remove underline */
        padding: 0.5rem 1.5rem;
        /* Padding for button */
        line-height: 2.3;
        /* Vertical alignment */
        transition: background 0.3s ease, box-shadow 0.3s ease;
        /* Smooth transitions */
        white-space: nowrap;
        /* Prevents text from wrapping */
    }

    .navbar .getstarted:hover {
        background: linear-gradient(90deg, #a0153e, #C20114);
        /* Change gradient on hover */
        box-shadow: 0 8px 15px rgba(16, 110, 234, 0.2);
        /* Shadow on hover */
    }

    /* Navbar Toggler */
    .navbar-toggler {
        padding: 8px 10px;
        /* Padding for the toggle button */
        font-size: 18px;
        /* Font size */
        background: rgba(0, 0, 0, 0.8);
        /* Dark background */
        color: #fff;
        /* White icon color */
        border: none;
        /* No border */
        transition: background 0.3s ease;
        /* Smooth transition */

    }

    .navbar-toggler:focus,
    .navbar-toggler:hover {
        background: rgba(255, 255, 255, 0.5);
        /* Light transparent background on hover */
    }

    .w-100 {
        height: 50vh;
        /* Height for full-width elements */
    }

    /* Mobile Styles */
    @media (max-width: 991px) {
        .navbar .navbar-nav {
            text-align: center;
            /* Centered text on mobile */
        }

        .navbar .navbar-nav .nav-link {
            margin-bottom: 10px;
            /* Spacing between links */
        }
    }

    /* Navbar */
</style>

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php"><span class="text-danger">Blood</span>Hub</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav mb-1 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="request-blood.php">Request Blood</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="donate-blood.php">Donate Blood</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="driver_register.php">Register Driver</a>
                </li>
                <?php if (isset($_SESSION['auth_user'])) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $_SESSION['auth_user']['user_name'] ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <form action="all_code.php" method="POST">
                                    <button type="submit" name="logout_btn" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>