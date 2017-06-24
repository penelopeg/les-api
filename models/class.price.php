<?php

class Price
{

    public function __construct()
    {
    }

    // Fetch social networks from DB
    public function get_prices()
    {
        $res = select_query_assoc(
            "SELECT name, price FROM price_table;"
        );
        if (!empty($res)) {
            return json_encode($res);
        } else {
            return null;
        }
    }

    public function update_prices($values)
    {
        $json = json_decode($values[0], true);
        $id = $json['id'];
        $name = $json['name'];
        $price = $json['price'];
        $res = execute_query(
            "UPDATE price_table SET name = '$name', price = '$price' WHERE id = '$id'"
        );
        return json_encode($res);
    }
}

?>