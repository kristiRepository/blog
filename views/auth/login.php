<?php include('views/partials/header.php');   ?>

<?php

if(isset($_GET['vkey'])){
    if(isset($message)){
        echo "<p style='background-color:lightgreen;'>".$message."</p>";
    }
}


?>


<div class="container">
    <div class="card card-default " style="width:500px;margin:auto; margin-top:100px;">
        <div class="card-header">
            <h3>Login</h3>
        </div>
        <div class="card-body">
            <?php
            if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-danger"><?php echo $_SESSION['message']; ?></div>
            <?php  }  unset($_SESSION['message']);?>
            <form action="/check" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" type="text" name="username" required value=<?php if(isset($_COOKIE['username'])){echo $_COOKIE['username'];}  ?> >
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" required value=<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];}  ?> >
                </div >
                <input style="width: 150px;" class="btn btn-primary" name="login" type="submit" value="Login">
                <span class="ml-4"><a href="/signup">Sign up</a></span> 
                <div style="margin-top:6px" class="form-group">
                    <input type="checkbox" name="remember" <?php if(isset($_COOKIE['username'])){echo "checked";}?> >
                    <label for="remember">Remember me</label>
                </div>
                <div style="margin-top:20px"><a class="pl-1" href="/forgot_pass">Forgot your password?</a></div>
        </div>
       
        </form>
    </div>
</div>
</div>








<?php include('views/partials/footer.php');  ?>