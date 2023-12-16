<?php
    include '../server/db_connection.php';

    function get_categories() {
        global $server_connection;

        $categories = array();
        $request = "SELECT * FROM products;";

        $query = mysqli_query($server_connection, $request);
        if ($query) {
            while ($product = mysqli_fetch_array($query)) {
                $category = $product['type'];
                if (!in_array($category, $categories)) {
                    $categories[] = $category;
                }
            }
        }

        return $categories;
    }
?>