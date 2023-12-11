<?php

$data = file('../data.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$somme = 0;

foreach ($data as $dataItem) {
    list($range1, $range2) = explode(",", $dataItem);

    list($start1, $end1) = explode("-", trim($range1));
    list($start2, $end2) = explode("-", trim($range2));

    if (($start1 >= $start2 && $end1 <= $end2) || ($start2 >= $start1 && $end2 <= $end1)) {
         ++$somme;
    }
}

echo $somme;

?>