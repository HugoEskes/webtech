<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  // User is not logged in, redirect to login page with a flag indicating the user was not logged in
  header('Location: login.php?not_logged_in=1');
}

$userID = $_SESSION['gebruikerID'];
$voornaam = $_SESSION['voornaam'];
$achternaam = $_SESSION['achternaam'];
$username = $_SESSION['gebruikersnaam'];
$email = $_SESSION['email'];

    if (isset($_POST['submit'])) {
      require_once 'php/connection.php';
      if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
      }

      $newName = $_POST['voornaam'];
      $newLastname = $_POST['achternaam'];
      $newUsername = $_POST['gebruikersnaam'];
      $newEmail = $_POST['email'];
      $newPassword = $_POST['wachtwoord'];

      // Confirm current password
      $query = "SELECT wachtwoord FROM gebruikers WHERE gebruikerID = '$userID'";
      $result = mysqli_query($connection, $query);
      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($_POST['huidig_wachtwoord'], $row['wachtwoord'])) {
          // Update password if it has been changed
          if ($newPassword) {
            $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $query = "UPDATE gebruikers SET wachtwoord = '$newPassword' WHERE gebruikerID = '$userID'";
            if (!mysqli_query($connection, $query)) {
              echo "Error updating password: " . mysqli_error($connection);
            }
          }

          // Update username and email
          $query = "UPDATE gebruikers SET voornaam = '$newName', achternaam = '$newLastname', gebruikersnaam = '$newUsername', email = '$newEmail' WHERE gebruikerID = '$userID'";
          if (mysqli_query($connection, $query)) {
            $_SESSION['voornaam'] = $newName;
            $_SESSION['achternaam'] = $newLastname;
            $_SESSION['gebruikersnaam'] = $newUsername;
            $_SESSION['email'] = $newEmail;
            echo "Record updated successfully";
          } else {
            echo "Error updating record: " . mysqli_error($connection);
          }
        } else {
          echo "Incorrect password";
        }
      } else {
        echo "User not found";
      }
      mysqli_close($connection);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>About us</title>
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
      table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        align-items: center;
        margin: 0 auto;
        height: 100%;
      }
      th, td {
        padding: 5px;
        text-align: left;
      }
      .dropdown:hover {
        display: block;
      }


    </style>

</head>

<body>
<!-- Navbar Start -->
<div class="container-fluid p-0 nav-bar">
    <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
        <a href="loggedin-index.php" class="navbar-brand px-lg-4 m-0">
            <h1 class="m-0 display-4 text-uppercase text-white">Ski. I. P</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav ml-auto p-4">
                <a href="loggedin-index.php" class="nav-item nav-link">Home</a>
                <a href="loggedin-reservation.php" class="nav-item nav-link">Reserve</a>
                <a href="loggedin-about.php" class="nav-item nav-link">About us</a>
                <a href="loggedin-account.php" class="nav-item nav-link active">Account</a>
                <a href="loggedin-myreservations.php" class="nav-item nav-link">My Reservations</a>
                <a href="php/logout.php" class="nav-item nav-link">Logout</a>
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->


<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">My Account</h1>
        <div class="d-inline-flex mb-lg-5">
            <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
            <p class="m-0 text-white px-2">/</p>
            <p class="m-0 text-white">My Account</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<?php

require_once 'php/connection.php';

// Check connection
if (!$connection) {
   die("Connection failed: " . mysqli_connect_error());
}
$voornaam = $_SESSION['voornaam'];
$achternaam = $_SESSION['achternaam'];
$gebruikerID = $_SESSION['gebruikerID'];
$gebruikersnaam = $_SESSION['gebruikersnaam'];
$email = $_SESSION['email'];
$wachtwoord = $_SESSION['wachtwoord'];


// Select query
$select_query = "SELECT * FROM gebruikers WHERE gebruikerID = '$gebruikerID'";
$result = mysqli_query($connection, $select_query);

echo "<table>";
echo "<tr><th>Name</th><th>Last Name</th><th>ID</th><th>Username</th><th>Email</th><th>Password</th><th>Action</th></tr>";

// Loop through the result set

  echo "<tr>";
  echo "<td>" . $voornaam . "</td>";
  echo "<td>" . $achternaam . "</td>";
  echo "<td>" . $gebruikerID . "</td>";
  echo "<td>" . $gebruikersnaam . "</td>";
  echo "<td>" . $email . "</td>";
  echo "<td>" . $wachtwoord . "</td>";
  echo "<td>";
  echo "<form action='delete.php' method='post'>";
  echo "<input type='hidden' name='id' value='" . $gebruikerID . "'>";
  echo "<input type='submit' name='delete' value='Delete'>";
  echo "</form>";
  echo "</td>";
  echo "</tr>";


echo "</table>";

// Close the database connection
mysqli_close($connection);

?>



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

<script>
    document.getElementById("update-form").addEventListener("submit", function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update-account.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                alert("Account updated successfully!");
            }
        };
        xhr.send(formData);
    });
</script>

</body>

</html>
