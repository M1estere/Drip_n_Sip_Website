<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Drip & Sip - Change Blog</title>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/form.css">

    <script src="js/browse_pic.js" defer></script>
</head>

<body>
    <?php include('templates/header.php'); ?>
    <?php include('support/translator.php'); ?>

    <?php
        include '../server/db_connection.php';

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $request = "SELECT * FROM blogs WHERE id = '$id';";

            $query = mysqli_query($server_connection, $request);
            if ($query) {
                $blog = mysqli_fetch_array($query);
                if ($blog) {
                    $date = $blog['date'];
                    $title = $blog['title'];

                    $temp_title = $title;
                    $temp_title = strtolower($temp_title);
                    $temp_title = str_replace(' ', '-', $temp_title);
                    
                    $text = $blog['text'];
                    
                    $picture = $blog['picture'];
                    $picture_path = '../assets/'.$picture;
                    $temp_picture_path = pathinfo($picture_path, PATHINFO_FILENAME);

                    $old_path = 'blogs-'.$temp_picture_path.'-'.$temp_title;
                    $old_path_desc = $old_path.'-desc';
                } else {
                    header("Location: blogs.php");
                    die;
                }
            }
        } else {
            header("Location: blogs.php");
            die;
        }
    ?>

    <?php
        $extensions = ['png', 'webp'];
        $info_message = '';
        if (isset($_POST['start_name_desc']) && isset($_POST['start_name']) && isset($_POST['id']) && isset($_POST['title']) && isset($_POST['text']) && isset($_POST['date'])) {
            $start_desc_name = $_POST['start_name_desc'];
            $start_name = $_POST['start_name'];
            
            $id = $_POST['id'];
            $title = $_POST['title'];
            $text = $_POST['text'];
            $date = $_POST['date'];

            $picture_name = $_FILES['picture']['name'];
            
            $low_cat = strtolower($category);
            $picture_to_save = $low_cat.'/'.$picture_name;

            $ext = strtolower(pathinfo($picture_to_save, PATHINFO_EXTENSION));
            
            $test_path = '../assets/'.$picture_to_save;
            if (file_exists($test_path)) {
                $info_message = $info_message.' '.'File '.$picture_to_save.' exists';
                $request = "UPDATE blogs SET date = '$date', title = '$title', text = '$text' WHERE id = '$id';";
            } else {
                move_uploaded_file($_FILES['picture']['tmp_name'], $test_path);
                if (in_array($ext, $extensions)) {
                    $request = "UPDATE blogs SET date = '$date', title = '$title', text = '$text', picture = '$picture_to_save' WHERE id = '$id';";
                    $picture_path = $test_path;
                } else {
                    $request = "UPDATE blogs SET date = '$date', title = '$title', text = '$text' WHERE id = '$id';";
                }
            }

            $query = mysqli_query($server_connection, $request);
            if ($query) {
                $info_message = $info_message.' '.'Blog '.$title.' successfully updated!';

                $temp_name = $title;
                $temp_name = str_replace(' ', '_', $temp_name);
                $temp_name = strtolower($temp_name);
                $get = 'action=change&change_name='.$temp_name;
                
                $temp_title = $title;
                $temp_title = strtolower($temp_title);
                $temp_title = str_replace(' ', '-', $temp_title);
                
                $desc_arr = explode('-', $start_name);
                $temp_picture_path = $desc_arr[1];
                $key_to_check = 'blogs-'.$temp_picture_path.'-'.$temp_title;
                $desc_key = $key_to_check.'-desc';

                if (delete_text_from_translations($start_desc_name) && delete_text_from_translations($start_name) && insert_text_to_translations($key_to_check, $title) && insert_text_to_translations($desc_key, $text)) {
                    $info_message = $info_message.' '.'Successfully added '.$name;
                    header("Location: blogs.php?action=add");
                    die;
                } else {
                    $info_message = $info_message.' '.'Something went wrong';
                }
            } else {
                $info_message = $info_message.' '.'Something went wrong...';
            }
        }
    ?>

    <section class="main-info-wrapper">
        <div class="main-info-region container">
            <div class="top-text">
                <span>Change Blog</span>
            </div>

            <div class="display-region">
                <form method="POST" action="" class="form" enctype="multipart/form-data">
                    <?php
                        echo "
                            <p class='info-message'>$info_message</p>
                        ";
                    ?>

                    <div class="input-fields">
                        <?php
                            echo "
                                <div class='form-block'>
                                    <p>Blog ID</p>
                                    <input readonly type='number' required name='id' value='$id'>
                                </div>
                            ";

                            echo "
                                <div class='form-block'>
                                    <p>Blog Creation Date</p>
                                    <input type='date' required name='date' value='$date'>
                                </div>
                            ";

                            echo "
                                <div class='form-block'>
                                    <p>Blog Title</p>
                                    <input type='text' required minlength='5' name='title' placeholder='Blog title...' value='$title'>
                                    <input type='text' name='start_name' hidden value='$old_path'>
                                    <input type='text' name='start_name_desc' hidden value='$old_path_desc'>
                                </div>
                            ";

                            echo "
                                <div class='form-block'>
                                    <p>Blog Picture</p>
                                    <div class='picture-container'>
                                        <input type='file' id='selectedFile' name='picture' accept='image/png' style='display: none;' onchange='recheckFile()'/>
                                        <input type='button' value='Browse Image...' onclick='chooseFile();'/>
                                        <img id='image' width='250px' height='100px' src='$picture_path'>
                                    </div>
                                </div>
                            ";

                            echo "
                                <div class='form-block'>
                                    <p>Blog Text</p>
                                    <textarea rows='8' name='text' placeholder='Blog text...' required minlength='5'>$text</textarea>
                                </div>
                            ";
                        ?>
                    </div>
                    <input type="submit" value="Change Blog">
                </form>
            </div>
        </div>
    </section>
</body>

</html>