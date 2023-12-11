<?php
$ln = file('../data.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$scorefinal = 0;
$shape_scores = ['X' => 1, 'Y' => 2, 'Z' => 3];
$choices_per_goal = ['X' => ['A' => 'X', 'B' => 'Z', 'C' => 'Y'], 'Y' => ['A' => 'X', 'B' => 'Y', 'C' => 'Z'], 'Z' => ['A' => 'Y', 'B' => 'Z', 'C' => 'X']];

function tour($lutinadversaire, $shape_goal)
{
    global $shape_scores, $choices_per_goal;

    $lutinjoueur = $choices_per_goal[$shape_goal][$lutinadversaire];
    $choix = $shape_scores[$lutinjoueur];

    if ($shape_goal == 'Z') {
        return $choix + 6;
    } elseif ($shape_goal == 'X') {
        return $choix;
    } else {
        return $choix + 3;
    }
}

foreach ($ln as $ligne) {
    list($lutinadversaire, $shape_goal) = explode(' ', trim($ligne));
    $scorefinal += tour($lutinadversaire, $shape_goal);
}

echo $scorefinal;
?>