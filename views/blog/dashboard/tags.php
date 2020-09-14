<?php include('views/partials/header.php');   ?>
<link rel="stylesheet" type="text/css" href="/views/blog/dashboard/style/style.css">
<link rel="stylesheet" type="text/css" href="/views/blog/dashboard/style/create.css">
<?php include('views/blog/dashboard/partial/sidebar.php'); ?>


<div class="main">

  <div class="container" style="padding-top: 40px; padding-bottom:40px;">
    <div class="card card-default ">
      <div class="card-header">
        <h2>Tags <span style="float:right;"><button id="button" class="btn btn-success">Add Tag</button></span></h2>
      </div>

      <table class="table table-bordered">
        <thead>
          <th>Id</th>
          <th>Tag Name</th>
          <th>No. Articles</th>
        </thead>
        <?php foreach ($tags as $tag) { ?>
          <tr>
            <td><?php echo $tag->getId(); ?></td>
            <td><?php echo $tag->getName(); ?></td>
            <td><?php echo $tag->noArticles(); ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>
</div>

<div class="popup">
  <div class="popup-content">
    <img src="/views/blog/dashboard/partial/x.png" class="close">
    <form id="form" action="/dashboard/create-tag" method="POST">
      <div class="form-group">
        <label for="name">Tag Name</label>
        <input name="name" type="text" class="form-control" placeholder="Enter Tag name" required>
      </div>
      <button type="submit" class="btn btn-primary">Add Tag</button>
    </form>
  </div>
</div>

</body>

<script>
  document.getElementById("button").addEventListener("click", function() {
    document.querySelector(".popup").style.display = "flex";
  });
  document.querySelector(".close").addEventListener("click", function() {
    document.querySelector(".popup").style.display = "";
  });
</script>


</html>
<?php include('views/partials/footer.php');   ?>