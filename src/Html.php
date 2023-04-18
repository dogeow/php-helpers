<?php
namespace Dogeow\PhpHelpers;

class Html
{
    /**
     * br 标签转空行
     * @param  string  $input
     * @return string
     */
    public static function br2nl(string $input): string
    {
        return preg_replace(
            '/<br.*?>/iu',
            "\n",
            str_replace("\n", '', str_replace("\r", '', htmlspecialchars_decode($input)))
        );
    }
}
