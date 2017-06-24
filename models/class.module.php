<?php

class Modules
{

    public function __construct()
    {
    }

    // Fetch all Modules from DB
    public function get_modules()
    {
        $res = select_query_assoc(
            'SELECT * FROM module;'
        );
        if (!empty($res)) {
            foreach ($res as $modules) {
                $theme = Theme::get_theme_by_id($modules['theme_id']);
                $modulesList[] = array(
                    'id' => $modules['id'],
                    'title' => $modules['title'],
                    'description' => $modules['description'],
                    'theme_id' => $modules['theme_id'],
                    'audio_path' => $modules['audio_path'],
                    'theme_name' => $theme['name']
                );
            }
            return json_encode($modulesList);
        } else {
            return null;
        }
    }

    // Fetch a Module by id from DB
    public function get_modules_by_id($id)
    {
        $res = select_query_assoc(
            "SELECT * FROM module WHERE id = $id;"
        );
        if (!empty($res)) {
            foreach ($res as $modules) {
                $theme = Theme::get_theme_by_id($modules['theme_id']);
                $modulesList[] = array(
                    'id' => $modules['id'],
                    'title' => $modules['title'],
                    'description' => $modules['description'],
                    'theme_id' => $modules['theme_id'],
                    'audio_path' => $modules['audio_path'],
                    'theme_name' => $theme
                );
            }
            return json_encode($modulesList);
        } else {
            return null;
        }
    }

    // Delete a Module by id from DB
    public function delete_modules($id)
    {
        $res = execute_query(
            "DELETE FROM module WHERE id = $id;"
        );
        return json_encode($res);
    }

    // Add Module with inserted values to DB
    public function add_modules($values)
    {
        $json = json_decode($values[0], true);
        $title = $json['title'];
        $description = $json['description'];
        $theme_id = $json['theme_id'];
        $audio_path = $json['audio_path'];
        $res = execute_query(
            "INSERT INTO module (title, description, theme_id, audio_path) VALUES ('$title', '$description', '$theme_id', '$audio_path')"
        );
        return json_encode($res);
    }

    // Update Module with updated values to DB
    public function update_modules($values)
    {
        $json = json_decode($values[0], true);
        $id = $json['id'];
        $title = $json['title'];
        $description = $json['description'];
        $theme_id = $json['theme_id'];
        $audio_path = $json['audio_path'];
        $res = execute_query(
            "UPDATE module SET title = '$title', description = '$description', theme_id = '$theme_id', audio_path = '$audio_path' WHERE id = '$id'"
        );
        return json_encode($res);
    }
}

?>