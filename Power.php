<?php
/**
 * Exponent Problems
 *
 * Raise number to a power without built-in functions
 *
 * NOTE: One of the problem constraints (because of time) was to only support positive integers
 *
 * @category InterviewQuestions
 * @package Power
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @date 2013-05-10
 *
 */

// loop example
function powLoop($base, $exp) {
    // TODO: add validation for input vars
	if ($exp < 1 || !is_integer($exp)) {
		die('Exponent does not meet problem constraints.');
	} elseif ($exp === 1){
        return $base;
    } else { // assume only positive exponents
        $answer = 1;
        for ($i = 0; $i < $exp; $i++){
            $answer = $answer * $base;
        } 
        return $answer;
    }
}

// loop test
echo '<h2>Loop example</h2>';
echo powLoop(10, 1). ' should be 10.<br/>'; // 10
echo powLoop(10, 2). ' should be 100.<br/>'; // 100
echo powLoop(2, 3). ' should be 8.<br/>'; // 8
echo powLoop(1500, 1). ' should be 1500.<br/>'; // 1500


// recursion example
function powWrapper($base, $exp) {
    return powRecursive(1, $base, $exp);
}

function powRecursive($total, $base, $exp) {
    $newTotal = $total * $base;
    if ($exp < 1 || !is_integer($exp)) {
        die('Exponent does not meet problem constraints.');
    } elseif ($exp === 1) {
        return($newTotal);
    } else {
        $newExp = $exp - 1;
        return powRecursive($newTotal, $base, $newExp);
    }
}

// recursion test
echo '<h2>Recursion example</h2>';
echo powWrapper(10, 1). ' should be 10.<br/>'; // 1000
echo powWrapper(10, 3). ' should be 1000.<br/>'; // 1000
echo powWrapper(2, 3). ' should be 8.<br/>'; // 8
echo powWrapper(1500, 1). ' should be 1500.<br/>'; // 1500

/*
unraveling recursion manually for 10, 3 example:
1, 10, 3
10, 10, 2
100, 10, 1
return 1000
*/
