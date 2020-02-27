<?php

use PHPUnit\Framework\TestCase;

class FindLongestPalindromeTest extends TestCase
{

    /**
     * @return array
     */
    public function longestPalindromeStringProvider(): array
    {
        return [
            ['Аргентина манит негра', 'аргентинаманитнегра'],
            ['Sum summus mus', 'sumsummusmus'],
            ['Пал, а норов худ и дух ворона лап.', 'паланоровхудидухвороналап'],
            ['Сани, плот и воз, зов и толп и нас.', 'саниплотивоззовитолпинас'],

            ['абракадабра', 'ака'],
            ['Каракум', 'карак'],
            ['Ка ра к   у м', 'карак'],
            ['Антропогенез', 'опо'],
            ['_a_', 'a'],
        ];
    }

    /**
     * @dataProvider longestPalindromeStringProvider
     * @param string $str
     * @param string $expectedLongestPalindrome
     */
    public function testItFindsLongestPalindrome(string $str, string $expectedLongestPalindrome): void
    {
        $this->assertEquals($expectedLongestPalindrome, findLongestPalindrome($str));
    }


    public function testItReturnsTheFirstCharIfNoPalindromeFound(): void
    {
        $this->assertEquals('о', findLongestPalindrome('обычная строка -> вернуть первый символ'));
        $this->assertEquals('s', findLongestPalindrome('simple string'));
    }

    public function testItWorksWithNumbers(): void
    {
        $this->assertEquals('123454321', findLongestPalindrome('123454321'));
        $this->assertEquals('11911', findLongestPalindrome('15321191155313'));
        $this->assertEquals('1', findLongestPalindrome('12345'));
    }
}
