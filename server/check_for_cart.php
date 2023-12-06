<?php
    if (isset($_GET['product_id']) && isset($_GET['name'])) {
        if (!isset($_SESSION['id'])) {
            header("Location: /auth.php");
            die;
        } else {
            $counter = 0;
            if (isset($_SESSION['cart'])) {
                $product_id = $_GET['product_id'];
                $name = $_GET['name'];
    
                $index = find_element($_SESSION['cart'], $name);
                
                if (!is_null($index)) {
                    $_SESSION['cart'][$index]['amount'] += 1;
                } else {
                    $_SESSION['cart'][] = [
                        'id' => $product_id,
                        'name' => $name,
                        'amount' => '1',
                    ];
                }
            } else {
                $_SESSION['cart'][0]['id'] = $_GET['product_id'];
                $_SESSION['cart'][0]['name'] = $_GET['name'];
                $_SESSION['cart'][0]['amount'] = '1';
            }
            if (isset($_SESSION['cart_size'])) {
                $_SESSION['cart_size'] += 1;
            } else {
                $_SESSION['cart_size'] = 1;
            }
        }
    }

    function find_element($array, $element) {
        foreach ($array as $name => $product_info) {
            if (trim($product_info['name']) == trim($element)) {
                return $name;
            }
        }
    }
?>