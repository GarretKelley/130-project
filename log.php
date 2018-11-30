<?php include('includes/header.php'); ?>
<div class="login">
	<div id="errorMsg"></div>
	<div class="container">
		<div>
			<label for="login-username">Username:</label><input type="text" id="login-username"><br/>
			<label for="login-password">Password:</label><input type="text" id="login-password"><br/>
			<input type="submit" id="login" value="Login"/>
		</div>
		<div>
			<label for="create-lastname">Lastname:</label><input type="text" id="create-lastname"><br/>
			<label for="create-firstname">Firstname:</label><input type="text" id="create-firstname"><br/>
			<label for="create-age">Age:</label><input type="text" id="create-age"><br/>
			<label for="create-gender">Gender:</label><input type="text" id="create-gender"><br/>
			<label for="create-location">Location:</label><input type="text" id="create-location"><br/>
			<label for="create-username">Username:</label><input type="text" id="create-username"><br/>
			<label for="create-password">Password:</label><input type="text" id="create-password"><br/>
			<input type="submit" id="create" value="Create"/>
		</div>
	</div>
	<script type="text/javascript">
		var errorMsg = document.getElementById('errorMsg');

		function postPlayers(payload) {
			var ajaxRequest = new XMLHttpRequest();
			ajaxRequest.onreadystatechange = function() {
				if (this.readyState !== 4) {
					return;
				}

				if (this.status === 200) {
					window.location = this.responseText;
				} else if (this.status === 400) {
					errorMsg.innerHTML = this.responseText;
				}
			};
			ajaxRequest.open("POST", "/130-project/ajax/login.php");
			ajaxRequest.setRequestHeader("Content-Type", "application/json");
			ajaxRequest.send(JSON.stringify(payload));
		}

		var userLoginInput = document.getElementById('login-username');
		var passLoginInput = document.getElementById('login-password');
		var loginButton = document.getElementById('login');
		loginButton.addEventListener('click', function() {
			postPlayers({
				mode: 'login',
				username: userLoginInput.value, 
				password: passLoginInput.value,
			});
		});

		var lastnameInput = document.getElementById('create-lastname');
		var firstnameInput = document.getElementById('create-firstname');
		var ageInput = document.getElementById('create-age');
		var genderInput = document.getElementById('create-gender');
		var locationInput = document.getElementById('create-location');
		var userCreateInput = document.getElementById('create-username');
		var passCreateInput = document.getElementById('create-password');
		var createButton = document.getElementById('create');
		createButton.addEventListener('click', function() {
			postPlayers({
				mode: 'create',
				lastname: lastnameInput.value,
				firstname: firstnameInput.value,
				age: ageInput.value,
				gender: genderInput.value,
				location: locationInput.value,
				username: userCreateInput.value, 
				password: passCreateInput.value,
			});
		});
	</script>
</div>
<?php include('includes/footer.php'); ?>
