<?php include "includes/admin_header.php"; ?>
<?php include "includes/functions.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
     <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <small>Author</small>
                        </h1>
                    </div>
                </div>
                
                <div class="col-xs-6">
                  <?php  addCategory();      ?>
                  <?php  deleteCategory();      ?>
                   <form action="" method="post">
                    <div class="form-group">
                       <label for="cat_title">Add Category</label>
                        <input type="text" class="form-control" name="cat_title">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="add_category" class="btn btn-primary" value="Add Category">
                    </div>
                    </form> 
            <?php  ////Edit Category
                    if(isset($_GET['edit'])){
                        $cat_id = $_GET['edit'];
                        include "includes/edit.php";
                    }                      
                    ?>
                </div>
                <div class="col-xs-6">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category's Title</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php selectAllCategories();   ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>
