<?php include('views/blog/partials/header.php'); ?>

<script src="https://cdn.tiny.cloud/1/rnp9io7fai2xcx9bcujqswjmgzm740xiciiq0gvdkwd5to3i/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<div class="container mt-5 mb-4">
    <div class="card card-default">
        <div class="card-header">
            Modify Draft
        </div>
        <div class="card-body">
            <?php
            if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-danger"><?php echo $_SESSION['message']; ?></div>
            <?php  }
            unset($_SESSION['message']); ?>
            <form action="/blog/update" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <textarea name="title" id="title" class="form-control" placeholder="Enter article title" rows="1" required><?php echo $draft['title']; ?></textarea>

                </div>
                <div class="form-group">
                    <label for="summary">Summary</label>
                    <textarea name="summary" id="summary" class="form-control" required><?php echo $draft['summary']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea name="body" id=myTextarea class="form-control" required><?php echo $draft['body']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Select article image</label>
                    <input class="form-control-file" type="file" name="image" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="category">Select Category</label><br>
                    <select name="category" required>
                        <?php foreach ($categories as $category) { ?>
                            <option value=<?php echo $category->getId(); ?>><?php echo $category->getName(); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="metadata">Meta-Data</label>
                    <textarea name="metadata" class="form-control" placeholder="Enter article meta-data"><?php echo $draft['meta_data']; ?></textarea>
                </div>

                <div class='form-group'>
                    <label for='tags'>Tags</label>
                    <select name="tags[]" id='tags' class="form-control tags-selector" multiple>
                        <?php foreach ($tags as $tag) { ?>
                            <option value=<?php echo $tag->getId(); ?>><?php echo $tag->getName(); ?></option>
                        <?php  } ?>
                    </select>
                </div>

                <input type="hidden" name="id1" value=<?php echo $draft['id']; ?>>
                <input type="hidden" name="image1" value=<?php echo $draft['image']; ?>>
                <input type="hidden" name="thumbnail1" value=<?php echo $draft['thumbnail']; ?>>
                <input type="hidden" name="category1" value=<?php echo $draft['category_id']; ?>>
                <?php foreach ($drafttags as $drafttag) { ?>
                    <input type="hidden" name="tags1[]" value=<?php echo $drafttag['tag_id'] ?>>
                <?php } ?>
                <input type="hidden" name="id1" value=<?php echo $draft['id']; ?>>
                <button class="btn btn-primary " type="submit" name="submit" value="edit">Add Article</button>

            </form>
            <form method="POST" action="/blog/delete">
                <input type="hidden" name="draft_id" value=<?php echo $draft['id']; ?>>
                <br>
                <button class="btn btn-danger" type="submit" name="submit">Delete Draft</button>
            </form>
        </div>
    </div>

</div>











<?php include('views/blog/partials/footer.php'); ?>

<script>
    tinymce.init({
        selector: '#myTextarea'
    });
</script>