<?php
/**
 * Created by PhpStorm.
 * User: Qilong
 * Date: 16/3/14
 * Time: 15:09
 */

namespace Q;


class QDateTime
{
    // Predefined Formats
    const DT_FORMAT_NORMAL          = "Y-m-d H:i:s";    // 2016-04-01 05:03:04
    const DT_FORMAT_COMPACT         = "YmdHis";         // 20160401050304
    const DT_FORMAT_DATE            = "Y-m-d";          // 2016-04-01
    const DT_FORMAT_DATE_CHINESE    = "Y年n月j日";       // 2016年4月1日
    const DT_FORMAT_TIME            = "G:i";            // 4:03


    const DT_PRECISION_YEAR    = "Y";
    const DT_PRECISION_DAY     = "D";
    const DT_PRECISION_HOUR    = "H";
    const DT_PRECISION_MIN     = "I";
    const DT_PRECISION_SEC     = "S";
    const DT_PRECISION_FORMAT  = "F";

    /**
     * 获取当前时间戳
     * @return int current timestamp
     */
    public static function time()
    {
        return time();
    }

    /**
     * @param string $timeStr
     * @param int $offsetTime
     * @return int timestamp
     */
    public static function strtotime($timeStr, $offsetTime = null)
    {
        return strtotime($timeStr, $offsetTime);
    }

    /**
     * @param null|int $timestamp
     * @param string $fmtString
     * @return bool|string
     */
    public static function format($timestamp = null, $fmtString = self::DT_FORMAT_NORMAL)
    {
        return date($fmtString, $timestamp);
    }


    /**
     * 获取$time1 - $time2 的值
     * 依赖于datetime函数，需要设置时区
     * @param string|int $time1
     * @param string|int|null $time2
     * @param string $precision
     * @param string $fmtStr format字符串，当$precision 为DT_PRECISION_FORMAT时必须提供, %y-%m-%d %h:%i:%s
     * @return int|bool 时间差，正数表示 $time1 比 $time2 晚
     */
    public static function diff($time1, $time2 = null, $precision = self::DT_PRECISION_SEC, $fmtStr = null)
    {
        $retval = false;
        switch ($precision) {
            case self::DT_PRECISION_YEAR:
            case self::DT_PRECISION_FORMAT:
                if (is_integer($time1)) { $time1 = date_create(self::format($time1)); }
                if ($time2 === null) { $time2 = date_create(self::format(self::time())); }
                else if (is_integer($time2)) { $time2 = date_create(self::format($time2)); }

                $intervalObj = date_diff($time2, $time1); // date_diff 是 第二个参数减第一个参数
                if ($precision == self::DT_PRECISION_YEAR) {
                    $retval = $intervalObj->y * ($intervalObj->invert ? -1 : 1);
                } else {
                    if ($fmtStr !== null) {
                        $fmtStr = str_replace("%y", $intervalObj->y, $fmtStr);
                        $fmtStr = str_replace("%m", $intervalObj->m, $fmtStr);
                        $fmtStr = str_replace("%d", $intervalObj->d, $fmtStr);
                        $fmtStr = str_replace("%h", $intervalObj->h, $fmtStr);
                        $fmtStr = str_replace("%i", $intervalObj->i, $fmtStr);
                        $retval = str_replace("%s", $intervalObj->s, $fmtStr);
                    }
                }
                break;
            case self::DT_PRECISION_DAY:
            case self::DT_PRECISION_HOUR:
            case self::DT_PRECISION_MIN:
            case self::DT_PRECISION_SEC:
                if (is_string($time1)) { $time1 = self::strtotime($time1); }
                if ($time2 === null) { $time2 = self::time(); }
                else if (is_string($time2)) { $time2 = self::strtotime($time2); }

                if ($precision == self::DT_PRECISION_SEC) {
                    $retval = $time1 - $time2;
                } else if ($precision == self::DT_PRECISION_MIN) {
                    $retval = floor(($time1 - $time2) / 60);
                } else if ($precision == self::DT_PRECISION_HOUR) {
                    $retval = floor(($time1 - $time2) / 60 / 60);
                } else {
                    $retval = floor(($time1 - $time2) / 60 / 60 / 12);
                }
                break;
            default:
                break;
        }

        return $retval;
    }
}