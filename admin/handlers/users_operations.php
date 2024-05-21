<?php

require '../../server/db_connection.php';

function get_users() {
    global $server_connection;

    $query = "SELECT * FROM clients;";
    $result_query = mysqli_query($server_connection, $query);

    $result['method'] = 'select';
    if ($result_query) {
        $clients = array();

        while ($client = mysqli_fetch_array($result_query)) {
            $id = $client['id'];

            $query_1 = "SELECT * FROM orders WHERE user_id = $id;";
            $result_query_1 = mysqli_query($server_connection, $query_1);
            if ($result_query_1) {
                $orders = array();
                while ($order = mysqli_fetch_array($result_query_1)) {
                    $orders[] = $order;
                }
                $client['orders'] = $orders;
            }

            $clients[] = $client;
        }

        $result['status_code'] = 200;
        $result['message'] = 'Got clients';
        $result['data'] = $clients;
    } else {
        $result['status_code'] = 500;
        $result['message'] = 'Error';
        $result['data'] = null;
    }

    return $result;
}

if ($_POST['type'] == 'get_all') {
    echo json_encode(get_users());
}