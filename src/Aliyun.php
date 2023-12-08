<?php

namespace Dogeow\PhpHelpers;

/**
 * OSS 添加文字水印
 *
 * @param  string  $text  文字内容
 * @param  string  $url  图片 URL
 * @param  array  $options  配置项
 * @return string  水印后的图片 URL
 */
function textWatermark(
    string $text,
    string $url,
    array $options = []
): string {
    $options = array_merge([
        'size' => 45,
        'color' => 'FFFFFF',
        'opacity' => 50,
    ], $options);

    $filteredEmoji = filterEmoji($text);
    $base64Str = base64_encode($filteredEmoji);
    $str = rtrim(str_replace(['+', '/'], ['-', '_'], $base64Str), '=');

    $watermarks = [
        "text_$str,g_nw,y_300,x_50,t_{$options['opacity']},color_{$options['color']},size_{$options['size']}",
        "text_$str,g_north,y_100,t_{$options['opacity']},color_{$options['color']},size_{$options['size']}",
        "text_$str,g_center,t_{$options['opacity']},color_{$options['color']},size_{$options['size']}",
        "text_$str,g_sw,y_300,x_50,t_{$options['opacity']},color_{$options['color']},size_{$options['size']}",
        "text_$str,g_se,y_300,x_50,t_{$options['opacity']},color_{$options['color']},size_{$options['size']}",
        "text_$str,g_ne,y_300,t_{$options['opacity']},color_{$options['color']},size_{$options['size']}",
        "text_$str,g_south,y_100,t_{$options['opacity']},color_{$options['color']},size_{$options['size']}",
    ];

    $separator = '/watermark,';
    $watermarkStr = implode($separator, $watermarks);

    return "$url?x-oss-process=image$separator$watermarkStr";
}
