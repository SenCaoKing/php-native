<?php

// 迭代生成器
function xrange($start, $end, $step = 1) {
    for ($i = $start; $i <= $end; $i += $step) {
        yield $i;
    }
}

foreach (xrange(1, 1000000) as $num) {
    // echo $num . "\n";
}


// 生成器为可中断的函数
$range = xrange(1, 1000000);
var_dump($range); // object(Generator)[2]
var_dump($range instanceof Iterator); // boolean true


