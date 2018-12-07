<?php
include_once dirname(__FILE__) . '/includes/config.php';
$sql = "SELECT * FROM faq";
$results = $pm->run($sql);

$page = 'faq';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Page Title -->
        <title><?php echo WEBSITE_NAME; ?></title>
        <?php include_once dirname(__FILE__) . '/resources/templates/header.php'; ?>
    </head>

    <body>

        <div class="page-holder">



            <!-- Menu Section -->
            <section id="menu" class="menu">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="error-template">
                                <h1>
                                    Oops!</h1>
                                <h2>
                                    404 Not Found</h2>
                                <div class="error-details">
                                    Sorry, an error has occured, Requested page not found!
                                </div>
                                <div class="error-actions">
                                    <a href="index.php" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                                        Take Me Home </a><a href="" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-envelope"></span> Contact Support </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <!-- End Menu Section -->

            <?php include_once dirname(__FILE__) . '/resources/templates/footer.php'; ?>

        </div>
    </body>
</html>
