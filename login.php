<?php
require_once 'php/connection.php';
require_once "php/session.php";
 

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = mysqli_real_escape_string($connection, htmlspecialchars($_POST['email']));
    $password = mysqli_real_escape_string($connection, htmlspecialchars($_POST['password']));
    
    // Retrieve user information from the "gebruikers" table
    $sql = "SELECT * FROM gebruikers WHERE email='$email'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if (empty($result)) {
        echo 'Login failed. Email not in our system.';
    }

    // Check if email and password match
    if ($row['email'] == $email && password_verify($password, $row['wachtwoord'])) {
    // Login success
    // Start a session and store the user's information
    session_start();
    $_SESSION['gebruikerID'] = $row['gebruikerID'];
    $_SESSION['gebruikersnaam'] = $row['gebruikersnaam'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['admin'] = False;
    
    // Redirect to the welcome page
    header("Location: loggedin-index.php");
    } else {
    // Login failed
    // Display an error message
    echo "Login failed. Email or password is incorrect.";
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.min.css" rel="stylesheet">
    </head>
    <body>
        <!-- Navbar Start -->
        <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="index.html" class="navbar-brand px-lg-4 m-0">
                <h1 class="m-0 display-4 text-uppercase text-white">Ski. I. P</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
                    <a href="index.html" class="nav-item nav-link">Home</a>
                    <a href="reservation.html" class="nav-item nav-link">Reserve</a>
                    <a href="about.html" class="nav-item nav-link">About us</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">My Ski. I. P</a>
                        <div class="dropdown-menu text-capitalize">
                            <a href="login.php" class="dropdown-item active">Login</a>
                            <a href="signup.php" class="dropdown-item">Signup</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- Page Header Start -->
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Login</h1>
        <div class="d-inline-flex mb-lg-5">
            <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
            <p class="m-0 text-white px-2">/</p>
            <p class="m-0 text-white">Login</p>
        </div> 
    </div>
</div>
<!-- Page Header End -->

<!-- Login page Start -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Login</h2>
                    <p>Please fill in your email and password.</p>
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" required />
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        </div>
                        <p>Don't have an account? <a href="signup.php">Register here</a>.</p>
                        <p>Are you an admin? <a href="admin_login.php"> Login here</a></p>
                    </form>
                </div>
            </div>
        </div> 
<!-- Login page end -->

<!-- Footer Start -->
<div class="container-fluid footer text-white mt-5 pt-5 px-0 position-relative overlay-top">
        <div class="row mx-0 pt-5 px-sm-3 px-lg-5 mt-4">
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Get In Touch</h4>
                <p><i class="fa fa-map-marker-alt mr-2"></i>Science Park 904, Amsterdam</p>
                <p><i class="fa fa-phone-alt mr-2"></i>+31 6 12345678</p>
                <p class="m-0"><i class="fa fa-envelope mr-2"></i>Skiliftreservations@gmail.com</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Newsletter</h4>
                <p>Amet elitr vero magna sed ipsum sit kasd sea elitr lorem rebum</p>
                <div class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control border-light" style="padding: 25px;" placeholder="Your Email">
                        <div class="input-group-append">
                            <button class="btn btn-primary font-weight-bold px-3">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid text-center text-white border-top mt-4 py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
            <p class="mb-2 text-white">Copyright &copy; <a class="font-weight-bold" href="#">Domain</a>. All Rights Reserved.</a></p>
            <p class="m-0 text-white">Designed by <a class="font-weight-bold" href="https://htmlcodex.com">HTML Codex</a></p>
        </div>
    </div>
    <!-- Footer End -->
<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Contact Javascript File -->
<script src="mail/jqBootstrapValidation.min.js"></script>
<script src="mail/contact.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>

<script>
  // Check if the user was not logged in when redirected to the login page
  if (new URLSearchParams(window.location.search).has("not_logged_in")) {
    alert("You need to log in to access this page");
  }
</script>

</body>
</html>

