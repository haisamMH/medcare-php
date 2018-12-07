<?php
include_once dirname(__FILE__) . '/includes/config.php';

if (empty($_SESSION['userSession']) || $_SESSION['userSession']['IsAdmin'] != 1) {
    header("location:admin_login.php");
    exit();  
}
$page = 'menu';
$sql = "SELECT * FROM pharmacy";
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
            <?php include_once dirname(__FILE__) . '/resources/templates/admin_navbar.php'; ?>


            <!-- Menu Section -->
            <section id="menu" class="menu">
                <div class="container">
                    <header class="text-center">
                        <h2>Pharmacy Management</h2>
                    </header>
                    <div class="row">
                        <a href="create_pharmacy.php"><button class="btn btn-success">Create Pharmacy</button></a>
                          <hr>
                    </div>
                     
                    <div class="menu">
                        <div class="row">
                           
                            <table id="menu_datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($results as $row) { ?>
                                    <tr>
                                        <td><?php echo $row['PharmacyName']; ?></td>
                                        <td><?php echo $row['UserTitle'].' '.$row['UserName']; ?></td>
                                        <td><?php echo $row['UserEmail']; ?></td>
                                        <td><?php echo $row['UserPhone']; ?></td>
                                        <td><?php echo $row['UserAddress']; ?></td>
                                         <td><?php echo $row['CreatedAt']; ?></td>
                                        <td><?php if($row['UserStatus'] == 1){ echo '<span class="label label-success">Yes</span>&nbsp;'; echo $row['PromotionPer']."%";} ?></td>
                                       <td><a href="edit_pharmacy.php?id=<?php echo ($row['PharmacyID']); ?>"<i class="fa fa-edit"></i></a></td>
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
                                        $('#menu_datatable').DataTable();
                                    });
                                </script>
                                </body>
                                </html>
