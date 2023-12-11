<?php

$data = fopen("../data.txt", "r");
$grid = [];
$rowIndex=0;

function calculateHighestTreesForRow($grid, $direction='forward') {
    $visibleTreesCoords = [];
    $rangeRows = range(1, count($grid) - 2);

    foreach($rangeRows as $i) {
        $reverse = $direction == 'reverse';
        $row = $grid[$i];
        $indexes = range(1, count($row) - 2);
        if($reverse) $indexes = array_reverse($indexes);
        
        $tempHighest = $reverse ? end($row) : $row[0];

        foreach($indexes as $j) {
            $currentTree = $grid[$i][$j];
            if($currentTree > $tempHighest) {
                $tempHighest = $currentTree;
                $visibleTreesCoords[] = "[$i, $j] ($currentTree)";
            }
        }
    }
    return $visibleTreesCoords;
}

function calculateHighestTreesForCol($grid, $direction='forward') {
    $visibleTreesCoords = [];
    $rangeCols = range(1, count($grid[0]) - 2);

    foreach($rangeCols as $j) {
        $reverse = $direction == 'reverse';
        $col = array_column($grid, $j);
        $indexes = range(1, count($col) - 2);
        if($reverse) $indexes = array_reverse($indexes);
        
        $tempHighest = $reverse ? end($col) : $col[0];

        foreach($indexes as $i) {
            $currentTree = $grid[$i][$j];
            if($currentTree > $tempHighest) {
                $tempHighest = $currentTree;
                $visibleTreesCoords[] = "[$i, $j] ($currentTree)";
            }
        }
    }
    return $visibleTreesCoords;
}

if($data) {
    while (($line = fgets($data)) !== false) {
        $grid[$rowIndex] = str_split(trim($line));
        $rowIndex++;
    }
    fclose($data);
}

$visibleTreesCoords = [];
$visibleTreesCoords = array_merge($visibleTreesCoords, calculateHighestTreesForRow($grid, 'forward'));
$visibleTreesCoords = array_merge($visibleTreesCoords, calculateHighestTreesForRow($grid, 'reverse'));
$visibleTreesCoords = array_merge($visibleTreesCoords, calculateHighestTreesForCol($grid, 'forward'));
$visibleTreesCoords = array_merge($visibleTreesCoords, calculateHighestTreesForCol($grid, 'reverse'));

$result = (2 * count($grid)) + (2 * count($grid[0])) - 4; 

$result += count(array_unique($visibleTreesCoords));
echo $result;
?>