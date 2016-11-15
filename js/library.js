function startClock() {
	var now = new Date();

	var hours = now.getHours() < 10 ? '0' + now.getHours() : now.getHours();
	var minutes = now.getMinutes() < 10 ? '0' + now.getMinutes() : now.getMinutes();
	var seconds = now.getSeconds() < 10 ? '0' + now.getSeconds() : now.getSeconds();

	document.getElementById('spanClock').innerHTML = hours + ':' + minutes + ':' + seconds;
	setTimeout(function() { startClock() }, 1000);
}

function validateRegistration() {
	var strFirstName = document.getElementById('FirstName').value;
	var strLastName = document.getElementById('LastName').value;
	var strPhoneNumber = document.getElementById('PhoneNumber').value;
	var strEmail = document.getElementById('Email').value;
	var strPassword1 = document.getElementById('Password1').value;
	var strPassword2 = document.getElementById('Password2').value;

	var regPhone = /^\([0-9]{3}\) [0-9]{3}\-[0-9]{4}$/;
	var regEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

	var strError = '';

	if (strFirstName == '')
		strError += 'First name field is empty<br />';

	if (strLastName == '')
		strError += 'Last name field is empty<br />';

	if (strPhoneNumber == '')
		strError += 'Phone number field is empty<br />';

	if (strEmail == '')
		strError += 'Email field is empty<br />';

	if (strPassword1 == '')
		strError += 'Password field is empty<br />';

	if (strPassword2 == '')
		strError += 'Password confirmation field is empty<br />';

	if (strError == '') {
		if (!regPhone.test(strPhoneNumber))
			strError += 'Invalid phone number, proper format: (999) 999-9999<br />'

		if (!regEmail.test(strEmail))
			strError += 'Invalid e-mail format<br />';

		if (strPassword1 != strPassword2)
			strError += 'Password fields don\'t match<br />';
	}

	if (strError != '') {
		document.getElementById('spanError').innerHTML = strError;
		return false;
	}
	return true;
	
}

function buildBoard() {
	var canvas = document.getElementById('canBoard');
	var con = canvas.getContext('2d');

	con.fillStyle = 'black';
	con.fillRect(0, 0, 640, 640);

	for (var i = 0; i < 8; i++) {
		for (var j = 0; j < 8; j++) {
			if (((i+j) % 2) == 0) {
				con.fillStyle = 'white';
				if(pieceToMove && i==pieceToMove.x && j==pieceToMove.y) con.fillStyle = '#AAFF66';
				con.fillRect(i*80, j*80, 80, 80);
			}
		}

	}
}

function addPieces() {
	var canvas = document.getElementById('canBoard');
	var con = canvas.getContext('2d');

	for (var i = 0; i < 8; i++) {
		for (var j = 0; j < 8; j++) {

			if ((i+j)%2 == 0 && (i < 3 || i > 4)) {
				con.beginPath();
				con.arc(i*80+40, j*80+40, 35, 0, 2*Math.PI);
				if (i<3) {
					con.fillStyle = 'red'
				} else {
					con.fillStyle = 'grey';
				}
				con.fill();
				con.stroke();
				
			}
		}
	}
}

function drawPieces() {
	var canvas = document.getElementById('canBoard');
	var g = canvas.getContext('2d');
	
	for (var x = 0; x < 8; x++) {
		for (var y = 0; y < 8; y++) {
			if(board[x][y]=='r') {
				g.beginPath();
				g.arc(x*80+40, y*80+40, 35, 0, 2*Math.PI);		
				g.fillStyle = 'red';
				g.fill();
				g.stroke();
			} else if(board[x][y]=='b') {
				g.beginPath();
				g.arc(x*80+40, y*80+40, 35, 0, 2*Math.PI);		
				g.fillStyle = 'grey';
				g.fill();
				g.stroke();
			}
		}
	}

}

function challenge(email) {
	 document.getElementById('PlayerToChallenge').value=email;
	 document.getElementById('ChallengeForm').submit();
}

function actualLeft(current) {
	if(current == null) return 0;
	return current.offsetLeft + actualLeft(current.offsetParent);
}

function actualTop(current) {
	if(current == null) return 0;
	return current.offsetTop + actualTop(current.offsetParent);
}

pieceToMove = false;


function play(e){
	//Get the x and y on the canvas
	var x = Math.floor(((e.clientX-actualLeft(e.target)+window.pageXOffset)/80));
	var y = Math.floor(((e.clientY-actualTop(e.target)+window.pageYOffset)/80));
	if(!pieceToMove) { //Trying to move a piece
		if((turn=="red" && board[x][y]=='r') || (turn=="black" && board[x][y]=='b')) {
			//A little bit of JSON to get you started on assignment 4
			pieceToMove = {"x": x, "y": y};
		}
	} else if (x == pieceToMove.x && y==pieceToMove.y) { // undoing a move
		pieceToMove = false;
	} else { 
		if(!board[x][y] && ((x+y)%2==0)) { //no pieces already there and a valid square
			var valid=false;
			var direction = (turn=="red")?-1:1;
			var otherSide = (turn=="red")?'b':'r';
			if(Math.abs(pieceToMove.y-y)==1) { //We're just moving
				if(pieceToMove.x-x==direction) valid = true; //right direction
			} else if (Math.abs(pieceToMove.y-y)==2) { //We're taking a piece
				if(pieceToMove.x-x==direction*2) { //right direction
					if(board[x+direction][y+((pieceToMove.y-y)/2)]==otherSide) valid = true; //there was a piece of the other color in between
				}
			}
		}
	}
	if(valid) {
		document.getElementById('s_x').value=pieceToMove.x;
		document.getElementById('s_y').value=pieceToMove.y;
		document.getElementById('d_x').value=x;
		document.getElementById('d_y').value=y;
		document.getElementById('PlayForm').submit();
	}
	buildBoard();
	drawPieces();
}
	
	
