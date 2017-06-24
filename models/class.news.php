<?php

class News
{

    public function __construct()
    {
    }

    // Fetch all News, news tags and news image from DB
    public function get_news()
    {
        $res = select_query_assoc(
            'SELECT * FROM news;'
        );
        if (!empty($res)) {
            foreach ($res as $news) {
                $tags = Tag::get_tag_by_news($news['id']);
                $image = Image::get_image('news', $news['id']);
                $newsList[] = array(
                    'id' => $news['id'],
                    'title' => $news['title'],
                    'content' => $news['content'],
                    'publish' => $news['publish_time'],
                    'tags' => $tags,
                    'image' => $image
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
                $tags = Tag::get_tag_by_news($news['id']);
                $image = Image::get_image('news', $news['id']);
                $newsList[] = array(
                    'id' => $news['id'],
                    'title' => $news['title'],
                    'content' => $news['content'],
                    'publish' => $news['publish_time'],
                    'tags' => $tags,
                    'image' => $image
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

    public function delete_news($newsId)
    {
        $res = array();
        array_push($res, execute_query(
            "DELETE FROM news WHERE id = $$newsId;"
        ));
        array_push($res, execute_query(
            "DELETE FROM news_2_tags WHERE news_id = $newsId;"
        ));
        return json_encode($res);
    }

    public function add_news($values)
    {
        $json = json_decode($values[0], true);
        $title = $json['title'];
        $content = $json['content'];
        $publish_time = $json['publish_time'];
        $tags = $json['selecttags'];
        $res = array();
        array_push($res,execute_query(
            "INSERT INTO news (title, content, publish_time VALUES ('$title', '$content', '$publish_time')"
        ));
        $id = last_insert_id();
        for ($i=0; $i < sizeof($tags); $i++) {
            array_push($res,execute_query(
                "INSERT INTO news_2_tags VALUES ($id,$tags[$i])"
            ));
        }
        return json_encode($res);
    }

    public function update_news($values)
    {
        $json = json_decode($values[0], true);
        $id = $json['id'];
        $title = $json['title'];
        $content = $json['content'];
        $publish_time = $json['publish_time'];
        $tags = $json['selecttags'];
        $res = array();
        $query = execute_query(
            "DELETE FROM news_2_tags WHERE news_id = '$id';"
        );
        array_push($res, execute_query(
            "UPDATE news SET name = '$title', description = '$content', e_time = '$publish_time' WHERE id = '$id'"
        ));
        for ($i = 0; $i < sizeof($tags); $i++) {
            array_push($res,execute_query(
                "INSERT INTO news_2_tags (news_id, tag_id)VALUES ('$id', '$tags[$i]')"
            ));
        }
        return json_encode($res);
    }
}

?>