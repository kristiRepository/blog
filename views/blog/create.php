<?php include('views/blog/partials/header.php'); ?>
<script src="https://cdn.tiny.cloud/1/rnp9io7fai2xcx9bcujqswjmgzm740xiciiq0gvdkwd5to3i/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>



<div class="container mt-5 mb-4">
    <div class="card card-default">
        <div class="card-header">
            Add New Article
        </div>
        <div class="card-body">
            <?php
            if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-danger"><?php echo $_SESSION['message']; ?></div>
            <?php  }
            unset($_SESSION['message']); ?>
            <form id="create-form" action="/blog/" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <textarea name="title" id="title" class="form-control" placeholder="Enter article title" rows="1" required></textarea>

                </div>
                <div class="form-group">
                    <label for="summary">Summary</label>
                    <textarea name="summary" id="summary" class="form-control" placeholder="Enter article summary" required></textarea>
                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea name="body" id=myTextarea class="form-control" placeholder="Enter article body" required></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Select article image</label>
                    <input class="form-control-file" type="file" name="image" accept="image/*" required>
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
                    <textarea name="metadata" class="form-control" placeholder="Enter article meta-data"></textarea>
                </div>

                <div class='form-group'>
                    <label for='tags'>Tags</label>
                    <select name="tags[]" id='tags' class="form-control tags-selector" multiple>
                        <?php foreach ($tags as $tag) { ?>
                            <option value=<?php echo $tag->getId(); ?>><?php echo $tag->getName(); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button class="btn btn-primary create" type="button" value="add">Add Article</button>
                <span><button class="btn btn-success create" type="button" value="draft">Save as draft</button></span>
            </form>
        </div>
    </div>

</div>












<?php include('views/blog/partials/footer.php'); ?>
<script src="/views/blog/assets/create.js"></script>