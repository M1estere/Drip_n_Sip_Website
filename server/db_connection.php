<?php
    $server_name = 'sql311.infinityfree.com';
    $server_username = 'if0_35575769';
    $server_password = 'IJHlRNTwaI';

    $db_name = 'if0_35575769_coffee_shop';

    $server_connection = mysqli_connect($server_name, $server_username, $server_password);

    if ($server_connection->connect_error) {
        die('Connection error!');
    }

    mysqli_select_db($server_connection, $db_name);
    mysqli_set_charset($server_connection, 'utf8');
?>