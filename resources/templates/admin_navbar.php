<!-- Navbar -->
<header class="header">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header"><a href="index.php" class="navbar-brand"><?php echo WEBSITE_NAME; ?></a>
                <div class="navbar-buttons">
                    <button type="button" data-toggle="collapse" data-target=".navbar-collapse" class="navbar-toggle navbar-btn">Menu<i class="fa fa-align-justify"></i></button>
                </div>
            </div>
            <div id="navigation" class="collapse navbar-collapse navbar-right">


                <?php if (!empty($_SESSION['userSession'])) { ?>
                    <ul class="nav navbar-nav">


                        <li class="<?php
                        if (isset($page) && $page == 'menu') {
                            echo ' active ';
                        }
                        ?>"><a href="admin_dashboard.php">Pharmacy Management</a></li>


                        <li class="<?php
                        if (isset($page) && $page == 'faq') {
                            echo ' active ';
                        }
                        ?>"><a href="faq_management.php">FAQ Management</a></li>

                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION['userSession']['UserName']; ?></a></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>

                    </ul>
<?php } ?>
            </div>
        </div>
    </nav>
</header><!-- End Navbar -->