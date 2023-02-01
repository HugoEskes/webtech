<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  // User is not logged in, redirect to login page with a flag indicating the user was not logged in
  header('Location: login.php?not_logged_in=1');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Home</title>
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
    <link href="css/style.min.css" rel="stylesheet">
    <style>
        .modal {
          display: none; 
          position: fixed; 
          z-index: 1; 
          left: 0;
          top: 0;
          width: 100%; 
          height: 100%; 
          overflow: auto; 
          background-color: rgb(0,0,0); 
          background-color: rgba(0,0,0,0.4);
        }
        
        .modal-content {
          background-color: #fefefe;
          margin: 15% auto; 
          padding: 20px;
          border: 1px solid #888;
          width: 80%; 
        }
        
        .close {
          color: #aaa;
          float: right;
          font-size: 28px;
          font-weight: bold;
        }
        
        .close:hover,
        .close:focus {
          color: black;
          text-decoration: none;
          cursor: pointer;
        }
    </style>
</head>

<body>
    <div id="privacy-policy-modal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <p>Your privacy policy text goes here.</p>
          <button id="accept-policy">Accept</button>
          <button id="decline-policy">Decline</button>
        </div>
      </div>
  
      <script>
        const modal = document.getElementById("privacy-policy-modal");
        const acceptBtn = document.getElementById("accept-policy");
        const declineBtn = document.getElementById("decline-policy");
        const span = document.getElementsByClassName("close")[0];
        
        if (!localStorage.getItem("policyAccepted")) {
        modal.style.display = "block";
      }
        
        acceptBtn.onclick = function() {
          localStorage.setItem("policyAccepted", true);
          modal.style.display = "none";
        }
        
        declineBtn.onclick = function() {
          modal.style.display = "none";
        }
        
        span.onclick = function() {
          modal.style.display = "none";
        }
        
        window.onclick = function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }
      </script>
      
<!-- Navbar Start -->
<div class="container-fluid p-0 nav-bar">
    <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
        <a href="loggedin-index.php" class="navbar-brand px-lg-4 m-0">
            <h1 class="m-0 display-4 text-uppercase text-white">Ski. I. P.</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav ml-auto p-4">
                <a href="loggedin-index.php" class="nav-item nav-link active">Home</a>
                <a href="loggedin-reservation.php" class="nav-item nav-link">Reserve</a>
                <a href="loggedin-about.php" class="nav-item nav-link">About us</a>
                <a href="loggedin-account.php" class="nav-item nav-link">Account</a>
                <a href="loggedin-myreservations.php" class="nav-item nav-link">My Reservations</a>
                <a href="php/logout.php" class="nav-item nav-link">Log out</a>
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->

<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5">
    <div id="blog-carousel" class="carousel slide overlay-bottom" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="img/skilift-7-1500x1004.jpg" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <h2 class="text-primary font-weight-medium m-0">Reserve your</h2>
                    <h1 class="display-1 text-white m-0">SKILIFT</h1>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="img/eueac3uf.jpg" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <h2 class="text-primary font-weight-medium m-0">Reserve your</h2>
                    <h1 class="display-1 text-white m-0">SKILIFT</h1>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#blog-carousel" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#blog-carousel" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
</div>
<!-- Carousel End -->

<!-- About Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="section-title">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;"></h4>
            <h1 class="display-4 text text-primary">Quick links</h1>
        </div>
        <div class="row">
            <div class="col-lg-4 py-0 py-lg-5">
                <h5 class="mb-3">Oprah Winfrey once said: 'Skiing is the next best thing to having wings'</h5>
                <p>We have to disagree with her on that. There is only one thing better than skiing, and it's the long invigorating journey up the mountain in one of our gondola's. </p>
                <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Unique views</h5>
                <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Front row seat on the slopes</h5>
                <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Time seems to fly</h5>
                <a href="loggedin-reservation.php" class="btn btn-secondary font-weight-bold py-2 px-4 mt-2">Reserve your place now!</a>
            </div>
            <div class="col-lg-4 py-5 py-lg-0" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100" src="img/matterhorn.png" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-4 py-0 py-lg-5">
                <h5 class="mb-3">If you want to lift yourself up, lift up someone else!</h5>
                <p>It is our mission to make skiing a more pleasant experience for you. We strive for the best and nothing less. Go straight to our about page to learn more.</p>
                <a href="loggedin-about.php" class="btn btn-primary font-weight-bold py-2 px-4 mt-2">Get to know us and our quest</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Service Start -->
<div class="container-fluid pt-5">
    <div class="container">
        <div class="section-title">
            <h1 class="display-4 text text-primary">What we offer</h1>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-5">
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <img class="img-fluid mb-3 mb-sm-0" src="img/service-4.jpg" alt="">
                    </div>
                    <div class="col-sm-7">
                        <h4><i class="fa fa-table service-icon"></i>Skip the queue</h4>
                        <p class="m-0">No more waiting waiting for hours, no more tedious long lines and always being able to slide the slopes you want. You can have it all with Ski.I.P.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-5">
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <img class="img-fluid mb-3 mb-sm-0" src="img/service-1.jpg" alt="">
                    </div>
                    <div class="col-sm-7">
                        <h4><i class="fa fa-check service-icon"></i>Fast reserving</h4>
                        <p class="m-0">With a few simple clicks on our website you can reserve the gondola that suits your timing. Who ever knew it could be so easy!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-5">
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <img class="img-fluid mb-3 mb-sm-0" src="img/service-2.jpg" alt="">
                    </div>
                    <div class="col-sm-7">
                        <h4><i class="fa fa-award service-icon"></i>Excellent views</h4>
                        <p class="m-0">Did you know our gondolas have the best views in the whole of France? Hell! The best in the whole wide world! You don't trust us? Come see for yourself.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-5">
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <img class="img-fluid mb-3 mb-sm-0" src="img/service-3.jpg" alt="">
                    </div>
                    <div class="col-sm-7">
                        <h4><i class="fa fa-award service-icon"></i>Safety first</h4>
                        <p class="m-0">You don't even have to worry. Our gondolas are approved by the safety standards of the European Comitty of Gondola Control (ECGC).</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->


<!-- Footer Start -->
<div class="container-fluid footer text-white mt-5 pt-5 px-0 position-relative overlay-top">
    <div class="row mx-0 pt-5 px-sm-3 px-lg-5 mt-4">
        <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Get In Touch</h4>
            <p><i class="fa fa-map-marker-alt mr-2"></i>Science Park 904, Amsterdam</p>
            <p><i class="fa fa-phone-alt mr-2"></i>+31 6 12345678</p>
            <p class="m-0"><i class="fa fa-envelope mr-2"></i>Skiliftreservations@gmail.com</p>
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
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>