<?php include('header.php'); ?>

<h1>Desktop Login View</h1>

<?php
	// create the login form
	print form_open('app/login');
	print form_input('name');
	print form_password('pass');
	print form_submit('button', 'Anmelden');
	print form_close();
?>

<?php include('footer.php'); ?>