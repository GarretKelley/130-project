<?php

include('includes/check-token.php');
validateToken(true);
include('includes/header.php');
include('php/levelFunctions.php');

if (isset($_GET['size']) && in_array($_GET['size'], ['0', '1'])) {
	$GLOBALS['size'] = (int)$_GET['size'];
} else {
	$GLOBALS['size'] = 0;
}

?>
		<div class="container">
			<div class="controls">
				<h1 class="title">
					PICROSS
				</h1>
				<div class="control-group">
					<h3>Time</h3>
					<div class="stopwatch">00:00:00</div>
					<h3>Turns</h3>
					<span id="turnsCounter">0</span>
					<h3>Mistakes</h3>
					<span id="mistakesCounter">0</span>
					<h3>Board</h3>
					<div>
						<label for="bColorOptions">Block Color</label>
						<select autocomplete="off" id="bColorOptions">
							<option selected value="FFF">Default</option>
							<option value="000">Black</option>
							<option value="B22222">Red</option>
							<option value="228B22">Green</option>
							<option value="1E90FF">Blue</option>
							<option value="FFD700">Yellow</option>
						</select>
					</div>
					<div>
						<label for="gColorOptions">Grid Color</label>
						<select autocomplete="off" id="gColorOptions">
							<option selected value="CCC">Default</option>
							<option value="000">Black</option>
							<option value="B22222">Red</option>
							<option value="228B22">Green</option>
							<option value="1E90FF">Blue</option>
							<option value="FFD700">Yellow</option>
						</select>
					</div>
					<div class ="buttons">
						<button id="suggest">Suggest Best Move &raquo;</button>
					</div>
				</div>
				<div class="control-group">
					<label for="gSize">Grid Size</label>
					<select id="gSize">
						<option <?php if ($GLOBALS['size'] === 0) { echo('selected'); } ?> value="0">7x7</option>
						<option <?php if ($GLOBALS['size'] === 1) { echo('selected'); } ?> value="1">13x13</option>
					</select>
					<div class ="buttons">
						<button id="new">New Game &raquo;</button>
						<button id="arcade">Arcade Mode</button>
						<button id="timed">Time Attack</button>
					</div>
				</div>
			</div>
			<div id="puzzle">
				<table class="gameTable">
					<?php

					function outputLevel($level) {
						// Header
						echo("<tr class=\"top\"><th></th>");
						for ($i = 0; $i < count($level); $i++) {
							$counts = join(" ", getCounts(array_column($level, $i)));
							echo("<th class=\"key top\">$counts</th>");
						}
						echo("</tr>");

						foreach($level as $rowIndex => $row) {
							echo("<tr>");
							$counts = join(" ", getCounts($row));
							echo("<th class=\"key left\">$counts</th>");
							foreach($row as $colIndex => $value) {
								echo("<td class=\"cell\" id=\"$rowIndex-$colIndex\" data-val=\"$value\"></td>");
							}
							echo("</tr>");
						}
					}

					if (isset($_GET['mode']) && $_GET['mode'] === 'rand') {
						$board = getRandomLevel();
						outputLevel($board);
					} else if (isset($_GET['mode']) && $_GET['mode'] === 'arcade') {
						
					}

					?>
				</table>
			</div>
		</div>
		<script type="text/javascript" src="js/picross.js"></script>
	</body>
</html>
