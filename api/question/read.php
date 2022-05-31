<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/question.php');

$db = new db();
$connect = $db->connect();

$question = new Question($connect);
$read = $question->read();

$num = $read->rowCount();

if($num > 0) {
    $question_array = [];
    $question_array['question'] = [];

    while($row = $read->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $question_item = array(
            'id' => $id,
            'title' => $title,
            'answer_a' => $answer_a,
            'answer_b' => $answer_b,
            'answer_c' => $answer_c,
            'answer_d' => $answer_d,
            'correct_answer' => $correct_answer,
        );

        array_push($question_array['question'], $question_item);
    }
    echo json_encode($question_array);
}