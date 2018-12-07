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
            <?php include_once dirname(__FILE__) . '/resources/templates/navbar.php'; ?>


            <!-- Menu Section -->
            <section id="menu" class="menu">
                <div class="container">
                    <header class="text-center">
                        <h2>FAQ</h2>
                    </header>


                    <div class="menu">
                        <div class="row">

                            <div class="container ">
                                <div class="panel-group" id="faqAccordion">
                                    <?php foreach($results as $key => $row) { ?>
                                    <div class="panel panel-default ">
                                        <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question<?php echo $key; ?>">
                                            <h4 class="panel-title">
                                                <a href="#" class="ing">Q: <?php echo $row['Question']; ?></a>
                                            </h4>

                                        </div>
                                        <div id="question<?php echo $key; ?>" class="panel-collapse collapse" style="height: 0px;">
                                            <div class="panel-body">
                                              
                                                <p><?php echo $row['Answer']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div> 
                                    <?php } ?>
                                </div>
                                <!--/panel-group-->
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
