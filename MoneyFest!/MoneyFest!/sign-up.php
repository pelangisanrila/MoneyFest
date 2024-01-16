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
   <body>
      <!-- loader Start -->
      <div id="loading">
         
      </div>
      <!-- loader END -->
        <!-- Sign in Start -->
        <section class="sign-in-page">
            <div class="container p-0">
                <div class="row no-gutters">
                    <div class="col-sm-12 align-self-center">
                        <div class="sign-in-from bg-white">
                            <h1 class="mb-0">Sign Up</h1>
                            <p>Register your account to achieve your financial goals</p>
                            <form class="mt-4">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">Your Full Name</label>
                                    <input type="email" class="form-control mb-0" id="exampleInputEmail1" placeholder="Your Full Name">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" id="gender" name="gender" placeholder="Your Full Name">
                                        <option value="" disabled selected hidden>Choose your gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="not-specified">Prefer no to say</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail2">Email address</label>
                                    <input type="email" class="form-control mb-0" id="exampleInputEmail2" placeholder="Enter email">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">Username</label>
                                    <input type="email" class="form-control mb-0" id="exampleInputEmail1" placeholder="Create your username">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="exampleInputdate">Birthdate</label>
                                    <input type="date" class="form-control" id="exampleInputdate" name="exampleInputdate" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control mb-0" id="exampleInputPassword1" placeholder="Password">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">Profession</label>
                                    <input type="email" class="form-control mb-0" id="exampleInputEmail1" placeholder="Enter your Profession">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="exampleInputPassword1">Confirm password</label>
                                    <input type="password" class="form-control mb-0" id="exampleInputPassword1" placeholder="Confirm your password">
                                </div>
                            </div>
                                <p>Add Profile Picture</p>
                                <div class="form-group col-sm-8">
                                    <div class="custom-file" style="border: 2px solid #f15773; border-radius: 5px; padding: 5px;">
                                        <input type="file" class="custom-file-input" id="customFile" name="photo" accept="image/*" onchange="updateFileName()">
                                        <label class="custom-file-label" for="customFile">Choose your profile picture</label>
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
                                <div class="d-inline-block w-100">
                                    <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">I accept <a href="#">Terms and Conditions</a></label>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right">Sign Up</button>
                                </div>
                                <div class="sign-info">
                                    <span class="dark-color d-inline-block line-height-2">Already Have Account ? <a href="index.php">Log In</a></span>
                                    <ul class="iq-social-media">
                                        <li><a href="#"><i class="ri-facebook-box-line"></i></a></li>
                                        <li><a href="#"><i class="ri-twitter-line"></i></a></li>
                                        <li><a href="#"><i class="ri-instagram-line"></i></a></li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Sign in END -->
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
      <!-- Chart Custom JavaScript -->
      <script src="js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="js/custom.js"></script>
   </body>
</html>