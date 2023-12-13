<?php
    include 'db_connection.php';

    // get shopping cart (products)
    function get_cart() {
        global $server_connection;

        $cart = $_SESSION['cart'];

        $res_cart = array();
        $counter = 0;
        if (!is_null($cart)) {
            foreach ($cart as $num => $array_info) {
                if ($array_info != NULL) {
                    $id = $array_info['id'];
                    $request = "SELECT * FROM products WHERE id = '$id';";
                    $query = mysqli_query($server_connection, $request);
        
                    if ($query) {
                        $product = mysqli_fetch_array($query);
        
                        $res_cart[$counter]['category'] = $product['type'];
                        $res_cart[$counter]['name'] = $product['name'];
                        $res_cart[$counter]['price'] = $product['price'];
                        $res_cart[$counter]['calories'] = $product['calories'];
                        $res_cart[$counter]['picture'] = $product['picture'];

                        $res_cart[$counter]['amount'] = get_amount($product['name']);
                    }
        
                    $counter += 1;
                }
            }
        }

        $res_cart = process_duplicates($res_cart);
        return $res_cart;
    }
    
    // get amount of specified product (support func)
    function get_amount($name) {
        $index = find_element_by_id($_SESSION['cart'], $name);

        return $_SESSION['cart'][$index]['amount'];
    }

    // process duplicates of every position in array (support func)
    function process_duplicates($array) {
        $res_array = array();
        $t = [
            'First' => [
                'name' => 'First Name',
                'category' => 'Espresso',
                'price' => '10',
            ],
            'Second' => [
                'name' => 'First Name',
                'category' => 'Espresso',
                'price' => '10',
            ],
        ];

        foreach ($array as $name => $product_info) {
            $index = find_element($res_array, $product_info['name']);

            if (!is_null($index)) {
                $res_array[$index]['amount'] += 1;
            } else {
                $res_array[] = $product_info;
            }
        }

        return $res_array;
    }

    // get element name in array by some name (support func)
    function find_element($array, $element) {
        foreach ($array as $name => $product_info) {
            if (trim($product_info['name']) == trim($element)) {
                echo $product_info['name'].'<br>';
                return $name;
            }
        }
    }

    // decrease amount of element by 1 from cart by name
    function remove_element($element_name) {
        if (isset($_SESSION['cart'])) {    
            $index = find_element_by_id($_SESSION['cart'], $element_name);
    
            if (!is_null($index)) {
                
                if ($_SESSION['cart'][$index]['amount'] > 1) {
                    $_SESSION['cart'][$index]['amount'] -= 1;
                } else {
                    return;
                }
            }

            $_SESSION['cart_size'] -= 1;
        }
    }

    // delete element from cart by name
    function delete_element($element_name) {
        $index = find_element_by_id($_SESSION['cart'], $element_name);
    
        $temp = 0;
        if (!is_null($index)) {
            $temp = $_SESSION['cart'][$index]['amount'];
        }

        unset($_SESSION['cart'][$index]);
        $_SESSION['cart_size'] -= (int)$temp;
    }
    
    // increase amount of element in cart by 1
    function add_element($element_name) {
        if (isset($_SESSION['cart'])) {
            $index = find_element_by_id($_SESSION['cart'], $element_name);

            if (!is_null($index)) {
                $_SESSION['cart'][$index]['amount'] += 1;
            }

            $_SESSION['cart_size'] += 1;
        }
    }

    // get element in array by id (support func)
    function find_element_by_id($array, $element_name) {
        $element_name = str_replace(' ', '_', $element_name);
        $element_name = strtolower($element_name);

        foreach ($array as $name => $array_info) {
            if ($array_info['name'] == $element_name) {
                return $name;
            }
        }
    }
?>