<?php include('views/partials/header.php');   ?>


<div class="container">
    <div class="card card-default " style="width:500px;margin:auto; margin-top:100px;">
        <div class="card-header">
            <h3 style="text-align:center;">Recover Password</h3>
        </div>
        <div class="card-body">
            <?php session_start();
            if (isset($_SESSION['e-message'])) { ?>
                <div class="alert alert-danger"><?php echo $_SESSION['e-message']; ?></div>
            <?php unset($_SESSION['e-message']); }
             ?>

            <p>Please enter your email account so we can assist you in recovering your account</p>

            <form action="/recover" method="POST">

                <div class="form-group">
                    <input type="email" name="recovery-email" class="form-control" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="forgot-password" class="btn btn-black">
                    Recover your password
                    </button>
                </div>
             




            </form>








</div>
</div>
</div>








<?php include('views/partials/footer.php');  ?>