<?php
/**
 * 二维数组按某列进行排序的方法
 */

// 方法①
$data[] = array('volume' => 67, 'edition' => 2);
$data[] = array('volume' => 86, 'edition' => 1);
$data[] = array('volume' => 85, 'edition' => 6);
$data[] = array('volume' => 98, 'edition' => 2);
$data[] = array('volume' => 86, 'edition' => 6);
$data[] = array('volume' => 67, 'edition' => 7);
// 取得列的列表
foreach($data as $key => $row){
    $volume[$key] = $row['volume'];
    $edition[$key] = $row['edition'];
}
// 将数据根据 volume 降序排列，根据 edition 升序排列
// 把 $data 作为最后一个参数，以通用键排序

array_multisort($volume, SORT_DESC, $edition, SORT_ASC, $data);

var_dump($data);

// 方法②
$arrUsers = array(
    array(
        'id'   => 1,
        'name' => '张三',
        'age'  => 25,
    ),
    array(
        'id'   => 2,
        'name' => '李四',
        'age'  => 23,
    ),
    array(
        'id'   => 3,
        'name' => '王五',
        'age'  => 40,
    ),
    array(
        'id'   => 4,
        'name' => '赵六',
        'age'  => 31,
    ),
    array(
        'id'   => 5,
        'name' => '黄七',
        'age'  => 20,
    ),
);
$last_ages = array_column($arrUsers, 'age');
array_multisort($last_ages, SORT_DESC, $arrUsers);
var_dump($arrUsers);

// 方法③
$arr = [
    0 => array('volume' => 67, 'edition' => 2),
    1 => array('volume' => 86, 'edition' => 1),
    2 => array('volume' => 85, 'edition' => 6),
    3 => array('volume' => 98, 'edition' => 2),
    4 => array('volume' => 86, 'edition' => 6),
    5 => array('volume' => 67, 'edition' => 7),
];

function arraySort($data, $col, $type = SORT_DESC){
    if(is_array($data)){
        $i = 0;
        foreach($data as $k => $v){
            if(key_exists($col, $v)){
                $arr[$i] = $v[$col];
                $i++;
            }else{
                continue;
            }
        }
    }else{
        return false;
    }
    array_multisort($arr, $type, $data);
    return $data;
}

var_dump(arraySort($arr, 'volume'));
