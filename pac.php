<?php

require __DIR__ . '/vendor/autoload.php';
require 'Storage.php';

header("Content-type: application/x-ns-proxy-autoconfig");
header("Cache-Control: max-age=300");
$storage = new Storage;

$m = new Mustache_Engine([
    'loader' => new Mustache_Loader_FilesystemLoader(__DIR__ . '/templates'),
]);
echo $m->render('pacfile', ['proxy' => $storage->readRules($_SERVER['REMOTE_ADDR'])]);
