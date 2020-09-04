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

<div class="" style="width:1400px;padding-top: 40px; padding-left:40px; padding-bottom:40px;">
  <div class="card card-default ">
      <div class="card-header">
        <h2>Articles</h2>
      </div>
      
      <table class="table ">
        <thead>
          <th>Id</th>
          <th>Title</th>
          <th>Summary</th>
          <th>Body</th>
          <th>Image</th>
          <th>Category</th>
          <th>Publish Date</th>
          <th>Status</th>
          <th>Is Feature</th>
          <th>Metadata</th>
          <th>Author</th>
          <th>Tags</th>
          <th>Mark Article</th>
          <th>Change Status</th>
        </thead>
        <?php //die(var_dump($article_tags)); ?>
        <?php foreach($articles as $article){ ?>
          <tr>
          <td><?php echo $article[0];  ?></td>
          <td><?php echo $article[1];  ?></td>
          <td><?php echo substr($article[3],0,11);  ?></td>
          <td><?php echo substr($article[4],0,11);  ?></td>
          <td><?php echo $article[5];  ?></td>
          <td><?php echo $article[13];  ?></td>
          <td><?php echo $article[7];  ?></td>
          <td><?php echo $article[8];  ?></td>
          <td><?php if($article[9]) echo 'yes';else{echo 'no';}  ?></td>
          <td><?php echo $article[10];  ?></td>
          <td><?php echo $article[15];  ?></td>
          <td><?php foreach($article_tags as $article_tag){ if($article[0]==$article_tag['article_id'] ){echo $article_tag['tag_name']." ";}} ?></td>
        <td><?php if($article[9]=='0'){ ?><form action="/dashboard/article/mark-article" method="POST"><input type="hidden" name="postId" value=<?php echo $article[0];  ?> ><button class="btn btn-success" type="submit">Mark</button></form><?php } else{ ?><form action="/dashboard/article/un-mark-article" method="POST"><input type="hidden" name="postId" value=<?php echo $article[0];  ?> ><button class="btn btn-success" type="submit">Unmark</button></form><?php } ?></td>
        <td><?php if($article[8]=='draft'){ ?><form action="/dashboard/article/publish-article" method="POST"><input type="hidden" name="articleId" value=<?php echo $article[0];  ?> ><button class="btn btn-warning" type="submit">Publish</button></form><?php } else{ ?><form action="/dashboard/article/draft-article" method="POST"><input type="hidden" name="articleId" value=<?php echo $article[0];  ?> ><button class="btn btn-warning" type="submit">Draft</button></form><?php } ?></td>
          <td></td>
          </tr>
        <?php } ?>
        </table>
      </div>
</div>
</div>

</div>
   
</body>
</html> 

<?php include('views/partials/footer.php');   ?>