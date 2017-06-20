<?php

class Contacts
{

    public function __construct()
    {
    }

    // Fetch contacts from DB
    public function get_contacts()
    {
        $res = select_query_assoc(
            'SELECT address, phone_nr, email FROM contacts;'
        );
        if (!empty($res)) {
            return json_encode($res);
        } else {
            return null;
        }
    }

    public function update_contacts($adress, $phone_nr, $email)
    {
        return true;
    }
}

?>