<?php
/**
 * Created by PhpStorm.
 * User: tom
 * Date: 2018/8/6
 * Time: 11:42
 */

require_once "UnionFindA.php";
require_once "UnionFindB.php";
require_once "UnionFindC.php";
require_once "UnionFindD.php";
require_once "UnionFindE.php";
require_once "UnionFindF.php";

class UnionFindTest
{
    public static function testUF($uf, $m)
    {
        $size = $uf->getSize();
        $startTime = microtime(true);
        for ($i = 0; $i < $m; $i++) {
            $a = rand(0, $size-1);
            $b = rand(0, $size-1);
            $uf->unionElements($a, $b);
        }
        for ($i = 0; $i < $size; $i++) {
            $a = rand(0, $size-1);
            $b = rand(0, $size-1);
            $uf->isConnected($a, $b);
        }
        $endTime = microtime(true);

        return round($endTime - $startTime ,3);
    }
}

$size = 100000;
$m = 100000;
$unionC = new UnionFindC($size);
$ufc = UnionFindTest::testUF($unionC, $m);
print("UnionFindC：" . $ufc . " s ".PHP_EOL);

$unionD = new UnionFindD($size);
$ufd = UnionFindTest::testUF($unionD, $m);
print("UnionFindD：" . $ufd . " s ".PHP_EOL);

$unionE = new UnionFindE($size);
$ufe = UnionFindTest::testUF($unionE, $m);
print("UnionFindE：" . $ufe . " s ".PHP_EOL);

$unionF = new UnionFindF($size);
$uff = UnionFindTest::testUF($unionF, $m);
print("UnionFindF：" . $uff . " s ".PHP_EOL);