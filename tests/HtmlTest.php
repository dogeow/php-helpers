<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Dogeow\PhpHelpers\Html;

final class HtmlTest extends TestCase
{
    public function testBr2nl(): void
    {
        $html = "<p>foo</p><br><br/><br /><br\n/><br style='height: 20px'><p>bar</p>";
        $string = Html::br2nl($html);

        $this->assertSame($string, "<p>foo</p>\n\n\n\n\n<p>bar</p>");
    }
}
