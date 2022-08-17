<?php
require __DIR__.'./../../../bootstrap/baseUrl.php';
define('URL_DIR', __DIR__.'./../../../public/assets/');

function url($url) {
    return BASE_URL_.$url;
}
