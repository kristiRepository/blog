<?php include('views/blog/partials/header.php'); ?>

<!-- MAIN CSS -->
<link rel="stylesheet" href="/views/blog/assets/index.css">

</head>



<section>
    <div class="container">
        <h2><?php echo $article[0]['title']; ?></h2>

        <p class="lead">
            <i class="fa fa-user"></i><?php echo " " . $article[0]['username']; ?> &nbsp;&nbsp;&nbsp;
            <i class="fa fa-calendar"></i><?php echo " " . $article[0]['publish_date']; ?> &nbsp;&nbsp;&nbsp;

        </p>

        <img src=<?php echo "/" . $article[0]['image'] ?> class="img-responsive" width="900px" height="500px" alt="" style="border: solid 1px;">

        <br>
        <br>
        <?php echo $article[0]['body']; ?>

        <br>
        <br>

        <div class="row">

            <div class="col-md-8 col-xs-12">
                <h4>Comments</h4>

                <?php foreach($comments as $comment){ ?>
                    <h5><?php echo $comment['username']; ?></h5>
                    <p><?php echo $comment['comment_body']; ?></p>
                    
                <?php } ?>


                <br>

                <h4>Leave a Comment</h4>

                <form action="/add-comment" method="POST" class="form">


                    <div class="form-group">
                        <textarea name="comment" class="form-control" rows="10" autocomplete="off"></textarea>
                    </div>

                    <input type="hidden" name="slug" value=<?php echo $article[0]['slug']; ?> >
                    <input type="hidden" name="article_id" value=<?php echo $article[0][0]; ?> >

                    <button type="submit" class="section-btn btn btn-primary">Comment</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
            if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-danger"><?php echo $_SESSION['message']; ?></div>
            <?php  }  unset($_SESSION['message']);?>



</body>

</html>






<?php include('views/blog/partials/footer.php'); ?>