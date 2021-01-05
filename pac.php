<?

header("Content-type: application/x-ns-proxy-autoconfig");
$file_name = "configurate.csv";

if (($handle = fopen($file_name, "a+")) !== false) {
    while (($data = fgetcsv($handle, 0, ",")) !== false) {
        if ($data[0] == $_SERVER['REMOTE_ADDR'] && date() < $data[3]) {
            $arParams = $data;
        }
    }
}

?>
function FindProxyForURL(url, host) {
<? if (!empty($arParams)) { ?>
    return "PROXY <?= $arParams[1] ?>:<?= $arParams[2] ?>";
<? } else { ?>
    return "DIRECT";
<? } ?>
}