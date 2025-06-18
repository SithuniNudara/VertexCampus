<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --navbar-height: 70px;
        }

        /* Navbar Container */
        .vertex-navbar {
            background-color: var(--primary-color);
            height: var(--navbar-height);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            transition: all 0.3s ease;
        }

        /* Navbar content container */
        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;
            padding: 0 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Logo/Brand */
        .navbar-brand {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .navbar-logo {
            height: 40px;
            margin-right: 10px;
        }

        .navbar-brand-text {
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
            margin: 0;
        }

        /* Main Navigation */
        .navbar-links {
            display: flex;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .navbar-links li {
            position: relative;
        }

        .navbar-links a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .navbar-links a:hover,
        .navbar-links a.active {
            color: white;
        }

        .navbar-links a i {
            margin-right: 8px;
            font-size: 0.9rem;
        }

        /* Mobile Menu */
        .mobile-menu {
            position: fixed;
            top: var(--navbar-height);
            left: 0;
            right: 0;
            background-color: var(--primary-color);
            padding: 20px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            transform: translateY(-100%);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 1020;
        }

        .mobile-menu.active {
            transform: translateY(0);
            opacity: 1;
        }

        .mobile-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .mobile-menu li {
            margin-bottom: 15px;
        }

        .mobile-menu a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            display: block;
            padding: 8px 0;
            font-weight: 500;
        }

        .mobile-menu a:hover,
        .mobile-menu a.active {
            color: white;
        }

        .mobile-menu a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .navbar-links {
                display: none;
            }

            .mobile-menu-toggle {
                display: block;
            }
        }

        /* Scrolled State */
        .vertex-navbar.scrolled {
            height: 60px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        /* Page Content (for demo) */
        .page-content {
            padding-top: var(--navbar-height);
            min-height: 15vh;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="vertex-navbar">
        <div class="navbar-container">
            <!-- Brand/Logo -->
            <a href="adminDashboard.php" class="navbar-brand">
                <img src="resources/logo.png" alt="Vertex Institute Logo" class="navbar-logo rounded-circle">
                <span class="navbar-brand-text">Vertex Institute</span>
            </a>

            <!-- Desktop Navigation -->
            <ul class="navbar-links">
                <li><a href="adminDashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="studentManagement.php"><i class="fas fa-user"></i> Student Management</a></li>
                <li><a href="instructorManagement.php"><i class="fas fa-chalkboard-teacher"></i> Instructor Management</a></li>
                <li><a href="courseManagement.php"><i class="fas fa-book"></i> Course Management</a></li>
            </ul>

            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <ul>
              <li><a href="adminDashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="studentManagement.php"><i class="fas fa-user"></i> Student Management</a></li>
                <li><a href="instructorManagement.php"><i class="fas fa-chalkboard-teacher"></i> Instructor Management</a></li>
                <li><a href="courseManagement.php"><i class="fas fa-book"></i> Course Management</a></li>    
        </ul>
    </div>

    <div class="page-content">

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile Menu Toggle
        document.getElementById('mobileMenuToggle').addEventListener('click', function () {
            document.getElementById('mobileMenu').classList.toggle('active');
        });

        // Mobile Dropdown Toggle
        document.querySelectorAll('.dropdown-toggle').forEach(function (toggle) {
            toggle.addEventListener('click', function (e) {
                e.preventDefault();
                const target = this.getAttribute('data-toggle');
                document.getElementById(target + 'Dropdown').classList.toggle('show');
                this.querySelector('i').classList.toggle('fa-chevron-down');
                this.querySelector('i').classList.toggle('fa-chevron-up');
            });
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function (e) {
            if (!e.target.closest('.vertex-navbar') && !e.target.closest('.mobile-menu')) {
                document.getElementById('mobileMenu').classList.remove('active');
            }
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function () {
            if (window.scrollY > 50) {
                document.querySelector('.vertex-navbar').classList.add('scrolled');
            } else {
                document.querySelector('.vertex-navbar').classList.remove('scrolled');
            }
        });

        // Set active link based on current page
        document.addEventListener('DOMContentLoaded', function () {
            const currentPage = window.location.pathname.split('/').pop();
            const links = document.querySelectorAll('.navbar-links a, .mobile-menu a');

            links.forEach(link => {
                const linkPage = link.getAttribute('href').split('/').pop();
                if (linkPage === currentPage) {
                    link.classList.add('active');

                    // Highlight parent dropdown if this is a child item
                    let parent = link.closest('.dropdown-submenu');
                    while (parent) {
                        const toggle = document.querySelector(`[data-toggle="${parent.id.replace('Dropdown', '')}"]`);
                        if (toggle) {
                            toggle.classList.add('active');
                        }
                        parent = parent.parentElement.closest('.dropdown-submenu');
                    }
                }
            });
        });
    </script>
</body>

</html>