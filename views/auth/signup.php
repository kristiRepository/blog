<?php include('views/partials/header.php');   ?>

<link rel="stylesheet" type="text/css" href="/views/auth/style/login.css">



<div class="sidenav">
    <div class="login-main-text">

        <h2>Register from here to access.</h2>
    </div>
</div>

<div class="main">
    <div class="col-md-6 col-sm-12">
        <div class="login-form">
            <?php
            if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-danger"><?php echo $_SESSION['message']; ?></div>
            <?php }
            unset($_SESSION['message']); ?>
            <form action="/register" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="txtPassword" class="form-control" type="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input id="txtConfirmPassword" class="form-control" type="password" name="confirm-password" required>
                </div>
                <input style="width: 150px;" class="btn btn-black" name="signup" type="submit" value="Sign up" required>


            </form>
        </div>
    </div>
</div>












<?php include('views/partials/footer.php');  ?>