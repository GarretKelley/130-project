<?php

include('includes/check-token.php');
validateToken(false);
include('includes/header.php');

?>
		<div class = "header">A quick quide to Picross</div>
		<div class ="howto">
			<p><img id = "image" src="images/howto.png" alt="example picross board">
				Left click to mark a cell as active.<br /><br />

				Right click to mark a cell as inactive. <br /><br />

				The numbers on the outside of the grid indicate # of active cells in a row
				in sequence. for example - in a 7x7 grid with the number 5  on the
				outside of a row, then there is a group of 5 active squares with no spaces
				between them. <br /><br />
			
				If there is more than 1 number for a row/column then there are multiple
				groups of active cells, separated by at least 1 unactive cell. <br /><br />
			
				The game is complete when all active squares are marked.
			</p>
		</div>
	</body>
</html>
