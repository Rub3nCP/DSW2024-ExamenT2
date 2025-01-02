<?php
function modifyArray($array, $number){
  $index = array_search($number, $array);
  if ($index === false) {
    //el número no esta en el array
    $array[] = $number;
  } else {
    //el número ya existe en el array, lo borramos
    unset($array[$index]);
    $array = array_values($array); //reindexamos el array para que los índices sigan consecutivos
  }
  return $array;
}

print_r(modifyArray([1,2,3,4,5],3));
print_r(modifyArray([1,2,4,5],3));
?>