            <div class="col-md-4">
            

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" name="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form><!--Search Form-->
                    <!-- /.input-group -->
                </div>
                
                <!-- Blog Search Well -->
                <div class="well">
                   <?php if(isset($_SESSION['user_role'])): ?>
                   <h4>Logged in as <?php echo $_SESSION['username']; ?></h4>
                   <a href="includes/logout.php" class="btn btn-primary">Logout</a>
                   <?php else: ?>               
                   
                    <h4>Login</h4>
                    <form action="includes/login.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Enter Username">                        
                    </div>                    
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" placeholder="Enter Password">        <span class="input-group-btn">
                            <button class="btn btn-primary" name="login" type="submit">
                                Login
                            </button>
                        </span>                
                    </div>
                    </form><!--Search Form-->
                    
                    <?php endif; ?>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                               <?php
                                $query = "SELECT * FROM categories";
                                $sidebar_categories_query = mysqli_query($connection, $query);
                                if(!$query){
                                    die("QUERY FAILED" . mysqli_error($connection));
                                }
                                while($row = mysqli_fetch_assoc($sidebar_categories_query)){
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                    echo "<li><a href='categories.php?p_id=$cat_id'>{$cat_title}</a>";
                                }                                 
    
                                ?>
                        
                            </ul>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>
