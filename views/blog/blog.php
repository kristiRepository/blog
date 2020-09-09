<?php include('views/blog/partials/header.php'); ?>


<body>

  <div class="wrapper">
    <!-- Sidebar Holder -->
    <?php include('views/blog/partials/sidebarleft.php'); ?>
    <!-- Page Content Holder -->
    <div id="content">

      <nav class="navbar navbar-expand-lg navbar-light bg-light">





        <div style="position: relative; margin:auto" id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">


            <?php $i = 0;
            foreach ($allarticles as $article) {
              if ($article['status'] == 'published' && $article['is_feature'] == 1) { ?>
                <div class="carousel-item <?php if ($i == 0) echo "active"; ?> ">
                  <img src="<?php echo "/" . $article['image']; ?>" width="1000px" height="370px">
                </div>
            <?php $i++;
              }
            } ?>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

      </nav>






      <?php if (isset($_GET['category']) || isset($_GET['tag'])) {
        foreach ($results as $result) { ?>

          <div style="float:left;" class="col-md-11 blogShort">
            <h1><?php echo $result['title']; ?></h1>
            <a href="/blog/article/?article=<?php echo $result['slug']; ?>"><img style="float:left;width:300px;height:200px;" src=<?php echo "/" . $result['thumbnail']; ?> width="350px" height="450px" class="pull-left img-responsive thumb margin10 img-thumbnail"></a>

            <article>
              <p>
                <?php echo $result['summary']; ?>
              </p>
            </article>
            <a class="btn btn-blog pull-right marginBottom10" href="/blog/article/?article=<?php echo $result['slug']; ?>">READ MORE</a>
          </div>



        <?php }
      } else {
        foreach ($articles as $article) { ?>

          <div style="float:left;" class="col-md-11 blogShort">
            <h1><?php echo $article['title']; ?></h1>
            <a href="/blog/article/?article=<?php echo $article['slug']; ?>"><img style="float:left; width:300px;height:200px;" src=<?php echo "/" . $article['thumbnail']; ?> width="350px" height="450px" class="pull-left img-responsive thumb margin10 img-thumbnail"></a>

            <article>
              <p>
                <?php echo $article['summary']; ?>
              </p>
            </article>
            <a class="btn btn-blog pull-right marginBottom10" href="/blog/article/?article=<?php echo $article['slug']; ?>">READ MORE</a>
          </div>
          </br>

      <?php }
      } ?>
      <br>
      <br>
      <br>
      <br>
      <div style="float:left;" class="container-fluid">
        <ul class="pagination">
          <?php $total_links = ceil($total / $limit);
          for ($i = 1; $i <= $total_links; $i++) {
          ?>
            <li class="page-item"><a href="/index/?<?php if (isset($_GET['tag'])) echo "tag=" . $_GET['tag'] . "&";
                                                    if (isset($_GET['category'])) echo "category=" . $_GET['category'] . "&"; ?>page=<?php echo $i; ?>" id=<?php echo $i; ?> class="page-link"><?php echo $i; ?></a></li>

          <?php } ?>
        </ul>
      </div>

    </div>


    <?php include('views/blog/partials/sidebarright.php'); ?>

  </div>

  <?php include('views/blog/partials/footer.php'); ?>