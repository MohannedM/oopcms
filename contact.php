<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    <?php
    if(isset($_POST['submit'])){
        $to = "mohanned_2510@hotmail.com";
        $email = "From: " . $_POST['email'];
        $subject = wordwrap($_POST['subject'], 70);
        $body = $_POST['body'];
        
        
        if(!empty($email) && !empty($subject)){            
            $message = "Your Message Had Been Sent";
            
            
            mail($to, $subject, $body, $email);
            
    } else {
            $message = "This Fields Cannot Be Empty";
        }
    } else {
        $message = " ";
    }

?>
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                       <h4 class="text-center"><?php echo $message; ?></h4>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject">
                        </div>
                        <textarea name="body" id="body" class="form-control" cols="30" rows="10"></textarea>                <br>
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
