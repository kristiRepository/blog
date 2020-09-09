<nav id="sidebar">
	<div class="p-4 pt-5">
		<h5>Categories</h5>
		<ul class="list-unstyled components mb-5">
			<?php
			foreach ($categories as $category) {
				echo "<li><a href='/index/?category=" . $category->getName() . "'>" . $category->getName() . "</a></li>";
			} ?>



		</ul>
		<div class="mb-5">
			<h5>Tags</h5>
			</br>
			<div class="tagcloud">


				<?php $check = array();
				foreach ($article_tags as $article_tag) {

					echo "<a href='/index/?tag=" . $article_tag->getName() . "' class='tag-cloud-link'>" . $article_tag->getName() . "  " . "</a>";
				} ?>

			</div>
		</div>
	</div>
</nav>