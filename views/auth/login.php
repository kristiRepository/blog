<?php include('views/partials/header.php');   ?>

<link rel="stylesheet" type="text/css" href="/views/auth/style/login.css">


<?php

if(isset($_GET['vkey'])){
    if(isset($message)){
        echo "<p style='background-color:lightgreen;text-align:right'>".$message."</p>";
    }
}


?>

<div class="sidenav">
         <div class="login-main-text">
            <h2>Personal Blog</h2>
            <p>Login or register from here to access.</p>
         </div>
      </div>

      <div class="main">
         <div class="col-md-6 col-sm-12">
            <div class="login-form">
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
                <input style="width: 150px;" class="btn btn-black" name="login" type="submit" value="Login">
                <span class="ml-4"><a href="/signup" class="btn btn-grey">Sign up</a></span> 
                <div style="margin-top:6px ;margin-left:7px;" class="form-group">
                    <input type="checkbox" name="remember" <?php if(isset($_COOKIE['username'])){echo "checked";}?> >
                    <label for="remember">Remember me</label>
                </div>
                <div><a class="pl-1" href="/forgot_pass">Forgot your password?</a></div>
      
       
        </form>
    </div>
</div>
</div>








<?php include('views/partials/footer.php');  ?>