<?php
include_once dirname(__FILE__) . '/includes/config.php';

if (empty($_SESSION['userSession']) || $_SESSION['userSession']['IsStaff'] != 1) {
    header("location:staff_login.php");
    exit();
}
$page = 'orders';
$PharmacyID = $_SESSION['userSession']['PharmacyID'];
$sql = "SELECT * FROM Orders Where PharmacyID='$PharmacyID'";
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
                        <h2>Orders Management </h2>
                    </header>

                    <div class="menu">
                        <div class="row">
                            <table id="menu_datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Order Date</th>
                                        <th>prescription</th>
                                        <th>Status</th>
                                        <th>Is Delivered</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php foreach ($results as $row) { ?>
                                        <tr>
                                            <td><?php echo $row['Id']; ?></td>
                                            <td><?php echo $row['Created']; ?></td>
                                            <td><a class="example-image-link" href="<?php echo $row['prescriptionUrl']; ?>" data-lightbox="example-1"><img class="example-image" src="<?php echo $row['prescriptionUrl']; ?>" alt="image-1" width="20%"/></a></td>
                                            <td><?php echo ($row['IsConfirmed'] == 0) ? 'In Progress' : 'Confirmed'; ?></td>
                                            <td><?php echo ($row['IsDelivered'] == 0) ? '<span class="label label-danger">No</span>' : '<span class="label label-success">Yes</span>'; ?></td>
                                            <td><a href="process_order.php?id=<?php echo base64_encode($row['Id'].SALT); ?>">View</a></td></tr>
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
