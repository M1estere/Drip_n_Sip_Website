<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Drip & Sip - Blogs Control</title>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/display-table.css">
</head>

<body>
    <?php include('templates/header.php'); ?>
    <?php include('support/translator.php'); ?>

    <?php
        include '../server/db_connection.php';

        // control display message after deleting/changing blogs
        if (isset($_GET['action'])) {
            $action = $_GET['action'];

            if ($action == 'add') {
                $info_message = 'Successfully added new blog';
            } else if ($action == 'change') {
                if (isset($_GET['change_name'])) {
                    $new_name = $_GET['change_name'];

                    $info_message = 'Successfully changed '.$new_name.' blog';
                }
            }
        }

        // control deleting
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $request = "SELECT * FROM blogs WHERE id = '$id';";
            $query = mysqli_query($server_connection, $request);
            if ($query) {
                $blog = mysqli_fetch_array($query);
                if ($blog) {
                    $picture_to_save = $blog['picture'];
                    $name = $blog['title'];

                    $request = "DELETE FROM blogs WHERE id = '$id';";
    
                    $query = mysqli_query($server_connection, $request);
                    if ($query) {
                        $temp_title = $name;
                        $temp_title = strtolower($temp_title);
                        $temp_title = str_replace(' ', '-', $temp_title);
                        unlink(realpath('../assets/'.$blog['picture']));
                        $temp_picture_path = pathinfo($picture_to_save, PATHINFO_FILENAME);
                        $key_to_check = 'blogs-'.$temp_picture_path.'-'.$temp_title;
                        $desc_key = $key_to_check.'-desc';

                        if (delete_text_from_translations($key_to_check) && delete_text_from_translations($desc_key))
                            $info_message = $info_message.' '.'Successfully deleted '.$name.' blog';
                        else 
                            $info_message = 'Something went wrong!';
                    } else {
                        $info_message = $info_message.' '.'Some error occured when deleting '.$name.' blog';
                    }
                } else {
                    $info_message = $info_message.' '.'Error: blog '.$id.' does not exist';
                }
            } else {
                $info_message = $info_message.' '.'Some error occured';
            }            
        }
    ?>

    <section class="main-info-wrapper">
        <div class="main-info-region container">
            <div class="top-text">
                <span>Blogs</span>
            </div>
            <div class="display-region">
                <?php
                    echo "
                        <p class='info-message'>$info_message</p>
                    ";
                ?>
                <table class="display-table" width="100%" height="500">
                    <tr>
                        <td></td>
                        <td><b>Date</b></td>
                        <td><b>Title</b></td>
                        <td><b>Text</b></td>
                        <td><b>Picture Path</b></td>
                        <td class="last-col"></td>
                    </tr>

                    <?php
                        // fill contents
                        include '../server/db_connection.php';

                        $request = "SELECT * FROM blogs;";

                        $query = mysqli_query($server_connection, $request);
                        if ($query) {
                            while ($blog = mysqli_fetch_array($query)) {
                                $id = $blog['id'];
                                $date = $blog['date'];
                                $title = $blog['title'];
                                $text = $blog['text'];
                                $picture = $blog['picture'];
                                $picture_path = '../assets/'.$picture;

                                echo "<tr>";
                                echo "
                                    <td><img src='$picture_path' style='width: 220px; height: 150px; object-fit: cover; border-radius: 20px'></td>
                                    <td>$date</td>
                                    <td>$title</td>
                                    <td>$text</td>
                                    <td>$picture</td>

                                    <td class='last-col'>
                                        <a href='?id=$id'>
                                            <div class='delete-button'>
                                                <button class='delete' id='delete-product'>X</button>
                                            </div>
                                        </a>

                                        <a href='change_blog.php?id=$id'>
                                            <div class='delete-button'>
                                                <button class='change' id='delete-product'>C</button>
                                            </div>
                                        </a>
                                    </td>
                                ";
                                echo "</tr>";
                            }
                        }
                    ?>
                </table>

                <form class="new-blog-form" method="POST" action="new_blog.php">
                    <input type="submit" value="Add New Blog">
                </form>
            </div>
        </div>
    </section>
</body>

</html>