<?php

class Reservation
{

    public function __construct()
    {
    }

    // Fetch all Reservations from DB
    public function get_reservation()
    {
        $res = select_query_assoc(
            'SELECT marcacao_visita.*, marcacao_2_type.* FROM marcacao_visita, marcacao_2_type WHERE marcacao_visita.id = marcacao_2_type.marcacao_id;'
        );
        if (!empty($res)) {
            foreach ($res as $reservation) {
                $reservationList[] = array(
                    'id' => $reservation['id'],
                    'name' => $reservation['name'],
                    'contact' => $reservation['contact'],
                    'email' => $reservation['email'],
                    'message' => $reservation['message'],
                    'visit_date' => $reservation['visit_date'],
                    'type_table' => $reservation['type_table'],
                    'type_id' => $reservation['type_id']
                );
            }
            return json_encode($reservationList);
        } else {
            return null;
        }
    }

    // Fetch all Reservations by id from DB
    public function get_reservation_by_id($id)
    {
        $res = select_query_assoc(
            "SELECT marcacao_visita.*, marcacao_2_type.* FROM marcacao_visita, marcacao_2_type WHERE marcacao_visita.id = $id AND marcacao_visita.id = marcacao_2_type.marcacao_id;"
        );
        if (!empty($res)) {
            foreach ($res as $reservation) {
                $reservationList[] = array(
                    'id' => $reservation['id'],
                    'name' => $reservation['name'],
                    'contact' => $reservation['contact'],
                    'email' => $reservation['email'],
                    'message' => $reservation['message'],
                    'visit_date' => $reservation['visit_date'],
                    'type_table' => $reservation['type_table'],
                    'type_id' => $reservation['type_id']
                );
            }
            return json_encode($reservationList);
        } else {
            return null;
        }
    }

    // Add Reservation with inserted values to DB
    public function add_reservation($name, $contact, $email, $message, $visit_date, $type_table, $type_id)
    {
        $res = array();
        array_push($res,execute_query(
            "INSERT INTO marcacao_visita VALUES (null, $name, $contact, $email, $message, $visit_date)"
        ));
        $id = last_insert_id();
        array_push($res,execute_query(
            "INSERT INTO marcacao_2_type VALUES ($id, $type_table, $type_id)"
        ));
        return json_encode($res);
    }
}

?>