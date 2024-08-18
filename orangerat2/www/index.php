<?php
ini_set('display_errors', 0);

define('ROOT', dirname(__FILE__, 2));

$inc = ROOT . '/inc';

require "$inc/conf.php";
require "$inc/db.php";

$page = @$_SERVER['REDIRECT_URL'];

if (empty($page)) {
    require ROOT . '/pages/home.php';
} else {
    $script = ROOT . "/pages$page.php";
    if (file_exists($script)) {
        require $script;
    } else {
        require ROOT . '/pages/404.php';
    }
}

function dd($arr)
{
    echo "<pre>";
    print_r($arr);
}
