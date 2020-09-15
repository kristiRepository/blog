<?php include('views/partials/header.php');   ?>
<link rel="stylesheet" type="text/css" href="/views/blog/dashboard/style/style.css">
<?php include('views/blog/dashboard/partial/sidebar.php'); ?>

<div class="main">

<div class="container" style="padding-top: 40px; padding-bottom:40px;">
  <div class="card card-default ">
      <div class="card-header">
        <h2>Users</h2>
      </div>
      
      <table class="table table-bordered">
        <thead>
          <th>Profile Picture</th>
          <th>Username</th>
          <th>Email</th>
          <th>Created</th>
          <th>Role</th>
          <th>Make Admin</th>
        </thead>
        <?php foreach($users as $user){?>
          <tr>
          <td><img width="40px" height="40px" src="/views/auth/profile_picture/<?php echo $_SESSION['profile_picture'] ?>"></td>
          <td><?php echo $user->getUsername(); ?></td>
          <td><?php echo $user->getEmail(); ?></td>
          <td><?php echo $user->getCreateDate(); ?></td>
          <td><?php echo $user->getUserRole(); ?></td>
          <td style="text-align: center;"><?php if($user->getUserRole()=="subscriber"){echo "<form action='/dashboard/make-admin' method='POST'><input  value=".$user->getId()." type='hidden' name='user_id'><button class='btn btn-success'>Make Admin</button></form>";} ?> <?php if($user->getUserRole()=="admin"){echo "<img src='/views/blog/dashboard/style/admin.png' width='40px;'>"; } ?></td>
          </tr>
        <?php } ?>
        </table>
      </div>
</div>
</div>
   
</body>
</html> 
<?php include('views/partials/footer.php');   ?>
