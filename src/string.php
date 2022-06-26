<?php
/*
 * 格式化字节大小
 *
 * @param  int  $size  字节数
 * @param  int  $base  MiB 或 MB，即 1024 或 1000
 * @param  string  $delimiter  数字和单位分隔符
 * @return string 格式化后的带单位的大小
 */

if (!function_exists('bytesForHuman')) {
    function bytesForHuman(int $size, int $base = 1024, string $delimiter = ''): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        for ($i = 0; $size >= $base && $i < 5; $i++) {
            $size /= $base;
        }

        return round($size, 2).$delimiter.$units[$i];
    }
}
