<?php

namespace PCN\Helpers;

class OsUtility
{
    public static function isUnixLike()
    {
        return in_array(PHP_OS_FAMILY, ['BSD', 'Solaris', 'Linux']);
    }

    public static function isMacOS()
    {
        return in_array(PHP_OS_FAMILY, ['Darwin']);
    }

    public static function isWindows()
    {
        return in_array(PHP_OS_FAMILY, ['Windows']);
    }
}
