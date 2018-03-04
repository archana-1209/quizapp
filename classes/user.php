<?php

include_once('mysql.php');


class User {

    private $username;
    private $quiz_type;
    private $user_id;
    public $mysql;

    public function createUser() { // Used for creating a new user and starting new session with new user information.
        $this->mysql = new Mysql();
        $this->username = $_POST['username'];
        $this->quiz_type = $_POST['quiz_type'];
        $response = $this->mysql->insertUser($this->username, $this->quiz_type);
        $this->user_id = mysql_insert_id();
        session_start();
        $_SESSION['username'] = $this->username;
        $_SESSION['user_id'] = $this->user_id;
        $_SESSION['quiz_type'] = $this->quiz_type;
        $_SESSION['question_number'] = 0;
        if ($response) {
            echo "<script type='text/javascript'>location.href = 'quiz.php';</script>";
        }
    }
}
