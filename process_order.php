<?php
include_once dirname(__FILE__) . '/includes/config.php';

if (empty($_SESSION['userSession'])) {
    header("location:login.php");
    exit();
} else {
    $Id = !empty($_GET['id']) ? base64_decode($_GET['id'].SALT) : '';
    if (!empty($Id)) {
        $PharmacyID = $_SESSION['userSession']['PharmacyID'];
        $sql = "SELECT * FROM Orders Where PharmacyID='$PharmacyID' AND Id='$Id'";
        $result = $pm->run($sql);

        if (count($result) == 0) {
            header("location:error.php");
        }

        $OrderId = @$result[0]['Id'];
        $sql = "SELECT * FROM order_items Where OrderId='$OrderId'";
        $order_items_results = $pm->run($sql);
    }

    $sql = "SELECT * ,i.id as ItemID FROM items i , brands b , generics_name gn , unit_type ut  WHERE i.BrandName= b.Id AND i.GenericName=gn.Id AND i.UnitType=ut.Id AND i.PharmacyID='$PharmacyID'";
    $items_results = $pm->run($sql);

    function fill_unit_select_box($items_results) {
        $output = '';

        foreach ($items_results as $row) {
            $output .= '<option value="' . $row["ItemID"] . '">' . $row["BrandName"] . " / " . $row["GenericName"] . " / " . $row["UnitDosage"] . " " . $row["UnitType"] . '</option>';
        }
        return $output;
    }

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Page Title -->
        <title><?php echo WEBSITE_NAME; ?></title>
        <?php include_once dirname(__FILE__) . '/resources/templates/pharmacy_header.php'; ?>
    </head>
    <body>

        <div class="page-holder">
            <?php include_once dirname(__FILE__) . '/resources/templates/pharmacy_navbar.php'; ?>

            <!-- Booking Section -->
            <section id="booking" class="booking">
                <div class="container text-center">
                    <div class="row">                          
                        <div class="col-lg-6">
                            <h3>prescription</h3><?php
                            if ($result[0]['IsDelivered'] == 1) {
                                echo 'Order Delivered';
                            }else if ($result[0]['IsConfirmed'] == 1){
                                echo 'Order Confirmed by customer';
                            }
                            ?>
                            <img src="<?php echo $result[0]['prescriptionUrl']; ?>" class="img-responsive">
                        </div>
                        <div class="col-lg-6">
                            <?php if (count($order_items_results) > 0) { ?>
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
                                <?php if ($result[0]['IsConfirmed'] == 1 && $result[0]['IsDelivered'] == 0) { ?> 
                                    <form id="deliveredForm">
                                        <input type="hidden" name="DOrderId" value="<?php echo ($result[0]['Id']); ?>">
                                        <button type="submit" id="delivered" class="btn btn-success">Delivered</button>
                                    </form>


                                <?php } ?>
                            <?php } ?>
                        </div>


                    </div>
                    <?php if ($result[0]['IsConfirmed'] == 0 && count($order_items_results) == 0) { ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Add Price Details</h3>
                                <div class="container">

                                    <div class="form-group">
                                        <form method="post" id="insert_form">
                                            <div class="table-repsonsive">
                                                <span id="error"></span>
                                                <table class="table table-bordered" id="item_table">
                                                    <tr>
                                                        <th>Select Unit</th>
                                                        <th>Enter Quantity</th>
                                                        <th>Enter Price Per Quantity</th>

                                                        <th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
                                                    </tr>
                                                </table>
                                                <div align="center">
                                                    <input type="hidden" name="OrderId" value="<?php echo $result[0]['Id']; ?>">
                                                    <input type="submit" name="submit" class="btn btn-info" value="Insert" />
                                                </div>
                                            </div>
                                        </form>
                                    </div> 
                                </div>

                            </div>
                        </div>
                    <?php } ?>
                </div>
            </section>
            <!-- End Booking Section -->

            <?php include_once dirname(__FILE__) . '/resources/templates/footer.php'; ?>
        </div>
        <script>
            $(document).ready(function () {

                $("#deliveredForm").submit(function (e) {
                    var form = $(this);
                    $.ajax({
                        type: "POST",
                        url: 'ajax/setDelivered.php',
                        data: form.serialize(), // serializes the form's elements.
                        success: function (data) {
                            if (data == '1') {
                                toastr.success('Updated successfully');
                                setTimeout(function () {
                                    location.reload();
                                }, 2000);
                            }
                        }
                    });

                    e.preventDefault(); // avoid to execute the actual submit of the form.
                });

<?php if ($result[0]['IsConfirmed'] == 0 && count($order_items_results) == 0) { ?>

                    $('.add').on('click', function () {
                        var html = '';
                        html += '<tr>';
                        html += '<td><select name="item_unit[]" class="form-control item_unit"><option value="">Select Unit</option><?php echo fill_unit_select_box($items_results); ?></select></td>';

                        html += '<td><input type="text" name="item_quantity[]" class="form-control item_quantity" /></td>';
                        html += '<td><input type="text" name="item_name[]" class="form-control item_name" /></td>';
                        html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
                        $('#item_table').append(html);
                    });

                    $(document).on('click', '.remove', function () {
                        $(this).closest('tr').remove();
                    });

                    $('#insert_form').on('submit', function (event) {
                        event.preventDefault();
                        var error = '';
                        $('.item_name').each(function () {
                            var count = 1;
                            if ($(this).val() == '')
                            {
                                error += "<p>Enter Item Name at " + count + " Row</p>";
                                return false;
                            }
                            count = count + 1;
                        });

                        $('.item_quantity').each(function () {
                            var count = 1;
                            if ($(this).val() == '')
                            {
                                error += "<p>Enter Item Quantity at " + count + " Row</p>";
                                return false;
                            }
                            count = count + 1;
                        });

                        $('.item_unit').each(function () {
                            var count = 1;
                            if ($(this).val() == '')
                            {
                                error += "<p>Select Unit at " + count + " Row</p>";
                                return false;
                            }
                            count = count + 1;
                        });
                        var form_data = $(this).serialize();
                        if (error == '')
                        {
                            $.ajax({
                                url: "ajax/addOrder.php",
                                method: "POST",
                                data: form_data,
                                success: function (data)
                                {
                                    if (data == 'ok')
                                    {
                                        $('#item_table').find("tr:gt(0)").remove();
                                        $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
                                        location.reload();
                                    }
                                }
                            });
                        } else
                        {
                            $('#error').html('<div class="alert alert-danger">' + error + '</div>');
                        }
                    });
<?php } ?>
            });
        </script>

    </body>
</html>
