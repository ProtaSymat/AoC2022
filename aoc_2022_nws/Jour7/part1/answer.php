<?php
$fileHandler = fopen("../data.txt", "r");

$totalSize = 0;
$fileSystem = []; 
$currentPath = []; 

if($fileHandler) {
    while (($line = fgets($fileHandler)) !== false) {
        $line = trim($line);
        handleLine($currentPath, $fileSystem, $line);
    }
}

calculateTotalSize($fileSystem, $totalSize);

echo $totalSize;


function handleLine(&$currentPath, &$fileSystem, $line)
{
    if($line[0] === '$') {
        if($line === '$ cd ..') {
            array_pop($currentPath);
        }

        preg_match('/^\$ cd ([a-zA-Z0-9]+)/', $line, $directoryChange);
        if(!empty($directoryChange)) {
            $currentPath[] = $directoryChange[1];
        }
    }
    else {
        writeToDirectory($fileSystem, $currentPath, $line);
    }
}


function writeToDirectory(&$fileSystem, $currentPath, $itemData)
{
    if(empty($currentPath)) {
        $itemParts = explode(' ', $itemData);
        if(!isset($fileSystem[$itemParts[1]])) {
            if($itemParts[0] === 'dir') {
                $fileSystem[$itemParts[1]] = [];
            } else {
                $fileSystem[$itemParts[1]] = $itemParts[0];
            }
        }
    } else {
        $tempPath = array_reverse($currentPath);
        $dir = array_pop($tempPath);
        $tempPath = array_reverse($tempPath);
        writeToDirectory($fileSystem[$dir], $tempPath, $itemData);
    }
}

function calculateTotalSize($fileSystem, &$totalSize)
{
    $directorySize = 0;
    foreach($fileSystem as $item) {
        if(is_array($item)) {
            $directorySize += calculateTotalSize($item, $totalSize);
        } else {
            $directorySize += $item;
        }
    }
    if($directorySize < 100000) {
        $totalSize += $directorySize;
    }
    return $directorySize;
}

?>