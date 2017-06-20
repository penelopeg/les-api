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

    // Fetch Tags belonging to event
    public function get_event_tags($eventId)
    {
        $res = select_query_assoc(
            "SELECT tag.id, tag.name FROM event_2_tags, tag WHERE tag.id = event_2_tags.tag_id AND event_2_tags.event_id = $eventId;"
        );
        if (!empty($res)) {
            return json_encode($res);
        } else {
            return null;
        }
    }

    // Fetch Tags belonging to event
    public function get_news_tags($newsId)
    {
        $res = select_query_assoc(
            "SELECT tag.id, tag.name FROM news_2_tags, tag WHERE tag.id = news_2_tags.tag_id AND news_2_tags.news_id = $newsId;"
        );
        if (!empty($res)) {
            return json_encode($res);
        } else {
            return null;
        }
    }
}

?>