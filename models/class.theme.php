<?php

class Theme
{

    public function __construct()
    {
    }

    // Fetch all Themes from DB
    public function get_themes()
    {
        $res = select_query_assoc(
            "SELECT * FROM theme;"
        );
        if (!empty($res)) {
            return json_encode($res);
        } else {
            return null;
        }
    }

    // Fetch Theme by id from DB
    public function get_theme_by_id($id)
    {
        $res = select_query_assoc(
            "SELECT * FROM theme WHERE id = '$id';"
        );
        if (!empty($res)) {
            return json_encode($res);
        } else {
            return null;
        }
    }

    // Delete Theme by id from DB
    public function delete_theme($id)
    {
        $res = array();
        array_push($res, execute_query(
            "DELETE FROM module WHERE theme_id = '$id';"
        ));
        array_push($res, execute_query(
            "DELETE FROM theme WHERE id = '$id';"
        ));
        return json_encode($res);
    }

    // Add Theme with inserted values into the DB
    public function add_theme($name)
    {
        $res = execute_query(
            "INSERT INTO theme (name) VALUES ('$name')"
        );
        return json_encode($res);
    }

    // Update Theme, given an ID, with updated values into the DB
    public function update_theme($values)
    {
        $json = json_decode($values[0], true);
        $id = $json['id'];
        $name = $json['name'];
        $res = execute_query(
            "UPDATE theme SET name = '$name' WHERE id = '$id'"
        );
        return json_encode($res);
    }
}

?>