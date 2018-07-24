<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/24
 * Time: 16:07
 */

require_once "MaxHeap.php";
class MaxHeapTest
{
    public static function testHeap($testData, $isHeapfy=false)
    {
        $maxHeap = null;
        $len = count($testData);
        $startTime = microtime(true);
        if($isHeapfy)
            $maxHeap = new MaxHeap(0, $testData);
        else
        {
            $maxHeap = new MaxHeap();
            for($i = 0; $i < $len; $i++)
                $maxHeap->add($testData[$i]);
        }
        $data = [];
        for ($i = 0; $i < $len; $i++)
            $data[$i] = $maxHeap->extractMax();
        for($i = 1; $i < $len; $i++)
        {
            try{
                if($data[$i - 1] < $data[$i])
                    throw new Exception("Error：".$data[$i-1].",".$data[$i]);
            }catch (Exception $e)
            {
                print "An exception：".$e->getMessage();
            }
        }
        print("Test Heap completed.".PHP_EOL);
        $endTime = microtime(true);
        return round($endTime-$startTime, 3);
    }
}

$n = 100000;
$testData = [];
for ($i = 0; $i < $n ; $i++)
{
    $testData[$i] = rand(1000, 1000000);
}
$time1 =  MaxHeapTest::testHeap($testData, false);
print("Without heapify：".$time1." s").PHP_EOL;
$time2 = MaxHeapTest::testHeap($testData,true);
print("With heapify：".$time2." s");

