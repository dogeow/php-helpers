<?php
namespace Dogeow\PhpHelpers;

class Str
{
    /*
     * 格式化字节大小
     *
     * @param  int  $size  字节数
     * @param  int  $base  MiB 或 MB，即 1024 或 1000
     * @param  string  $delimiter  数字和单位分隔符
     * @return string 格式化后的带单位的大小
     */
    public static function bytesForHuman(int $size, int $base = 1024, string $delimiter = ''): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        for ($i = 0; $size >= $base && $i < 5; $i++) {
            $size /= $base;
        }

        return round($size, 2).$delimiter.$units[$i];
    }

    /**
     * 进制转换
     * 用来做短网址
     * @param  string  $number  需要转换的字符串
     * @param  string  $targetBit  转成多少位
     */
    public static function baseConvert(string $number, string $targetBit): string
    {
        $dic = [
            0 => '0', 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9',
            10 => 'A', 11 => 'B', 12 => 'C', 13 => 'D', 14 => 'E', 15 => 'F', 16 => 'G', 17 => 'H', 18 => 'I',
            19 => 'J', 20 => 'K', 21 => 'L', 22 => 'M', 23 => 'N', 24 => 'O', 25 => 'P', 26 => 'Q', 27 => 'R',
            28 => 'S', 29 => 'T', 30 => 'U', 31 => 'V', 32 => 'W', 33 => 'X', 34 => 'Y', 35 => 'Z',
        ];
        $remainder = bcmod($number, $targetBit);
        $quotient = (string) floor((float) bcdiv($number, $targetBit));

        if ($quotient === '0') {
            return $dic[$remainder];
        }

        return self::baseConvert($quotient, $targetBit).$dic[$remainder];
    }

    /**
     * RGB颜色转16进制颜色
     */
    public static function rgb2Hex(int $r, int $g = -1, int $b = -1): string
    {
        $rHex = dechex($r < 0 ? 0 : (min($r, 255)));
        $gHex = dechex($g < 0 ? 0 : (min($g, 255)));
        $bHex = dechex($b < 0 ? 0 : (min($b, 255)));
        $color = (strlen($rHex) < 2 ? '0' : '').$rHex;
        $color .= (strlen($gHex) < 2 ? '0' : '').$gHex;
        $color .= (strlen($bHex) < 2 ? '0' : '').$bHex;

        return "#${color}";
    }

    /**
     * 获取一张图片的主要颜色
     *
     * @param  string  $imgUrl  图片的本地路径或者在线路径
     * @param  bool  $isHex  是否获取16进制的主要颜色
     */
    public static function getMainColor(string $imgUrl, bool $isHex): string
    {
        $imageInfo = getimagesize($imgUrl);
        // 图片类型
        $imgType = strtolower(substr(image_type_to_extension($imageInfo[2]), 1));
        // 对应函数
        $imageFun = 'imagecreatefrom'.($imgType === 'jpg' ? 'jpeg' : $imgType);
        $i = $imageFun($imgUrl);
        // 循环色值
        $rColorNum = $gColorNum = $bColorNum = $total = 0;
        for ($x = 0; $x < imagesx($i); $x++) {
            for ($y = 0; $y < imagesy($i); $y++) {
                $rgb = imagecolorat($i, $x, $y);
                // 三通道
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;
                $rColorNum += $r;
                $gColorNum += $g;
                $bColorNum += $b;
                $total++;
            }
        }
        $r = round($rColorNum / $total);
        $g = round($gColorNum / $total);
        $b = round($bColorNum / $total);
        if ($isHex) {
            return self::rgb2Hex($r, (int) $g, (int) $b);
        }

        return "rgb(${r}, ${g}, ${b})";
    }

    public static function getTitle($url)
    {
        $str = file_get_contents($url);

        if ($str !== '') {
            $str = trim(preg_replace('/\s+/', ' ', $str));
            preg_match("/<title>(.*)<\/title>/i", $str, $title);

            return $title[1];
        }

        return false;
    }

    /**
     * @param $input
     * @return array|string|null
     */
    public static function br2nl($input)
    {
        return preg_replace(
            '/<br\s?\/?>/iu',
            "\n",
            str_replace("\n", '', str_replace("\r", '', htmlspecialchars_decode($input)))
        );
    }

    /**
     * 给定开始字符和结束字符，截取这个区间
     *
     * @param  string  $string
     * @param  string  $start
     * @param  string  $end
     * @return string
     */
    public static function getStringBetween(string $string, string $start, string $end): string
    {
        $startPos = strpos($string, $start);
        $endPos = strpos($string, $end);

        return substr($string, $startPos, $endPos - $startPos);
    }

    public static function status($status): ?string
    {
        return match ($status) {
            '新' => ' new',
            '热' => ' hot',
            '沸' => ' boil',
            default => null,
        };
    }

    /*
     * 微博热度
     *
     * @param  int  $size  热度
     * @return string 格式化后的带单位的大小
     */
    public static function weiboHotForHuman(int $size): string
    {
        $units = ['', 'K', 'M', 'G'];
        for ($i = 0; $size >= 1000 && $i < 5; $i++) {
            $size /= 1000;
        }

        return round($size).$units[$i];
    }

    public static function topping($topping)
    {
        if (count($topping) >= 2) {
            $diff = $topping[0]->created_at->diffInMinutes($topping[1]->created_at);
            if ($diff > 2) {
                $topping->pop();
            }
        }

        return $topping;
    }
}
