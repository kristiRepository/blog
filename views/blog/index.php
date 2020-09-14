<?php include('views/blog/partials/header.php'); ?>

<!-- MAIN CSS -->
<link rel="stylesheet" href="/views/blog/assets/index.css">

</head>



<section>
    <div class="container">
        <h2><?php echo $article['title']; ?></h2>

        <p class="lead">
            <i class="fa fa-user"></i><?php echo " " . $article['username']; ?> &nbsp;&nbsp;&nbsp;
            <i class="fa fa-calendar"></i><?php echo " " . $article['publish_date']; ?> &nbsp;&nbsp;&nbsp;

        </p>

        <img src=<?php echo "/" . $article['image'] ?> class="img-responsive" width="900px" height="500px" alt="" style="border: solid 1px;">

        <br>
        <br>
        <?php echo $article['body']; ?>

        <br>
        <br>

        <div class="row">
            <div class="col-md-8 col-xs-12 pull-left">
                <h4>Comments</h4>

                <?php $i = 0;
                foreach ($comments as $comment) {  ?>



                    <h5><?php echo $comment['username']; ?></h5>
                    <?php if ($_SESSION['id'] == $comment['user_id']) { ?>
                        <div id="replace<?php echo $i; ?>">
                            <form style="float: right;" method="POST" action="/comment/delete">
                                <input type="hidden" name="comment_id" value=<?php echo $comment['comment_id']; ?>>
                                <input type="hidden" name="author" value=<?php echo $comment['user_id']; ?>>
                                <input type="hidden" name="slug" value=<?php echo $article['slug']; ?>>
                                <button type="submit" class="btn btn-danger  ml-2">Delete</button></form>
                            <button  style="float: right;" class="btn btn-primary edit-comment " onclick=editComment(<?php echo $i; ?>,<?php echo $comment['comment_id']; ?>,<?php echo '\'' . base64_encode($comment['comment_body']) . '\''; ?>,<?php echo $comment['user_id']; ?>,<?php echo '\'' . base64_encode($article['slug']) . '\''; ?>);>Edit</button>
                        </div> <?php } ?>
                    <p id="paragraph<?php echo $i; ?>" style="word-break: break-word;"><?php echo $comment['comment_body']; ?></p>



                <?php $i++;
                } ?>
            </div>
        </div>
        <br>
        <br>

        <div class="row">

            <div class="col-md-8 col-xs-12 pull-left">

                <h4>Leave a Comment</h4>

                <form action="/add-comment" method="POST" class="form">


                    <div class="form-group">
                        <textarea name="comment" class="form-control" rows="15" autocomplete="off"></textarea>
                    </div>

                    <input type="hidden" name="slug" value=<?php echo $article['slug']; ?>>
                    <input type="hidden" name="article_id" value=<?php echo $article['id']; ?>>

                    <button type="submit" class="section-btn btn btn-primary">Comment</button>
                </form>
            </div>
        </div>
    </div>

</section>
<?php
if (isset($_SESSION['message'])) { ?>
    <div class="alert alert-danger"><?php echo $_SESSION['message']; ?></div>
<?php  }
unset($_SESSION['message']); ?>



</body>

</html>

<?php include('views/blog/partials/footer.php'); ?>



<script>

    

    function editComment(i, commment_id, comment_body, author, slug) {
var x=atob(comment_body);


        $("#replace" + i + "").html("<form method='POST' action='/comment/update'><div class='form-group'><textarea class='form-control' name='new_content'>"+ atob(comment_body)+"</textarea><input type='hidden' name='comm_author' value=" + author + "></div><input type='hidden' name='id_comment' value=" + commment_id + "><input type='hidden' name='redirect_comm' value=" + atob(slug) + "><button type='submit' class='btn btn-primary'>Comment</button></form>");
        $("#paragraph" + i).hide();
    }
</script>