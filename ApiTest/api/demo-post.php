<?php

$arr = [
    1 => '{"id": 1, "name": "First", "type": "post"}',
    2 => '{"id": 2, "name": "Second", "type": "post"}',
    3 => '{"id": 3, "name": "Third", "type": "post"}',
];

$id = isset($_POST['id']) ? $_POST['id'] : 0;

echo isset($arr[$id]) ? $arr[$id] : '';
exit();