<!DOCTYPE html>
<html>
<head>
	<title>All You Need - Login and Registration</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
</head>
<body class="login">

<h1>All You Need</h1>

<h1 class="header">Login</h1>
<form action="/Users/login" method="post">
<table>
	<tr>
		<td>
		Email:</td><td><input type="text" name="email" /></td>
	</tr>
	<tr>
		<td>
		Password:</td><td><input type="password" name="password" /></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="Login" /></td>
	</tr>
</table>
</form>

<h1 class="header">Register</h1>
<form action="/Users/register" method="post">
<table>
	<tr>
		<td>
		Username:</td><td><input type="text" name="username" /></td>
	</tr>
	<tr>
		<td>
		First name:</td><td><input type="text" name="f_name" /></td>
	</tr>
	<tr>
		<td>
		Last name:</td><td><input type="text" name="l_name" /></td>
	</tr>
	<tr>
		<td>
		Email:</td><td><input type="text" name="email" /></td>
	</tr>
	<tr>
		<td>
		Password:</td><td><input type="password" name="password" /></td>
	</tr>
	<tr>
		<td>
		Confirm password:</td><td><input type="password" name="password_confirmation" /></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="Register" /></td>
	</tr>
</table>
</form>

<?php
	if($this->session->flashdata('errors2'))
	{
		echo $this->session->flashdata('errors2');
	}

	if($this->session->flashdata('errors3'))
	{
		echo $this->session->flashdata('errors3');
	}

	if($this->session->flashdata('errors'))
	{
		echo $this->session->flashdata('errors');
	}
?>

</body>
</html>
