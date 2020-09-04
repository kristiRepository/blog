<nav id="sidebar">
	<div class="p-4 pt-5">
		<h5>Categories</h5>
		<ul class="list-unstyled components mb-5">
			<?php $check = array();
			foreach ($articles as $article) { ?>

				<?php if (!in_array($article['category_name'], $check)) {
					echo "<li><a href='/index/?category=".$article['category_name'] ."'>" . $article['category_name'] . "</li>";
					array_push($check, $article['category_name']);
				} ?></a>

			<?php } ?>



		</ul>
		<div class="mb-5">
			<h5>Tags</h5>
			</br>
			<div class="tagcloud">
				

			<?php $check = array();
			foreach ($article_tags as $article_tag) { ?>

				<?php if (!in_array($article_tag['tag_name'], $check)) {
					echo "<a href='/index/?tag=".$article_tag['tag_name']."' class='tag-cloud-link'>" . $article_tag['tag_name']."  " . "</a>";
					array_push($check, $article_tag['tag_name']);
				} ?></a>

			<?php } ?>
				
			</div>
		</div>
	</div>
</nav>