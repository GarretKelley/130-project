<?php 

include('includes/check-token.php');
validateToken(false);
include('includes/header.php'); 

?>
<div class="wrapper">
	<div id="errorMsg"></div>
	<div class="container">
		<script type="text/javascript">
			var submitButton;
			var createDiv;
			var isLogin;
			function showLogin() {
				submitButton.value = 'Login';
				createDiv.style.display = 'none';
				isLogin = true;
			}
			function showCreate() {
				submitButton.value = 'Create';
				createDiv.style.display = 'block';
				isLogin = false;
			}
			window.addEventListener('load', function() {
				submitButton = document.getElementById('submit-info');
				createDiv = document.getElementById('create-info');
				showLogin();
			});
		</script>
		<ul id="buttons">
			<li>
				<a href="javascript:showLogin()">Sign in</a>
			</li>
			<li>
				<a href="javascript:showCreate()">Sign up</a>
			</li>
		</ul>
		<div id="loginsetup">
			<label for="username">Username:</label><input type="text" id="username"><br/>
			<label for="password">Password:</label><input type="password" id="password"><br/>
			<div id="create-info">
				<label for="create-lastname">Lastname:</label><input type="text" id="create-lastname"><br/>
				<label for="create-firstname">Firstname:</label><input type="text" id="create-firstname"><br/>
				<label for="create-age">Age:</label><input type="text" id="create-age"><br/>
				<label for="create-gender">Gender:</label><input type="text" id="create-gender"><br/>
				<label for="create-location">Location:</label><input type="text" id="create-location"><br/>
			</div>
			<input type="submit" id="submit-info" value="Login"/>
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

				if (this.status === 200 && isLogin) {
					window.location = this.responseText;
				} else {
					errorMsg.innerHTML = this.responseText;
				}
			};
			ajaxRequest.open("POST", "ajax/login.php");
			ajaxRequest.setRequestHeader("Content-Type", "application/json");
			ajaxRequest.send(JSON.stringify(payload));
		}

		var lastnameInput = document.getElementById('create-lastname');
		var firstnameInput = document.getElementById('create-firstname');
		var ageInput = document.getElementById('create-age');
		var genderInput = document.getElementById('create-gender');
		var locationInput = document.getElementById('create-location');
		var userInput = document.getElementById('username');
		var passInput = document.getElementById('password');
		var submitButton = document.getElementById('submit-info');
		submitButton.addEventListener('click', function() {
			if (isLogin) {
				postPlayers({
					mode: 'login',
					username: userInput.value, 
					password: passInput.value,
				});
			} else {
				postPlayers({
					mode: 'create',
					lastname: lastnameInput.value,
					firstname: firstnameInput.value,
					age: ageInput.value,
					gender: genderInput.value,
					location: locationInput.value,
					username: userInput.value, 
					password: passInput.value,
				});
			}
		});
	</script>
</div>
<?php include('includes/footer.php'); ?>
