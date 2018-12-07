<?php
include_once dirname(__FILE__) . '/includes/config.php';

if (empty($_SESSION['userSession'])) {
    header("location:login.php");
    exit();
} else {
    $Id = !empty($_GET['id']) ? $_GET['id'] : '';
    if (!empty($Id)) {
        $sql = "SELECT * FROM Orders Where Id='$Id'";
        $result = $pm->run($sql);

        if (count($result) > 0) {
            
        } else {
            echo 'No Order details found';
            exit();
        }

        $OrderId = @$result[0]['Id'];
        $sql = "SELECT * FROM order_items Where OrderId='$OrderId'";
        $order_items_results = $pm->run($sql);
    } else {
        exit();
    }
}
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

            <!-- Booking Section -->
            <section id="booking" class="booking">
                <div class="container text-center">
                    <div class="row">                          
                        <div class="col-lg-6">
                            <h3>prescription</h3>
                            <?php
                            if ($result[0]['IsDelivered'] == 1) {
                                echo 'Order Delivered';
                            } else if ($result[0]['IsConfirmed'] == 1) {
                                echo 'Order Confirmed by you';
                            }
                            ?>
                            <img src="<?php echo $result[0]['prescriptionUrl']; ?>" class="img-responsive">
                        </div>
                        <div class="col-lg-6">
                            <h3>Invoice</h3>
                            <div class="row">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Item</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>

                                    </tr>
                                    <?php
                                    $sum = 0.00;
                                    foreach ($order_items_results as $row) {
                                        $ItemId = $row['ItemId'];
                                        $sql = "SELECT * FROM items i , brands b , generics_name gn , unit_type ut  WHERE i.BrandName= b.Id AND i.GenericName=gn.Id AND i.UnitType=ut.Id AND i.Id='$ItemId'";
                                        $items_results = $pm->run($sql);
                                        $total = $row['Qty'] * $row['Price'];
                                        $sum += $total;
                                        ?>
                                        <tr>
                                            <td><?php echo $items_results[0]['BrandName'] . "<br>" . $items_results[0]['GenericName'] . "<br>" . $items_results[0]['UnitDosage'] . " " . $items_results[0]['UnitType']; ?></td>
                                            <td><?php echo $row['Qty']; ?></td>
                                            <td><?php echo $row['Price'] . " lkr"; ?></td>
                                            <td><?php echo number_format((float) ($total), 2, '.', '') . " lkr"; ?></td>

                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <th colspan="3">Grand Total</th>
                                        <td><?php echo number_format($sum, 2, '.', '') . " lkr"; ?></td>
                                    </tr>
                                </table>
                                <?php if ($result[0]['IsConfirmed'] == 0 && count($order_items_results) > 0) { ?>
                                    <input type="hidden" id="OrderId" value="<?php echo $OrderId; ?>">
                                    <button id="confirm" class="btn btn-success">Confirm</button>
                                <?php } ?>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <?php include_once dirname(__FILE__) . '/resources/templates/footer.php'; ?>
        </div>
        <script type="text/javascript">
            $("#confirm").on("click", function (e) {
                e.preventDefault();
                $.ajax({type: "POST",
                    url: "ajax/confirmOrder.php",
                    data: {id: $('#OrderId').val()},
                    success: function (result) {
                        if (result == '1') {
                            toastr.success('Success');
                            window.setTimeout(function () {
                                window.location.reload()
                            }, 3000);
                        }
                    },
                    error: function (result) {
                        alert('error');
                    }
                });
            });
        </script>
    </body>
</html>
