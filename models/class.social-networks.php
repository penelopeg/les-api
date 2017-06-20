<?php

class SocialNetworks
{

    public function __construct()
    {
    }

    // Fetch social networks from DB
    public function get_social_networks()
    {
        $res = select_query_assoc(
            'SELECT name, url FROM social_networks;'
        );
        if (!empty($res)) {
            return json_encode($res);
        } else {
            return null;
        }
    }

    public function update_social_networks($id, $name, $url)
    {
        return true;
    }
}

?>