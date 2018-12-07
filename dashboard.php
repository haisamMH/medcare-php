<?php
include_once dirname(__FILE__) . '/includes/config.php';

if (@$_SESSION['userSession']['IsUser'] != 1) {
    header("location:login.php");
    exit();  
}
$sql = "SELECT * FROM pharmacy";
$pharmacy_results = $pm->run($sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Page Title -->
        <title>Dashboard | <?php echo WEBSITE_NAME; ?></title>
        <?php include_once dirname(__FILE__) . '/resources/templates/header.php'; ?>
    </head>
    <body>

        <div class="page-holder">
            <?php include_once dirname(__FILE__) . '/resources/templates/navbar.php'; ?>

            <!-- Booking Section -->
            <section id="booking" class="booking">
                <div class="container text-center">
                    <div class="row">
                        <div class="form-holder col-md-10 col-md-push-1 text-center">
                            <div class="ribbon">
                                <i class="fa fa-star"></i>
                            </div>

                            <h2>Order Online</h2>
                           
                            <form method="post" action="controller/uploadImage.php" enctype='multipart/form-data'>
                                <div class="row">
                                    <div class="col-md-10">
                                         <label for="BrandName" class="col-sm-6 unique">Select Pharmacy
                                             <select name="PharmacyID" id="PharmacyID" class="form-control" required="">
                                                     <option></option>
                                                     <?php foreach($pharmacy_results as $row) { ?>
                                                     <option value="<?php echo $row['PharmacyID']; ?>"><?php echo $row['PharmacyName']; ?></option>
                                                     <?php } ?>
                                                 </select>
                                            </label>
                                            
                                        <div class="row">
                                            <label for="Prescription" class="col-sm-12 unique">Upload Prescription Image 
                                                <input type="file" name="file" id="file" required autocomplete="off">
                                            </label>
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn-unique">Upload</button> 
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

            <?php include_once dirname(__FILE__) . '/resources/templates/footer.php'; ?>
        </div>
    </body>
</html>
