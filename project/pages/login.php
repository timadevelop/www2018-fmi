<?php include_once("parts/header.php") ?>
<div class="ui-form">
	<form action="me.php">
	<h3>Login  /  register</h3>
	<div class="form-row">
		<input type="text" id="email" required autocomplete="off"><label for="email">Email</label>
	</div>
	<div class="form-row">
		<input type="password" id="password" required autocomplete="off"><label for="password">Password</label>
	</div>
	<p><input type="submit" value="Login"></p>
</form>

<a href="me.html"><input class="form-btn" id="google-login" type="submit" value="Login with Google"></a>
<a href="me.html"><input class="form-btn" id="fb-login" type="submit" value="Login with Facebook"></a>
<a href="login_company.html"><input class="form-btn" id="company-login" type="submit" value="I represent a company"></a>

</div>
<?php include_once("parts/footer.php") ?>
