<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <title>Галерея</title>
</head>

<body>
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
    <h3>Галерея</h3>
    <form method='post' action='add-album.php'>
        <label>Добавить альбом:</label><br>
        <input type='text' name='album_name' /> <input type='submit' name='submit_album' value='Add' />
    </form><br>
    <?php
    if (isset($_GET['add_album_action'])) {
        if ($_GET['add_album_action'] == 'successfull') { ?>
            <br>Новый альбом создан<br><br>
    <?php }
    }
    ?>
    <?php
    $albums = $mysqli->query('SELECT * FROM gallery_albums');
    while ($album_data = $albums->fetch_assoc()) {
        $photos = $mysqli->query('SELECT * FROM gallery_photos WHERE album_id = ' . $album_data['album_id'] . ''); ?>
        <b>#<?php echo $album_data['album_id'] ?></b> <a href='view-album.php?album_id=<?php echo $album_data['album_id'] ?>'><?php echo $album_data['album_name'] ?></a> (<?php echo $photos->num_rows; ?>)<br><br>
    <?php }
    ?>
</body>

</html>