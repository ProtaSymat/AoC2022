<?php
$data = file_get_contents('../data.txt');
$ln = explode("\n", $data);

$threeBestlutin = [];
$sum = 0;
$lutin = 1;

foreach ($ln as $ligne) {
    if (ctype_space($ligne) !== false) {
        $threeBestlutin[] = ['calories' => $sum, 'lutin' => $lutin];

        usort($threeBestlutin, function ($a, $b) {
            return $b['calories'] - $a['calories'];
        });

        $threeBestlutin = array_slice($threeBestlutin, 0, 3);

        $lutin++;
        $sum = 0;
    } else {
        $sum += (int)$ligne;
    }
}

$totalCalories = array_sum(array_column($threeBestlutin, 'calories'));
echo $totalCalories;