<?php
/**
 * Created by PhpStorm.
 * User: tom
 * Date: 2018/8/6
 * Time: 10:39
 */

/** 并查集类接口
 * Interface UF
 */
interface UF
{
    public function getSize();
    public function unionElements($p, $q);
    public function isConnected($p, $q);
}