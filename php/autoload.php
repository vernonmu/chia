<?php

spl_autoload_register(function ($file) {
    $paths = array(
        __DIR__ . "/$file.php",
    );
    foreach ($paths as $path) {
        if (file_exists($path)) {
            include $path;
            break;
        }
    }
});
