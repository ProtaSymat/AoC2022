<?php
$lines = file('../data.txt', FILE_IGNORE_NEW_LINES);
$result = array();

foreach ($lines as $line) {
    if(!strstr($line, ' 1   2')) continue;
    $data = str_replace(' ', '', $line);
    for($i = 0; $i < strlen($data); $i++){
        $result[$data[$i]] = array();
    }
}

$lines = array_reverse($lines);
foreach ($lines as $line) {
    if(!strstr($line, '[')) continue;
    $data = str_replace(array('[', ']', '    '), array('', '', '0'), $line);
    $data = str_replace(' ', '', $data);

    for($i = 0; $i < strlen($data); $i++){
        if($data[$i] == '0') continue;
        $result[$i + 1][] = $data[$i];
    }  
}


$lines = array_reverse($lines);

foreach ($lines as $line) {
    if(!strstr($line, 'move')) continue;
   
    $line = trim($line);

    preg_match('/move (\d+) from (\d+) to (\d+)/', $line, $procedure);

    $moves = $procedure[1];
    $source = $procedure[2];
    $destination = $procedure[3];

    $slice = array_slice($result[$source], 0 - $moves);
    $result[$source] = array_slice($result[$source], 0, count($result[$source]) - $moves);
    $result[$destination] = array_merge($result[$destination], $slice);
}

$output = '';
for($i = 1; $i <= 9; $i++){
    $numElements = count($result[$i]);
    $output .= $result[$i][$numElements - 1];
}


echo $output;
?>