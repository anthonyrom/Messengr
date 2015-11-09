<?php 

$db = new mysqli("localhost","awromvwi_a","HRzC5[M.tpKM","awromvwi_messengr");

if ($db->connect_error) {
    die("Couldn't connect to DB");
}

$username = stripslashes(htmlspecialchars($_GET['username']));
$message = stripslashes(htmlspecialchars($_GET['message']));

if ($username == "" || $message == "") {
    die();
}

$result = $db->prepare("INSERT INTO messages VALUES('',?,?)");
$result->bind_param("ss", $username, $message);
$result->execute();

echo "test"