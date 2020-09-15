<?php include('views/blog/partials/header.php'); ?>



<body>

<div class="wrapper" >
<?php include('views/blog/partials/sidebarleft.php'); ?>

<div id="content">
<section>
    <div class="container pt-3">
        <h2 style="color: black;"><?php echo $article['title']; ?></h2>

        <p class="lead pt-3">
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



                    <h5><span style="padding-right: 10px;"><img width="40px" height="40px" src="/views/auth/profile_picture/<?php echo $comment['profile_picture']; ?>"></span><?php echo $comment['username']; ?><span style="font-size: 10px;padding-left:5px"><?php echo "(".date("m/d/y g:i A",strtotime($comment['created_at'])).")"; ?></span></h5>
                    <?php if ($_SESSION['id'] == $comment['user_id']) { ?>
                        <div id="replace<?php echo $i; ?>">
                            <form style="float: right;" method="POST" action="/comment/delete">
                                <input type="hidden" name="comment_id" value=<?php echo $comment['comment_id']; ?>>
                                <input type="hidden" name="author" value=<?php echo $comment['user_id']; ?>>
                                <input type="hidden" name="slug" value=<?php echo $article['slug']; ?>>


                                <button type="submit" class="btn btn-danger  ml-2">Delete</button></form>
                            <button style="float: right;" class="btn btn-primary edit-comment " onclick=editComment(<?php echo $i; ?>,<?php echo $comment['comment_id']; ?>,<?php echo '\'' . base64_encode($comment['comment_body']) . '\''; ?>,<?php echo $comment['user_id']; ?>,<?php echo '\'' . base64_encode($article['slug']) . '\''; ?>);>Edit</button>
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
                        <textarea name="comment" class="form-control" rows="3" autocomplete="off"></textarea>
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


</div>

<?php include('views/blog/partials/sidebarright.php'); ?>
</div>




<script>
    function editComment(i, commment_id, comment_body, author, slug) {



        $("#replace" + i + "").html("<form method='POST' action='/comment/update'><div class='form-group'><textarea class='form-control' name='new_content'>" + atob(comment_body) + "</textarea><input type='hidden' name='comm_author' value=" + author + "></div><input type='hidden' name='id_comment' value=" + commment_id + "><input type='hidden' name='redirect_comm' value=" + atob(slug) + "><button type='submit' class='btn btn-primary'>Comment</button></form>");
        $("#paragraph" + i).hide();

    }
</script>