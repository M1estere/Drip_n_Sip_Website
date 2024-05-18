<?php

require '../../server/db_connection.php';

function get_product_by_title($title) {
    global $server_connection;

    $query = "SELECT * FROM products WHERE name = '$title';";
    $result_query = mysqli_query($server_connection, $query);
    $product = mysqli_fetch_array($result_query);

    return $product;
}

function get_product_by_id($id) {
    global $server_connection;

    $query = "SELECT * FROM products WHERE id = $id;";
    $result_query = mysqli_query($server_connection, $query);
    $product = mysqli_fetch_array($result_query);

    return $product;
}

function edit_product($new_data) {
    global $server_connection;

    $id = $new_data['id'];
    $name = $new_data['name'];
    $category = $new_data['category'];
    $price = $new_data['price'];
    $calories = $new_data['calories'];
    $image_path = $new_data['picture'];

    $result['data'] = get_product_by_id($id);
    $query = "UPDATE products SET name = '$name', type = '$category', price = $price, calories = $calories, picture = '$image_path' WHERE id = $id;";
    $result_query = mysqli_query($server_connection, $query);

    $result['method'] = 'edit';
    if ($result_query) {
        $result['status_code'] = 200;
        $result['message'] = 'Product successfully changed';
    } else {
        $result['status_code'] = 500;
        $result['message'] = 'Error';
        $result['data'] = null;
    }

    return $result;
}

function add_product($product_data) {
    global $server_connection;

    $title = $product_data['title'];
    $category = $product_data['category'];
    $price = $product_data['price'];
    $calories = $product_data['calories'];
    $image_path = $product_data['imagePath'];

    $query = "INSERT INTO products (`name`, `type`, `price`, `calories`, `picture`) 
           VALUES ('{$title}', '{$category}', {$price}, {$calories}, '{$image_path}')";
    $result_query = mysqli_query($server_connection, $query);

    $result['method'] = 'insert';
    if ($result_query){
        $result['status_code'] = 200;

        $result['message'] = "Product {$title} successfully added";
        $result['data'] = get_product_by_title($title);
    } else {
        $result['status_code'] = 500;

        $result['message'] = "Product {$title} successfully added";
        $result['data'] = get_product_by_title($title);
    }

    return $result;
}

function delete_product($id) {
    global $server_connection;

    $result["data"] = get_product_by_id($id);

    $query = "DELETE FROM products WHERE id = $id;";
    $result_query = mysqli_query($server_connection, $query);

    $result['method'] = 'delete';
    if ($result_query) {
        $result['status_code'] = 200;
        $result['message'] = 'Product deleted';
    } else {
        $result['status_code'] = 500;
        $result['message'] = 'Failed to delete';
        $result['data'] = null;
    }

    return $result;
}

function get_products() {
    global $server_connection;

    $query = "SELECT * FROM products;";
    $result_query = mysqli_query($server_connection, $query);

    $result['method'] = 'select';
    if ($result_query) {
        $products = array();

        while ($product = mysqli_fetch_array($result_query)) {
            array_push($products, $product);
        }

        $result['status_code'] = 200;
        $result['message'] = 'Got products';
        $result['data'] = $products;
    } else {
        $result['status_code'] = 500;
        $result['message'] = 'Error';
        $result['data'] = null;
    }

    return $result;
}

if ($_POST['type'] == 'add') {
    echo json_encode(add_product($_POST['data']));
} else if ($_POST['type'] == 'get_all') {
    echo json_encode(get_products());
} else if ($_POST['type'] == 'delete') {
    echo json_encode(delete_product($_POST['id']));
} else if ($_POST['type'] == 'edit') {
    echo json_encode(edit_product($_POST['data']));
}