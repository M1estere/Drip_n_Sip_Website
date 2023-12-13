<?php
    // get random products of specified length

    include 'db_connection.php';

    function get_products($amount) {
        global $server_connection;

        $result_array = array();

        $request = "SELECT * FROM products;";

        $query = mysqli_query($server_connection, $request);

        if ($query) {
            $counter = 0;

            while ($product = mysqli_fetch_array($query)) {
                $result_array[$counter]['id'] = $product['id'];
                $result_array[$counter]['category'] = $product['type'];
                $result_array[$counter]['name'] = $product['name'];
                $result_array[$counter]['price'] = $product['price'];
                $result_array[$counter]['calories'] = $product['calories'];
                $result_array[$counter]['picture'] = $product['picture'];
                
                $counter += 1;
            }
        }
        
        $get_it = array();
        for ($i = 0; $i < $amount; $i++) {
            $random = array_rand($result_array);
            $get_it[] = $result_array[$random];
        
            unset($result_array[$random]);
        }

        return $get_it;
    }
?>