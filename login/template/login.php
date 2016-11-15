			<h1>Login</h1>

			<span id="spanError" style="color: red"><?php 
			foreach($ErrorMessages as $err) {
			echo $err . "<br />\n";
			}
			
			?></span>
			<br />
			<form method="post">
				<table>
					<tr>
						<td>Email:</td>
						<td><input type="text" id="Email" name="email" value="<?= $email?>"/></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" id="Password1" name="pass1"/></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align: center"><input type="submit" value="Login" /></td>
					</tr>
				</table>
			</form>	

