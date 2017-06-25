<?php

class Service_Project
{

    public function __construct()
    {
    }

    // Fetch all Projects and Services from DB
    public function get_services_projects()
    {
        $res = select_query_assoc(
            'SELECT * FROM project_service;'
        );
        if (!empty($res)) {
            foreach ($res as $project_service) {
                $projectServiceList[] = array(
                    'id' => $project_service['id'],
                    'type' => $project_service['type'],
                    'name' => $project_service['name'],
                    'description' => $project_service['description']
                );
            }
            return json_encode($projectServiceList);
        } else {
            return null;
        }
    }

    // Fetch all Projects and Services by id from DB
    public function get_services_projects_by_id($id)
    {
        $res = select_query_assoc(
            "SELECT * FROM project_service WHERE id = $id;"
        );
        if (!empty($res)) {
            foreach ($res as $project_service) {
                $projectServiceList[][] = array(
                    'id' => $project_service['id'],
                    'type' => $project_service['type'],
                    'name' => $project_service['name'],
                    'description' => $project_service['description']
                );
            }
            return json_encode($projectServiceList);
        } else {
            return null;
        }
    }

    // Fetch all Projects and Services by type from DB
    public function get_services_projects_by_type($type)
    {
        $res = select_query_assoc(
            "SELECT * FROM project_service WHERE type = $type;"
        );
        if (!empty($res)) {
            foreach ($res as $project_service) {
                $projectServiceList[][] = array(
                    'id' => $project_service['id'],
                    'type' => $project_service['type'],
                    'name' => $project_service['name'],
                    'description' => $project_service['description']
                );
            }
            return json_encode($projectServiceList);
        } else {
            return null;
        }
    }

    // Delete Projects and Services by id from DB
    public function delete_services_projects($id)
    {
        $res = execute_query(
            "DELETE FROM project_service WHERE id = $id)"
        );
        return json_encode($res);
    }

    // Add Projects and Services with inserted values to DB
    public function add_services_projects($values)
    {
        $json = json_decode($values[0], true);
        $type = $json['type'];
        $name = $json['name'];
        $description = $json['description'];
        $res = execute_query(
            "INSERT INTO project_service (type, name, description) VALUES ('$type', '$name', '$description')"
        );
        return json_encode($res);
    }

    // Add Projects and Services with updated values to DB
    public function update_services_projects($values)
    {
        $json = json_decode($values[0], true);
        $id = $json['id'];
        $type = $json['type'];
        $name = $json['name'];
        $description = $json['description'];
        $res = execute_query(
            "UPDATE project_service SET type = '$type', name = '$name', description = '$description' WHERE id = '$id'"
        );
        return json_encode($res);
    }
}

?>