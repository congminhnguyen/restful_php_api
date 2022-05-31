<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/question.php');

$db = new db();
$connect = $db->connect();

$question = new Question($connect);

$question->id = isset($_GET['id']) ? $_GET['id'] : die();

$question->show();

$question_item = array(
    'id' => $question->id,
    'title' => $question->title,
    'answer_a' => $question->answer_a,
    'answer_b' => $question->answer_b,
    'answer_c' => $question->answer_c,
    'answer_d' => $question->answer_d,
    'correct_answer' => $question->correct_answer,
);

print_r(json_encode($question_item));