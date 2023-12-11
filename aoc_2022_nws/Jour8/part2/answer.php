<?php

$filePath = fopen("../data.txt", "r");

$maxScore = 0;
$treeGrid = [];

$rowIndex=0;
if($filePath) {
    while (($line = fgets($filePath)) !== false) {
        $line = trim($line);

        $treeGrid[$rowIndex] = str_split($line);
        $rowIndex++;
    }
}
function getRowColumnMatrix($treeGrid, $row, $column): array
{
    $rowMatrix = $treeGrid[$row];
    $colMatrix = [];
    for($i=0; $i<=count($treeGrid[$row]) -1; $i++) {
        $colMatrix[] = $treeGrid[$i][$column];
    }

    return [$rowMatrix, $colMatrix];
}

for($row=0; $row <= count($treeGrid) - 1; $row++) {
    for($column=0; $column <= count($treeGrid[$row]) - 1; $column++) {

        [$rowMatrix, $colMatrix] = getRowColumnMatrix($treeGrid, $row, $column);

        $currentTree = $treeGrid[$row][$column];
        $currentTreeScore = 1;

        $rightScore = 0;
        $leftScore = 0;
        $topScore = 0;
        $bottomScore = 0;


        for($i=$column+1; $i <= count($rowMatrix) -1; $i++) {
            $rightScore++;
            if($rowMatrix[$i] >= $currentTree) {
                break;
            }
        }

        for($i=$column - 1; $i >= 0; $i--) {
            $leftScore++;
            if($rowMatrix[$i] >= $currentTree) {
                break;
            }
        }

        for($i=$row + 1; $i <= count($colMatrix) -1; $i++) {
            $topScore++;
            if($colMatrix[$i] >= $currentTree) {
                break;
            }
        }

        for($i=$row - 1; $i >= 0; $i--) {
            $bottomScore++;
            if($colMatrix[$i] >= $currentTree) {
                break;
            }
        }

        $currentTreeScore *= $rightScore ?: 1;
        $currentTreeScore *= $leftScore ?: 1;
        $currentTreeScore *= $topScore ?: 1;
        $currentTreeScore *= $bottomScore ?: 1;

        $maxScore = max($maxScore, $currentTreeScore);
    }
}

echo $maxScore;
?>