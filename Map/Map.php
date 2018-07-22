<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/22
 * Time: 16:05
 */

/**
 * 映射接口类
 * Interface Map
 */
interface Map
{
    public function add($key, $value);
    public function remove($key);
    public function contains($key);
    public function get($key);
    public function set($key, $value);
    public function getSize();
    public function isEmpty();
}