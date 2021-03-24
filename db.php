<?php
require 'libs/rb.php';
R::setup(
    'mysql:host=localhost;dbname=gallery',
    'Misha',
    ' '
);
session_start();
