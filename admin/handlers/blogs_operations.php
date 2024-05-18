<?php

require '../../server/db_connection.php';

function get_all_blogs() {
    global $server_connection;

    $query = "SELECT * FROM blogs;";
    $result_query = mysqli_query($server_connection, $query);

    $result['method'] = 'select';
    if ($result_query) {
        $blogs = array();

        while ($blog = mysqli_fetch_array($result_query)) {
            $blogs[] = $blog;
        }

        $result['status_code'] = 200;
        $result['message'] = 'Got blogs';
        $result['data'] = $blogs;
    } else {
        $result['status_code'] = 500;
        $result['message'] = 'Error';
        $result['data'] = null;
    }

    return $result;
}

if ($_POST['type'] == 'get_all') {
    echo json_encode(get_all_blogs());
}