<?php
/**
 * Created by PhpStorm.
 * User: daixiaohan
 * Date: 2018/7/26
 * Time: 17:34
 */

class Solution347
{
    /**
     * @param $nums
     * @param $k
     * @return array
     */
    public function topKFrequent($nums, $k)
    {
        $numData = [];
        foreach ($nums as $val)
        {
            if(array_key_exists($val, $numData)) {
                $numData[$val] += 1;
            } else {
                $numData[$val] = 1;
            }
        }
        $list = [];
        arsort($numData);
        foreach($numData as $key=>$val)
        {
           if(count($list) < $k) array_push($list, $key);
        }
        return $list;
    }
}
$solution = new Solution347();
$list = $solution->topKFrequent([1,1,1,2,2,2,3,3], 2);
print_r($list);
