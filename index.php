<?php

require __DIR__ . '/vendor/autoload.php';
require 'Storage.php';

$storage = new Storage;

if (!empty($_REQUEST['proxy'])) {
    $client = $_REQUEST['client']; // return `$_SERVER['REMOTE_ADDR'];` once remote control done
    $since = ($_REQUEST['action'] ?? null) == "stop" ? 0 : time();
    $storage->addRule($client, $_REQUEST['proxy'], $_REQUEST['port'], $_REQUEST['time'], $_REQUEST['pattern'], $since);
    header("Location: index.php");
    exit();
}


$m = new Mustache_Engine([
    'loader' => new Mustache_Loader_FilesystemLoader(__DIR__ . '/templates'),
    'helpers' => [
        'formatTimestamp' => function($text, Mustache_LambdaHelper $helper) {
            $timestamp = intval($helper->render($text)); 
            $diff = $timestamp - time();
            if ($diff <= 0) {
                return "Due";
            }
            $diff = intval($diff / 60);
            return "$diff minutes";
        },
    ]
]);
echo $m->render('list', ['DATA' => $storage->readRules(RULES_ALL), 'myIP' => $_SERVER['REMOTE_ADDR']]);
