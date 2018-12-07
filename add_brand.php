<?php include_once dirname(__FILE__).'/includes/config.php'; 

if (empty($_SESSION['userSession']) || $_SESSION['userSession']['IsStaff'] != 1) {
    header("location:staff_login.php");
    exit();  
}
$page = 'brandsAndGenerics';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Page Title -->
        <title><?php echo WEBSITE_NAME; ?></title>
        <?php include_once dirname(__FILE__).'/resources/templates/pharmacy_header.php'; ?>
    </head>
    <body>

        <div class="page-holder">
            <?php include_once dirname(__FILE__).'/resources/templates/pharmacy_navbar.php'; ?>

            <!-- Booking Section -->
            <section id="booking" class="booking">
                <div class="container text-center">

                    <div class="row">
                        <div class="form-holder col-md-10 col-md-push-1 text-center">
                         
                            <h2>Add Brand Name</h2>
                           

                            <form id="brand-add-form" method="post" action="#">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="row">
                                           
                                            <label for="BrandName" class="col-sm-12 unique">Brand Name
                                                <input name="BrandName" id="BrandName">
                                            </label>
                                             
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn-unique">Add</button> 
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

            <?php include_once dirname(__FILE__).'/resources/templates/admin_footer.php'; ?>
        </div>
    </body>
</html>
