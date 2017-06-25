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

    public function update_contacts($values)
    {
        $json = json_decode($values[0], true);
        $address = $json['address'];
        $phone_nr = $json['phone_nr'];
        $email = $json['email'];
        $res = execute_query(
            "UPDATE contacts SET address = '$address', phone_nr = '$phone_nr', email = '$email'"
        );
        return json_encode($res);
    }
}

?>