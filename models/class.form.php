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

    public function answer($user, $answers)
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

    public function update_question($id, $question)
    {
        return true;
    }

    public function insert_question($question)
    {
        return true;
    }

    private function _answerUser($user)
    {
        $user_name = $user['name'];
        $user_email = $user['email'];
        $user_contact = $user['contact'];
        $currentDate = date();
        $query = "INSERT INTO form VALUES (null, $user_name, $user_contact, $user_email, $currentDate)";
        $resForm = execute_query($query);

        return $resForm;
    }

    private function _answerQuestions($formId, $answers)
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