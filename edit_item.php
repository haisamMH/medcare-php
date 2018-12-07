<?php
include_once dirname(__FILE__) . '/includes/config.php';
if (empty($_SESSION['userSession']) || $_SESSION['userSession']['IsStaff'] != 1) {
    header("location:staff_login.php");
    exit();  
}
$itemid = !empty($_GET['id']) ? ($_GET['id']) : null;
$PharmacyID = $_SESSION['userSession']['PharmacyID'];
$sql = "SELECT * FROM items  WHERE Id=:MenuItemId AND PharmacyID=:PharmacyID";
$param = array(":MenuItemId"=> $itemid,":PharmacyID" => $PharmacyID);
$results = $pm->run($sql,$param);

if(count($results) == 0){
    header("location:error.php");
}

$sql = "SELECT * FROM category";
$menucategory_results = $pm->run($sql);

$sql = "SELECT * FROM generics_name";
$generics_name_results = $pm->run($sql);

$sql = "SELECT * FROM brands";
$brands_results = $pm->run($sql);

$sql = "SELECT * FROM unit_type";
$unit_type_results = $pm->run($sql);

$page = 'menu';
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
    </style>

    <body>

        <div class="page-holder">
            <?php include_once dirname(__FILE__) . '/resources/templates/pharmacy_navbar.php'; ?>


            <!-- Menu Section -->
            <section id="menu" class="menu">
                <div class="container">
                    <header class="text-center">
                        <h2>Edit Item</h2>
                    </header>
                    
                    <div class="menu">
                        <div class="row">
                            <form id="edit-menu-form" method="post" action="#" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-10 col-md-push-1">
                                        <div class="row">
                                            <input type="hidden" name="id" value="<?php echo $results[0]['Id']; ?>">
                                            <label for="BrandName" class="col-sm-6 unique">Brand Name
                                                 <select name="BrandName" id="BrandName" class="form-control">
                                                     <option></option>
                                                     <?php foreach($brands_results as $row) { ?>
                                                     <option value="<?php echo $row['Id']; ?>" <?php if($row['Id'] == $results[0]['BrandName']) { echo ' selected '; } ?>><?php echo $row['BrandName']; ?></option>
                                                     <?php } ?>
                                                 </select>
                                            </label>
                                            
                                            <label for="SpecialInstruction" class="col-sm-6 unique">Description
                                                <input name="SpecialInstruction" type="text" id="SpecialInstruction" required value="<?php echo $results[0]['SpecialInstruction']; ?>">
                                            </label>
                                            
                                             <label for="GenericName" class="col-sm-6 unique">Generic Name
                                                 <select name="GenericName" id="GenericName" class="form-control">
                                                     <option></option>
                                                     <?php foreach($generics_name_results as $row) { ?>
                                                     <option value="<?php echo $row['Id']; ?>" <?php if($row['Id'] == $results[0]['GenericName']) { echo ' selected '; } ?>><?php echo $row['GenericName']; ?></option>
                                                     <?php } ?>
                                                 </select>
                                            </label>
                                            
                                            <label for="Category" class="col-sm-6 unique">Category
                                                 <select name="Category" id="Category" class="form-control">
                                                     <option></option>
                                                     <?php foreach($menucategory_results as $row) { ?>
                                                     <option value="<?php echo $row['Id']; ?>" <?php if($row['Id'] == $results[0]['Category']) { echo ' selected '; } ?>><?php echo $row['Type']; ?></option>
                                                     <?php } ?>
                                                 </select>
                                            </label>
                                             <label for="Unit Type" class="col-sm-6 unique">Unit Type
                                                 <select name="UnitType" id="UnitType" class="form-control">
                                                     <option></option>
                                                     <?php foreach($unit_type_results as $row) { ?>
                                                     <option value="<?php echo $row['Id']; ?>" <?php if($row['Id'] == $results[0]['UnitType']) { echo ' selected '; } ?>><?php echo $row['UnitType']; ?></option>
                                                     <?php } ?>
                                                 </select>
                                            </label>
                                             <label for="Image" class="col-sm-6 unique">Unit Dosage
                                                 <input name="UnitDosage" type="text" id="UnitDosage" required value="<?php echo $results[0]['UnitDosage']; ?>">
                                            </label>
                                           
                                 
                           
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn-unique">Create</button> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
