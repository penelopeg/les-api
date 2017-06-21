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

    public function update_prices($id, $name, $price)
    {
        $res = execute_query(
            "UPDATE price_table SET name = '$name', price = '$price' WHERE id = $id"
        );
        return json_encode($res);
    }
}

?>