<?php

if (! function_exists('isActive')) {

    function isActive($href, $class = 'active')
    {
        return $class = (strpos(Route::currentRouteName(), $href) === 0 ? $class : '');
    }
    function isActiveMenu($href, $classMenu = 'menu-open')
    {
        return $classMenu = (strpos(Route::currentRouteName(), $href) === 0 ? $classMenu : '');
    }
}
