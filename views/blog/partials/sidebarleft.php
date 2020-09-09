
<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Personal Blog</h3>
    </div>

    <ul class="list-unstyled components">

        <li>
            <a href="/index">Home</a>
        </li>
        <?php if($_SESSION['user_role'] == 'admin'){ ?>
        <li>
            <a href="/dashboard/index">Dashboard</a>
        </li>
        <?php } ?>
        <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?php echo $_SESSION['username'] ?></a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="/signout">Sign out</a>
                </li>
            </ul>
        </li>


    </ul>
    
    <ul class="list-unstyled pl-2">
        <li>
        <a href="/blog/create">Add new post</a>
        </li>
        <li>
        <a href="#" id="draft">My Drafts</a>
        </li>
        <ul style="display:none" class="list-unstyled pl-2" id="list">
            <?php foreach($mydrafts as $mydraft){ ?>
                <li><a href="/blog/edit/?article=<?php echo $mydraft['slug'] ?>"><?php echo $mydraft['title']; ?></a></li>
            <?php } ?>
            <li id="close"><a href="#">Close</a></li>
        </ul> 
    </ul>


</nav>

<script>
    document.getElementById("draft").addEventListener("click", function() {
        document.querySelector("#list").style.display = "grid";
    });
    document.querySelector("#close").addEventListener("click", function() {
        document.querySelector("#list").style.display = "none";
    });

</script>