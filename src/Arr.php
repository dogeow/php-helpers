<?php
namespace Likunyan\PhpHelpers;

class Arr
{
    /**
     * 两数组合
     * @description 限制：不包含自己，位置排列没有限制
     * @param $array
     * @return array
     */
    public static function combinationOfTwoNumbers($array): array
    {
        $combinations = [];

        foreach ($array as $a) {
            foreach ($array as $b) {
                if ($a === $b) {
                    continue;
                }

                if (self::isInTwoDimensionalArray($combinations, [$a, $b])) {
                    continue;
                }

                $combinations[] = [$a, $b];
            }
        }

        return $combinations;
    }


    /**
     * @param $array
     * @param $item
     * @return bool
     */
    public static function isInTwoDimensionalArray($array, $item): bool
    {
        foreach ($array as $row) {
            if (in_array($item, $row)) {
                return true;
            }
        }

        return false;
    }
}
