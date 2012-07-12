	<div id="stickyfooter">
	<?php
		if($page=="photos")
		{
			$newoffset = $offset+$maxitems;
			print "<a href='?album=$album&number=$number&id=$id&offset=$newoffset' class='menuelement'>Next $maxitems</a>";
			$newoffset = $offset-$maxitems;
			if($newoffset>=0)
				print "<a href='?album=$album&number=$number&id=$id&offset=$newoffset' class='menuelement'>Previous $maxitems</a>";
		}
	?>
	</div>
</body>

</html>