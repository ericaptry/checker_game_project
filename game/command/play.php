<?php
$s_x = $s_y = $d_x = $d_y  = "";
$redPlayer  = array();
$blackPlayer  = array();


function executePlayGame() {
	global $player, $s_x, $s_y, $d_x, $d_y;
	if(!empty($_REQUEST['player']))
		$player = trim($_REQUEST['player']);
	
	if(sizeof($_REQUEST['s_x']))
		$s_x = (int)trim($_REQUEST['s_x']);
	
	if(sizeof($_REQUEST['s_y']))
		$s_y = (int)trim($_REQUEST['s_y']);
	
	if(sizeof($_REQUEST['d_x']))
		$d_x = (int)trim($_REQUEST['d_x']);
	
	if(sizeof($_REQUEST['d_y']))
		$d_y = (int)trim($_REQUEST['d_y']);
	
	return validatePlayGame() && executePlayGameCommand();
}

function validatePlayGame() {
	global $player, $s_x, $s_y, $d_x, $d_y, $ErrorMessages;
	if(empty($player)) $ErrorMessages['player'] = 'No player was provided to find a game.';
	
	if(!sizeof($s_x) || !sizeof($s_y) || !sizeof($d_x) || !sizeof($d_y)) $ErrorMessages['s_x'] = 'The move coordinates were corrupt.';

	return empty($ErrorMessages);
}

function executePlayGameCommand() {
	global $player, $s_x, $s_y, $d_x, $d_y, $redPlayer, $blackPlayer, $turn, $currentPlayer, $ErrorMessages;

	
	if(strcmp($_SESSION['email'], $currentPlayer['email'])) {
		$ErrorMessages['player'] = "It isn't your turn!";
		return false;
	}
	
	if($s_x < 0 || $s_x >= 8 || $s_y < 0 || $s_y >= 8 || $d_x < 0 || $d_x >= 8 || $d_y < 0 || $d_y >= 8) {
		$ErrorMessages['s_x'] = "You must stay on the board!";
		return false;
	}
	
	$board = array();
	for($i=0; $i<8;$i++) {
		$board[$i] = array();
		for($j=0; $j<8;$j++)$board[$i][$j]=false;
	}
	
	foreach($redPlayer['pieces'] as $piece) {
		$board[$piece['x']][$piece['y']] = 'r';
	}
	
	foreach($blackPlayer['pieces'] as $piece) {
		$board[$piece['x']][$piece['y']] = 'b';
	}

	if(isset($board[$s_x][$s_y]) && ((!strcmp($turn,"red") && !strcmp($board[$s_x][$s_y],'r')) || (!strcmp($turn,"black") && !strcmp($board[(int)$s_x][(int)$s_y],'b')))) {

	} else {
		$ErrorMessages['s_x'] = "You may only move your own pieces.";
		return false;
	}
	$valid=false;
	
	if(!$board[$d_x][$d_y] && (($d_x+$d_y)%2==0)) { 
		$direction = (!strcmp($turn,"red"))?-1:1;
		$otherSide = (!strcmp($turn,"red"))?'b':'r';
		if(abs($s_y-$d_y)==1) { //We're just moving
			if($s_x-$d_x==$direction) $valid = true; //right direction
		} else if (abs($s_y-$d_y)==2) { //We're taking a piece
			if(($s_x-$d_x)==($direction*2)) { //right direction
				if(!strcmp($board[$d_x+$direction][$d_y+(($s_y-$d_y)/2)] , $otherSide)) $valid = true;
			}
		}
	}
	
	$otherGames="";
	if($valid) {
		$turnIndex = (!strcmp($turn,"red"))?1:0; //switch turns

		foreach($currentPlayer['pieces'] as $key => $piece) {
			if($piece['x']==$s_x && $piece['y']==$s_y) {
				unset($currentPlayer['pieces'][$key]);
				$currentPlayer['pieces'] = array_values($currentPlayer['pieces']);
				array_push($currentPlayer['pieces'],
				array(  "x" => $d_x,
				"y" => $d_y));
				break;
			}
		}
		
		
		if(abs($s_y-$d_y)!=1) { //Remove the taken piece
			//Setting the reference
			if($currentPlayer==$redPlayer) {
				$playerThatLostAPiece = & $blackPlayer;
			} else {
				$playerThatLostAPiece = & $redPlayer; 
			}
			foreach($playerThatLostAPiece['pieces'] as $key => $piece) {
				if($piece['x']==($d_x+$direction) && $piece['y']==($d_y+(($s_y-$d_y)/2))) {
					unset($playerThatLostAPiece['pieces'][$key]);
					$playerThatLostAPiece['pieces'] = array_values($playerThatLostAPiece['pieces']);
					break;
				}
			}	
			
		}
		
		//Save State
		$f = fopen('data/challenge.txt', "r");
		while (($buffer = fgets($f)) !== false) {
			
			
			$buffer = trim($buffer);
			if(empty($buffer)) continue;
			list($ti, $red, $black, $count, $pieces) = explode(",", $buffer);
			$pieces = explode(":", $pieces);
			if(!strcmp($player, $red) or !strcmp($player, $black)) {
					
			} else {
				$otherGames .= $buffer . "\n";
			}
		}
		fclose($f);
		
		//Make the line
		$redPieces = array();
		$blackPieces = array();
		foreach($redPlayer['pieces'] as $piece) {
			array_push($redPieces, $piece['x'].".".$piece['y']);
		}
		foreach($blackPlayer['pieces'] as $piece) {
			array_push($blackPieces, $piece['x'].".".$piece['y']);
		}
		
		
		$f = fopen('data/challenge.txt', "w");
		
		$array = array($turnIndex, $redPlayer['email'], $blackPlayer['email'], sizeof($redPlayer['pieces']), implode(":", $redPieces) . ":" . implode(":", $blackPieces));

		//Write the line
		fputs($f, implode(",", $array) . "\n");
		fputs($f, $otherGames);
		fclose($f);
		return true;
	}

	$ErrorMessages['s_x'] = "That move is invalid. " ;
	return false;
}


?>
