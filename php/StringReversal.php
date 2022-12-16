<?php
/**
 * String Reversal Problems
 *
 * We will reverse strings
 *
 * @category InterviewQuestions
 * @package ReverseStrings
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @date 2013-05-10
 *
 */

// step 1 -> write a function to reverse this, return a string
function reverseString($input){
    $inputArray = str_split($input);
    $output = '';
    $length = count($inputArray);
    for ($i = $length - 1; $i > -1; $i--) {
        $output .= $inputArray[$i];        
    }
    return $output;
}

$input = "This is a test";
echo '<b>Test reverseString function:</b><br/>';
echo reverseString($input).'<br/><br/>'; // should be: "tset a si sihT"


// step 2 -> same reversal but preserve words
function reverseWords($input){
    $inputArray = explode(" ", $input);
    $output = '';
    $length = count($inputArray);
    for ($i = $length - 1; $i > -1; $i--) {
        $outputArray[] = $inputArray[$i];        
    }
  $output = implode(' ', $outputArray);
    return $output;
}

$input = "This is a test";
echo '<b>Test reverseWords function:</b><br/>';
echo reverseWords($input).'<br/><br/>'; // should be: "test a is This"


// step 3 - modify reverseString and use recursion
function reverseRecurseWrapper($input) {
    $inputArray = str_split($input);
    $outputArray = recursePopPush($inputArray);
    $output = implode("", $outputArray);
	return $output;
}

function recursePopPush($inputArray, $outputArray = array()){
	if (count($inputArray) > 0) {
        $letter = array_pop($inputArray);
        $outputArray[] = $letter; 
        $outputArray = recursePopPush($inputArray, $outputArray);
    }
    return $outputArray;
}

$input = "This is a test";
echo '<b>Test reverseRecurseWrapper function:</b><br/>';
echo reverseRecurseWrapper($input).'<br/><br/>'; // should be: "tset a si sihT"
