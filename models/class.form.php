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

    public function get_answers()
    {
        $res = select_query_assoc(
            'SELECT * FROM form;'
        );

        if (!empty($res)) {
            foreach($res as $form){
                $answers = select_query_assoc(
                    'SELECT answer, question FROM form_answers, form_question WHERE form_answers.form_id = ? AND '.
                    ' form_question.id = form_answers.question_id', array($form['id'])
                );
                $form_answers[] = array(
                    'id' => $form['id'],
                    'visitante_name' => $form['visitante_name'],
                    'contact' => $form['contact'],
                    'email' => $form['email'],
                    'creation_date' => $form['creation_date'],
                    'answers'=>$answers
                );
            }
            return json_encode($form_answers);
        } else {
            return null;
        }
    }

    public function answer($values)
    {
        $json = json_decode($values[0], true);
        $name = $json['name'];
        $contact = $json['contact'];
        $mail = $json['mail'];
        $today = date("Y-m-d H:i:s");
        $res = array();
        array_push($res, execute_query(
            "INSERT INTO form (visitante_name, contact, email, creation_date) VALUES ('$name', '$contact', '$mail', '$today')"
        ));
        $formId = last_insert_id();
        foreach($json['questions'] as $question){
            $id = $question['id'];
            $answer = $question['answer'];
            array_push($res, execute_query(
                "INSERT INTO form_answers (form_id, question_id, answer) VALUES ('$formId', '$id', '$answer')"
            ));
        }
        return $res;
    }

    public function delete_question($id)
    {
        $res = array();
        array_push($res, execute_query(
            "DELETE FROM form_answers WHERE question_id = '$id'"
        ));
        array_push($res, execute_query(
            "DELETE FROM form_question WHERE id = '$id'"
        ));
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
            "INSERT INTO form_question (question) VALUES ('$question[0]')"
        );
        return json_encode($res);
    }
}

?>
