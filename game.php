<?php

$size = (isset($_GET['size']) && in_array($_GET['size'], ['0', '1'])) ? (int)$_GET['size'] : 0;
$levelNum = (isset($_GET['level'])) ? (int)$_GET['level'] : 0;

if (isset($_GET['mode'])) {
	$mode = $_GET['mode'];
	session_start();
	if ($levelNum === 0) {
		// Clear the session information if it is the start of the series.
		unset($_SESSION['level_score']);
	}

	if ($levelNum !== 0) {
		foreach(range(0, $levelNum - 1) as $l) {
			// Redirect to first level if no scores are saved for any previous level
			if (!isset($_SESSION['level_score']) || !array_key_exists($l, $_SESSION['level_score'])) {
				header("Location: game.php?mode=$mode&level=0&size=$size");
			}
		}
	}
} else {
	$mode = 'practice';
}

include('includes/check-token.php');
validateToken(true);
include('includes/header.php');
include('php/levelFunctions.php');

?>
		<div class="container">
			<div class="controls">
				<h1 class="title">
					PICROSS
				</h1>
				<h4>
					<?php 
					
					echo(ucfirst($mode));
					if ($mode !== 'practice') {
						echo(" - Level ".($levelNum + 1));
					}

					?>
				</h4>
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
						<option <?php if ($size === 0) { echo('selected'); } ?> value="0">7x7</option>
						<option <?php if ($size === 1) { echo('selected'); } ?> value="1">13x13</option>
					</select>
					<div class ="buttons">
						<script type="text/javascript">
							function goPractice() {
								location.href = 'game.php?size=' + $('#gSize').val();
							}
							function goArcade() {
								location.href = 'game.php?mode=arcade&level=0&size=' + $('#gSize').val();
							}
						</script>
						<a href="javascript:goPractice()">
							<button id="new">Practice &raquo;</button>
						</a>
						<a href="javascript:goArcade()">
							<button id="arcade">Arcade Mode &raquo;</button>
						</a>
						<button id="timed">Time Attack &raquo;</button>
					</div>
				</div>
			</div>
			<div id="puzzle">
				<?php

				function outputLevel($level) {
					// Header
					echo("<div></div><div class=\"top\">");
					for ($i = 0; $i < count($level); $i++) {
						$counts = join(" ", getCounts(array_column($level, $i)));
						echo("<div><pre>$counts</pre></div>");
					}
					echo("</div>");

					echo("<div class=\"left\">");
					foreach($level as $rowIndex => $row) {
						$counts = join(" ", getCounts($row));
						echo("<div><pre>$counts</pre></div>");
					}
					echo("</div>");

					echo("<div id=\"cells\">");
					foreach($level as $rowIndex => $row) {
						echo("<div>");
						foreach($row as $colIndex => $value) {
							echo("<span id=\"$rowIndex-$colIndex\" data-val=\"$value\"><div></div></span>");
						}
						echo("</div>");
					}
					echo("</div>");
				}

				if (isset($_GET['mode']) && $_GET['mode'] === 'arcade') {
					$board = getLevel($size, $levelNum);
				} else {
					$board = getRandomLevel($size);
				}
				outputLevel($board);

				?>
			</div>
		</div>
		<div id="win-message" style="display: none;">
			<div>
				<?php

				if (isset($_SESSION['level_score'])) {
					foreach($_SESSION['level_score'] as $l => $s) {
						$lvl = $l + 1;
						echo("<div>Level $lvl score: <span class=\"level-score\">$s</span></div>");
					}
				}

				?>
				<div style="margin-top: 30px;">
					Score: <span id="final-score-text"></span>
				</div>
				<div style="margin-top: 10px;">
					Total Score: <span id="total-score-text"></span>
				</div>
				<form class="buttons" action="nextlevel.php" method="post">
					<input id="final-score" name="score" style="display: none;"/>
					<input id="final-time" name="time" style="display: none;"/>
					<input name="num" style="display: none;" value="<?php echo($levelNum) ?>"/>
					<input name="mode" style="display: none;" value="<?php echo($mode) ?>"/>
					<input name="size" style="display: none;" value="<?php echo($size) ?>"/>
					<button type="submit">
					<?php
						if ($levelNum === 2) {
							echo("Save Game");
						} else {
							echo("Next Level");
						}
					?>
					</button>
				</form>
			</div>
		</div>
		<script type="text/javascript" src="js/picross.js"></script>
	</body>
</html>
