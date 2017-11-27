<?php

function array_count($array) {
    $count = 0;
    foreach ($array as $item => $value) {
        $count++;
    }
    return $count;
};

$array1 = [2,3,4,5,6,7];
$array2 = [
    'name' => 'Женя',
    'age' => 20,
    'sex' => 'Male',
];
$array3 = [
    [3,4,5],
    [7,8,9],
];
echo array_count($array1);
echo '</br>';
echo array_count($array2);
echo '</br>';
echo array_count($array3);
echo '</br>';

/*
function dayWeek() {
    $days = [
        1 => 'пн',
        2 => 'вт',
        3 => 'ср',
        4 => 'чт',
        5 => 'пт',
        6 => 'сб',
        7 => 'вс',
    ];
    return $days[date('N', $time)];
}
echo dayWeek(time() - 0 );
 */

$var = '<html>'
        . '<head></head>'
        .'<body>'
            .'<form enctype=multipart/form-data method="post" action="save.php">'
                .'<p><input name = "username"></p>'
                .'<p><input type = "file" name = "image"></p>'
                .'<p><input type = "file" name = "image2"></p>'
                .'<p><input type = "submit" value = "Save"></p>'
            .'</form>'
        .'</body>'
        .'</html>';
echo $var;



$h = fopen('file.txt', 'w');
fwrite($h, 'write');
fwrite($h, '123');
fclose($h);

@mkdir('files');
@mkdir('files/mfiles');
if (file_exists('file.txt')) {
    rename('file.txt', 'files/file.txt');
}
copy('./files/file.txt', './files/file2.txt');
if( filesize('./files/file.txt') < filesize('./files/file2.txt') ) {
    unlink('./files/file.txt');
}
if (file_exists('file.txt')) {
    rename('./files/file2.txt', './files/mfiles/file2.txt');
}
file_put_contents('./files/mfiles/file2.txt', 'some strings');






//file_get_contents('file.txt');
//file_put_contents('file.txt', 'put');



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

