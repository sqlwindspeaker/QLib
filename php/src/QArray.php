<?php
/**
 * Created by PhpStorm.
 * User: Qilong
 * Date: 16/3/6
 * Time: 11:30
 */

namespace Q;


class QArray
{
    // search direction
    const SEARCH_DIRECTION_HEADING  = 0;    // heading to trailing
    const SEARCH_DIRECTION_TRAILING = 1;    // trailing to heading

    // size methods
    public static function size($array) { return count($array); }
    public static function isEmpty($array) { return empty($array); }

    // simple search using '='
    public static function contains($array, $element) { return in_array($element, $array, true); }
    public static function indexOf($array, $element, $direction = self::SEARCH_DIRECTION_HEADING)
    {
        if ($direction == self::SEARCH_DIRECTION_HEADING) { return array_search($element, $array, true); }
        else {
            $arrTmp = array_reverse($array);
            $idx = array_search($element, $arrTmp, true);
            return count($array) - 1 - $idx;
        }
    }

    // search with custom condition
    public static function find($array, $conditionFunc) { foreach ($array as $element) { if ($conditionFunc($element)) { return $element; } } return null; }
    public static function findIndex($array, $conditionFunc) { foreach ($array as $index => $element) { if ($conditionFunc($element)) { return $index; } } return -1; }
    public static function filter($array, $function) { return array_values(array_filter($array, $function)); }

    // create new array
    public static function concat($array, $appendArray) { return array_merge($array, $appendArray); }
    public static function slice($array, $start, $end)
    {
        $size = count($array);
        if ($size == 0) { return []; }

        $length = (($end >= 0) ? $end - $start : $end + $size - $start) % $size;

        if ($length <= 0) { return []; }
        else { return array_slice($array, $start, $length); }
    }

    // array modifications
    public static function push(&$array, $element) { array_push($array, $element); }
    public static function pop(&$array) { array_pop($array); }
    public static function shift(&$array) { array_shift($array); }
    public static function unshift(&$array, $element) { array_unshift($array, $element); }
    public static function splice(&$array, $start, $count = 0, $replace = []) { array_splice($array, $start, $count, $replace); }

    // sort and order
    public static function sort(&$array, $sortFunc) { usort($array, $sortFunc); }
    public static function unique($array) { return array_unique($array, SORT_REGULAR); }
    public static function reverse($array) { return array_reverse($array); }

    // traversal
    public static function each(&$array, $function) { array_walk($array, $function, $array); }
    public static function accumulate($array, $function, $initial) { return array_reduce($array, $function, $initial); }
    public static function map($array, $mapFunc) { return array_map($mapFunc, $array); }

    // collection operations
    public static function union($array0, $array1) { return array_unique(array_merge($array0, $array1), SORT_REGULAR); }
    public static function intersection($array0, $array1) { return array_values(array_intersect($array0, $array1)); }
    public static function difference($array0, $array1) { return array_values(array_diff($array0, $array1)); }

    // element access
    public static function first($array) { return reset($array); }
    public static function last($array) { return end($array); }

    // misc operations
    public static function join($array, $delimiter) { return join($delimiter, $array); }
}