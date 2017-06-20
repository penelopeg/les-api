<?php

// Wrapper functions for PDO, this way there is no need to always write all this code

// Select query, return values with associative keys
function select_query_assoc($query, $values = array())
{
    global $pdo;
    $stmt = $pdo->prepare($query);
    $stmt->execute($values);
    $res = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data = array();
        foreach ($row as $key => $r_data) {
            $data[$key] =  $r_data;
        }
        $res[] = $data;
    }
    return $res;
}

// Select query, return values with numeric keys
function select_query_num($query, $values = array())
{
    global $pdo;
    $stmt = $pdo->prepare($query);
    $stmt->execute($values);
    $res = array();
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        $data = array();
        foreach ($row as $key => $r_data) {
            $data[$key] =  $r_data;
        }
        $res[] = $data;
    }
    return $res;
}


// Insert, Update or delete query
function execute_query($query, $values = array())
{
    try {
        global $pdo;
        $stmt = $pdo->prepare($query);
        $stmt->execute($values);

        return "successful";
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

// Get Insert id
function last_insert_id()
{
    global $pdo;
    return $pdo->lastInsertId();
}

?>