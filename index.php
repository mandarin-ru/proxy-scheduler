<?php
$file_name = "configurate.csv";

if (($handle = fopen($file_name, "a+")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
        $arResult['DATA'][] = $data;
    }

    if (!empty($_REQUEST['ip'])){
        $write =
            $_REQUEST['ip'].','.$_REQUEST['proxy'].','.$_REQUEST['port'].','.$_REQUEST['time'];
        $write = explode(",", $write);
        fputcsv($handle, $write);
    }

    fclose($handle);



}?>
    <form action="">
        <input type="text" name="ip">
        <input type="text" name="proxy">
        <input type="number" name="port">
        <input type="number" name="time">
        <input type="submit">
    </form>
<?

    ?>
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
