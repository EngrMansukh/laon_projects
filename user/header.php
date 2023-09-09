<?php session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
    header("Location: /login.php"); // Redirect to login page or an appropriate page
    exit;
}

require_once "db.php" ;?>
<!DOCTYPE html>
<html lang="en" data-sidebar-color="dark" data-topbar-color="light" data-sidebar-view="default">

<head>
    <meta charset="utf-8">
    <title>Dashboard </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="MyraStudio" name="author">

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="assets/css/theme.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">

    <!-- Head Js -->
    <script src="assets/js/head.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="app-wrapper">

        <!-- Sidenav Menu Start -->
        <div class="app-menu">

            <!-- Brand Logo -->
            <a href="index.php" class="logo-box">
            <h2 style="color:#fff;font-size:20px"> <?php echo ucfirst($_SESSION['user_name']);?></h2>
            </a>

            <!--- Menu -->
            <div data-simplebar>
                <ul class="menu" data-fc-type="accordion">
                   

                    <li class="menu-item">
                        <a href="index.php" class="menu-link waves-effect">
                            <span class="menu-icon"><i class="ph-duotone ph-house"></i></span>
                            <span class="menu-text"> Dashboard </span>
                          
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="index.php" class="menu-link waves-effect">
                            <span class="menu-icon"><i class="ph-duotone ph-user"></i></span>
                            <span class="menu-text"> User Info </span>
                          
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="index.php" class="menu-link waves-effect">
                            <span class="menu-icon"><i class="ph-duotone ph-money"></i></span>
                            <span class="menu-text"> WithDraw </span>
                          
                        </a>
                    </li>
               

                    

      

                    <li class="menu-item">
                        <a href="/login.php" data-fc-type="collapse" class="menu-link waves-effect">
                            <span class="menu-icon"><i class="ph-duotone ph-sign-in"></i></span>
                            <span class="menu-text"> logout </span>
                            <span class="menu-arrow"></span>
                        </a>

                     
                    </li>

                </ul>
            </div>
        </div>
        <!-- Sidenav Menu End  -->

        <!-- Start Page Content here -->
        <div class="app-content">

            <!-- Topbar Start -->
            <header class="app-header flex items-center px-5 gap-4">

                <!-- Brand Logo -->
                <a href="index.php" class="logo-box">
                    <img src="assets/images/logo-sm.png" class="h-6" alt="Small logo">
                </a>

            </header>


          