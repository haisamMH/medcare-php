<?php
include_once dirname(__FILE__) . '/includes/config.php';

if (empty($_SESSION['userSession']) || $_SESSION['userSession']['IsStaff'] != 1) {
    header("location:staff_login.php");
    exit();
}
$page = 'products';
$PharmacyID = $_SESSION['userSession']['PharmacyID'];
$sql = "SELECT *,i.Id as ItemID FROM items i , brands b , generics_name gn , unit_type ut  WHERE i.BrandName= b.Id AND i.GenericName=gn.Id AND i.UnitType=ut.Id AND i.PharmacyID='$PharmacyID'";

$results = $pm->run($sql);
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
                        <a href="create_item.php"><button class="btn btn-success">Add Product</button></a>
                        <hr>
                    </div>

                    <div class="menu">
                        <div class="row">
                            <table id="menu_datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Item ID</th>
                                        <th>Brand Name</th>
                                        <th>Generic Name</th>
                                        <th>Dosage</th>
                                        <th>Special Notes</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($results as $row) { ?>
                                        <tr>
                                            <td><?php echo $row['ItemID']; ?></td>
                                            <td><?php echo $row['BrandName']; ?></td>
                                            <td><?php echo $row['GenericName']; ?></td>
                                            <td><?php echo $row['UnitDosage'] . " " . $row['UnitType']; ?></td>
                                            <td><?php echo $row['SpecialInstruction']; ?></td>
                                            <td><a href="edit_item.php?id=<?php echo $row['ItemID']; ?>">Edit</a></td></tr>
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
                $('#menu_datatable').DataTable();
            });
        </script>
    </body>
</html>
