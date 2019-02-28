<?php

$arr = [
    1 => '{"id": 1, "name": "First", "type": "get"}',
    2 => '{"id": 2, "name": "Second", "type": "get"}',
    3 => '{"id": 3, "name": "Third", "type": "get"}',
];

$id = isset($_GET['id']) ? $_GET['id'] : 0;

echo isset($arr[$id]) ? $arr[$id] : '';
exit();