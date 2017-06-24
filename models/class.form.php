<?php
class Form
{
    public function __construct()
    {
    }
    
    public function get_questions()
    {
        $res = select_query_assoc(
            'SELECT id, question FROM form_question;'
        );
        if (!empty($res)) {
            return json_encode($res);
        } else {
            return null;
        }
    }

    public function answer($user, $answers) // not finished
    {
        $user = json_decode($user, true);
        $returnUserMessage = _answerUser($user);
        $formId = last_insert_id();
        $answers = json_decode($answers, true);
        $returnAnswerMessage = _answerQuestions($answers);

        if ($returnUserMessage == 'successful' && $returnAnswerMessage == 'successful') {
            return 'successful';
        }

        return $returnUserMessage." ".$returnAnswerMessage;
    }

    public function delete_question($id)
    {
        $res = execute_query(
            "DELETE FROM form_question WHERE id = '$id';"
        );
        return json_encode($res);
    }

    public function update_question($values)
    {
        $json = json_decode($values[0], true);
        $id = $json['id'];
        $question = $json['question'];
        $res = execute_query(
            "UPDATE form_question SET question = '$question' WHERE id = '$id'"
        );
        return json_encode($res);
    }

    public function insert_question($question)
    {
        $res = execute_query(
            "INSERT INTO form_question (question) VALUES ('$question')"
        );
        return json_encode($res);
    }

    private function _answerUser($user)  // not finished
    {
        $user_name = $user['name'];
        $user_email = $user['email'];
        $user_contact = $user['contact'];
        $currentDate = date();
        $query = "INSERT INTO form VALUES (null, $user_name, $user_contact, $user_email, $currentDate)";
        $resForm = execute_query($query);

        return $resForm;
    }

    private function _answerQuestions($formId, $answers)  // not finished
    {
        $query = "INSERT INTO form_answers VALUES";
        foreach ($answers as $key => $value) {
            $query += "($formId, $key, $value)";
        }
        $query += ");";
        $resForm = execute_query($query);
        return $resForm;
    }
}

?>