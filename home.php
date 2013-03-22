<?php $theme->display("header"); ?>
<?php $theme->display("navigation"); ?>
		<div id="imagebox">
		<?php
			foreach ( $posts as $post )
			{
				echo $theme->content($post, 'multiple');
			}
		?>
		</div>
<?php $theme->display("footer"); ?>