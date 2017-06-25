<?php

class Info
{

    public function __construct()
    {
    }

    // Fetch social networks from DB
    public function get_info()
    {
        $res = select_query_assoc(
            'SELECT * FROM info_geral;'
        );
        if (!empty($res)) {
            return json_encode($res);
        } else {
            return null;
        }
    }

    public function update_info($values)
    {
        $json = json_decode($values[0], true);
        $id = $json['id'];
        $title = $json['title'];
        $description = $json['description'];
        $res = execute_query(
            "UPDATE info_geral SET title = '$title', description = '$description' WHERE id = '$id'"
        );
        return json_encode($res);
    }
}

?>