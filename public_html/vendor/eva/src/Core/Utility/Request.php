<?php

/**
 * Created by PhpStorm.
 * User: Charles
 * Date: 10/12/2017
 * Time: 01:34
 */

namespace Eva\Core\Utility;

class Request
{
    public static function getRequestUri($allPathSegment = true)
    {
        $paths = getenv('REQUEST_URI');
        $pathSegment = explode('/', $paths);
        $pathsArray = array_values(array_filter($pathSegment));
        $pathsArrayLast = (count($pathsArray) > 1) ? $pathsArray[count($pathsArray) - 1] : $pathsArray;
        return ($allPathSegment) ? $pathsArray : $pathsArrayLast;
    }
}