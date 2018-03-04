<?php

include_once('classes/mysql.php'); // Includes Mysql Class used for mysql operations
include_once('classes/user.php'); // Includes User Class used for user operations

$mysql = new Mysql();
$user = new User();

$is_form_posted = False;
if (array_key_exists('is_form_posted', $_POST)) { // Check if $_POST has 'is_form_posted' key
    $is_form_posted = $_POST['is_form_posted'];
}
if ($is_form_posted) { // If form is posted, create a new user
    $user->createUser();
} else { // Initially index.php is getting the quiz types from here
    $quiz_types = $mysql->getAllQuizTypes();
}
