<?php

/**
 * 是否是一个 IP 地址
 * @param  string  $ip
 * @return bool
 */
function isIp(string $ip): bool
{
    $reg = '/^((?:(?:25[0-5]|2[0-4]\d|((1\d{2})|([1-9]?\d)))\.){3}(?:25[0-5]|2[0-4]\d|((1\d{2})|([1-9]?\d))))$/';

    return (bool) preg_match($reg, $ip);
}
