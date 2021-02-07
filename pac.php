<?php

require __DIR__ . '/vendor/autoload.php';

header("Content-type: application/x-ns-proxy-autoconfig");
$file_name = "configurate.csv";

if (($handle = fopen($file_name, "a+")) !== false) {
    while (($data = fgetcsv($handle, 0, ",")) !== false) {
        if ($data[0] == $_SERVER['REMOTE_ADDR'] && date() < $data[3]) {
            $arParams = ['ip' => $data[0], 'proxy' => $data[1], 'port' => $data[2], 'duration' => $data[3]]; ;
        }
    }
	fclose($handle);
}

$m = new Mustache_Engine([
    'loader' => new Mustache_Loader_FilesystemLoader(__DIR__ . '/templates'),
]);
echo $m->render('pacfile', $arParams);
