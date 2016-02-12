<?php 
	
	require __DIR__ . '/vendor/autoload.php';
	ORM::configure(array(
		'connection_string' => 'mysql:host=localhost;dbname=dummy',
		'username' => 'root',
		'password' => 'root'
		));
	// ORM::configure('return_result_sets', true);
	$person = ORM::forTable('user');
	$person->name='Fred blogs';

 ?>