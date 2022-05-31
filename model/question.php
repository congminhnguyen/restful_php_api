<?php

class Question {
    private $conn;

    //question properties
    public $id;
    public $title;
    public $ans_a;
    public $ans_b;
    public $ans_c;
    public $ans_d;
    public $correct_ans;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //read data
    public function read() {
        $query = 'Select * from question order by id desc';
        $statement = $this->conn->prepare($query);
        $statement->execute();
        return $statement;
    }

    //show data
    public function show() {
        $query = 'Select * from question where id=? limit 1';
        $statement = $this->conn->prepare($query);
        $statement->bindParam(1, $this->id);
        $statement->execute();
        
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $this->title = $row['title'];
        $this->answer_a =  $row['answer_a'];
        $this->answer_b =  $row['answer_b'];
        $this->answer_c =  $row['answer_c'];
        $this->answer_d =  $row['answer_d'];
        $this->correct_answer =  $row['correct_answer'];
    }

    //create data
    public function create() {
        $query = "insert into question set title=:title, answer_a=:answer_a, answer_b=:answer_b, answer_c=:answer_c, answer_d=:answer_d, correct_answer=:correct_answer";
        $statement = $this->conn->prepare($query);

        //clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->answer_a = htmlspecialchars(strip_tags($this->answer_a));
        $this->answer_b = htmlspecialchars(strip_tags($this->answer_b));
        $this->answer_c = htmlspecialchars(strip_tags($this->answer_c));
        $this->answer_d = htmlspecialchars(strip_tags($this->answer_d));
        $this->correct_answer = htmlspecialchars(strip_tags($this->correct_answer));

        //bind data 
        $statement->bindParam(':title', $this->title);
        $statement->bindParam(':answer_a', $this->answer_a);
        $statement->bindParam(':answer_b', $this->answer_b);
        $statement->bindParam(':answer_c', $this->answer_c);
        $statement->bindParam(':answer_d', $this->answer_d);
        $statement->bindParam(':correct_answer', $this->correct_answer);

        if($statement->execute()){
            return true;
        }
        printf("Error %s.\n" , $statement->error);
        return false;
    }

    //update data
    public function update() {
        $query = "update question set title=:title, answer_a=:answer_a, answer_b=:answer_b, answer_c=:answer_c, answer_d=:answer_d, correct_answer=:correct_answer where id=:id";
        $statement = $this->conn->prepare($query);

        //clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->answer_a = htmlspecialchars(strip_tags($this->answer_a));
        $this->answer_b = htmlspecialchars(strip_tags($this->answer_b));
        $this->answer_c = htmlspecialchars(strip_tags($this->answer_c));
        $this->answer_d = htmlspecialchars(strip_tags($this->answer_d));
        $this->correct_answer = htmlspecialchars(strip_tags($this->correct_answer));
        $this->id = htmlspecialchars(strip_tags($this->id));

        //bind data 
        $statement->bindParam(':title', $this->title);
        $statement->bindParam(':answer_a', $this->answer_a);
        $statement->bindParam(':answer_b', $this->answer_b);
        $statement->bindParam(':answer_c', $this->answer_c);
        $statement->bindParam(':answer_d', $this->answer_d);
        $statement->bindParam(':correct_answer', $this->correct_answer);
        $statement->bindParam(':id', $this->id);

        if($statement->execute()){
            return true;
        }
        printf("Error %s.\n" , $statement->error);
        return false;
    }

    //delete data
    public function delete() {
        $query = "delete from question where id=:id";
        $statement = $this->conn->prepare($query);

        //clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        //bind data 
        $statement->bindParam(':id', $this->id);

        if($statement->execute()){
            return true;
        }
        printf("Error %s.\n" , $statement->error);
        return false;
    }
}
