<?php
$player  = "";
$redPlayer  = array();
$blackPlayer  = array();


function executeViewGame() {
	global $player;
	if(!empty($_REQUEST['player']))
		$player = trim($_REQUEST['player']);
	
	return validateViewGame() && executeViewGameCommand();
}

function validateViewGame() {
	global $player, $ErrorMessages;
	if(empty($player)) $ErrorMessages['player'] = 'No player was provided to find a game.';

	return empty($ErrorMessages);
}


function executeViewGameCommand() {
	global $player, $redPlayer, $blackPlayer, $turn, $currentPlayer, $ErrorMessages;
	$foundTheGame = false;
	


	$f = fopen('data/challenge.txt', "r");
	while (($buffer = fgets($f)) !== false) {
	
	
		$buffer = trim($buffer);
		if(empty($buffer)) continue;
		
		list($turnIndex, $red, $black, $count, $pieces) = explode(",", $buffer);
		$pieces = explode(":", $pieces); 
		if(!strcmp($player, $red) or !strcmp($player, $black)) {
		
			$pf = fopen('data/members.txt', "r");
			while (($buffer = fgets($pf)) !== false) {
				$buffer = trim($buffer);
				if(empty($buffer)) continue;
				list($e, $p, $fn, $ln, $ph) = explode(",", $buffer);
				if(strcmp($red, $e)) continue;
				$redPlayer['firstname'] = $fn;
				$redPlayer['lastname'] = $ln;
				$redPlayer['email'] = $e;
				$redPlayer['pieces'] = array();
				for($i = 0; $i < $count; $i++) {
					list($x, $y) =  explode(".",$pieces[$i]);
					array_push($redPlayer['pieces'], 
						array(  "x" => $x, 
								"y" => $y));
				}
				break;
			}
			fclose($pf);
			
			
			
			$pf = fopen('data/members.txt', "r");
			while (($buffer = fgets($pf)) !== false) {
				$buffer = trim($buffer);
				if(empty($buffer)) continue;
				list($e, $p, $fn, $ln, $ph) = explode(",", $buffer);
				if(strcmp($black, $e)) continue;
				$blackPlayer['firstname'] = $fn;
				$blackPlayer['lastname'] = $ln;
				$blackPlayer['email'] = $e;
				$blackPlayer['pieces'] = array();
				for($i = $count; $i < sizeof($pieces); $i++) {
					list($x, $y) =  explode(".",$pieces[$i]);
					array_push($blackPlayer['pieces'], 
						array(  "x" => $x, 
								"y" => $y));
				}
				break;
			}
			fclose($pf);
			
			
			if(strcmp($turnIndex,"1")) {
				$turn = "red";
				$GLOBALS["currentPlayer"] = & $redPlayer;
				
			} else {
				$turn = "black";
				$GLOBALS["currentPlayer"] = & $blackPlayer;				
			}
			
			
			return true;
		}

	}

	$ErrorMessages['player'] = "Sorry, we couldn't find a game for user with email '$player'.";
	return false;
}


?>