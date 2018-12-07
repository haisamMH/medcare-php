<?php
include_once dirname(__FILE__) . '/includes/config.php';

if (empty($_SESSION['userSession']) || $_SESSION['userSession']['IsStaff'] != 1) {
    header("location:staff_login.php");
    exit();
}
$page = 'brandsAndGenerics';
$PharmacyID = $_SESSION['userSession']['PharmacyID'];
$sql = "SELECT * FROM brands";
$brand_results = $pm->run($sql);

$sql = "SELECT * FROM generics_name";
$generics_results = $pm->run($sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Page Title -->
        <title><?php echo WEBSITE_NAME; ?></title>
        <?php include_once dirname(__FILE__) . '/resources/templates/admin_header.php'; ?>
    </head>
    <style type="text/css">
        .badge{
            background-color: #b16302;
        }
        p.before{
            text-decoration: line-through;
        }
        .menu_img {
            width: 50%;
            max-width: 100px;
            margin: 0 auto;
        }
    </style>

    <body>

        <div class="page-holder">
            <?php include_once dirname(__FILE__) . '/resources/templates/pharmacy_navbar.php'; ?>


            <!-- Menu Section -->
            <section id="menu" class="menu">
                <div class="container">
                    <header class="text-center">
                        <h2>Product Management </h2>
                    </header>
                    <div class="row">
                        <a href="add_brand.php"><button class="btn btn-success">Add Brand</button></a>
                        <a href="add_generic.php"><button class="btn btn-success">Add Generic</button></a>
                        <hr>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <table id="brand_datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Brand Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($brand_results as $row) { ?>
                                    <tr>
                                            <td><?php echo $row['BrandName']; ?></td>
                                        </tr>
                                    <?php } ?> 
                                </tbody>
                            </table>
                        </div>
                         <div class="col-md-6">
                            <table id="generic_datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Generic Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($generics_results as $row) { ?>
                                    <tr>
                                            <td><?php echo $row['GenericName']; ?></td>
                                        </tr>
                                    <?php } ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Menu Section -->

            <?php include_once dirname(__FILE__) . '/resources/templates/admin_footer.php'; ?>

        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#brand_datatable').DataTable();
                 $('#generic_datatable').DataTable();
            });
        </script>
    </body>
</html>
