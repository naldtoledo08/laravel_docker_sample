<?php

if (!function_exists('display_date')) {
    function display_date($date)
    {
        return date('M d, Y', strtotime($date));
    }
}

if (!function_exists('display_date_time')) {
    function display_date_time($date)
    {
        return date('M d, Y h:i a', strtotime($date));
    }
}

if (!function_exists('display_time')) {
    function display_time($date)
    {
        return date('h:i a', strtotime($date));
    }
}

if (!function_exists('display_date_with_day')) {
    function display_date_with_day($date)
    {
        return date('l M d, Y', strtotime($date));
    }
}

if (!function_exists('display_day')) {
    function display_day($date)
    {
        return date('l', strtotime($date));
    }
}


if (!function_exists('is_route_active')) {
    function is_route_active($route)
    {
        return Request::is($route) ? 'active' : '';
    }
}

if (!function_exists('display_shift_time')) {
    function display_shift_time($time, $time_flex)
    {
        $time = display_time('2010-01-01 '.$time);

        if(isset($time_flex) && $time_flex) {
            $time .= ' - '.display_time('2010-01-01 '.$time_flex);
        }
        
        return $time;
    }
}