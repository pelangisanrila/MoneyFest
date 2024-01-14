<?php
require "includes/db_connect.php";

$_SESSION['id_user'] = 1;

$profile_sql = "SELECT * FROM user WHERE user_name = 'Khairunnisa'";
$query = mysqli_query($connect, $profile_sql);

if (!$query) {
    die("Query gagal" . mysqli_error($connect));
}

while ($row = mysqli_fetch_array($query)) {
    $name = $row['user_name'];
    $_SESSION['id_user'] = $row['id_user'];
}

$newFileName = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["photo"]["name"])) {
   $uploadDir = 'C:' . DIRECTORY_SEPARATOR . 'xampp' . DIRECTORY_SEPARATOR . 'htdocs' . DIRECTORY_SEPARATOR . 'MoneyFest' . DIRECTORY_SEPARATOR . 'MoneyFest' . DIRECTORY_SEPARATOR . 'MoneyFest' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'structs';
   // Directory where uploaded images will be saved
    $randomStr = uniqid(); // Generate a random string
    $date = date('Y-m-d'); // Get current date

    // Get the file information
    $fileName = basename($_FILES["photo"]["name"]);
    $fileTmp = $_FILES["photo"]["tmp_name"];

    // Extract file extension
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    // Create a unique filename using current date, random string, and file extension
    $newFileName = $date . '-' . $randomStr . '.' . $fileExtension;

    // Move the uploaded file to the specified directory with the new filename
    $destination = $uploadDir . $newFileName;
    if (move_uploaded_file($fileTmp, $destination)) {
        echo "";
    } else {
        echo "Error uploading file.";
    }

    if ($_FILES['photo']['error'] != 0) {
      die("File upload error: " . $_FILES['photo']['error']);
  }
  
}

// $row = mysqli_fetch_array($query);
// $_SESSION['id_user'] = $row['id_user'];

if (isset($_POST['income-button'])) {
    $id_user = 1;
    $income_name = $_POST['income_name'];
    $id_category_income = $_POST['kategori'];
    $total_income = $_POST['nominal'];
    $date_income = $_POST['exampleInputdate'];
    $image_income = $newFileName;

    $income_query = "CALL input_income('$id_user', '$income_name', '$id_category_income', '$total_income', '$date_income', '$image_income')";
    $product_sql = mysqli_query($connect, $income_query);

    if ($product_sql) {
      // Query executed successfully
      echo "Income added successfully!";
      header("Location:income.php");
  } else {
      // Query execution failed
      echo "Error: " . mysqli_error($connect);
  }

}
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

      <style>
         /* * {
            box-sizing: border-box;
            font-family: 'Helvetica Neue', sans-serif;
         } */
      
         .container {
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 40vh; */
         }
      
         .radio-tile-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
         }
      
         .input-container {
            position: relative;
            height: 7rem;
            width: 7rem;
            margin: 0.5rem;
         }
      
         .radio-button {
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            margin: 0;
            cursor: pointer;
         }
      
         .radio-tile {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            border: 2px solid #f15773;
            border-radius: 5px;
            padding: 1rem;
            transition: transform 300ms ease;
         }

         .icon {
      display: flex;
      align-items: center;
      justify-content: center; /* Menambahkan properti justify-content */
      height: 100%; /* Menambahkan properti height */
   }

      
         .icon i {
            font-size: 50px;
            font-weight: bold;
            color: #f15773;
         }
      
         .radio-tile-label {
            text-align: center;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #f15773;
         }
      
         .radio-button:checked + .radio-tile {
            background-color: #f7cbd3;
            border: 2px solid #f15773;
            color: white;
            transform: scale(1.1, 1.1);
         }
      </style>


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
                     <!-- <li class="iq-menu-title"><i class="ri-separator"></i><span>Main</span></li> -->
                     <li><a href="index.php" class="iq-waves-effect"><i class="las la-home"></i><span>Home</span></a></li>
                     <li class="active">
                        <a href="#FinancialReporting" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="true"><i class="las la-check-square"></i><span>Financial Reporting</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>                   
                        <ul id="FinancialReporting" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                           <li class="active"><a href="income.php">Income</a></li>
                           <li><a href="expenses.php">Expenses</a></li>
                           <li><a href="debts.php">Debts</a></li>
                           <li><a href="receivables.php">Receivables</a></li>
                           <li><a href="saving.php">Saving Funds</a></li>
                        </ul>
                     </li>
                     <li><a href="Reports.php" class="iq-waves-effect"><i class="las la-file-contract"></i><span>Financial Reports</span></a></li>
                     <li><a href="Analysis.php" class="iq-waves-effect"><i class="las la-chart-bar"></i><span>Financial Analysis</span></a></li>
                     <li><a href="forum.php" class="iq-waves-effect"><i class="las la-user-tie"></i><span>Discussion Forum</span></a></li>
                     <li><a href="chat.php" class="iq-waves-effect"><i class="las la-sms"></i><span>Expert Consultation</span></a></li>
                     <br><br>
                     <li><a href="#" class="iq-waves-effect"><i class="las la-sign-out-alt"></i><span>Logout</span></a></li>
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
               <h5 class="mb-0">Reporting of Income</h5>
               <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="index.html">Financial Reporting</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Income</li>
                  </ol>
               </nav>
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
               <!-- <div class="col-lg-7">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Task by Team</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <div id="chart-task" style="height: 370px;"></div>
                     </div>
                  </div>
               </div> -->
               <div class="col-lg-12">
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-body tasks-box">
                              <div class="d-flex align-items-center">                                 
                                 <a href="#" class="iq-icon-box rounded-circle iq-bg-primary mr-3">
                                    <i class="ri-file-shield-line"></i>
                                 </a>
                                 <div>
                                    <h6>Total Income:</h6>
                                    <h3>2.500.000</h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-body tasks-box">
                              <div class="d-flex align-items-center">                                 
                                 <a href="#" class="iq-icon-box rounded-circle iq-bg-success mr-3">
                                    <i class="ri-check-line"></i>
                                 </a>
                                 <div>
                                    <h6>Balance :</h6>
                                    <h3>1.500.000</h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- <div class="col-sm-6">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-body tasks-box">
                              <div class="d-flex align-items-center">                                 
                                 <a href="#" class="iq-icon-box rounded-circle iq-bg-info mr-3">
                                    <i class="ri-ball-pen-line"></i>
                                 </a>
                                 <div>
                                    <h6>In Progress:</h6>
                                    <h3>500</h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-body tasks-box">
                              <div class="d-flex align-items-center">                                 
                                 <a href="#" class="iq-icon-box rounded-circle iq-bg-danger mr-3">
                                    <i class="ri-close-line"></i>
                                 </a>
                                 <div>
                                    <h6>Overdue:</h6>
                                    <h3>500</h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div> -->
                     <!-- <div class="col-sm-12">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-header d-flex justify-content-between">
                              <div class="iq-header-title">
                                 <h4 class="card-title">Top inquiries</h4>
                              </div>
                           </div>
                           <div class="iq-card-body tasks-box">
                              <div class="d-flex align-items-center judtify-content-between mb-3">
                                 <h5 class="col-sm-6 pl-0">UI/UX Design</h5>
                                 <div class="col-sm-6 p-0 iq-progress-bar">
                                    <span class="bg-primary" data-percent="65" ></span>
                                 </div>
                              </div>
                              <div class="d-flex align-items-center judtify-content-between mb-3">
                                 <h5 class="col-sm-6 pl-0">Product Design</h5>
                                 <div class="col-sm-6 p-0 iq-progress-bar">
                                    <span class="bg-info" data-percent="35" ></span>
                                 </div>
                              </div>
                              <div class="d-flex align-items-center judtify-content-between">
                                 <h5 class="col-sm-6 pl-0">Testing</h5>
                                 <div class="col-sm-6 p-0 iq-progress-bar">
                                    <span class="bg-success" data-percent="80" ></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div> -->
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
                           <h4 class="card-title">History</h4>
                        </div>
                        <div class="large-FAB" type="button" data-toggle="modal" data-target=".bd-example-modal-xl">
                            <div class="state-layer"><img class="icon" src="https://c.animaapp.com/uU0Ui5cS/img/icon-1.svg" /></div>

                            <!-- Extra large modal -->
                           <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"   aria-hidden="true" >
                              <div class="modal-dialog modal-xl">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title">Reporting of Income</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="iq-card">
                                            <div class="iq-card-body">
                                               <form method="$_POST" enctype="multipart/form-data">
                                                <div class="col-lg-12">
                                                <div class="row">
                                                <div class="col-sm-6">
                                                  <div class="form-group">
                                                     <label for="exampleInputText1">Income Name </label>
                                                     <input type="text" class="form-control" name="income_name" id="exampleInputText1" value="" placeholder="Enter detail of the income">
                                                  </div>
                                                  <div class="form-group">
                                                     <label for="exampleInputNumber1">Nominal</label>
                                                     <input type="number" class="form-control" name="nominal" id="exampleInputNumber1" value="" placeholder="Enter your total income">
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="exampleInputdate">Date Input</label>
                                                      <input type="date" class="form-control" id="exampleInputdate" name="exampleInputdate" />
                                                  </div>
                                                </div>

                                                <div class="col-sm-6">

                                                <?php
                                                // Fetch categories from the database
                                                $category_query = "SELECT id_category_income, income_category FROM category_income";
                                                $category_result = mysqli_query($connect, $category_query);

                                                if (!$category_result) {
                                                   die("Error fetching categories: " . mysqli_error($connect));
                                                }

                                                $categoryIconMapping = array(
                                                   1 => 'las la-hand-holding-usd',
                                                   2 => 'las la-coins',
                                                   3 => 'las la-money-bill-wave-alt',
                                                   4 => 'las la-business-time'
                                                );

                                                $getCategoryName = array(
                                                1 => 'Wage',
                                                2 => 'Bonus',
                                                3 => 'Investment',
                                                4 => 'Part Time'
                                                );

                                                ?>

                                                   <p>Kategori</p>
                                                   <div class="container">
                                                      <div class="radio-tile-group row mb-3" name="kategori">

                                                         <?php
                                                         // Loop through each category and create radio buttons with icons
                                                         foreach ($category_result as $row) {
                                                               $categoryId = $row['id_category_income'];
                                                               $iconClass = $categoryIconMapping[$categoryId];
                                                               $nameKategori = $getCategoryName[$categoryId];
                                                         ?>
                                                               <div class="col-sm-3 col-md-3 col-lg-3">
                                                                  <div class="input-container">
                                                                     <input id="<?= $categoryId ?>" class="radio-button" type="radio" name="kategori" value="<?= $categoryId ?>" />
                                                                     <div class="radio-tile">
                                                                           <div class="icon wage-icon">
                                                                              <i class="<?= $iconClass ?>" style="font-size: 50px; font-weight: bold; color: #f15773;"></i>
                                                                           </div><br>
                                                                           <label for="<?= $categoryId ?>" class="radio-tile-label"><?= $nameKategori ?></label>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                         <?php } ?>
                                                      </div>
                                                   </div>
                                                   
                                                   <p>Add Image</p>
                                                   <div class="form-group">
                                                      <div class="custom-file" style="border: 2px solid #f15773; border-radius: 5px; padding: 5px;">
                                                         <input type="file" class="custom-file-input" id="customFile" name="photo" accept="image/*" onchange="updateFileName()">
                                                         <label class="custom-file-label" for="customFile">Choose your file</label>
                                                      </div>
                                                   </div>

                                                   <script>
                                                      function updateFileName() {
                                                         var input = document.getElementById('customFile');
                                                         var fileName = input.files[0].name;
                                                         var label = document.querySelector('.custom-file-label');
                                                         label.textContent = fileName;
                                                      }
                                                   </script>

                                                 </div>
                                                </div>
                                                </div>
                                                <div class="modal-footer">
                                                   <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> -->
                                                   <button type="button" class="btn btn-primary" type="submit" name="income-button" id="submit">Save</button>
                                                </div>
                                                
                                               </form>
                                               <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                               </div>
                                            </div>
                                         </div>
                                    </div>
                                    <!-- <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                       <button type="button" class="btn btn-primary" type="submit" name="income-button" id="submit">Save</button>
                                    </div> -->
                                 </div>
                              </div>
                           </div>

                        </div>
                     
                     </div>
                     <div class="iq-card-body">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height-half" style="background-color: transparent; box-shadow: none;">
                        <div class="iq-card-body rounded" style="background-color:#fcefef">
                        <p class="breadcrumb-item"><b>Tuesday, 9 January 2024</b></p>
                        <ul class="task-lists m-0 p-0">
                           <li class="d-flex mb-4 align-items-center">
                              <div class="profile-icon iq-bg-primary"><span>B</span></div>
                              <div class="media-support-info ml-3">
                                 <h6>Biaya Salon</h6>
                                 <p class="mb-0 font-size-12">Gaya Hidup</p>
                              </div>
                              <div class="media-support-info ml-3">
                                 <p class="text-primary mb-0"> + Rp 168.900 </p>
                              </div>
                              <div class="revenue-amount">
                                 <button type="button" class="btn mb-3 btn-primary rounded-pill"><i class="ri-bill-fill"></i>View Image</button>
                              </div>
                           </li> 
                           <li class="d-flex mb-4 align-items-center">
                              <div class="profile-icon iq-bg-info"><span>P</span></div>
                              <div class="media-support-info ml-3">
                                 <h6>Bayar uang PDAM</h6>
                                 <p class="mb-0 font-size-12">Listrik/PDAM</p>
                              </div>
                              <div class="media-support-info ml-3">
                                 <p class="text-primary mb-0"> + Rp 168.900 </p>
                              </div>
                              <div class="revenue-amount">
                                 <button type="button" class="btn mb-3 btn-primary rounded-pill"><i class="ri-bill-fill"></i>View Image</button>
                              </div>
                           </li>
                           <li class="d-flex mb-4 align-items-center">
                              <div class="profile-icon iq-bg-danger"><span>A</span></div>
                              <div class="media-support-info ml-3">
                                 <h6>Makan pagi</h6>
                                 <p class="mb-0 font-size-12">Makanan</p>
                              </div>
                              <div class="media-support-info ml-3">
                                 <p class="text-primary mb-0"> + Rp 168.900 </p>
                              </div>
                              <div class="revenue-amount">
                                 <button type="button" class="btn mb-3 btn-primary rounded-pill"><i class="ri-bill-fill"></i>View Image</button>
                              </div>
                           </li>
                           <li class="d-flex mb-4 align-items-center">
                              <div class="profile-icon iq-bg-success"><span>P</span></div>
                              <div class="media-support-info ml-3">
                                 <h6>Belanja Perlengkapan Sekolah</h6>
                                 <p class="mb-0 font-size-12">Pendidikan</p>
                              </div>
                              <div class="media-support-info ml-3">
                                 <p class="text-primary mb-0"> + Rp 168.900 </p>
                              </div>
                              <div class="revenue-amount">
                                 <button type="button" class="btn mb-3 btn-primary rounded-pill"><i class="ri-bill-fill"></i>View Image</button>
                              </div>
                           </li>
                           <li class="d-flex align-items-center">
                              <div class="profile-icon iq-bg-warning"><span>A</span></div>
                              <div class="media-support-info ml-3">
                                 <h6>Bayar Gojek</h6>
                                 <p class="mb-0 font-size-12">Transportasi</p>
                              </div>
                              <div class="media-support-info ml-3">
                                 <p class="text-primary mb-0"> + Rp 168.900 </p>
                              </div>
                              <div class="revenue-amount">
                                 <button type="button" class="btn mb-3 btn-primary rounded-pill"><i class="ri-bill-fill"></i>View Image</button>
                              </div>
                           </li>                            
                        </ul>
                        </div>
                        </div>

                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height-half" style="background-color: transparent; box-shadow: none;">
                           <div class="iq-card-body rounded" style="background-color:#fcefef">
                           <p class="breadcrumb-item"><b>Friday, 12 January 2024</b></p>
                           <ul class="task-lists m-0 p-0">
                              <li class="d-flex mb-4 align-items-center">
                                 <div class="profile-icon iq-bg-primary"><span>B</span></div>
                                 <div class="media-support-info ml-3">
                                    <h6>Biaya Salon</h6>
                                    <p class="mb-0 font-size-12">Gaya Hidup</p>
                                 </div>
                                 <div class="media-support-info ml-3">
                                    <p class="text-primary mb-0"> + Rp 168.900 </p>
                                 </div>
                                 <div class="revenue-amount">
                                    <button type="button" class="btn mb-3 btn-primary rounded-pill"><i class="ri-bill-fill"></i>View Image</button>
                                 </div>
                              </li> 
                              <li class="d-flex mb-4 align-items-center">
                                 <div class="profile-icon iq-bg-info"><span>P</span></div>
                                 <div class="media-support-info ml-3">
                                    <h6>Bayar uang PDAM</h6>
                                    <p class="mb-0 font-size-12">Listrik/PDAM</p>
                                 </div>
                                 <div class="media-support-info ml-3">
                                    <p class="text-primary mb-0"> + Rp 168.900 </p>
                                 </div>
                                 <div class="revenue-amount">
                                    <button type="button" class="btn mb-3 btn-primary rounded-pill"><i class="ri-bill-fill"></i>View Image</button>
                                 </div>
                              </li>
                              <li class="d-flex mb-4 align-items-center">
                                 <div class="profile-icon iq-bg-danger"><span>A</span></div>
                                 <div class="media-support-info ml-3">
                                    <h6>Makan pagi</h6>
                                    <p class="mb-0 font-size-12">Makanan</p>
                                 </div>
                                 <div class="media-support-info ml-3">
                                    <p class="text-primary mb-0"> + Rp 168.900 </p>
                                 </div>
                                 <div class="revenue-amount">
                                    <button type="button" class="btn mb-3 btn-primary rounded-pill"><i class="ri-bill-fill"></i>View Image</button>
                                 </div>
                              </li>
                              <li class="d-flex mb-4 align-items-center">
                                 <div class="profile-icon iq-bg-success"><span>P</span></div>
                                 <div class="media-support-info ml-3">
                                    <h6>Belanja Perlengkapan Sekolah</h6>
                                    <p class="mb-0 font-size-12">Pendidikan</p>
                                 </div>
                                 <div class="media-support-info ml-3">
                                    <p class="text-primary mb-0"> + Rp 168.900 </p>
                                 </div>
                                 <div class="revenue-amount">
                                    <button type="button" class="btn mb-3 btn-primary rounded-pill"><i class="ri-bill-fill"></i>View Image</button>
                                 </div>
                              </li>
                              <li class="d-flex align-items-center">
                                 <div class="profile-icon iq-bg-warning"><span>A</span></div>
                                 <div class="media-support-info ml-3">
                                    <h6>Bayar Gojek</h6>
                                    <p class="mb-0 font-size-12">Transportasi</p>
                                 </div>
                                 <div class="media-support-info ml-3">
                                    <p class="text-primary mb-0"> + Rp 168.900 </p>
                                 </div>
                                 <div class="revenue-amount">
                                    <button type="button" class="btn mb-3 btn-primary rounded-pill"><i class="ri-bill-fill"></i>View Image</button>
                                 </div>
                              </li>                            
                           </ul>
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
