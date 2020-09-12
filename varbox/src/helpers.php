<?php

use Illuminate\Support\Str;

if (!function_exists('form')) {
    /**
     * @return \Collective\Html\FormBuilder
     */
    function form()
    {
        return app('form');
    }
}

if (!function_exists('form_admin')) {
    /**
     * @return \Varbox\Contracts\AdminFormHelperContract
     */
    function form_admin()
    {
        return app('admin_form.helper');
    }
}

if (!function_exists('menu')) {
    /**
     * @return \Varbox\Contracts\MenuHelperContract
     */
    function menu()
    {
        return app('menu.helper');
    }
}

if (!function_exists('flash')) {
    /**
     * @param string|null $type
     * @return \Varbox\Contracts\FlashHelperContract
     */
    function flash($type = null)
    {
        return app('flash.helper', [
            'type' => $type
        ]);
    }
}

if (!function_exists('meta')) {
    /**
     * @return \Varbox\Helpers\MetaHelper
     */
    function meta()
    {
        return app('meta.helper');
    }
}

if (!function_exists('uploaded')) {
    /**
     * @param string $file
     * @return \Varbox\Contracts\UploadedHelperContract
     */
    function uploaded($file)
    {
        return app('uploaded.helper', [
            'file' => $file
        ]);
    }
}

if (!function_exists('uploader')) {
    /**
     * @return \Varbox\Contracts\UploaderHelperContract
     */
    function uploader()
    {
        return app('uploader.helper');
    }
}

if (!function_exists('array_depth')) {
    /**
     * @param array $array
     * @return int
     */
    function array_depth(array $array) {
        $maxDepth = 1;

        foreach ($array as $value) {
            if (is_array($value)) {
                $depth = array_depth($value) + 1;

                if ($depth > $maxDepth) {
                    $maxDepth = $depth;
                }
            }
        }

        return $maxDepth;
    }
}

if (!function_exists('array_search_key_recursive')) {
    /**
     * @param string|int $needle
     * @param array $haystack
     * @param bool $regexp
     * @return mixed|null
     */
    function array_search_key_recursive($needle, array $haystack = [], $regexp = false)
    {
        $array = new \RecursiveIteratorIterator(
            new \RecursiveArrayIterator($haystack),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($array as $key => $value) {
            if ($regexp ? Str::is($key, $needle) : $key === $needle) {
                return $value;
            }
        }

        return null;
    }
}

if (!function_exists('get_object_vars_recursive')) {

    function get_object_vars_recursive($object)
    {
        $result = [];
        $vars = is_object($object) ? get_object_vars($object) : $object;

        if (is_array($vars) && !empty($vars)) {
            foreach ($vars as $key => $value) {
                $value = (is_array($value) || is_object($value)) ? get_object_vars_recursive($value) : $value;
                $result[$key] = $value;
            }
        }

        return $result;
    }
}
