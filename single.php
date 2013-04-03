<?php $theme->display("header"); ?>
<?php $theme->display("navigation"); ?>
		<div class="<?php echo Habari\Post::type_name($post->content_type); ?> single">
			<div class="contentarea">
				<h2 class="posttitle"><?php echo $post->title; ?></h2>
				<div class="postcontent">
					<?php echo $post->content_out; ?>
				</div>
			</div>
		</div>
<?php $theme->display("footer"); ?>