<?php

require __DIR__ . '/vendor/autoload.php';

$file_name = "configurate.csv";

if (($handle = fopen($file_name, "a+")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
        $arResult['DATA'][] = ['ip' => $data[0], 'proxy' => $data[1], 'port' => $data[2], 'duration' => $data[3]]; 
    }

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
        
        $write = [$_SERVER['REMOTE_ADDR'], $_REQUEST['proxy'], $_REQUEST['port'], time() + $_REQUEST['time']];
        fputcsv($handle, $write);
        header("Location: index.php");
        exit();
    }
    fclose($handle);

    $m = new Mustache_Engine([
        'loader' => new Mustache_Loader_FilesystemLoader(__DIR__ . '/templates'),
    ]);
    echo $m->render('list', $arResult);
}
