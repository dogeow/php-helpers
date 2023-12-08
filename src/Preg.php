<?php

/**
 * 是否 IP 地址
 * @param  string  $ip
 * @return bool
 */
function isIp(string $ip): bool
{
    return filter_var($ip, FILTER_VALIDATE_IP) !== false;
}
