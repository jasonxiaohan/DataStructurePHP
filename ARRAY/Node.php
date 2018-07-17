<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/17
 * Time: 8:27
 */

namespace Home\Interfaces;

class Node
{
    public $e = null;
    public $next = null;

    public function __construct($e, $next = null)
    {
        $this->e = $e;
        $this->next = $next;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string)$this->e;
    }
}