<?php

$data = explode(PHP_EOL, file_get_contents('../data.txt'));
$totalSum = 0;

function calcul($item)
{
    $lowercase = range('a', 'z');
    $uppercase = range('A', 'Z');

    if (in_array($item, $lowercase)) {
        return array_search($item, $lowercase) + 1;
    } elseif (in_array($item, $uppercase)) {
        return array_search($item, $uppercase) + 27;
    } else {
        return 0; 
    }
}

function priorite($compartimentA, $compartimentB)
{
    $sum = 0;

    $items1 = str_split($compartimentA);
    $items2 = str_split($compartimentB);
    $commonItems = array_unique(array_intersect($items1, $items2));
    $commonItems = implode(" ", $commonItems);
    $sum += calcul($commonItems);
    return $sum;
}

foreach ($data as $dataItem) {
    $compartments = strlen($dataItem);
    $compartment1 = substr($dataItem, 0, 
    $compartments / 2);
    $compartment2 = substr($dataItem, $compartments / 2);
    if ($compartments) {
        $priorite = priorite($compartment1, $compartment2);
        $totalSum += $priorite;
    }
}

echo $totalSum;

?>