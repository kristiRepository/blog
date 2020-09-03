<?php include('views/partials/header.php');   ?>


<div class="container ">
    <div class="card card-default " style="width:500px;margin:auto; margin-top:100px;">
        <div class="card-header">
            <h3>Sign up</h3>
        </div>
        <div class="card-body">
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
                <input style="width: 150px;" class="btn btn-primary" name="signup" type="submit" value="Sign up" required>

        </div>
        </form>
    </div>
</div>
</div>












<?php include('views/partials/footer.php');  ?>