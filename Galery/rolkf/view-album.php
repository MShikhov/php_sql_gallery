<?php
include 'connection.php';
if (isset($_GET['album_id'])) {
    $album_id = $_GET['album_id'];
    $get_album = $mysqli->query("SELECT * FROM gallery_albums WHERE album_id = $album_id");
    $album_data = $get_album->fetch_assoc();
} else {
    header('Location: main.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <title><?php echo $album_data['album_name'] ?></title>
</head>

<body>
    <?php
    $photo_count = $mysqli->query("SELECT * FROM gallery_photos WHERE album_id = $album_id");
    ?>
    <style>
* {
        background-color: wheat;
        text-align: center;
    }

    .button {
        background-color: #4CAF50;
        /* Green */
        border: none;
        border-radius: 10px;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
    }

    input {
        width: 300px;
        font-size: 13px;
        padding: 6px 0 4px 10px;
        border: 1px solid #cecece;
        background: #F6F6f6;
        border-radius: 8px;
    }
    </style>
    <a href='main.php'>На главную</a> | <?php echo $album_data['album_name'] ?> (<?php echo $photo_count->num_rows; ?>)<br><br>
    <form method='post' action='upload-photo.php?album_id=<?php echo $album_id ?>' enctype='multipart/form-data'>
        <label>Добавить фото в альбом:</label><br>
        <input type='file' name='photo' /> <input type='submit' name='upload_photo' value='Добавить' />
    </form>
    <?php
    if (isset($_GET['upload_action'])) {
        if ($_GET['upload_action'] == 'success') { ?>
            <br><br>Фото добавлено в альбом!<br><br>
    <?php }
    }
    ?>
    <?php
    $photos = $mysqli->query("SELECT * FROM gallery_photos WHERE album_id = $album_id");
    while ($photo_data = $photos->fetch_assoc()) { ?>
        <img src='<?php echo $photo_data['photo_link'] ?>' width='200px' height='200px' />
    <?php }
    ?>
</body>

</html>