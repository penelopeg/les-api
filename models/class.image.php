<?php

class Image
{

	public function __construct() {

	}

	// Fetch social networks from DB
	public function get_image($table, $id) 
	{
		$res = select_query_assoc(
			"SELECT url FROM image WHERE type_table='$table' AND type_id=$id;"
		);
		if (!empty($res)) {
			return json_encode($res);
		}
		else
			return null;		
	}

	public function update_image($id, $type_table, $type_id, $url)
	{
        $res = execute_query(
            "UPDATE image SET type_table = '$type_table', type_id = '$type_id', url = '$url'  WHERE id = $id"
        );
        return json_encode($res);
	}
}

?>