<?php $theme->display("header"); ?>
<?php $theme->display("navigation"); ?>
		<div class="entry single">
			<div class="contentarea">
				<h2 class="posttitle"><?php echo $post->title; ?></h2>
				<div class="postcontent">
					<?php echo $post->content_out; ?>
				</div>
			</div>
		</div>
<?php $theme->display("footer"); ?>