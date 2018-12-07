<?php include_once dirname(__FILE__).'/includes/config.php'; 

if (!empty($_SESSION['userSession']) && @$_SESSION['userSession']['IsAdmin'] == 1) {
    header("location:admin_dashboard.php");
    exit();
}elseif (!empty ($_SESSION['userSession']) && $_SESSION['userSession']['IsStaff'] == 1) {
    header("location:staff_dashboard.php");
    exit();
}elseif(!empty ($_SESSION['userSession']) && $_SESSION['userSession']['IsUser'] == 1){
    header("location:dashboard.php");
    exit();
}
$page = 'index';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Page Title -->
        <title><?php echo WEBSITE_NAME; ?></title>
        <?php include_once dirname(__FILE__).'/resources/templates/header.php'; ?>
    </head>

    <body>
        <div class="page-holder">
            <?php include_once dirname(__FILE__).'/resources/templates/navbar.php'; ?>
            <!-- Hero Section -->
            <section id="hero" class="hero">
                <div id="slider" class="sl-slider-wrapper">

                    <div class="sl-slider">
                        <!-- slide -->
                        <div class="sl-slide bg-1" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                            <div class="sl-slide-inner" style="background-image: url(img/computer-3343887_1280.jpg);">
                                <div class="container">
                                    <h2><span class="text-primary"><?php echo WEBSITE_NAME; ?></span></h2>
                                </div>
                            </div>
                        </div>
                        <!-- slide -->
                        <div class="sl-slide bg-2" data-orientation="vertical" data-slice1-rotation="10" data-slice2-rotation="-15" data-slice1-scale="1.5" data-slice2-scale="1.5">
                            <div class="sl-slide-inner" style="background-image: url(img/hand-2308932_1280.jpg);">
                                <div class="container">
                                     <h2><span class="text-primary"><?php echo WEBSITE_NAME; ?></span></h2>
                                </div>
                            </div>
                        </div>
                    </div><!-- End sl-slider -->

                    <!-- slider pagination -->
                    <nav id="nav-dots" class="nav-dots">
                        <span class="nav-dot-current"></span>
                        <span></span>
                        <span></span>
                    </nav>

                    <!-- scroll down btn -->
                    <a id="scroll-down" href="#about" class="hidden-xs"></a>

                    <!-- social icons menu -->
                    <div class="social">
                        <div class="wrapper">
                            <ul class="list-unstyled">
                                <li><a href="#" title="facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" title="twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" title="pinterest" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="#" title="instagram" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                            <span>Follow us on</span>
                        </div>
                    </div>
                </div><!-- End slider-wrapper -->
            </section>
            <!-- End Hero Section -->



            <!-- Details -->
            <section id="details" class="details">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="heading text-center">
                                <p>Call Us Now</p>
                               
                            </div>
                            <a href="tel:9870988764" class="phone">000 0000000</a>
                        </div>

                        <div class="col-sm-6">
                            <div class="heading text-center">
                                <p>Check Our Clients'</p>
                                <h5>Reviews</h5>
                            </div>
                            <a href="feedback.php" class="reviews btn-unique"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Details-->


            <!-- About Section -->
            <section id="about" class="about">
                <div class="container text-center">
                    <header>
                        <h2>About Pharmacy</h2>
                        <h3>Check our story</h3>
                    </header>
                    <p class="lead"> </p>
                </div>
            </section>
            <!-- End About Section -->


            <!-- Services Section -->
            <section id="services" class="services">
                <div class="container text-center">
                    <header>
                        <h2>We provide the following</h2>
                        <h3>Our Specialities</h3>
                    </header>

                    <div class="row">
                        <!-- item -->
                        <div class="col-sm-4 service">
                            <div class="icon">
                                <i class="icon-like"></i>
                            </div>
                            <div class="text">
                                <h4></h4>
                                
                            </div>
                        </div>

                        <!-- item -->
                        <div class="col-sm-4 service">
                            <div class="icon">
                                <i class="icon-hat"></i>
                            </div>
                            <div class="text">
                                <h4></h4>
                                
                            </div>
                        </div>

                        <!-- item -->
                        <div class="col-sm-4 service">
                            <div class="icon">
                                <i class="icon-plate"></i>
                            </div>
                            <div class="text">
                                <h4></h4>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Services Section -->
  
            <section id="feedback" class="contact">
                <div id="map"></div>
                <div class="container text-center">
                    <div class="form-holder">
                        <header>
                            <h2>Feedback</h2>
                            <h3></h3>
                        </header>

                        <form method="post" action="#" id="feedback-form">
                            <div class="row">
                                <label for="user-name" class="col-sm-6 unique">Name
                                    <input type="text" name="username" id="user-name" required autocomplete="off">
                                </label>
                                <label for="user-email" class="col-sm-6 unique">Email
                                    <input type="email" name="useremail" id="user-email" required>
                                </label>
                                <label for="message" class="col-sm-12 unique">Your Feedback
                                    <textarea name="message" id="message" required></textarea>
                                </label>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn-unique" id="submit">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <!-- End Booking Section -->
            <?php include_once dirname(__FILE__).'/resources/templates/footer.php'; ?>
        </div>
    </body>
</html>
