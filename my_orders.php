<?php
include_once dirname(__FILE__) . '/includes/config.php';

if (@$_SESSION['userSession']['IsUser'] != 1) {
    header("location:login.php");
    exit();
}

$UserID = $_SESSION['userSession']['UserID'];

$sql = "SELECT * FROM Orders o , pharmacy p Where o.UserId='$UserID' AND o.PharmacyID = p.PharmacyID";
$results = $pm->run($sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Page Title -->
        <title><?php echo WEBSITE_NAME; ?></title>
        <?php include_once dirname(__FILE__) . '/resources/templates/header.php'; ?>
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
            <?php include_once dirname(__FILE__) . '/resources/templates/navbar.php'; ?>


            <!-- Menu Section -->
            <section id="menu" class="menu">
                <div class="container">
                    <header class="text-center">
                        <h2>My Orders</h2>
                    </header>

                    <div class="menu">
                        <div class="row">
                            <table id="menu_datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Order Date</th>
                                        <th>Prescription</th>
                                        <th>Pharmacy</th>
                                        <th>Invoice Status</th>
                                        <th>Is Confirmed</th>
                                        <th>Is Delivered</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($results as $row) {
                                        $OrderId = $row['Id'];
                                        $sql = "SELECT * FROM order_items Where OrderId='$OrderId'";
                                        $order_items_results = $pm->run($sql);
                                        ?>
                                        <tr>
                                            <td><?php echo $OrderId; ?></td>
                                            <td><?php echo $row['Created']; ?></td>
                                            <td><img src="<?php echo $row['prescriptionUrl']; ?>" width="20%"></td>
                                            <td><?php echo $row['PharmacyName']; ?></td>
                                            <td><?php echo count($order_items_results) > 0 ? 'Created' : 'In Progress'; ?></td>
                                            <td><?php echo ($row['IsConfirmed'] == 0) ? 'No' : 'Yes'; ?></td>
                                            <td><?php echo ($row['IsDelivered'] == 0) ? 'No' : 'Yes'; ?></td>
                                            <td><a href="view_orders.php?id=<?php echo $row['Id']; ?>">View</a></td>
                                        </tr>
                                    <?php } ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Menu Section -->

<?php include_once dirname(__FILE__) . '/resources/templates/footer.php'; ?>

        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#menu_datatable').DataTable();
            });
        </script>
    </body>
</html>
