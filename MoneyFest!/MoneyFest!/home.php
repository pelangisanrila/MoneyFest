<?php
require "includes/db_connect.php";

$_SESSION['id_user'] = 1;

// $query = "SELECT id FROM users WHERE user_name = 'Khairunnisa'";
// $result = mysqli_query($conn, $query);

// if(mysqli_num_rows($result) > 0) {
//     $row = mysqli_fetch_assoc($result);
//     $_SESSION['user_id'] = $row['id'];
// } else {
//     // user tidak ditemukan
// }

$profile_sql = "SELECT * FROM user WHERE user_name = 'Khairunnisa'";
$query = mysqli_query($connect, $profile_sql);

if (!$query) {
    die("Query gagal" . mysqli_error($connect));
}

while ($row = mysqli_fetch_array($query)) {
    $name = $row['user_name'];
    $_SESSION['id_user'] = $row['id_user'];
}


$user = $_SESSION['id_user'];
  $balance_sql = "SELECT balance($user) AS balance";
  $balance_query = mysqli_query($connect, $balance_sql);
  $balance = mysqli_fetch_assoc($balance_query);
  $balance = $balance['balance'];
?>


<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>MoneyFest! - Smart Financial Management</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="images/favicon.ico" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="css/responsive.css">

   </head>

   <body class="header-top-bg">
      <!-- loader Start -->
      <div id="loading">
         
      </div>
      <!-- loader END -->
      <!-- Wrapper Start -->
      <div class="wrapper">
      <!-- Sidebar  -->
      <div class="iq-sidebar">
         <div class="iq-sidebar-logo d-flex justify-content-between">
            <a href="index.html">
            <img src="images/logo.gif" class="img-fluid" alt="">
            <span>MoneyFest!</span>
            </a>
            <div class="iq-menu-bt align-self-center">
               <div class="wrapper-menu">
                  <div class="line-menu half start"></div>
                  <div class="line-menu"></div>
                  <div class="line-menu half end"></div>
               </div>
            </div>
         </div>
         <div id="sidebar-scrollbar">
               <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">
                     <br>
                     <li class="iq-menu-title"><i class="ri-separator"></i><span>Articles</span></li>
        
                    <!-- New card -->
                    <div class="card iq-mb-3">
                        <div class="card-header">
                            Financial Education
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">10 Simple Ways To Manage Your Money Better</h4>
                            <p class="card-text">Being good with money is about more than just making ends meet. Don't worry that you're not a math whiz; great math skills aren't really necessary - you just need to know basic addition and subtraction.</p>
                            <a href="https://www.thebalancemoney.com/ways-to-be-better-with-money-960664" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card iq-mb-3">
                        <div class="card-header">
                            Financial  Education
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">How a financial advisor can help you achieve your financial resolutions</h4>
                            <p class="card-text">A new year brings new opportunities for self-improvement. You might have a New Year’s resolution to exercise more or quit smoking, but setting goals for your financial health is important, too.</p>
                            <a href="https://www.aol.com/financial-advisor-help-achieve-financial-110006621.html" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    
                  </ul>
               </nav>
               <div class="p-3"></div>
            </div>
      </div>
      <!-- TOP Nav Bar -->
      <div class="iq-top-navbar">
         <div class="iq-navbar-custom">
            <div class="iq-sidebar-logo">
               <div class="top-logo">
                  <a href="index.html" class="logo">
                  <img src="images/logo.gif" class="img-fluid" alt="">
                  <span>MoneyFest!</span>
                  </a>
               </div>
            </div>
            <div class="navbar-breadcrumb">
               <h5 class="mb-0">Hai, <?= $name ?></h5>
               <!-- <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="index.html">Financial Reporting</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Income</li>
                  </ol>
               </nav> -->
            </div>
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <i class="ri-menu-3-line"></i>
                  </button>
                  <div class="iq-menu-bt align-self-center">
                     <div class="wrapper-menu">
                        <div class="line-menu half start"></div>
                        <div class="line-menu"></div>
                        <div class="line-menu half end"></div>
                     </div>
                  </div>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav ml-auto navbar-list">
                        
                        <!-- <li class="nav-item">
                           <a href="#" class="iq-waves-effect"><i class="ri-shopping-cart-2-line"></i></a>
                        </li> -->
                        <li class="nav-item">
                           <a href="#" class="search-toggle iq-waves-effect">
                              <i class="ri-notification-2-line"></i>
                              <span class="bg-danger dots"></span>
                           </a>
                           <div class="iq-sub-dropdown">
                              <div class="iq-card shadow-none m-0">
                                 <div class="iq-card-body p-0 ">
                                    <div class="bg-danger p-3">
                                       <h5 class="mb-0 text-white">All Notifications<small class="badge  badge-light float-right pt-1">4</small></h5>
                                    </div>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">New Order Recieved</h6>
                                             <small class="float-right font-size-12">23 hrs ago</small>
                                             <p class="mb-0">Lorem is simply</p>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40 rounded" src="images/user/01.jpg" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Emma Watson Nik</h6>
                                             <small class="float-right font-size-12">Just Now</small>
                                             <p class="mb-0">95 MB</p>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40 rounded" src="images/user/02.jpg" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">New customer is join</h6>
                                             <small class="float-right font-size-12">5 days ago</small>
                                             <p class="mb-0">Jond Nik</p>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40" src="images/small/jpg.svg" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Updates Available</h6>
                                             <small class="float-right font-size-12">Just Now</small>
                                             <p class="mb-0">120 MB</p>
                                          </div>
                                       </div>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </li>
                        <li class="nav-item iq-full-screen"><a href="#" class="iq-waves-effect" id="btnFullscreen"><i class="ri-fullscreen-line"></i></a></li>
                     </ul>
                  </div>
                  <ul class="navbar-list">
                     <li>
                        <a href="#" class="search-toggle iq-waves-effect bg-primary text-white"><img src="images/user/1.jpg" class="img-fluid rounded" alt="user"></a>
                        <div class="iq-sub-dropdown iq-user-dropdown">
                           <div class="iq-card shadow-none m-0">
                              <div class="iq-card-body p-0 ">
                                 <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white line-height">Hello Nik jone</h5>
                                    <span class="text-white font-size-12">Available</span>
                                 </div>
                                 <a href="profile.html" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-primary">
                                          <i class="ri-file-user-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">My Profile</h6>
                                          <p class="mb-0 font-size-12">View personal profile details.</p>
                                       </div>
                                    </div>
                                 </a>
                                 <a href="profile-edit.html" class="iq-sub-card iq-bg-primary-success-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-success">
                                          <i class="ri-profile-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Edit Profile</h6>
                                          <p class="mb-0 font-size-12">Modify your personal details.</p>
                                       </div>
                                    </div>
                                 </a>
                                 <a href="account-setting.html" class="iq-sub-card iq-bg-primary-danger-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-danger">
                                          <i class="ri-account-box-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Account settings</h6>
                                          <p class="mb-0 font-size-12">Manage your account parameters.</p>
                                       </div>
                                    </div>
                                 </a>
                                 <a href="privacy-setting.html" class="iq-sub-card iq-bg-primary-secondary-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-secondary">
                                          <i class="ri-lock-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Privacy Settings</h6>
                                          <p class="mb-0 font-size-12">Control your privacy parameters.</p>
                                       </div>
                                    </div>
                                 </a>
                                 <div class="d-inline-block w-100 text-center p-3">
                                    <a class="iq-bg-danger iq-sign-btn" href="sign-in.html" role="button">Sign out<i class="ri-login-box-line ml-2"></i></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                  </ul>
               </nav>
         </div>
      </div>
      <!-- TOP Nav Bar END -->


      <!-- Page Content  -->
      <div id="content-page" class="content-page">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12 ">
                   <div class="row justify-content-center">
                       <div class="col-sm-6">
                           <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                               <div class="iq-card-body tasks-box">
                                   <div class="d-flex align-items-center">
                                       <a href="#" class="iq-icon-box rounded-circle iq-bg-primary mr-3">
                                           <i class="ri-file-shield-line"></i>
                                       </a>
                                       <div>
                                           <h6>Balance : </h6>
                                           <h3>Rp <?= number_format($balance) ?></h3>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           
            <div class="row">
               <!-- <div class="col-md-4">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-body">
                        <div id="chart-home3-01"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Ongoing Tsk</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <ul class="task-lists m-0 p-0">
                           <li class="d-flex mb-4 align-items-center">
                              <div class="user-img img-fluid"><img src="images/user/01.jpg" alt="story-img" class="rounded-circle avatar-40"></div>
                              <div class="media-support-info ml-3">
                                 <h6>Make New Home Page</h6>
                                 <p class="mb-0 font-size-12">Feb 14, 2020</p>
                              </div>
                           </li> 
                           <li class="d-flex mb-4 align-items-center">
                              <div class="user-img img-fluid"><img src="images/user/02.jpg" alt="story-img" class="rounded-circle avatar-40"></div>
                              <div class="media-support-info ml-3">
                                 <h6>Redesign the Dashboard</h6>
                                 <p class="mb-0 font-size-12">Feb 12, 2020</p>
                              </div>
                           </li>
                           <li class="d-flex mb-4 align-items-center">
                              <div class="user-img img-fluid"><img src="images/user/03.jpg" alt="story-img" class="rounded-circle avatar-40"></div>
                              <div class="media-support-info ml-3">
                                 <h6>Analysis New Product</h6>
                                 <p class="mb-0 font-size-12">Feb 10, 2020</p>
                              </div>
                           </li>
                           <li class="d-flex mb-4 align-items-center">
                              <div class="user-img img-fluid"><img src="images/user/04.jpg" alt="story-img" class="rounded-circle avatar-40"></div>
                              <div class="media-support-info ml-3">
                                 <h6>Ubdate Dashboard 3</h6>
                                 <p class="mb-0 font-size-12">Feb 12, 2020</p>
                              </div>
                           </li>
                           <li class="d-flex align-items-center">
                              <div class="user-img img-fluid"><img src="images/user/05.jpg" alt="story-img" class="rounded-circle avatar-40"></div>
                              <div class="media-support-info ml-3">
                                 <h6>Salve Support Tikit</h6>
                                 <p class="mb-0 font-size-12">Feb 14, 2020</p>
                              </div>
                           </li>                            
                        </ul>
                     </div>
                  </div>
               </div> -->
               <div class="col-md-12">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Welcome to the MoneyFest!</h4>
                        </div>
                        
                           
                        <!-- <button type="button" class="btn btn-primary mb-3"><i class="las la-pen pr-0"></i></button> -->
                        <!-- <button type="button" class="btn btn-primary rounded-pill mb-3">
                           <div>
                              <a class="iq-icons-list" href="#"><i class="las la-pen"></i></a>
                           </div>

                        </button> -->
                        <!-- <button class="btn btn-primary btn-lg btn-block col-md-1 font-size-16 p-3" data-target="#compose-email-popup" data-toggle="modal">
                           <i class="ri-send-plane-line mr-2"></i>
                           New Message
                       </button> -->
                     
                     </div>
                     <div class="iq-card-body">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height-half" style="background-color: transparent; box-shadow: none;">
                      
                          <div class="row">
                           <div class="col text-center">
                              <a href="income.php">
                              <button class="btn btn-primary mb-3 btn-lg" style="border-radius: 20px; width: 100px; height: 100px;">
                                <i class="las la-pen-square" style="color: black; font-size: 50px; font-weight: bold;"></i>
                              </button>
                              </a>
                              <div style="color: black; font-weight: bold;">Financial Reporting</div>
                            </div>
                            
                           <div class="col text-center">
                              <a href="income.php">
                              <button type="button" class="btn btn-primary mb-3 btn-lg" style="border-radius: 20px; width: 100px; height: 100px;">
                                <i class="las la-money-bill-wave" style="color: black; font-size: 50px; font-weight: bold;"></i>
                              </button>
                              </a>
                              <div style="color: black; font-weight: bold;">Income</div>
                           </div>
                           <div class="col text-center">
                              <a href="expenses.php">
                              <button type="button" class="btn btn-primary mb-3 btn-lg" style="border-radius: 20px; width: 100px; height: 100px;">
                                <i class="las la-calculator" style="color: black; font-size: 50px; font-weight: bold;"></i>
                              </button>
                              </a>
                              <div style="color: black; font-weight: bold;">Expenses</div>
                           </div>
                           <div class="col text-center">
                              <a href="debts.php">
                              <button type="button" class="btn btn-primary mb-3 btn-lg" style="border-radius: 20px; width: 100px; height: 100px;">
                                <i class="las la-money-bill-alt" style="color: black; font-size: 50px; font-weight: bold;"></i>
                              </button>
                              </a>
                           <div style="color: black; font-weight: bold;">Debts</div>
                           </div>
                           <div class="col text-center">
                              <a href="receivables.php">
                              <button type="button" class="btn btn-primary mb-3 btn-lg" style="border-radius: 20px; width: 100px; height: 100px;">
                                <i class="las la-hand-holding-usd" style="color: black; font-size: 50px; font-weight: bold;"></i>
                              </button>
                              </a>
                              <div style="color: black; font-weight: bold;">Receivables</div>
                           </div>
                          </div>
                          <br><br>
                          <div class="row">
                           <div class="col text-center">
                              <button type="button" class="btn btn-primary mb-3 btn-lg" style="border-radius: 20px; width: 100px; height: 100px;">
                                <i class="las la-money-check-alt" style="color: black; font-size: 50px; font-weight: bold;"></i>
                              </button>
                              <div style="color: black; font-weight: bold;">Bills</div>
                           </div>
                           <div class="col text-center">
                              <button type="button" class="btn btn-primary mb-3 btn-lg" style="border-radius: 20px; width: 100px; height: 100px;">
                                <i class="las la-piggy-bank" style="color: black; font-size: 50px; font-weight: bold;"></i>
                              </button>
                              <div style="color: black; font-weight: bold;">Saving Funds</div>
                           </div>
                           <div class="col text-center">
                              <button type="button" class="btn btn-primary mb-3 btn-lg" style="border-radius: 20px; width: 100px; height: 100px;">
                                <i class="las la-file-contract" style="color: black; font-size: 50px; font-weight: bold;"></i>
                              </button>
                              <div style="color: black; font-weight: bold;">Financial Reports</div>
                           </div>
                           <div class="col text-center">
                              <button type="button" class="btn btn-primary mb-3 btn-lg" style="border-radius: 20px; width: 100px; height: 100px;">
                                <i class="las la-chart-bar" style="color: black; font-size: 50px; font-weight: bold;"></i>
                              </button>
                              <div style="color: black; font-weight: bold;">Financial Analysis</div>
                           </div>
                           <div class="col text-center">
                              <button type="button" class="btn btn-primary mb-3 btn-lg" style="border-radius: 20px; width: 100px; height: 100px;">
                                <i class="las la-user-tie" style="color: black; font-size: 50px; font-weight: bold;"></i>
                              </button>
                              <div style="color: black; font-weight: bold;">Discussion Forum</div>
                           </div>
                          </div>

                          <br><br>
                          <div class="row">
                           <div class="col text-center">
                              <button type="button" class="btn btn-primary mb-3 btn-lg" style="border-radius: 20px; width: 100px; height: 100px;">
                                <i class="las la-sms" style="color: black; font-size: 50px; font-weight: bold;"></i>
                              </button>
                              <div style="color: black; font-weight: bold;">Experts Consultation</div>
                           </div>
                           <div class="col text-center">
                              <button type="button" class="btn btn-primary mb-3 btn-lg" style="border-radius: 20px; width: 100px; height: 100px;">
                                <i class="las la-user-check" style="color: black; font-size: 50px; font-weight: bold;"></i>
                              </button>
                              <div style="color: black; font-weight: bold;">Experts</div>
                           </div>
                           <div class="col text-center">
                              <button type="button" class="btn btn-primary mb-3 btn-lg" style="border-radius: 20px; width: 100px; height: 100px;">
                                <i class="lab la-facebook-messenger" style="color: black; font-size: 50px; font-weight: bold;"></i>
                              </button>
                              <div style="color: black; font-weight: bold;">Chat experts</div>
                           </div>
                           <div class="col text-center">
                              <button type="button" class="btn btn-primary mb-3 btn-lg" style="border-radius: 20px; width: 100px; height: 100px;">
                                <i class="lab la-cc-amazon-pay" style="color: black; font-size: 50px; font-weight: bold;"></i>
                              </button>
                              <div style="color: black; font-weight: bold;"> Payment Confirmation</div>
                           </div>
                           <div class="col text-center">
                              <button type="button" class="btn btn-primary mb-3 btn-lg" style="border-radius: 20px; width: 100px; height: 100px;">
                                <i class="las la-certificate" style="color: black; font-size: 50px; font-weight: bold;"></i>
                              </button>
                              <div style="color: black; font-weight: bold;">MoneyFest! Premium</div>
                           </div>
                          </div>
                          
                      
                        </div>
                      </div>
                      
                     
                  </div>
               </div>
            </div>
            
         </div>
      </div>
   </div>
      <!-- Wrapper END -->
      <!-- Footer -->
      <footer class="bg-white iq-footer">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-6">
                  <ul class="list-inline mb-0">
                     <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                     <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                  </ul>
               </div>
               <div class="col-lg-6 text-right">
                  Copyright <span id="copyright"> 
<script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>
</span> <a href="#">MoneyFest!</a> All Rights Reserved.
               </div>
            </div>
         </div>
      </footer>
      <!-- Footer END -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="js/waypoints.min.js"></script>
      <script src="js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="js/wow.min.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="js/apexcharts.js"></script>
      <!-- Slick JavaScript -->
      <script src="js/slick.min.js"></script>
      <!-- Select2 JavaScript -->
      <script src="js/select2.min.js"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="js/smooth-scrollbar.js"></script>
      <!-- lottie JavaScript -->
      <script src="js/lottie.js"></script>
      <!-- core JavaScript -->
      <script src="js/core.js"></script>
      <!-- charts JavaScript -->
      <script src="js/charts.js"></script>
      <!-- animated JavaScript -->
      <script src="js/animated.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="js/custom.js"></script>

      <script>
         document.addEventListener('DOMContentLoaded', function () {
           var form = document.querySelector('.modal-body form');
       
           // Menahan event penutupan modal ketika ada interaksi dalam form
           form.addEventListener('click', function (event) {
             event.stopPropagation();
           });
       
           // Menahan event penutupan modal ketika ada penginputan dalam form
           form.addEventListener('input', function (event) {
             event.stopPropagation();
           });
         });
       </script>
       
   </body>
</html>
