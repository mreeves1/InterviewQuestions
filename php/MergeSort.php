<?php
// Simple little merge sort recursive function based on:
// Coursera's Stanford Algorithms: Design and Analysis, Part 1 Course
// ref: https://www.coursera.org/course/algo

function mergeSort($a) {

  $len = count($a);
  if ($len == 1) {
    return $a;
  }
  $chunk_size = ceil($len/2);
  $tmp = array_chunk($a, $chunk_size); // first chunk will be larger
  $b1 = $tmp[0];
  $b2 = $tmp[1];

  if (count($b1) > 1) {
    $b1 = mergeSort($b1);  
  } 
  if (count($b2) > 1) {
    $b2 = mergeSort($b2);
  }

  $i = 0;
  $j = 0;
  $b1_max = count($b1);
  $b2_max = count($b2);
  $output = array();
  while ($i <= $b1_max || $j <= $b2_max){
    if (!isset($b1[$i]) && !isset($b2[$j])) {
      return $output;
    } elseif (!isset($b1[$i])) {
      $output[] = $b2[$j];
      $j++;
    } elseif (!isset($b2[$j])) {
      $output[] = $b1[$i];
      $i++;
    } elseif ($b1[$i] > $b2[$j]) {
      $output[] = $b2[$j];
      $j++;
    } elseif ($b1[$i] < $b2[$j]) {
      $output[] = $b1[$i];
      $i++;
    } elseif ($b1[$i] == $b2[$j]) {
      $output[] = $b1[$i];
      $output[] = $b2[$j];
      $i++;
      $j++;
    } else {
      die("unexpected case!");
    }
  }
}

// Test Cases
$a1 = array(2,3,7,1,9,6,4,0);
echo "********** array with even count:\n";
echo "input:\n".var_export($a1, true)."\n";
echo "output:\n".var_export(mergeSort($a1), true)."\n\n";

$a2 = array(6,3,-5,1,0,20,-100,5);
echo "********** array with negative numbers:\n";
echo "input:\n".var_export($a2, true)."\n";
echo "output:\n".var_export(mergeSort($a2), true)."\n\n";

$a3 = array(6,3,2,1,4,20,7);
echo "********** odd array length:\n";
echo "input:\n".var_export($a3, true)."\n";
echo "output:\n".var_export(mergeSort($a3), true)."\n\n";

$a4 = array(4,3,2,1,4,20,2);
echo "********** duplicate numbers array:\n";
echo "input:\n".var_export($a4, true)."\n";
echo "output:\n".var_export(mergeSort($a4), true)."\n\n";

$a5 = array(4);
echo "********** 1 number array:\n";
echo "input:\n".var_export($a5, true)."\n";
echo "output:\n".var_export(mergeSort($a5), true)."\n\n";

$a6 = array(1,2,3,4,5,6,7,8,9,10);
echo "********** already sorted array:\n";
echo "input:\n".var_export($a6, true)."\n";
echo "output:\n".var_export(mergeSort($a6), true)."\n\n";
