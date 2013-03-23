<?php $theme->display("header"); ?>
		<div id="menu">
				<?php echo $theme->area('menubar'); ?>
		</div>
		<div id="photonavigator">
			<?php echo $post->content_thumbnails; ?>
		</div>
		<div class="photoset single">
			<?php echo $post->content_media; ?>
		</div>
<?php $theme->display("footer"); ?>