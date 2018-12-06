<?php

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
				<div class="control-group">
					<h3>Time</h3>
					<div class="stopwatch">00:00:00</div>
					<h3>Turns</h3>
					<span id="turnsCounter">0</span>
					<h3>Mistakes</h3>
					<span id="mistakesCounter">0</span>
				</div>
				<div class="control-group">
					<h3>Settings</h3>
					<form name="gridSize">Grid Size
						<select id="gSize"></select>
					</form>
					<form name="blockColorForm"> Block Color
						<select id="bColorOptions"></select>
					</form>
					<form name="gridColorForm"> Grid Color
						<select id="gColorOptions"></select>
					</form>
				</div>
				<div class="control-group">
					<div class ="buttons">
						<button id="suggest">Suggest Best Move &raquo;</button>
						<button id="new">New Game &raquo;</button>
						<button id="arcade">Arcade Mode</button>
						<button id="timed">Time Attack</button>
					</div>
				</div>
			</div>
			<div id="puzzle">
				<table class = 'gameTable'>
					<?php

					if (isset($_GET['mode']) && $_GET['mode'] === 'rand') {
						$level = getRandomLevel();
					}

					// Header
					echo("<tr><th></th>");
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

					?>
				</table>
			</div>
		</div>
		<script type="text/javascript" src="js/picross.js"></script>
	</body>
</html>
