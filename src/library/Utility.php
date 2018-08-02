<?php

namespace Janice\Library;

/**
 * @author ambi
 * @date 2018/8/1
 */

class Utility
{
    /**
     *
     * @param string $field
     * @param string $target
     * @param string $placeholder
     * @return mixed
     */
    public static function replaceField($field, $target, $placeholder=':field')
    {
        return str_replace($placeholder, $field, $target);
    }
}