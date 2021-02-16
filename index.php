<?php

require __DIR__ . '/vendor/autoload.php';
require 'Storage.php';

$storage = new Storage;

if (!empty($_REQUEST['proxy'])) {
    /*foreach ($arResult['DATA'] as $key => $arItem){
        if ($arItem[0] == $_REQUEST['ip']){
            unset ($arItem[$key]);
            $flag = true;
        }
    }
    if ($flag){
        $handle1 = fopen($file_name, "w");
        fputcsv($handle1, explode(",", $arResult['DATA']));
    }*/
    
    $storage->addRule($_SERVER['REMOTE_ADDR'], $_REQUEST['proxy'], $_REQUEST['port'], time() + $_REQUEST['time'], $_REQUEST['pattern']);
    header("Location: index.php");
    exit();
}


$m = new Mustache_Engine([
    'loader' => new Mustache_Loader_FilesystemLoader(__DIR__ . '/templates'),
]);
echo $m->render('list', ['DATA' => $storage->readRules()]);
