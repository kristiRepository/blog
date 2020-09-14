<?php include('views/partials/header.php');   ?>


<div class="container">
    <div class="card card-default " style="width:500px;margin:auto; margin-top:100px;">
        <div class="card-header">
            <h3 style="text-align:center;">Reset Password</h3>
        </div>
        <div class="card-body">
            <?php session_start();
            if (isset($_SESSION['e-message'])) { ?>
                <div class="alert alert-danger"><?php echo $_SESSION['e-message']; ?></div>
            <?php unset($_SESSION['e-message']); }
             ?>


            <form action="/confirm-pass" method="POST">

<div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
</div>
<div class="form-group">
    <label for="password">Confirm Password</label>
    <input type="password" name="confirm-password" class="form-control" placeholder="Enter your password" required>
</div>
<input type="hidden" name="vkey" value=<?php echo $vkey; ?> >
<div class="form-group">
    <button type="submit" name="submit" class="btn btn-black">
    Reset password
    </button>
</div>





</form>









            </div>
</div>
</div>








<?php include('views/partials/footer.php');  ?>



