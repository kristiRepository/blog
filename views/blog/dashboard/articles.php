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
      <div class="card card-default " style="overflow: auto;">

        <div class="card-header">Articles</div>


        <table class="table">
          <thead>
            <th>Id</th>
            <th>Title</th>
            <th>Summary</th>
            <th>Image</th>
            <th>Category</th>
            <th>Publish Date</th>
            <th>Status</th>
            <th>Is Feature</th>
            <th>Author</th>
            <th>Tags</th>
            <th>Mark Article</th>
            <th>Change Status</th>
          </thead>

          <?php foreach ($articles as $article) { ?>
            <tr>
              <td><?php echo $article['id'];  ?></td>
              <td><?php echo $article['title'];  ?></td>
              <td><?php echo substr($article['summary'], 0, 30);  ?></td>
              <td><img style="width:60px" src=<?php echo "/" . $article['image']; ?>></td>
              <td><?php echo $article['category_name'];  ?></td>
              <td><?php echo $article['publish_date'];  ?></td>
              <td><?php echo $article['status'];  ?></td>
              <td><?php if ($article['is_feature']) echo 'yes';
                  else {
                    echo 'no';
                  }  ?></td>
              <td><?php echo $article['username'];  ?></td>
              <td><?php foreach ($article_tags as $article_tag) {
                    if ($article['id'] == $article_tag['article_id']) {
                      echo $article_tag['tag_name'] . " ";
                    }
                  } ?></td>
              <td><?php if ($article['is_feature'] == '0') { ?><form action="/dashboard/article/mark-article" method="POST"><input type="hidden" name="postId" value=<?php echo $article['id'];  ?>><button style="width:150px;" class="btn btn-success" type="submit">Mark</button></form><?php } else { ?><form action="/dashboard/article/un-mark-article" method="POST"><input type="hidden" name="postId" value=<?php echo $article['id'];  ?>><button style="width:150px;" class="btn btn-success" type="submit">Unmark</button></form><?php } ?></td>
              <td><?php if ($article['status'] == 'unpublished') { ?><form action="/dashboard/article/publish-article" method="POST"><input type="hidden" name="articleId" value=<?php echo $article['id'];  ?>><button style="width:150px;" class="btn btn-warning" type="submit">Publish</button></form><?php } else { ?><form action="/dashboard/article/unpublish-article" method="POST"><input type="hidden" name="articleId" value=<?php echo $article['id'];  ?>><button style="width:150px;" class="btn btn-warning" type="submit">Unpublish</button></form><?php } ?></td>
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