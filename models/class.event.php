<?php

class Event
{

    public function __construct()
    {
    }

    // Fetch all Events and event tags from DB
    public function get_events()
    {
        $res = select_query_assoc(
            'SELECT * FROM event ORDER BY e_time;'
        );
        if (!empty($res)) {
            foreach ($res as $event) {
                $tags = Tag::get_tag_by_event($event['id']);
                $url = Image::get_image('event', $event['id']);
                $events[] = array(
                    'id' => $event['id'],
                    'name' => $event['name'],
                    'desc' => $event['description'],
                    'e_time' => $event['e_time'],
                    'tags' => $tags,
                    'url' => $url
                );
            }
            return json_encode($events);
        } else {
            return null;
        }
    }

    // Fetch an Event by id and event tags from DB
    public function get_event_by_id($id)
    {
        $res = select_query_assoc(
            "SELECT * FROM event WHERE id = $id;"
        );
        if (!empty($res)) {
            foreach ($res as $event) {
                $tags = Tag::get_tag_by_event($event['id']);
                $url = Image::get_image('event', $event['id']);
                $events[] = array(
                    'id' => $event['id'],
                    'name' => $event['name'],
                    'desc' => $event['description'],
                    'e_time' => $event['e_time'],
                    'tags' => $tags,
                    'url' => $url
                );
            }
            return json_encode($events);
        } else {
            return null;
        }
    }

    // Fetch an Event by tags
    public function get_event_by_tag($tags)
    {
        $query = "SELECT event.* FROM event, event_2_tags WHERE event.id = event_2_tags.event_id AND (event_2_tags.tag_id = $tags[0]";
        for ($i=1; $i < sizeof($tags); $i++) {
            $query .= " OR event_2_tags.tag_id = $tags[$i]";
        }
        $query .= ") GROUP BY id";
        $res = select_query_assoc(
            $query
        );
        if (!empty($res)) {
            return json_encode($res);
        } else {
            return null;
        }
    }

    public function get_event_by_date($date)
    {
        $res = select_query_assoc(
            "SELECT * FROM event WHERE e_time LIKE '$date%';"
        );
        if (!empty($res)) {
            foreach ($res as $event) {
                $tags = Tag::get_tag_by_event($event['id']);
                $image = Image::get_image('event', $event['id']);
                $events[] = array(
                    'id' => $event['id'],
                    'name' => $event['name'],
                    'desc' => $event['description'],
                    'e_time' => $event['e_time'],
                    'tags' => $tags,
                    'image' => $image
                );
            }
            return json_encode($events);
        } else {
            return null;
        }
    }

    public function delete_event($id)
    {
        $res = array();
        array_push($res, execute_query(
            "DELETE FROM event_2_tags WHERE event_id = $id;"
        ));
        array_push($res, execute_query(
            "DELETE FROM event WHERE id = $id;"
        ));
        return json_encode($res);
    }

    public function add_event($values)
    {
        $json = json_decode($values[0], true);
        $name = $json['name'];
        $desc = $json['description'];
        $e_time = $json['e_time'];
        //$url = $json['url'];
        $tags = $json['selecttags'];
        $res = array();
        array_push($res,execute_query(
            "INSERT INTO event (name, description, e_time) VALUES ('$name', '$desc', '$e_time')"
        ));
        $id = last_insert_id();
        /*array_push($res,execute_query(
            "INSERT INTO image (type_table, type_id, url) VALUES ('event', '$id', '$url')"
        ));*/
        for ($i=0; $i < sizeof($tags); $i++) {
            array_push($res,execute_query(
                "INSERT INTO event_2_tags (event_id, tag_id) VALUES ($id, $tags[$i])"
            ));
        }
        return json_encode($res);
    }

    public function update_event($values)
    {
        $json = json_decode($values[0], true);
        $id = $json['id'];
        $name = $json['name'];
        $desc = $json['description'];
        $e_time = $json['e_time'];
        //$url = $json['url'];
        $tags = $json['selecttags'];
        $res = array();
        execute_query(
            "DELETE FROM event_2_tags WHERE event_id = $id;"
        );
        /*
        execute_query(
            "DELETE FROM image WHERE type_id = $id;"
        );*/
        array_push($res, execute_query(
            "UPDATE event SET name = '$name', description = '$desc', e_time = '$e_time' WHERE id = '$id'"
        ));
        /*
        array_push($res,execute_query(
            "INSERT INTO image (type_table, type_id, url) VALUES ('event', '$id', '$url')"
        ));*/
        for ($i = 0; $i < sizeof($tags); $i++) {
            array_push($res,execute_query(
                "INSERT INTO event_2_tags (event_id, tag_id) VALUES ('$id', '$tags[$i]')"
            ));
        }
        return json_encode($res);
    }

}