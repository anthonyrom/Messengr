<?php 

$db = new mysqli("localhost","awromvwi_a","HRzC5[M.tpKM","awromvwi_messengr");

if ($db->connect_error) {
    die("Could not connect to database.");
}

$result = $db->prepare("SELECT * FROM messages");
$result->execute();

$result = $result->get_result();

while ($r = $result->fetch_row()) {
    echo $r[1];
	echo "\\";
	echo $r[2];
	echo "\n";
}