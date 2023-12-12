<?php
    include 'db_connection.php';

    function get_orders($user_index) {
        global $server_connection;

        $result_array = array();

        $request = "SELECT * FROM orders WHERE user_id = '$user_index';";

        $query = mysqli_query($server_connection, $request);
        if ($query) {
            $counter = 1;
            while ($order = mysqli_fetch_array($query)) {
                $order_name = 'Order '.$counter;
                
                $result_array[$order_name]['amount'] = $order['amount'];
                $result_array[$order_name]['price'] = $order['price'];
                $result_array[$order_name]['creation_date'] = $order['creation_date'];

                $counter += 1;
            }
        }

        return $result_array;
    }
?>