<?php
    // get array of all blogs

    include 'db_connection.php';

    function blogs($amount) {
        global $server_connection;

        $res_array = array();

        $request = "SELECT * FROM blogs;";
        
        $query = mysqli_query($server_connection, $request);
        if ($query) {
            $counter = 0;
            while ($blog = mysqli_fetch_array($query)) {
                $res_array[$counter]['id'] = $blog['id'];
                $res_array[$counter]['title'] = $blog['title'];
                $res_array[$counter]['date'] = $blog['date'];
                $res_array[$counter]['text'] = $blog['text'];
                $res_array[$counter]['picture'] = $blog['picture'];

                $counter += 1;
            }
        }

        shuffle($res_array);
        return array_slice($res_array, 0, $amount);
    }
?>