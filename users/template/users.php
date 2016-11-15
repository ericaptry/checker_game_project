			<h1>Users</h1>
<?php

foreach($users as $user) {
?>
			<table>
				<tr>
					<td rowspan="4" width="120px"><img src="images/horsehead.jpg"height="100" width="100"></td>
					<td width="150px"><strong>Name:</strong></td>
					<td><?= $user['firstname'] ?> <?= $user['lastname'] ?><?php
					if(isset($usersInGameMap[$user['email']])) {?>
					<a class="button" href='view.php?player=<?= $user['email'] ?>'>View</a>
	<?php				
					} elseif (!empty($_SESSION['email']) && strcasecmp($user['email'], $_SESSION['email'])){?>
 
					<a class="button" href="#" onclick="challenge('<?= $user['email'] ?>');return false;">Challenge</a>

	<?php				}
					?>
					</td>
				</tr>
				<tr>
					<td valign="top"><strong>phone:</strong></td>
					<td><?= $user['phone']?></td>
				</tr>
			</table>
			<br />
 <?php }?>
 <form action="challenge.php" method="post" id="ChallengeForm"><input name="player" id="PlayerToChallenge" type="hidden" /></form>