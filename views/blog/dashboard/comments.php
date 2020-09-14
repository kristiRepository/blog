<?php include('views/partials/header.php');   ?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/views/blog/dashboard/style/style.css">
</head>
<body>

<?php include('views/blog/dashboard/partial/sidebar.php'); ?>


<div class="main">

<div class="container" style="padding-top: 40px; padding-bottom:40px;">
  <div class="card card-default " style="overflow: auto;">
  <div class="card-header">Comments</div>
      
      
      <table class="table">
        <thead>
          <th>Id</th>
          <th>Comment Body</th>
          <th>Article</th>
          <th>Author</th>
          <th>Action</th>
        </thead>
        <?php foreach($comments as $comment){?>
          <tr>
          <td><?php echo $comment['comment_id'] ?></td>
          <td style="word-break:break-word;"><?php echo $comment['comment_body']; ?></td>
          <td><?php echo $comment['title']; ?></td>
          <td><?php echo $comment['username']; ?></td>
          <td style="text-align: center;"><form  method="POST" action="/comment/delete">
                    <input type="hidden" name="comment_id" value=<?php echo $comment['comment_id']; ?>>
                    <input type="hidden" name="admin" value="admin">
                    <button type="submit" class="btn btn-danger  ml-2">Delete</button></form></td>
          </tr>
        <?php } ?>
        </table>
      </div>
</div>
</div>



</body>
</html> 


<?php include('views/partials/footer.php');   ?>