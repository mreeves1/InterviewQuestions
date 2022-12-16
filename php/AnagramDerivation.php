<?php
/**
 * An anagram derivation is a K-letter word derived from an K-1 letter word by adding a letter and rearranging.
 *
 * For example, here is a derivation of "aliens"
 * ail + s =
 * sail + n =
 * nails + e =
 * aliens
 *
 * Write a program that will find the longest such derivation from a 3-letter word in a list of words where every derived
 * word also exists in the list of words.
 *
 * list_of_words = [ail, sail, nails, aliens, trucker, garbage, computer, etc....]
 *
 * @category InterviewQuestions
 * @package AnagramDerivation
 * @author Michael Reeves <mike.reeves@gmail.com>
 *
 * TODO: Add a method to use a dictionary file as the word list source and do some more testing
 * Possible candidates:
 * http://iweb.dl.sourceforge.net/project/wordlist/Ispell-EnWL/3.1.20/ispell-enwl-3.1.20.zip
 * http://hivelocity.dl.sourceforge.net/project/wordlist/12Dicts/5.0/12dicts-5.0.zip
 * http://www.gutenberg.org/dirs/etext02/mword10.zip
 */

function findLargestWordDerivation($findWord, $wordsList) {
    // put words into arrays based on their length
    $wordsArray = array(); //multidimensional array with word length as key
    foreach ($wordsList as $word) {
        $wordLength = strlen($word);
        if (isset($wordsArray[$wordLength])) {
            $wordsArray[$wordLength][] = $word;
        } else {
            $wordsArray[$wordLength] = array($word);
        }
    }
    // echo '<pre>'.var_export($wordsArray, true).'</pre>'; //debug

    $maxWord = checkDerivation($findWord, $wordsArray, '');
    return $maxWord;

}

function checkDerivation($findWord, $multiList, $maxWord) {
    $wordSize = strlen($findWord);
    $words = $multiList[$wordSize];
    $lettersString = 'abcdefghijklmnopqrstuvwxyz';
    $letters = str_split($lettersString);

    foreach($words as $word) {
        if ($findWord === $word) {
            if (strlen($findWord) > strlen($maxWord)) {
                $maxWord = $findWord;
                // echo 'found max word: '.$maxWord.'<br/>'; // debug
            }
            // Now we need to test all letters to create a new word
            for ($i = 0; $i < count($letters) - 1; $i++) {
                $newLetter = $letters[$i];
                $lettersToTest = str_split($word);
                $lettersToTest[] = $newLetter;
                $childWords = $multiList[$wordSize+1];
                foreach($childWords as $childWord) {
                    // $childWordSize = strlen($findWord);
                    $childLetters = str_split($childWord);
                    $foundFlag = true;
                    foreach($childLetters as $childLetter){
                        if (!in_array($childLetter, $lettersToTest)) {
                            $foundFlag = false;
                            break;
                        }
                    }
                    if ($foundFlag) {
                        // echo 'found max word: '.$maxWord.'<br/>'; //debug
                        $maxWord = checkDerivation($childWord, $multiList, $maxWord);
                    }
                }
            }
        }
    }
    return $maxWord;
}

$wordList = array('ail', 'fall', 'ball', 'hail', 'bail', 'bails', 'all', 'avail', 'vail', 'sail', 'nails', 'aliens', 'alienate', 'trucker', 'garbage', 'computer');

$startWord1 = 'ail';
$maxWord1 = findLargestWordDerivation($startWord1, $wordList);

$startWord2 = 'all';
$maxWord2 = findLargestWordDerivation($startWord2, $wordList);

// HTML output for fun and sanity check:
echo 'The word list is: <br/><pre>'.var_export($wordList, true).'</pre>';
echo 'Largest Word Derivation of ' . $startWord1 . ' is '. $maxWord1 . '<br/>';
echo 'Largest Word Derivation of ' . $startWord2 . ' is '. $maxWord2 . '<br/>';