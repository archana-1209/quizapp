<?php

class Mysql { // Mysql class for mysql operations

    private $conn;
    private $host;
    private $user;
    private $password;
    private $baseName;
    private $port;
    private $Debug;

    function __construct($params = array()) { // Edits mysql configuration on __construct method
        $this->conn = false;
        $this->host = 'localhost';
        $this->user = 'root';
        $this->password = '';
        $this->baseName = 'quizapp';
        $this->port = '3306';
        $this->debug = true;
        $this->connect();
    }

    function __destruct() {
        $this->disconnect();
    }

    function connect() { // Connects the database
        if (!$this->conn) {
            $this->conn = mysql_connect($this->host, $this->user, $this->password);
            mysql_select_db($this->baseName, $this->conn);
            mysql_set_charset('utf8', $this->conn);

            if (!$this->conn) {
                $this->status_fatal = true;
                echo 'Connection failed';
                die();
            } else {
                $this->status_fatal = false;
            }
        }

        return $this->conn;
    }

    function disconnect() {  // Disconnects from database
        if ($this->conn) {
            @pg_close($this->conn);
        }
    }

    function getOne($query) { // Gets one row from a table
        $cnx = $this->conn;
        if (!$cnx || $this->status_fatal) {
            echo 'Get One -> Connection failed';
            die();
        }

        $cur = @mysql_query($query, $cnx);

        if ($cur == FALSE) {
            $errorMessage = @pg_last_error($cnx);
            $this->handle_error($query, $errorMessage);
        } else {
            $this->Error = FALSE;
            $this->BadQuery = "";
            $tmp = mysql_fetch_array($cur, MYSQL_ASSOC);

            $return = $tmp;
        }

        @mysql_free_result($cur);
        return $return;
    }

    function getAll($query) { // Gets multiple or all rows from a table
        $cnx = $this->conn;
        if (!$cnx || $this->status_fatal) {
            echo 'Get All -> Connection failed';
            die();
        }

        mysql_query("SET NAMES 'utf8'");
        $cur = mysql_query($query);
        $return = array();

        while ($data = mysql_fetch_assoc($cur)) {
            array_push($return, $data);
        }

        return $return;
    }

    function getAllQuizTypes() { // Gets all quiz types from quiz_types table
        $cnx = $this->conn;
        if (!$cnx || $this->status_fatal) {
            echo 'Get All Quiz Types -> Connection failed';
            die();
        }

        mysql_query("SET NAMES 'utf8'");
        $query = 'select * from quiz_types order by quiz_type asc';
        $cur = mysql_query($query);
        $return = array();

        while ($data = mysql_fetch_assoc($cur)) {
            array_push($return, $data);
        }

        return $return;
    }

    function getOneQuestion($quiz_type, $question_number) { // Gets only one question from questions table with given number by limit x, 1
        $cnx = $this->conn;
        if (!$cnx || $this->status_fatal) {
            echo 'Get One Question -> Connection failed';
            die();
        }

        $query = "select * from questions where quiz_type = {$quiz_type} order by id asc limit {$question_number}, 1";
        $cur = @mysql_query($query, $cnx);

        if ($cur == FALSE) {
            $errorMessage = @pg_last_error($cnx);
            $this->handle_error($query, $errorMessage);
        } else {
            $this->Error = FALSE;
            $this->BadQuery = "";
            $tmp = mysql_fetch_array($cur, MYSQL_ASSOC);

            $return = $tmp;
        }

        @mysql_free_result($cur);
        return $return;
    }

    function getQuestionCount($quiz_type) { // Gets count of questions of selected quiz type
        $cnx = $this->conn;
        if (!$cnx || $this->status_fatal) {
            echo 'Get Question Count -> Connection failed';
            die();
        }

        $query = "select count(id) as count from questions where quiz_type = {$quiz_type}";
        $cur = @mysql_query($query, $cnx);

        if ($cur == FALSE) {
            $errorMessage = @pg_last_error($cnx);
            $this->handle_error($query, $errorMessage);
        } else {
            $this->Error = FALSE;
            $this->BadQuery = "";
            $tmp = mysql_fetch_array($cur, MYSQL_ASSOC);

            $return = $tmp;
        }

        @mysql_free_result($cur);
        return $return;
    }

    function getAnswersOfQuestion($quiz_type, $question_id) { // Gets all answer options of the selected question
        $cnx = $this->conn;
        if (!$cnx || $this->status_fatal) {
            echo 'Get Answers of Question -> Connection failed';
            die();
        }

        mysql_query("SET NAMES 'utf8'");
        $query = "select * from answer_options where quiz_type = {$quiz_type} and question = {$question_id}";
        $cur = mysql_query($query);
        $return = array();

        while ($data = mysql_fetch_assoc($cur)) {
            array_push($return, $data);
        }

        return $return;
    }

    function getCorrectAnswers($user_id) { // Gets the correct answers of user
        $cnx = $this->conn;
        if (!$cnx || $this->status_fatal) {
            echo 'Get Question Count -> Connection failed';
            die();
        }

        $query = "select count(is_answer_true) as correct_answer_count from user_activity where user_id = {$user_id} and is_answer_true = 1";
        $cur = @mysql_query($query, $cnx);

        if ($cur == FALSE) {
            $errorMessage = @pg_last_error($cnx);
            $this->handle_error($query, $errorMessage);
        } else {
            $this->Error = FALSE;
            $this->BadQuery = "";
            $tmp = mysql_fetch_array($cur, MYSQL_ASSOC);

            $return = $tmp;
        }

        @mysql_free_result($cur);
        return $return;
    }

    function updateUserResult($correct_answer_count, $question_count, $user_id) { // Updates user_result field on user table after finishing the quiz
        $cnx = $this->conn;
        if (!$cnx || $this->status_fatal) {
            return null;
        }

        $query = "update user SET result='{$correct_answer_count}/{$question_count}' WHERE id={$user_id}";
        $cur = @mysql_query($query, $cnx);

        if ($cur == FALSE) {
            $ErrorMessage = @mysql_last_error($cnx);
            $this->handle_error($query, $ErrorMessage);
        } else {
            $this->Error = FALSE;
            $this->BadQuery = "";
            $this->NumRows = mysql_affected_rows();
            return $cur;
        }
        @mysql_free_result($cur);
    }

    function insertUserActivity($user_id, $quiz_type, $question_id, $answer_option, $is_answer_true) { // Inserts a row to user_activity table each time a user answers a question
        $cnx = $this->conn;
        if (!$cnx || $this->status_fatal) {
            return null;
        }

        $query = "insert into user_activity (user_id, quiz_type, question, answer_option, is_answer_true) values ({$user_id}, {$quiz_type}, {$question_id},{$answer_option}, {$is_answer_true})";
        $cur = @mysql_query($query, $cnx);

        if ($cur == FALSE) {
            $ErrorMessage = @mysql_last_error($cnx);
            $this->handle_error($query, $ErrorMessage);
        } else {
            $this->Error = FALSE;
            $this->BadQuery = "";
            $this->NumRows = mysql_affected_rows();
            return $cur;
        }
        @mysql_free_result($cur);
    }
    
    function insertUser($username, $quiz_type) { // Inserts a new user with selected quiz type
        $cnx = $this->conn;
        if (!$cnx || $this->status_fatal) {
            return null;
        }

        $query = "insert into user (username, quiz_type) values ('{$username}', {$quiz_type})";
        $cur = @mysql_query($query, $cnx);

        if ($cur == FALSE) {
            $ErrorMessage = @mysql_last_error($cnx);
            $this->handle_error($query, $ErrorMessage);
        } else {
            $this->Error = FALSE;
            $this->BadQuery = "";
            $this->NumRows = mysql_affected_rows();
            return $cur;
        }
        @mysql_free_result($cur);
    }

    function execute($query, $use_slave = false) { // Can be used for all kinds of Insert and Update operations
        $cnx = $this->conn;
        if (!$cnx || $this->status_fatal) {
            return null;
        }

        $cur = @mysql_query($query, $cnx);

        if ($cur == FALSE) {
            $ErrorMessage = @mysql_last_error($cnx);
            $this->handle_error($query, $ErrorMessage);
        } else {
            $this->Error = FALSE;
            $this->BadQuery = "";
            $this->NumRows = mysql_affected_rows();
            return $cur;
        }
        @mysql_free_result($cur);
    }

    function handleError($query, $str_erreur) { // For error handling
        $this->Error = TRUE;
        $this->BadQuery = $query;
        if ($this->Debug) {
            echo "Query : " . $query . "<br>";
            echo "Error : " . $str_erreur . "<br>";
        }
    }

}
