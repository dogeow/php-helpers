<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Dogeow\PhpHelpers\Str;

final class StrTest extends TestCase
{
    public function testBytesForHuman(): void
    {
        $size = Str::bytesForHuman('1024');
        $this->assertSame($size, "1KB");

        $size = Str::bytesForHuman('5200');
        $this->assertSame($size, "5.08KB");

        $size = Str::bytesForHuman('9000000000000000000000000000000000000000');
        $this->assertSame($size, "6770.85CB");
    }
}
