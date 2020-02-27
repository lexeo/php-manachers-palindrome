<?php
declare(strict_types=1);

/**
 * Finds the first longest palindrome in a given string using Manacher's algorithm (an O(N) solution)
 * @link https://en.wikipedia.org/wiki/Longest_palindromic_substring
 * Note: Any non-alphanumeric chars will be removed
 * @param string $str
 * @return string The found palindrome (single char is also considered as a palindrome)
 */
function findLongestPalindrome(string $str): string
{
    $delimiter = '|';
    $str2 = implode($delimiter, preg_split('//u', mb_strtolower(preg_replace('/\W|_/u', '', $str))));
    $str2len = mb_strlen($str2);

    $palLengths = [];
    $rmLeft = $rmRight = 0;
    $maxPalLen = $maxPalCenter = 0;
    for ($i = 1; $i < $str2len; $i++) {
        $iPalLength = $i < $rmRight ? min($rmRight - $i, $palLengths[($rmRight - $i) + $rmLeft]) : 0;

        // try to expand palindrome
        $l = $i - $iPalLength - 1;
        $r = $i + $iPalLength + 1;
        while ($l >= 0 && $r < $str2len && mb_substr($str2, $l, 1) === mb_substr($str2, $r, 1)) {
            $iPalLength++;
            $l--;
            $r++;
        }
        // update the rightmost palindrome boundaries
        if ($i + $iPalLength > $rmRight) {
            $rmRight = $i + $iPalLength;
            $rmLeft = $i - $iPalLength;
        }

        //remember the longest palindrome
        if ($iPalLength > $maxPalLen) {
            $maxPalLen = $iPalLength;
            $maxPalCenter = $i;
        }
        $palLengths[$i] = $iPalLength;
    }

    return str_replace($delimiter, '', mb_substr($str2, $maxPalCenter - $maxPalLen, 2 * $maxPalLen + 1));
}
