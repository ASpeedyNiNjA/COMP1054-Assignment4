function confirmDelete() {
	if (confirm('Are you sure you want to delete this?') == true) {
	  // user clicked OK so execute the link
	  return true;
	}
	else {
	  // user clicked Cancel so stop execution
	  return false;
	}
}

function togglePassword() {
	let pwInput = document.getElementById('password');
	let img = document.getElementById('showHide');
 
	if (pwInput.type == 'password') {
	  pwInput.type = 'text';
	  img.src = 'images/skull-x.png';
	}
	else {
	  pwInput.type = 'password';
	  img.src = 'images/skull-straw.png';
	}
}

function comparePasswords() {
	let password = document.getElementById('password').value;
	let confirm = document.getElementById('confirm').value;
	let pwErr = document.getElementById('pwErr');
 
	if (password != confirm) {
	  pwErr.innerText = 'Passwords do not match';
	  return false;
	}
	else {
	  pwErr.innerText = '';
	  return true;
	}
}