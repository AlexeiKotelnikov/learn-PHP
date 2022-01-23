<?php
function arraySort(array $array, $key, $sort): array {
  
  if ($sort == SORT_ASC) {
      function build_sorter($key) { //вызов анонимной функции
        return function ($a, $b) use ($key) {  //чтобы можно было использовать аргумент родительской функции
          if (is_string($key)) {   //проверка: является ли ключ строкой или нет
            return strnatcmp($a[$key], $b[$key]);
          } else {
            return $a[$key] - $b[$key];
          }
        };
      }
      usort($array, build_sorter($key));
      $arr = [];
    array_push ($arr, $array); //пихаем измененый порядок элементов в новый массив
    print_r($arr);
    return $arr;
  } else {
   function build_sorter($key) {
    return function ($a, $b) use ($key) {
      if (is_string($key)) {
        return strnatcmp($b[$key], $a[$key]);
      } else {
        return $a[$key] + $b[$key];
      }
    };
  }
  
  usort($array, build_sorter($key));
  $arr = [];
  array_push ($arr, $array);
  print_r($arr);
  return $arr;
}
};

$menu = [ 
  [ 'title' => 'Main',
  'sort' => 1,
  'path' => '/main-page.html'
],
[ 'title' => 'Gallery',
'sort' => 5,
'path' => '/gallery.html'
],
[ 'title' => 'Contact',
'sort' => 3,
'path' => '/contacts-page.html'
]
];

arraySort( $menu, 'sort', SORT_DESC);