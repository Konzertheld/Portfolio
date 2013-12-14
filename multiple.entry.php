<div class="post entry">
	<div class="contentpreview">
		<h2><a href="<?php echo $content->permalink; ?>" title="<?php echo $content->title; ?>"><?php echo $content->title_out; ?></a></h2>
		<div class="contentpreview_center"><div class="contentpreview_content"><?php echo $content->content_excerpt; ?></div></div>
		<p class="meta"><?php _e('An article from %1$s by %2$s', array($content->pubdate->format(), $content->author->displayname), $theme->name); ?></p>
	</div>
</div>