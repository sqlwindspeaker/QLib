<?php
/**
 * Created by PhpStorm.
 * User: Qilong
 * Date: 16/3/6
 * Time: 11:36
 */

namespace Q;

class QString
{
    // search direction
    const SEARCH_DIRECTION_HEADING  = 0;    // heading to trailing
    const SEARCH_DIRECTION_TRAILING = 1;    // trailing to heading

    const TRIM_OPT_LEFT     = 0;
    const TRIM_OPT_RIGHT    = 1;
    const TRIM_OPT_ALL      = 2;

    public static function size($string) { return strlen($string); }
    public static function isEmpty($string) {}

    public static function trim($string, $trimOpt = self::TRIM_OPT_ALL)
    {
        if ($trimOpt == self::TRIM_OPT_ALL) {
            return trim($string);
        } else if ($trimOpt == self::TRIM_OPT_LEFT) {
            return ltrim($string);
        } else {
            return rtrim($string);
        }
    }
    public static function lcFirst($string) {}
    public static function ucFirst($string) {}
    public static function toLower($string) {}
    public static function toUpper($string) {}

    /**
     * 根据分隔符将字符串分解成数组
     * @param $string
     * @param $delimiter
     * @return array|false 分隔符为""时，返回false
     */
    public static function split($string, $delimiter)
    {
        return explode($delimiter, $string);
    }

    /**
     * 判断是否存在子字符串
     * @param $string
     * @param $substring
     * @param $ignoreCase
     * @return bool
     */
    public static function contains($string, $substring, $ignoreCase)
    {
        if ($ignoreCase) { return stripos($string, $substring) !== false; }
        else { return strpos($string, $substring) !== false; }
    }

    /**
     * 查找子字符串第一次出现的位置
     * @param $string
     * @param $substring
     * @param $direction
     * @return int -1 表示字符串不存在, else 表示第一次出现的下标
     */
    public static function indexOf($string, $substring, $direction)
    {
        if ($direction == self::SEARCH_DIRECTION_HEADING) { $pos = strpos($string, $substring); }
        else { $pos = strrpos($string, $substring); }

        return ($pos !== false) ? $pos : -1;
    }

    public static function slice($string, $start, $end) {}
    public static function splice($string, $start, $count, $replace) {}



}