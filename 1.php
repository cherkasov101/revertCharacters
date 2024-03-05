<?php

function revertCharacters($input) {
    $words = explode(" ", $input);
    foreach ($words as &$word) {
        $punctuation = "";
        if (preg_match('/[.,!?]/', $word[strlen($word)-1])) {
            $punctuation = $word[strlen($word)-1];
            $word = substr($word, 0, -1);
        }
        $firstLetter = mb_substr($word, 0, 1);
        $upperLetter = mb_strtoupper($firstLetter, 'UTF-8');
        if ($firstLetter === $upperLetter) {
            $word = swapLetterCase($word);
        }
        $word = mb_strrev($word) . $punctuation;
    }
    return implode(" ", $words);
}

function swapLetterCase($input) {
    $firstLetter = mb_substr($input, 0, 1, 'UTF-8');
    $firstLetter = mb_strtolower($firstLetter, 'UTF-8');
    $lastLetter = mb_substr($input, -1, 1, 'UTF-8');
    $lastLetter = mb_strtoupper($lastLetter, 'UTF-8');
    return $firstLetter . mb_substr($input, 1, -1, 'UTF-8') . $lastLetter;
}

function mb_strrev($str){
    $r = '';
    for ($i = mb_strlen($str); $i>=0; $i--) {
        $r .= mb_substr($str, $i, 1);
    }
    return $r;
}

// Unit tests
function testRevertCharacters() {
    $input = "Привет! Давно не виделись.";
    $expected = "Тевирп! Онвад ен ьсиледив.";
    $result = revertCharacters($input);
    echo "Input: $input\n";
    echo "Expected: $expected\n";
    echo "Result: $result\n";
    if ($result === $expected) {
        echo "Test passed";
    } else {
        echo "Test failed";
    }
}

testRevertCharacters();