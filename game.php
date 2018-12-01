<?php

include('includes/check-token.php');
include('includes/header.php');

?>
		<div class="container">
			<div class="controls">
				<h1 class="title">
					PICROSS
				</h1>
				<div class="control-group">
					<h3>Time</h3>
					<div class="stopwatch"></div>
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
						<tr>
							<td></td>
							<td class="key top">1</td>
							<td class="key top">4</td>
							<td class="key top">2</td>
							<td class="key top"></td>
							<td class="key top">1</td>
							<td class="key top">4</td>
							<td class="key top">2</td>
						</tr>
						<tr>
							<td class="key left"></td>
							<td class="cell s0" data-x="0" data-y="0"></td>
							<td class="cell s0" data-x="0" data-y="1"></td>
							<td class="cell s0" data-x="0" data-y="2"></td>
							<td class="cell s0" data-x="0" data-y="3"></td>
							<td class="cell s0" data-x="0" data-y="4"></td>
							<td class="cell s0" data-x="0" data-y="5"></td>
							<td class="cell s0" data-x="0" data-y="6"></td>
						</tr>
						<tr>
							<td class="key left">2&nbsp;1</td>
							<td class="cell s0" data-x="1" data-y="0"></td>
							<td class="cell s0" data-x="1" data-y="1"></td>
							<td class="cell s0" data-x="1" data-y="2"></td>
							<td class="cell s0" data-x="1" data-y="3"></td>
							<td class="cell s0" data-x="1" data-y="4"></td>
							<td class="cell s0" data-x="1" data-y="5"></td>
							<td class="cell s0" data-x="1" data-y="6"></td>
						</tr>
						<tr>
							<td class="key left">2</td>
							<td class="cell s0" data-x="2" data-y="0"></td>
							<td class="cell s0" data-x="2" data-y="1"></td>
							<td class="cell s0" data-x="2" data-y="2"></td>
							<td class="cell s0" data-x="2" data-y="3"></td>
							<td class="cell s0" data-x="2" data-y="4"></td>
							<td class="cell s0" data-x="2" data-y="5"></td>
							<td class="cell s0" data-x="2" data-y="6"></td>
						</tr>
						<tr>
							<td class="key left">2</td>
							<td class="cell s0" data-x="3" data-y="0"></td>
							<td class="cell s0" data-x="3" data-y="1"></td>
							<td class="cell s0" data-x="3" data-y="2"></td>
							<td class="cell s0" data-x="3" data-y="3"></td>
							<td class="cell s0" data-x="3" data-y="4"></td>
							<td class="cell s0" data-x="3" data-y="5"></td>
							<td class="cell s0" data-x="3" data-y="6"></td>
						</tr>
						<tr>
							<td class="key left">1</td>
							<td class="cell s0" data-x="4" data-y="0"></td>
							<td class="cell s0" data-x="4" data-y="1"></td>
							<td class="cell s0" data-x="4" data-y="2"></td>
							<td class="cell s0" data-x="4" data-y="3"></td>
							<td class="cell s0" data-x="4" data-y="4"></td>
							<td class="cell s0" data-x="4" data-y="5"></td>
							<td class="cell s0" data-x="4" data-y="6"></td>
						</tr>
						<tr>
							<td class="key left">1</td>
							<td class="cell s0" data-x="5" data-y="0"></td>
							<td class="cell s0" data-x="5" data-y="1"></td>
							<td class="cell s0" data-x="5" data-y="2"></td>
							<td class="cell s0" data-x="5" data-y="3"></td>
							<td class="cell s0" data-x="5" data-y="4"></td>
							<td class="cell s0" data-x="5" data-y="5"></td>
							<td class="cell s0" data-x="5" data-y="6"></td>
						</tr>
						<tr>
							<td class="key left">1</td>
							<td class="cell s0" data-x="6" data-y="0"></td>
							<td class="cell s0" data-x="6" data-y="1"></td>
							<td class="cell s0" data-x="6" data-y="2"></td>
							<td class="cell s0" data-x="6" data-y="3"></td>
							<td class="cell s0" data-x="6" data-y="4"></td>
							<td class="cell s0" data-x="6" data-y="5"></td>
							<td class="cell s0" data-x="6" data-y="6"></td>
						</tr>
				</table>
			</div>
		</div>
		<script type="text/javascript" src="js/picross.js"></script>
	</body>
</html>
