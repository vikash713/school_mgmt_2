<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Layout</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('./sp.jpg');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
        }
        .card-img-top {
            height: 180px;
            object-fit: cover; /* Ensures the image covers the area without distortion */
        }
        .card {
            background-color: #ffffff;
            border: 1px solid #ddd; 
        }
        .card-body {
            padding: 1.25rem;
        }
        /* Custom Navbar styles */
        .navbar {
            background-color: #fff;
            padding: 0.5rem 1rem;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: black;
            font-weight: bold;
        }
        .navbar-nav .nav-link:hover {
            color: #007bff;
        }
        .navbar-toggler-icon {
            background-image: url('data:image/svg+xml,...'); /* Ensure toggler icon is visible */
        }
        .navbar-nav .nav-item.logout-btn {
            margin-left: auto; /* Pushes the button to the right */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">School Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="./student_display.php">Students <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./teacher_display.php">Teachers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./course_display.php">Courses</a>
                </li>
                <!-- Logout Button -->
                <li class="nav-item logout-btn">
                    <a class="nav-link btn btn-danger text-white" href="./Logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main content -->
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-4">
                <div class="card" style="width: 100%;">
                    <svg class="bd-placeholder-img card-img-top" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#17a2b8"></rect>
                        <text x="30%" y="50%" fill="#dee2e6" dy=".3em">Students Detail</text>
                    </svg>
                    <div class="card-body">
                        <h5 class="card-title">Students Detail</h5>
                        <p class="card-text">Click below to view the student details.</p>
                        <a href="./student_display.php" class="btn btn-primary">Click here</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 100%;">
                    <svg class="bd-placeholder-img card-img-top" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#fd7e14"></rect>
                        <text x="30%" y="50%" fill="#dee2e6" dy=".3em">Teachers Detail</text>
                    </svg>
                    <div class="card-body">
                        <h5 class="card-title">Teachers Details</h5>
                        <p class="card-text">Click below to view the Teachers details.</p>
                        <a href="./teacher_display.php" class="btn btn-primary">Click here</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 100%;">
                    <svg class="bd-placeholder-img card-img-top" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#20c997"></rect>
                        <text x="30%" y="50%" fill="#dee2e6" dy=".3em">Course Details</text>
                    </svg>
                    <div class="card-body">
                        <h5 class="card-title">Course Details</h5>
                        <p class="card-text">Click below to view the Course details.</p>
                        <a href="./course_display.php" class="btn btn-primary">Click here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
