<?php include('views/blog/partials/header.php'); ?>

<body>

  <div class="wrapper">
    <!-- Sidebar Holder -->
    <?php include('views/blog/partials/sidebarleft.php'); ?>
    <!-- Page Content Holder -->
    <div id="content">

      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

          <button type="button" id="sidebarCollapse" class="navbar-btn">
            <span></span>
            <span></span>
            <span></span>
          </button>


          <div style="position: relative; margin:auto" id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active ">
                <img src="views/blog/blogphotos/test1.png" width="900px" height="370px">
              </div>
              <div class="carousel-item">
                <img src="views/blog/blogphotos/test2.png" width="900px" height="370px">
              </div>
              <div class="carousel-item">
                <img src="views/blog/blogphotos/test3.png" width="900px" height="370px">
              </div>
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

      <div class="col-md-11 blogShort">
                     <h1>Title 1</h1>
                     <img style="float:left;" src="views/blog/blogphotos/test1.png" width="300px" height="400px"  class="pull-left img-responsive thumb margin10 img-thumbnail">
                     
                     <article><p>
                         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                         ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only 
                         f
                         </p></article>
                     <a class="btn btn-blog pull-right marginBottom10" href="#">READ MORE</a> 
       </div>
       <hr>
    
    
    
    </div>


    <?php include('views/blog/partials/sidebarright.php'); ?>

  </div>

  <?php include('views/blog/partials/footer.php'); ?>