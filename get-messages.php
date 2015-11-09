<?php 

$db = new mysqli("localhost","awromvwi_a","HRzC5[M.tpKM","awromvwi_messengr");

if ($db->connect_error) {
    die("Couldn't connect to DB");
}