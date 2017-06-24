<?php

class Utilities
{

    public function __construct()
    {
    }

    // Validate key
    public function validate_key($key)
    {
        $res = select_query_assoc(
            'SELECT type FROM api_user_type, api_keys WHERE api_key = ? AND api_user_type.id = api_keys.user_type_id;',
            array($key)
        );
        if (!empty($res)) {
            return $res[0];
        } else {
            return null;
        }
    }

    // Validate user
    public function validate_user($type, $method, $endpoint=null)
    {
        if ($method=='POST' && ($endpoint==='form')) 
        {
            return true;
        }
        else if ($method=='PUT' || $method=='DELETE' || $method=='POST') {
            if ($type==2) {
                return false;
            }
        }

        return true;
    }
}

?>