<?php

class Schedule
{

    public function __construct()
    {
    }

    // Fetch social networks from DB
    public function get_schedule()
    {
        $res = select_query_assoc(
            'SELECT * FROM time_schedule;'
        );
        if (!empty($res)) {
            return json_encode($res);
        } else {
            return null;
        }
    }

    public function update_schedule($id,$day,$opening_hours,$closing_hours)
    {
        $res = execute_query(
            "UPDATE time_schedule SET day = '$day', opening_hours = '$opening_hours', closing_hours = '$closing_hours' WHERE id = $id"
        );
        return json_encode($res);
    }
}

?>