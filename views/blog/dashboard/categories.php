<?php include('views/partials/header.php');   ?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/views/blog/dashboard/style/style.css">
    <link rel="stylesheet" type="text/css" href="/views/blog/dashboard/style/create.css">
</head>

<body>

    <?php include('views/blog/dashboard/partial/sidebar.php'); ?>

    <div class="main">

        <div class="container" style="padding-top: 40px; padding-bottom:40px;">
            <div class="card card-default ">
                <div class="card-header">
                    <h2>Categories <span style="float:right;"><button id="button" class="btn btn-success">Add Category</button></span></h2>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <th>Category Name</th>
                        <th>No. Articles</th>
                        <th>Actions</th>

                    </thead>
                    <?php foreach ($categories as $category) { ?>
                        <tr>
                            <td><?php echo $category->getName(); ?></td>
                            <td><?php echo $category->articlesCount(); ?></td>
                            <td>
                                <div style="text-align:center;"><button id=<?php echo $category->getId(); ?>  onclick="show($(this).attr('id'),$(this).attr('vi'));" class="btn btn-primary" vi=<?php echo $category->getName(); ?> style="width: 150px; height:40px;">Edit</button><span><form style="display: inline;" action="/dashboard/delete-category" method="POST"><input type="hidden" name="delete_category" value=<?php echo $category->getId(); ?>><button type="submit" style="width: 150px; height:40px;" class="btn btn-danger">Delete</button></form></div>
                            </td>
                        </tr>
                    <?php } ?>
                </table>


            </div>
            <?php
            if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-danger"><?php echo $_SESSION['message']; ?></div>
            <?php  }
            unset($_SESSION['message']); ?>
            <?php if (isset($_SESSION['success'])) { ?>
                <div class="alert alert-success"><?php echo $_SESSION['success']; ?></div>
            <?php  }
            unset($_SESSION['success']); ?>
        </div>
    </div>





    <div class="popup">
        <div class="popup-content">
            <img src="/views/blog/dashboard/partial/x.png" class="close">
            <form id="form" action="/dashboard/create-category" method="POST">
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input name="name" type="text" class="form-control" placeholder="Enter Category name" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Category</button>
            </form>
        </div>
    </div>

    <div class="edit-popup">
        <div class="edit-popup-content">
            <img src="/views/blog/dashboard/partial/x.png" class="edit-close">
            <form id="form" action="/dashboard/edit-category" method="POST">
                <div class="form-group">
                    <label for="edit-name">Category Name</label>
                    <input name="edit-name" id="edit_name" type="text" class="form-control" placeholder="Enter Category name" required>
                </div>
                <input type="hidden" id="category_id" name="category_id" value="">
                <button type="submit" id="edit-button" class="btn btn-primary ">Edit Category</button>
            </form>
        </div>
    </div>




</body>

</html>
<script>
    document.getElementById("button").addEventListener("click", function() {
        document.querySelector(".popup").style.display = "flex";
    });
    document.querySelector(".close").addEventListener("click", function() {
        document.querySelector(".popup").style.display = "";
    });
    document.querySelector(".edit-close").addEventListener("click", function() {
        document.querySelector(".edit-popup").style.display = "";
    });

    function show(id,value) {
        document.querySelector(".edit-popup").style.display = "flex";
        document.querySelector("#category_id").value = id;
        document.querySelector("#edit_name").value = value;
    }
</script>
<?php include('views/partials/footer.php');   ?>