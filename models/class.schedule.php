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

    public function update_schedule()
    {
        return true;
    }
}

?>