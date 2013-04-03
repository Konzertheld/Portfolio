<?php $theme->display("header"); ?>
<?php $theme->display("navigation"); ?>
		<div id="imagebox">
		<?php
			if(count($theme->get_blocks("content", 0, $theme))) {
				echo $theme->area("content");
			}
			else {
				foreach ( $posts as $post )
				{
					echo $theme->content($post, 'multiple');
				}
			}
		?>
		</div>
<?php $theme->display("footer"); ?>