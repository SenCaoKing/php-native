<?php

# Example 1 array_unique() 例子
$input = array("a"=>"green", "red", "b"=>"green", "blue", "red");
$result = array_unique($input);
print_r($result);
/**
 * Output:
 *  Array ( [a] => green [0] => red [1] => blue )
 */

# Example 2 array_unique() 和类型
$input = array(4, "4", "3", 4, 3, "3");
$result = array_unique($input);
var_dump($result);
/**
 * Output:
 *  array (size=2)
        0 => int 4
        2 => string '3' (length=1)
 */