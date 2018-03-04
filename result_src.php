<?php

session_start();
$username = $_SESSION['username'];
$correct_answer_count = $_SESSION['correct_answer_count'];
$question_count = $_SESSION['question_count'];
