<?php session_start();
//$_SESSION['user_role'];
// Check if the request comes from an allowed source
 
 $user_id =$_SESSION['user_id'];
// Check if the user is authenticated (logged in)
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
    header("Location: /login.php"); // Redirect to login page or an appropriate page
    exit;
}
require_once 'db.php';

$userquery = "SELECT COUNT(id) AS laon_count FROM loan WHERE is_active=1
 AND user_id = $user_id";
$resultusers = $conn->query($userquery);
$row = $resultusers->fetch_assoc();
$userCount = $row['laon_count'];



$deposite_amount = "SELECT SUM(deposite) as total_deposit FROM loan WHERE 
is_active = 1  and user_id = $user_id";
$deposite_amount_query = $conn->query($deposite_amount );
$row = $deposite_amount_query ->fetch_assoc();
$deposite_amount_query = $row['total_deposit'];

$loan_count = "SELECT COUNT(id) as laon_count FROM loan where is_active  =1";
$loan_count_query = $conn->query($loan_count);
$row = $loan_count_query ->fetch_assoc();
$loanount = $row['laon_count'];


$remaining = "SELECT  amount  FROM users WHER WHERE is_active AND id = $user_id";
$remaining_query = $conn->query($remaining);
$row = $remaining_query ->fetch_assoc();
$remaining_query = $row['amount'];

$deposite_withdraw = "SELECT COUNT(user_id) as withdrawtotal FROM loan WHERE is_active AND withdraw>0  =1";
$withdraw_amount_query = $conn->query($deposite_withdraw);
$row = $withdraw_amount_query ->fetch_assoc();
$withdraw_amount_query = $row['withdrawtotal'];



?>

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
                        <a href="usersList.php" class="menu-link waves-effect">
                            <span class="menu-icon"><i class="ph-duotone ph-user">

                            </i></span>
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
            <!-- Topbar End -->

            <main class="p-6">

                <!-- Page Title Start -->
                <div class="flex justify-between items-center mb-6">
                    <h4 class="text-slate-900 text-lg font-medium">Dashboard</h4>

                    
                </div>
                <!-- Page Title End -->

                <div class="grid xl:grid-cols-4 md:grid-cols-2 gap-6 mb-6">
                <?php 
    //while ($row = $result->fetch_assoc()) {


  ?>

<div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="p-5">
                                <i class="bx bx-layer float-right text-3xl text-muted"></i>
                                <h6 class="text-muted text-sm uppercase">Total Loan APPLY Time </h6>
                                <h3 class="text-2xl mb-3" data-plugin="counterup"><?= $userCount; ?></h3>
                             
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="p-5">
                                <i class="bx bx-layer float-right text-3xl text-muted"></i>
                                <h6 class="text-muted text-sm uppercase">
                                    Total Amount</h6>
                                <h3 class="text-2xl mb-3" data-plugin="counterup">
                                    <?= $deposite_amount_query; ; ?></h3>
                                 
                                
                                </span>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="p-5">
                                <i class="bx bx-layer float-right text-3xl text-muted"></i>
                                <h6 class="text-muted text-sm uppercase">WithDraw Amount</h6>
                                <h3 class="text-2xl mb-3" data-plugin="counterup">
                                <?= $deposite_amount_query - $remaining_query; ?></h3>
                               
                                
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="p-5">
                                <i class="bx bx-layer float-right text-3xl text-muted"></i>
                                <h6 class="text-muted text-sm uppercase">Remaining Amount</h6>
                                <h3 class="text-2xl mb-3" data-plugin="counterup">
                                
                                <?= $remaining_query ?></h3>
                              
                                </span>
                            </div>
                        </div>
                    </div>

                   
<?php //} ?>
                  
                </div>
                <!-- end row -->

             

               

            </main>

            <?php     require_once('footer.php') ?>