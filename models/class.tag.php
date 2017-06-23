<?php

class Tag
{

    public function __construct()
    {
    }

    // Fetch all Tags from DB
    public function get_tags()
    {
        $res = select_query_assoc(
            "SELECT * FROM tag;"
        );
        if (!empty($res)) {
            return json_encode($res);
        } else {
            return null;
        }
    }

    // Fetch Tag belonging to tag ID
    public function get_tag_by_id($tagId)
    {
        $res = select_query_assoc(
            "SELECT tag.id, tag.name, tag.color FROM tag WHERE tag.id = $tagId;"
        );
        if (!empty($res)) {
            return json_encode($res);
        } else {
            return null;
        }
    }

    // Fetch Tags belonging to event
    public function get_tag_by_event($eventId)
    {
        $res = select_query_assoc(
            "SELECT tag.id, tag.name, tag.color FROM event_2_tags, tag WHERE tag.id = event_2_tags.tag_id AND event_2_tags.event_id = $eventId;"
        );
        if (!empty($res)) {
            return json_encode($res);
        } else {
            return null;
        }
    }

    // Fetch Tags belonging to event
    public function get_tag_by_news($newsId)
    {
        $res = select_query_assoc(
            "SELECT tag.id, tag.name, tag.color FROM news_2_tags, tag WHERE tag.id = news_2_tags.tag_id AND news_2_tags.news_id = $newsId;"
        );
        if (!empty($res)) {
            return json_encode($res);
        } else {
            return null;
        }
    }

    public function delete_tag($tagId)
    {
        $res = array();
        array_push($res, execute_query(
            "DELETE FROM tag WHERE id = $tagId;"
        ));
        array_push($res, execute_query(
            "DELETE FROM news_2_tags WHERE tag_id = $tagId;"
        ));
        array_push($res, execute_query(
            "DELETE FROM event_2_tags WHERE tag_id = $tagId;"
        ));
        return json_encode($res);
    }

    public function add_tag($name)
    {
        $res = array();
        array_push($res, execute_query(
            "INSERT INTO tag VALUES (null, $name)"
        ));
        return json_encode($res);
    }

    public function update_tag($tagId, $name)
    {
        $res = execute_query(
            "UPDATE tag SET name = '$name' WHERE id = $tagId"
        );
        return json_encode($res);
    }
}

?>