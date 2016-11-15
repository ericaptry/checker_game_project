			<h1>Register</h1>

			<span id="spanError" style="color: red"><?php 
			foreach($ErrorMessages as $err) {
			echo $err . "<br />\n";
			}
			
			?></span>
			<br />
			<form method="post">
				<table>
					<tr>
						<td>First name:</td>
						<td><input type="text" id="FirstName" name="firstname" value="<?= $firstname?>"/></td>
					</tr>
					<tr>
						<td>Last name:</td>
						<td><input type="text" id="LastName" name="lastname" value="<?= $lastname?>"/></td>
					</tr>
					<tr>
						<td>Phone number:</td>
						<td><input type="text" id="PhoneNumber" placeholder="(999) 999-9999" name="phone" value="<?= $phone?>"/></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><input type="text" id="Email" name="email" value="<?= $email?>"/></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" id="Password1" name="pass1"/></td>
					</tr>
					<tr>
						<td>Confirm password:</td>
						<td><input type="password" id="Password2" name="pass2"/></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align: center"><input type="submit" value="Register" onclick="return validateRegistration();" /></td>
					</tr>
				</table>
			</form>	

