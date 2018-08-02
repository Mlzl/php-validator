<?php
/**
 * @author ambi
 * @date 2018/8/1
 */

namespace Janice\Library;


class MessageBox extends \SplQueue
{
    /**
     * @param JaniceMessage $value
     */
    public function push($value)
    {
        parent::push($value);
    }

    /**
     * @return JaniceMessage
     */
    public function pop()
    {
        return parent::pop();
    }
}