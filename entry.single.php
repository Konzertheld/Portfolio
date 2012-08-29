<?php include("header.php"); ?>
		<div class="entry single">
			<h2 class="posttitle"><?php echo $post->title; ?></h2>
			<div class="postcontent">
				<?php echo $post->content_out; ?>
			</div>
		</div>
	</div>
<?php include("footer.php"); ?>