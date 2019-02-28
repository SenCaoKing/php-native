<?php

$url = $_POST['url'];
$params = json_decode($_POST['params'], JSON_UNESCAPED_UNICODE);
$method = $_POST['method'];

exit(request($url, $params, $method));

/**
 * 根据链接、参数、请求方式获取数据
 * @param $url string 链接
 * @param $params array 参数
 * @param $method string 获取方式，get或者post
 */
function request($url, $params, $method)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    if ($method === 'get') {
        curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($params));
    } elseif ($method === 'post') {
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    }

    $output = curl_exec($ch);
    curl_close($ch);

    return $output;
}
