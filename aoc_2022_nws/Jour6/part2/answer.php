<?php

$firstLineChars = str_split(explode(PHP_EOL, file_get_contents('../data.txt'))[0]);

for ($position = 0; $position < count($firstLineChars)-13; $position++) {
    $combination = array_slice($firstLineChars, $position, 14);

    if (count(array_unique($combination)) === 14) {
        echo $position + 14;
        break;
    }
    
}

?>