<?php
$file_name = "configurate.csv";

if (($handle = fopen($file_name, "a+")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
        $arResult['DATA'][] = $data;
    }

    if (!empty($_REQUEST['ip'])){

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

        $write =
            $_REQUEST['ip'].','.$_REQUEST['proxy'].','.$_REQUEST['port'].','.(time()+ $_REQUEST['time']);
        $write = explode(",", $write);
        fputcsv($handle, $write);
        header("Location: index.php");
        exit();
    }
    fclose($handle);
}?>
    <form action="">
        <input type="hidden" name="ip" value="<?=$_SERVER['REMOTE_ADDR']?>">
        <input type="text" name="proxy">
        <input type="number" name="port">
        <input type="number" name="time">
        <input type="submit">
    </form>
    <table border="1">
        <?foreach ($arResult['DATA'] as $arData){?>
        <tr>
            <td><?=$arData[0]?></td>
            <td><?=$arData[1]?></td>
            <td><?=$arData[2]?></td>
            <td><?=$arData[3]?></td>
        </tr>
        <?}?>
    </table>

<a href="/pac.php">Скачать файл</a>