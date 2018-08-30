<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>分页</title>
<?php
/**
 * Created by PhpStorm.
 * 分页
 * User: Sen
 * Date: 2017/3/1
 * Time: 21:52
 */
// 分页的函数
function news($pageNum = 1, $pageSize = 3)
{
    $array = array();
    $coon = mysqli_connect("localhost", "root", "root");
    mysqli_select_db($coon, "laravel_test");
    mysqli_set_charset($coon, "utf8");
    // limit为约束显示多少条信息，后面有两个参数，第一个为从第几个开始，第二个为长度
    $rs = "select * from articles limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
    $r = mysqli_query($coon, $rs);
    while ($obj = mysqli_fetch_object($r)) {
        $array[] = $obj;
    }
    mysqli_close($coon);
    return $array;
}

// 显示总页数的函数
function allNews()
{
    $coon = mysqli_connect("localhost", "root", "root");
    mysqli_select_db($coon, "laravel_test");
    mysqli_set_charset($coon, "utf8");
    $rs = "select count(*) num from articles"; // 可以显示出总页数
    $r = mysqli_query($coon, $rs);
    $obj = mysqli_fetch_object($r);
    return $obj->num;
}

$allNum = allNews();
$pageSize = 3; // 约定每页显示的信息条数
$pageNum = empty($_GET['pageNum']) ? 1 : $_GET['pageNum'];
$endPage = ceil($allNum/$pageSize); // 总页数
$array = news($pageNum, $pageSize);
?>
</head>
<body>
<table border="1" style="text-align: center;" cellpadding="0">
    <tr>
        <td>编号</td>
        <td>标题</td>
        <td>内容</td>
        <td>发布日期</td>
    </tr>
    <?php
    foreach($array as $key => $value){
        echo "<tr>";
        echo "<td>{$value->id}</td>";
        echo "<td>{$value->title}</td>";
        echo "<td>{$value->content}</td>";
        echo "<td>{$value->created_at}</td>";
        echo "</tr>";
    }
    ?>
</table>
<div>
    <a href="?pageNum=1">首页</a>
    <a href="?pageNum=<?php echo $pageNum==1 ? 1 : ($pageNum-1); ?>">上一页</a>
    <a href="?pageNum=<?php echo $pageNum==$endPage ? $endPage : ($pageNum+1); ?>">下一页</a>
    <a href="?pageNum=<?php echo $endPage; ?>">尾页</a>

</div>

</body>
</html>
