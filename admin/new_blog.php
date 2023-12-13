<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Drip & Sip - New Blog</title>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/form.css">

    <script src="js/browse_pic.js" defer></script>
</head>

<body>
    <?php include('templates/header.php'); ?>

    <?php
        include '../server/db_connection.php';

        $extensions = ['png', 'webp'];
        $info_message = '';
        if (isset($_POST['date']) && isset($_POST['title']) && isset($_POST['text'])) {
            $date = $_POST['date'];
            $title = $_POST['title'];
            $text = $_POST['text'];

            $picture = $_FILES['picture'];

            $time = time();
            $picture_name = $time.'_'.$picture['name'];
            $temp_name = $picture['tmp_name'];

            $low_cat = strtolower($category);
            $picture_to_save = $low_cat.'/'.$picture_name;
            $destination = '../assets/blogs/'.$picture_to_save;

            $extension = explode('.', $picture_name);
            $extension = end($extension);

            $request = "SELECT * FROM products WHERE name = '$name' AND type = '$category';";

            $query = mysqli_query($server_connection, $request);
            $product = mysqli_fetch_array($query);
            if ($product) {
                $info_message = $info_message.' '.'Product '.$name.' of '.$category.' already exists';
            } else {
                $picture_to_save = 'blogs'.$picture_to_save;
                $request = "INSERT INTO blogs (date, title, text, picture) VALUES ('$date', '$title', '$text', '$picture_to_save');";

                $query = mysqli_query($server_connection, $request);
                if ($query) {
                    if (in_array($extension, $extensions)) {
                        move_uploaded_file($temp_name, $destination);
                        $info_message = 'Image uploaded successfully!';
                    }

                    $info_message = $info_message.' '.'Successfully added '.$name;
                    header("Location: blogs.php?action=add");
                    die;
                } else {
                    $info_message = $info_message.' '.'Something went wrong';
                }
            }
        }
    ?>

    <section class="main-info-wrapper">
        <div class="main-info-region container">
            <div class="top-text">
                <span>Add New Blog</span>
            </div>

            <div class="display-region">
                <form method="POST" action="new_blog.php" class="form" enctype="multipart/form-data">
                    <?php
                        echo "
                            <p class='info-message'>$info_message</p>
                        ";
                    ?>

                    <div class="input-fields">
                        <div class="form-block">
                            <p>Blog Creation Date</p>
                            <input type="date" required minlength="4" name="date">
                        </div>

                        <div class="form-block">
                            <p>Blog Title</p>
                            <input type="text" required minlength="5" name="title" placeholder="Blog title...">
                        </div>

                        <div class="form-block">
                            <p>Blog Text</p>
                            <textarea rows="8" name="text" placeholder="Blog text..." required minlength="5"></textarea>
                        </div>

                        <div class="form-block">
                            <p>Blog Picture</p>
                            <div class="picture-container">
                                <input type="file" id="selectedFile" name="picture" accept="image/png" style="display: none;" onchange="recheckFile()" required/>
                                <input type="button" value="Browse Image..." onclick="chooseFile();"/>
                                <img id="image" width="250px" height="100px">
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Add Blog">
                </form>
            </div>
        </div>
    </section>
</body>

</html>