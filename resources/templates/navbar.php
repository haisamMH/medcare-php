<!-- Navbar -->
<header class="header">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header"><a href="index.php" class="navbar-brand">MedCare</a>
                <div class="navbar-buttons">
                    <button type="button" data-toggle="collapse" data-target=".navbar-collapse" class="navbar-toggle navbar-btn">Menu<i class="fa fa-align-justify"></i></button>
                </div>
            </div>
            <div id="navigation" class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">
                    <?php if($page == 'index'){ ?>
                    <li class="active"><a href="#hero">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
            
                    <li><a href="#feedback">Feedback</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                    <?php } else { ?>
                  
                    <?php } ?>
                </ul>
                <a href="dashboard.php" class="btn navbar-btn btn-default hidden-sm hidden-xs" id="">Order Online</a>
                <?php if (!empty($_SESSION['userSession'])) { ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="my_orders.php">My Orders</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION['userSession']['UserName']; ?></a></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                       
                    </ul>
                <?php } ?>
            </div>
        </div>
    </nav>
</header><!-- End Navbar -->