<?php
include_once dirname(__FILE__) . '/includes/config.php';
$sql = "SELECT * FROM feedback";
$results = $pm->run($sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Page Title -->
        <title><?php echo WEBSITE_NAME; ?></title>
        <?php include_once dirname(__FILE__) . '/resources/templates/header.php'; ?>
    </head>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,200italic);
        body {
  background: #eee;
  font-family: 'Source Sans Pro', sans-serif;
  font-weight: 300;
}

/*.container {
  max-width: 800px;
  margin:10px auto;
}*/

.text-center {
  text-align: center;
}

.quote-card {
  background: #fff;
  color: #222222;
  padding: 20px;
  padding-left: 50px;
  box-sizing: border-box;
  box-shadow: 0 2px 4px rgba(34, 34, 34, 0.12);
  position: relative;
  overflow: hidden;
  min-height: 120px;
}
.quote-card p {
  font-size: 22px;
  line-height: 1.5;
  margin: 0;
  max-width: 80%;
}
.quote-card cite {
  font-size: 16px;
  margin-top: 10px;
  display: block;
  font-weight: 200;
  opacity: 0.8;
}
.quote-card:before {
  font-family: Georgia, serif;
  content: "“";
  position: absolute;
  top: 10px;
  left: 10px;
  font-size: 5em;
  color: rgba(238, 238, 238, 0.8);
  font-weight: normal;
}
.quote-card:after {
  font-family: Georgia, serif;
  content: "”";
  position: absolute;
  bottom: -110px;
  line-height: 100px;
  right: -32px;
  font-size: 25em;
  color: rgba(238, 238, 238, 0.8);
  font-weight: normal;
}
@media (max-width: 640px) {
  .quote-card:after {
    font-size: 22em;
    right: -25px;
  }
}

    </style>
    <body>

        <div class="page-holder">
            <?php include_once dirname(__FILE__) . '/resources/templates/navbar.php'; ?>


            <!-- Menu Section -->
            <section id="menu" class="menu">
                <div class="container">
                    <header class="text-center">
                        <h2>Customer Reviews</h2>
                    </header>


                    <div class="menu">
                        <div class="row">

                            <div class="container ">
                                <div class="panel-group" id="faqAccordion">
                                    <?php foreach ($results as $row) { ?>
                                        <blockquote class="quote-card">
                                            <p>
                                               <?php echo $row['Feedback']; ?>
                                            </p>

                                            <cite>
                                                <?php echo $row['UserName']; ?>
                                            </cite>
                                        </blockquote>
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
