<?php include_once dirname(__FILE__).'/includes/config.php'; 

if (empty($_SESSION['userSession']) || $_SESSION['userSession']['IsAdmin'] != 1) {
    header("location:admin_login.php");
    exit();  
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Page Title -->
        <title><?php echo WEBSITE_NAME; ?></title>
        <?php include_once dirname(__FILE__).'/resources/templates/admin_header.php'; ?>
    </head>
    <body>

        <div class="page-holder">
            <?php include_once dirname(__FILE__).'/resources/templates/admin_navbar.php'; ?>

            <!-- Booking Section -->
            <section id="booking" class="booking">
                <div class="container text-center">
                    <div class="row">
                        <div class="form-holder col-md-10 col-md-push-1 text-center">
                            <div class="ribbon">
                                <i class="fa fa-star"></i>
                            </div>

                            <h2>Create Pharmacy</h2>
                        
                            <form id="pharmacy-signup-form" method="post" action="#">
                                <div class="row">
                                    <div class="col-md-10 col-md-push-1">
                                        <div class="row">
                                             <label for="PharmacyName" class="col-sm-6 unique">Pharmacy Name
                                                <input name="PharmacyName" type="text" id="PharmacyName" required autocomplete="off">
                                            </label>
                                             <label for="title" class="col-sm-6 unique">User Title
                                                 <select name="title" id="title" required class="form-control">
                                                     <option></option>
                                                     <option value="Mr">Mr</option>
                                                     <option value="Mrs">Mrs</option>
                                                     <option value="Miss">Miss</option>
                                                     <option value="Dr">Dr</option>
                                                     <option value="Rev">Rev</option>
                                                     <option value="Ms">Ms</option>
                                                 </select>
                                            </label>
                                            <label for="name" class="col-sm-6 unique">Name
                                                <input name="name" type="text" id="name" required autocomplete="off">
                                            </label>
                                            <label for="email" class="col-sm-6 unique">Email
                                                <input name="email" type="email" id="email" required autocomplete="off">
                                            </label>
                                            <label for="number" class="col-sm-6 unique">Phone Number
                                                <input name="number" type="number" id="number" required autocomplete="off" maxlength="10">
                                            </label>
                                            <label for="password" class="col-sm-6 unique">Password
                                                <input name="password" type="password" id="password" required>
                                            </label>
                                            <label for="password_confirm " class="col-sm-6 unique">Password Confirm 
                                                <input name="password_confirm" type="password" id="password_confirm" required autocomplete="off">
                                            </label>
                                            <label for="address" class="col-sm-12 unique">Address
                                                <textarea id="address" name="address" required></textarea>
                                            </label>
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn-unique">Create</button>
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
