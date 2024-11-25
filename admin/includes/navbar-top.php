<style>
    /* Navbar Styles */
    .sb-topnav {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        padding: 0.5rem 1rem;
    }

    /* Navbar Brand */
    .sb-topnav .navbar-brand {
        font-size: 1.75rem;
        font-weight: bold;
        color: #ffffff;
        transition: color 0.3s;
    }

    .sb-topnav .navbar-brand span {
        font-size: 1.75rem;
        font-weight: bold;
        color: #000;
        transition: color 0.3s;
    }

    .sb-topnav .navbar-brand:hover {
        color: #000;
    }

    .sb-topnav .navbar-brand span:hover {
        color: #fff;
    }

    /* Navbar Links */
    .sb-topnav .nav-link {
        color: #ffffff;
        padding: 0.75rem 1rem;
        transition: background-color 0.3s, color 0.3s;
        border-radius: 0.25rem;
    }

    .sb-topnav .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: #ffcc00;
    }

    /* Dropdown Menu */
    .sb-topnav .dropdown-menu {
        background-color: #dc3545;
        border: none;
    }

    .sb-topnav .dropdown-item {
        color: #ffffff;
        transition: background-color 0.3s;
    }

    .sb-topnav .dropdown-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    /* Search Form */
    .sb-topnav .form-inline .form-control {
        border-radius: 0.25rem;
        border: 1px solid #ffffff;
    }

    .sb-topnav .form-inline .form-control:focus {
        box-shadow: none;
        border-color: #ffcc00;
    }

    .sb-topnav .form-inline .btn {
        background-color: #ffcc00;
        color: #dc3545;
        border: none;
        transition: background-color 0.3s, color 0.3s;
        border-radius: 0.25rem;
    }

    .sb-topnav .form-inline .btn:hover {
        background-color: #e6b800;
        color: #ffffff;
    }

    /* Sidebar Toggle Button */
    #sidebarToggle {
        color: #ffffff;
        transition: color 0.3s;
    }

    #sidebarToggle:hover {
        color: #ffcc00;
    }
</style>

<nav class="sb-topnav navbar navbar-expand navbar-dark">
    <!-- Navbar Brand -->
    <a class="navbar-brand ps-3" href="../index.php"><span>Blood</span>Hub</a>
    <!-- Sidebar Toggle -->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
        <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= $_SESSION['auth_user']['user_name'] ?> <i class="fas fa-user fa-fw"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li>
                    <form action="../all_code.php" method="POST">
                        <button type="submit" name="logout_btn" class="dropdown-item">Logout</button>
                        
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
