<?php include_once dirname(__FILE__).'/includes/config.php'; 

if (empty($_SESSION['userSession']) || $_SESSION['userSession']['IsAdmin'] != 1) {
    header("location:admin_login.php");
    exit();  
}

$id = !empty($_GET['id']) ? ($_GET['id']) : null;

$sql = "SELECT * FROM pharmacy  WHERE PharmacyID=:PharmacyID";
$param = array(":PharmacyID"=> $id);
$results = $pm->run($sql,$param);
if(count($results) == 0){
    header("location:error.php");
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

                            <h2>Edit Pharmacy</h2>
                        
                            <form id="pharmacy-edit-form" method="post" action="#">
                                <div class="row">
                                    <div class="col-md-10 col-md-push-1">
                                        <div class="row">
                                             <label for="PharmacyName" class="col-sm-6 unique">Pharmacy Name
                                                 <input name="PharmacyName" type="text" id="PharmacyName" required autocomplete="off" value="<?php echo $results[0]['PharmacyName']; ?>">
                                            </label>
                                            <input type="hidden" name="id" value="<?php echo $results[0]['PharmacyID']; ?>">
                                             <label for="title" class="col-sm-6 unique">User Title
                                                 <select name="title" id="title" required class="form-control">
                                                     <option></option>
                                                     <option value="Mr" <?php echo $results[0]['UserTitle'] == 'Mr' ? 'selected' : '' ?>>Mr</option>
                                                     <option value="Mrs" <?php echo $results[0]['UserTitle'] == 'Mrs' ? 'selected' : '' ?>>Mrs</option>
                                                     <option value="Miss" <?php echo $results[0]['UserTitle'] == 'Miss' ? 'selected' : '' ?>>Miss</option>
                                                     <option value="Dr" <?php echo $results[0]['UserTitle'] == 'Dr' ? 'selected' : '' ?>>Dr</option>
                                                     <option value="Rev" <?php echo $results[0]['UserTitle'] == 'Rev' ? 'selected' : '' ?>>Rev</option>
                                                     
                                                 </select>
                                            </label>
                                            <label for="name" class="col-sm-6 unique">User Name
                                                <input name="name" type="text" id="name" required autocomplete="off" value="<?php echo $results[0]['UserName']; ?>">
                                            </label>
                                            <label for="email" class="col-sm-6 unique">Email
                                                <input name="email" type="email" id="email" required autocomplete="off" value="<?php echo $results[0]['UserEmail']; ?>">
                                            </label>
                                            <label for="number" class="col-sm-6 unique">Phone Number
                                                <input name="number" type="number" id="number" required autocomplete="off" maxlength="10" value="<?php echo $results[0]['UserPhone']; ?>">
                                            </label>
                         
                                            <label for="address" class="col-sm-12 unique">Address
                                                <textarea id="address" name="address" required><?php echo $results[0]['UserAddress']; ?></textarea>
                                            </label>
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn-unique">Update</button>
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
