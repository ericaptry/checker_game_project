<script>
turn = "<?= $turn?>";
board = new Array(8);
for(i = 0; i < 8; i++) board[i] = new Array(8);

function placePieces() {
	
	<?php

	//
	echo "\n //red \n";
	foreach($redPlayer['pieces'] as $piece) {
	echo "board[" . $piece['x'] . "][" . $piece['y'] . "] = 'r';\n ";
	}
	echo "\n //black \n";
	foreach($blackPlayer['pieces'] as $piece) {
	echo "board[" . $piece['x'] . "][" . $piece['y'] . "] = 'b';\n ";
	}

	?>
	drawPieces();
}

</script>

			<h1>Game on</h1>
			
			<span id="spanError" style="color: red"><?php 
			foreach($ErrorMessages as $err) {
			echo $err . "<br />\n";
			}
			
			?></span>

		<p><font color="green"><?= $redPlayer['firstname'] . " " . $redPlayer['lastname'] ?> (red) vs. <?= $blackPlayer['firstname'] . " " . $blackPlayer['lastname'] ?> (black).
			It is currently <?= $turn ?>'s turn.</font></p>
			<canvas id="canBoard" width="640px" height="640px" onclick="<?= strcmp($_SESSION['email'], $currentPlayer['email'])?'return false;':'play(event);' ?>"></canvas>
			<form action="play.php" method="post" id="PlayForm">
			<input name="player" type="hidden" value="<?=$player ?>" />
			<input name="s_x" id="s_x" type="hidden" />
			<input name="s_y" id="s_y" type="hidden" />
			<input name="d_x" id="d_x" type="hidden" />
			<input name="d_y" id="d_y" type="hidden" />
			</form>