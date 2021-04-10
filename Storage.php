<?php

const RULES_FILE_NAME = "data/configurate.csv";

class Storage {

    function readRules(?string $clientFilter = NULL): array {
        if (($handle = @fopen(RULES_FILE_NAME, "r")) === FALSE) {
            return [];
        }
        $result = [];
        while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
            $row = ['ip' => $data[0], 'proxy' => $data[1], 'port' => $data[2], 'duration' => $data[3], 'pattern' => $data[4]];
            if ($clientFilter === NULL || $clientFilter == $row['ip']) {
                $result[] = $row;
            }
        }
        fclose($handle);
        return $result;
    }

    function addRule(string $ip, string $proxy, string $port, string $duration, string $pattern) {
        if (($handle = fopen(RULES_FILE_NAME, "a")) === FALSE) {
            return;
        }
        $write = [$ip, $proxy, $port, $duration, $pattern];
        fputcsv($handle, $write);
        fclose($handle);
    }

}
