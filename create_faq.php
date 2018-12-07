<?php include_once dirname(__FILE__).'/includes/config.php'; 

if (empty($_SESSION['userSession']) || $_SESSION['userSession']['IsAdmin'] != 1) {
    header("location:admin_login.php");
    exit();  
}
$page = 'faq';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Page Title -->
        <title>New Parrot Restaurant</title>
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
                         
                            <h2>Create Faq</h2>
                           

                            <form id="faq-create-form" method="post" action="#">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="row">
                                           
                                            <label for="Question" class="col-sm-12 unique">Question
                                                <textarea name="Question" id="Question"></textarea>
                                            </label>
                                            
                                             <label for="Answer" class="col-sm-12 unique">Answer
                                                <textarea name="Answer" id="Answer"></textarea>
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

            <?php include_once dirname(__FILE__).'/resources/templates/admin_footer.php'; ?>
        </div>
    </body>
</html>
