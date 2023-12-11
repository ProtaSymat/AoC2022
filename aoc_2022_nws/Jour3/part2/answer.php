<?php
$data = explode(PHP_EOL, file_get_contents('../data.txt'));
$totalSum = 0;
$table = array();

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

function priorite($compartment)
{
    $items = array_map('str_split', $compartment);
    $commonItems = call_user_func_array('array_intersect', $items);
    $uniqueCommonItems= array_unique($commonItems);
    $sum = array_sum(array_map('calcul', $uniqueCommonItems));
    return $sum;
}

foreach ($data as $datum) {
    $table[] = $datum;
    if (count($table) == 3) {
        $totalSum += priorite($table);
        $table= array();
    }
}

if(count($table) > 0){
    $totalSum += priorite($table);
}
echo $totalSum;

?>