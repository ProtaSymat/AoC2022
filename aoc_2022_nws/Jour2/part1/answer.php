<?php
$ln = file('../data.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$scorefinal = 0;
$lutinjoueur_map = ['X' => 1, 'Y' => 2, 'Z' => 3];
$winning_combinations = ['AY', 'BZ', 'XC'];
$losing_combinations = ['AX', 'BY', 'CZ'];

function tour($lutinadversaire, $lutinjoueur)
{
    global $lutinjoueur_map, $winning_combinations, $losing_combinations;

    $choix = $lutinjoueur_map[$lutinjoueur];

    if (in_array($lutinadversaire . $lutinjoueur, $winning_combinations)) {
        return $choix + 6;
    } elseif (in_array($lutinadversaire . $lutinjoueur, $losing_combinations)) {
        return $choix;
    } else {
        return $choix + 3;
    }
}

foreach ($ln as $ligne) {
    list($lutinadversaire, $lutinjoueur) = explode(' ', trim($ligne));
    $scorefinal += tour($lutinadversaire, $lutinjoueur);
}

echo $scorefinal;

?>