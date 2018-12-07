<?php
include_once dirname(__FILE__) . '/includes/config.php';

if (empty($_SESSION['userSession']) || $_SESSION['userSession']['IsAdmin'] != 1) {
    header("location:admin_login.php");
    exit();  
}
$page = 'faq';
$sql = "SELECT * FROM `faq`";
$results = $pm->run($sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Page Title -->
        <title>New Parrot Restaurant</title>
        <?php include_once dirname(__FILE__) . '/resources/templates/admin_header.php'; ?>
    </head>
    <style type="text/css">
        .badge{
            background-color: #b16302;
        }
        p.before{
            text-decoration: line-through;
        }
        .fa-remove {
  color: red;
}
    </style>

    <body>

        <div class="page-holder">
            <?php include_once dirname(__FILE__) . '/resources/templates/admin_navbar.php'; ?>


            <!-- Menu Section -->
            <section id="menu" class="menu">
                <div class="container">
                    <header class="text-center">
                        <h2>FAQ Management</h2>
                    </header>
                    <div class="row">
                        <a href="create_faq.php"><button class="btn btn-success">Create FAQ</button></a>
                        <hr>
                    </div>
                     
                    <div class="menu">
                        <div class="row">
                            <table id="menu_datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($results as $row) { ?>
                                    <tr>
                                        <td><?php echo $row['Question']; ?></td>
                                        <td><?php echo $row['Answer']; ?></td>
                                        
                                        <td><a href="faq_edit.php?id=<?php echo base64_encode($row['Id']); ?>"<i class="fa fa-edit"></i></a>&nbsp;<span class="faq_delete" faqid="<?php echo base64_encode($row['Id']); ?>"><i class="fa fa-remove"></i></span></td>
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
