<?php

$handler = fopen("../data.txt", "r");

$result = 0;
$fs = []; // file system
$path = []; 
$totalSize = 0;
$sizes = [];

if($handler) {
    while (($line = fgets($handler)) !== false) {
        $line = trim($line);

        if($line[0] === '$') {
            if($line === '$ cd ..') {
                array_pop($path);
            }

            preg_match('/^\$ cd ([a-zA-Z0-9]+)/', $line, $dir);
            if(!empty($dir)) {
                $path[] = $dir[1];
            }
        } else {
            writeToFS($fs, $path, $line);
        }
    }
}
calcTotalSize($fs,$totalSize);

$freeSize = 70000000 - $totalSize;
$reqSize = 30000000 - $freeSize;

mapSizes($fs, $sizes, $reqSize);
sort($sizes);
$result = $sizes[0];

echo  $result;

function writeToFS(&$fs, $path, $data): void
{
    if(empty($path)) {
        $item = explode(' ', $data );

        if(!isset($fs[$item[1]])) {
            if($item[0] === 'dir') {
                $fs[$item[1]] = [];
            } else {
                $fs[$item[1]] = $item[0];
            }
        }
    } else {
        $tempPath = array_reverse($path);
        $dir = array_pop($tempPath);
        $tempPath = array_reverse($tempPath);
        writeToFS($fs[$dir], $tempPath, $data);
    }
}

function calcTotalSize($fs, &$totalSize): void
{
    foreach($fs as $item) {
        if(is_array($item)) {
            calcTotalSize($item, $totalSize);
        } else {
            $totalSize += $item;
        }
    }
}

function mapSizes($fs, &$sizes, &$reqSize)
{
    $size = 0;
    foreach($fs as $item) {
        if(is_array($item)) {
            $size += mapSizes($item, $sizes, $reqSize);
        } else {
            $size += $item;
        }
    }
    if($size > $reqSize) {
        $sizes[] = $size;
    }
    return $size;
}