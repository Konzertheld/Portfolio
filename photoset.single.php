<?php $theme->display("header"); ?>
		<div id="menu">
				<?php echo $theme->area('menubar'); ?>
		</div>
		<div id="photonavigator">
			<div id="navigation">
				<a href="#" onclick="navigate_left();" class="navigate"><</a><br>
				<a href="#" onclick="navigate_right();" class="navigate">></a>
			</div>
			<?php echo $post->content_thumbnails; ?>
		</div>
		<div class="photoset single">
			<?php echo $post->content_media; ?>
		</div>
<?php $theme->display("footer"); ?>