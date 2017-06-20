<?php

class News
{

    public function __construct()
    {
    }

    // Fetch all News and news tags from DB
    public function get_news()
    {
        $res = select_query_assoc(
            'SELECT * FROM news;'
        );
        if (!empty($res)) {
            foreach ($res as $news) {
                $tags = Tag::get_news_tags($news['id']);
                $newsList[] = array(
                    'id' => $news['id'],
                    'title' => $news['title'],
                    'content' => $news['content'],
                    'publish' => $news['publish_time'],
                    'tags' => $tags
                );
            }
            return json_encode($newsList);
        } else {
            return null;
        }
    }

    // Fetch a News by id and news tags from DB
    public function get_news_by_id($id)
    {
        $res = select_query_assoc(
            "SELECT * FROM news WHERE id = $id;"
        );
        if (!empty($res)) {
            foreach ($res as $news) {
                $tags = Tag::get_news_tags($news['id']);
                $newsList[] = array(
                    'id' => $news['id'],
                    'title' => $news['title'],
                    'content' => $news['content'],
                    'publish' => $news['publish_time'],
                    'tags' => $tags
                );
            }
            return json_encode($newsList);
        } else {
            return null;
        }
    }

    // Fetch an News by tags
    public function get_news_by_tag($tags)
    {
        $query = "SELECT news.* FROM news, news_2_tags WHERE news.id = news_2_tags.news_id AND (news_2_tags.tag_id = $tags[0]";
        for ($i=1; $i < sizeof($tags); $i++) {
            $query .= " OR news_2_tags.tag_id = $tags[$i]";
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
}

?>