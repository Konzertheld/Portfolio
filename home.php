<?php include("header.php"); ?>
		<div id="imagebox">
		<?php
			foreach ( $posts as $post )
			{
				echo $theme->content($post, 'multiple');
			}
		?>
		</div>
	</div>
<?php include("footer.php"); ?>