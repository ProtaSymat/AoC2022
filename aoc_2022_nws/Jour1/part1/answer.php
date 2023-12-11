<?php
$data = file_get_contents('../data.txt');
$ln = explode("\n", $data);

$sum = 0;
$resultat = 0;
$bestLutin = -1;
$lutin = 0;

foreach ($ln as $ligne) {
    $ligne = trim($ligne);

    if ($ligne === "") {
        if ($sum > $resultat) {
            $resultat = $sum;
            $bestLutin = $lutin;
        }
        $sum = 0;
        $lutin++;
    } else {
        $sum += intval($ligne);
    }
}

if ($sum > $resultat) {
    $resultat = $sum;
    $bestLutin = $lutin;
}


echo $resultat;