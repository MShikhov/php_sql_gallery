<?php
include 'connection.php';
if (isset($_POST['submit_album'])) {
$album = $_POST['album_name'];
$add_album = $mysqli->query("INSERT INTO gallery_albums (album_name) VALUES ($album)");
if ($add_album) {
header('Location: main.php?add_album_action=successfull');
} else {
echo $mysqli->error;
}
}
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