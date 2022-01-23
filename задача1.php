<?php
function cutString($line, $length , $appends): string
{
    if (mb_strlen($line) > $length) {
	    $line = mb_substr($line, 0, $length); 
	    return $line .= $appends;
    } else {
        return $line;
    }
}

$arr1 =['123456789123456789', '123456789', 'abcdefgjklmnopqrstuvwxyz', 'абвгдеёжзикл'];
$arr2 = [];

foreach ($arr1 as $key =>$valueArr1) {
    $valueArr1 = cutString( $valueArr1,  14, '...');
        array_push ($arr2, $valueArr1);
}

 print_r ($arr2);
