<?php include_once dirname(__FILE__).'/includes/config.php'; 

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

            <!-- Booking Section -->
            <section id="booking" class="booking">
                <div class="container text-center">

                    <div class="row">
                        <div class="form-holder col-md-10 col-md-push-1 text-center">
                            <div class="ribbon">
                                <i class="fa fa-star"></i>
                            </div>

                            <h2>MEMBER LOGIN</h2>
                            <h3>PLEASE ENTER YOUR LOGIN DETAILS TO PROCEED</h3>

                            <form id="login-form" method="post" action="#">
                                <div class="row">
                                    <div class="col-md-10 col-md-push-1">
                                        <div class="row">
                                           
                                            <label for="email" class="col-sm-6 unique">Email
                                                <input name="email" type="email" id="email" required>
                                            </label>
                                            
                                            <label for="password" class="col-sm-6 unique">Password
                                                <input name="password" type="password" id="password" required>
                                            </label>
                                            
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn-unique">Login</button>  <br><button type="submit" class="btn-unique" id="btn-reg">Become a member</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Booking Section -->

            <?php include_once dirname(__FILE__).'/resources/templates/footer.php'; ?>
        </div>
    </body>
</html>
