<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Likunyan\PhpHelpers\Arr;

final class ArrTest extends TestCase
{
    public function testCombinationOfTwoNumbers(): void
    {
        $array = ['a', 'b', 'c'];
        $arrays = Arr::combinationOfTwoNumbers($array);

        $this->assertSame(['a', 'b'], $arrays[0]);
        $this->assertSame(['c', 'b'], $arrays[count($arrays) - 1]);
        $this->assertSame(count($array) * 2, count($arrays));
    }
}
