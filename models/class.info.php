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
            'SELECT title, description FROM info_geral;'
        );
        if (!empty($res)) {
            return json_encode($res);
        } else {
            return null;
        }
    }

    public function update_info($id, $title, $desc)
    {
        $res = execute_query(
            "UPDATE info_geral SET title = '$title', description = '$desc' WHERE id = $id"
        );
        return json_encode($res);
    }
}

?>