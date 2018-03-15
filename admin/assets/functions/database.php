<?php

function retrieve_config() {
	return parse_ini_file($_SERVER['DOCUMENT_ROOT'] .  '/admin/assets/config/config.ini');
}

function update_db($sql) {
	$config = retrieve_config();
	$conn = new mysqli($config['host'], $config['username'], $config['password'], $config['dbname']);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	return $conn->query($sql);
}

function select_db($sql) {
	$config = retrieve_config();
	$conn = new mysqli($config['host'], $config['username'], $config['password'], $config['dbname']);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	return $conn->query($sql);	
}

function delete_db($sql) {
	$config = retrieve_config();
	$conn = new mysqli($config['host'], $config['username'], $config['password'], $config['dbname']);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	return $conn->query($sql);
}

function insert_db($sql) {
	$config = retrieve_config();
	$conn = new mysqli($config['host'], $config['username'], $config['password'], $config['dbname']);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	if ($conn->query($sql) == true) {
		return $conn->insert_id;
	}
	else
	{
		return null;
	}
}

function tester($file) {
	return $file . "eifhoiefhoi";
}

?>