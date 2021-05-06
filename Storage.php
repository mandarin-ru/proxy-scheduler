<?php

const RULES_FILE_NAME = "data/configurate.csv";
const RULES_ONLY_ACTIVE = true;
const RULES_ALL = false;

class Storage {

    function readRules(bool $onlyActive, ?string $clientFilter = NULL): array {
        if (($handle = @fopen(RULES_FILE_NAME, "r")) === FALSE) {
            return [];
        }
        $result = [];
        while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
            $row = [
                'ip' => $data[0], 
                'proxy' => $data[1], 
                'port' => $data[2], 
                'timeEnd' => $data[3], 
                'pattern' => $data[4],
                'duration' => $data[5],
            ];
            if ($clientFilter !== NULL && $clientFilter != $row['ip']) {
                continue;
            }
            if ($onlyActive && $row['timeEnd'] < time()) {
                continue;
            }
            $result[] = $row;
        }
        fclose($handle);
        return $result;
    }

    function addRule(string $ip, string $proxy, string $port, int $duration, string $pattern, $since = NULL) {
        $existing = $this->readRules();
        if (($handle = fopen(RULES_FILE_NAME, "w")) === FALSE) {
            return;
        }
        $since = $since ?? time();
        $timeEnd = $since + $duration;
        $write = [$ip, $proxy, $port, $timeEnd, $pattern, $duration];
        fputcsv($handle, $write);
        foreach ($existing as $rule) {
            if ($ip == $rule['ip'] && $proxy == $rule['proxy'] && $port == $rule['port'] && $pattern == $rule['pattern']) {
                continue;
            }
            fputcsv($handle, [$rule['ip'], $rule['proxy'], $rule['port'], $rule['timeEnd'], $rule['pattern'], $rule['duration']]);
        }
        fclose($handle);
    }

}
