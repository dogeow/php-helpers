<?php

class Live
{
    /**
     * 判断手机号的运营商
     * @param  int|string  $number  手机号码
     * @return string
     */
    public static function getPhoneOperator(int|string $number): string
    {
        // 判断手机号位数
        if (strlen($number) !== 11) {
            return '未知';
        }

        // 中国移动
        $cm = [
            134, 135, 136, 137, 138, 139, 147, 148, 150, 151, 152, 157, 158, 159, 178, 182, 183, 184, 187, 188, 198,
            1440, 165, 170, 170, 170,
        ];

        // 中国联通
        $cu = [
            166, 167, 130, 131, 132, 155, 156, 185, 186, 175, 176, 145, 170, 170, 170, 170, 171,
        ];

        // 中国电信
        $ct = [
            133, 199, 191, 173, 162, 153, 177, 180, 181, 189, 170, 170, 170,
        ];

        $numberHead = substr($number, 0, 3);

        if (in_array($numberHead, $cm)) {
            return '中国移动';
        } elseif (in_array($numberHead, $cu)) {
            return '中国联通';
        } elseif (in_array($numberHead, $ct)) {
            return '中国电信';
        } else {
            return '未知';
        }
    }

    /**
     * 判断手机号是否虚拟号码
     * @param  int|string  $number  手机号码
     * @return bool
     */
    public static function isVirtualPhone(int|string $number): bool
    {
        // 中国移动 1703, 1705, 1706, 165
        // 中国联通 1704, 1707, 1708, 1709, 171, 167
        // 中国电信 1700, 1701, 1702, 162
        $virtual = [170, 171, 162, 165, 167];

        $numberHead = substr($number, 0, 3);
        if (in_array($numberHead, $virtual)) {
            return true;
        }

        return false;
    }
}
