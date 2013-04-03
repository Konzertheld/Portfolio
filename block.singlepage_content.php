<?php if($content->page instanceof Habari\Post): ?>
		<div class="page single">
			<div class="contentarea">
				<h2 class="posttitle"><?php echo $content->page->title; ?></h2>
				<div class="postcontent">
					<?php echo $content->page->content_out; ?>
				</div>
			</div>
		</div>
<?php endif; ?>