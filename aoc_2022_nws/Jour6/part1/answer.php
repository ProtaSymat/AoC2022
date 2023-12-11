<?php
$firstLineChars = str_split(explode(PHP_EOL, file_get_contents('../data.txt'))[0]);

for ($position = 0; $position < count($firstLineChars)-3; $position++) {
    $combination = [
        $firstLineChars[$position], 
        $firstLineChars[$position+1], 
        $firstLineChars[$position+2], 
        $firstLineChars[$position+3]
    ];

    if (count(array_unique($combination)) === 4) {
        echo $position + 4;
        break;
    }
}
?>