<?php

include_once('classes/mysql.php'); // Includes Mysql Class used for mysql operations

$mysql = new Mysql();

session_start();

$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$quiz_type = $_SESSION['quiz_type'];

if (!$_POST) { // For first question
    $question_number = $_SESSION['question_number'];
    $question = $mysql->getOneQuestion($quiz_type, $question_number);
    $question_count = $mysql->getQuestionCount($quiz_type);
    $answers = $mysql->getAnswersOfQuestion($quiz_type, $question['id']);
    $progress_bar_value = 0;
} else { // JSON request is handled in this part
    $question_id = $_POST['question_id'];
    $answer_option = $_POST['answer_options'];
    $question_number = $_POST['question_number'];
    $question_count = $_POST['question_count'];
    $is_answer_true = 0;
    if ($_POST['which_option_true'] == $_POST['answer_options']) {
        $is_answer_true = 1;
    }
    $response = $mysql->insertUserActivity($user_id, $quiz_type, $question_id, $answer_option, $is_answer_true);
    if ($response) { // If user activity is inserted successfully
        $question_number++;
        if ($question_number != $question_count) { // If last question is not answered yet
            $question = $mysql->getOneQuestion($quiz_type, $question_number);
            $answers = $mysql->getAnswersOfQuestion($quiz_type, $question['id']);
            $progress_bar_value = round(($question_number / $question_count) * 100);
            $data['question_number'] = $question_number;
            $data['question'] = $question;
            $data['answers'] = $answers;
            $data['progress_bar_value'] = $progress_bar_value;
            $data['question_count'] = $question_count;
            $data['show_result'] = false;
            echo json_encode($data);
        } else { // If last question is answered
            $data['show_result'] = true;
            $data['progress_bar_value'] = 100;
            $correct_answer_count = $mysql->getCorrectAnswers($user_id);
            $_SESSION['question_count'] = $question_count;
            $_SESSION['correct_answer_count'] = $correct_answer_count['correct_answer_count'];
            $response = $mysql->updateUserResult($correct_answer_count['correct_answer_count'], $question_count, $user_id);
            if ($response) {
                echo json_encode($data);
            }
        }
    }
}