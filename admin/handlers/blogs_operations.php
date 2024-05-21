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

function get_blog_by_id($id) {
    global $server_connection;

    $query = "SELECT * FROM blogs WHERE id = $id;";
    $result_query = mysqli_query($server_connection, $query);
    $blogs = mysqli_fetch_array($result_query);

    return $blogs;
}

function get_blog_by_title($title) {
    global $server_connection;

    $query = "SELECT * FROM blogs WHERE title = '$title';";
    $result_query = mysqli_query($server_connection, $query);
    $blog = mysqli_fetch_array($result_query);

    return $blog;
}

function edit_blog($new_data) {
    global $server_connection;

    $id = $new_data['id'];
    $date = $new_data['date'];
    $title = $new_data['title'];
    $text = $new_data['text'];
    $image_path = $new_data['picture'];

    $result['new_data'] = $new_data;
    $result['data'] = get_blog_by_id($id);
    $query = "UPDATE blogs SET date = '$date', title = '$title', text = '$text', picture = '$image_path' WHERE id = $id;";
    $result_query = mysqli_query($server_connection, $query);

    $result['method'] = 'edit';
    if ($result_query) {
        $result['status_code'] = 200;
        $result['message'] = 'Blog successfully changed';
    } else {
        $result['status_code'] = 500;
        $result['message'] = 'Error';
        $result['data'] = null;
    }

    return $result;
}

function add_blog($data) {
    global $server_connection;

    $date = $data['date'];
    $title = $data['title'];
    $text = $data['text'];
    $image_path = $data['picture'];

    $query = "INSERT INTO blogs (`date`, `title`, `text`, `picture`) VALUES ('$date', '$title', '$text', '$image_path');";
    $result_query = mysqli_query($server_connection, $query);

    $result['method'] = 'add';
    if ($result_query) {
        $result['status_code'] = 200;
        $result['message'] = 'Blog successfully added';
        $result['data'] = get_blog_by_title($title);
    } else {
        $result['status_code'] = 500;
        $result['message'] = 'Error';
        $result['data'] = null;
    }

    return $result;
}

function delete_blog($data) {
    global $server_connection;

    $id = $data['id'];

    $result["data"] = get_blog_by_id($id);

    $query = "DELETE FROM blogs WHERE id = $id;";
    $result_query = mysqli_query($server_connection, $query);

    $result['method'] = 'delete';
    if ($result_query) {
        $result['status_code'] = 200;
        $result['message'] = 'Blog deleted';
    } else {
        $result['status_code'] = 500;
        $result['message'] = 'Failed to delete';
        $result['data'] = null;
    }

    return $result;
}

if ($_POST['type'] == 'get_all') {
    echo json_encode(get_all_blogs());
} else if ($_POST['type'] == 'edit') {
    echo json_encode(edit_blog($_POST['data']));
} else if ($_POST['type'] == 'add') {
    echo json_encode(add_blog($_POST['data']));
} else if ($_POST['type'] == 'del') {
    echo json_encode(delete_blog($_POST['data']));
}