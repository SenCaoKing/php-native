<html>
<head>
    <title>接口测试工具</title>
    <meta content="text/html; charset=UTF-8">

    <link href="https://cdn.bootcss.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/jsoneditor/5.9.6/jsoneditor.min.css" rel="stylesheet">

    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/jsoneditor/5.9.6/jsoneditor.min.js"></script>
    <script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
</head>

<style>
    .base-text, button {cursor: pointer;}
    #jsoneditor{height: 80%;}
</style>

<body>
<h1 class="text-center">接口测试工具</h1>

<div class="container-fluid">
    <div class="row">
        <div class="col">

            <label for="base-url">站点：</label>
            <input id="base-url" name="base-url" type="text" class="rd_1 w350" value="http://www.site1.com"
                   required />

            <label><input type="radio" name="method" checked="checked" value="get" />GET</label>
            <label><input type="radio" name="method" value="post" />POST</label>
            <br />

            <label for="params">参数：</label>
            <textarea id="params" name="params" class="w-100 small h-25">"id": 2</textarea>

            <br />
            <div class="apis">
                <?php
                /**
                 * 这里我们读取api目录下的文件来获得接口列表，在实际情况中，
                 * 比如在MVC框架中，我们可以先获得文件内容，再通过正则方式
                 * 获取具体的接口名称
                 */
                ?>
                <?php $files = array_slice(scandir('./api'), 2); ?>
                <?php foreach ($files as $file): ?>
                    <div class="api-item">
                        <button data-url="/api/<?= $file ?>"><?= $file ?></button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col">
            <div id="jsoneditor"></div>
            <p><a href="#" target="_blank" id="full-url" class="text-gray"></a></p>
        </div>
    </div>
</div>

<script>
    // 初始化JSON编辑器
    var container = document.getElementById("jsoneditor");
    var options = {mode: 'code', indentation: 4};
    var editor = new JSONEditor(container, options);

    // 点击接口
    $('.api-item button').on('click', function() {
        // 高亮
        $('.api-item button').removeClass('current');
        $(this).addClass('current');

        // 获取DOM中的数据
        var base = $('input[name=base-url]').val(),
            api = $(this).attr('data-url'),
            params = '{' + $('#params').val().replace(/\n/g, ',') + '}',
            method = $('input[name=method]:checked').val(),
            href = (method === 'get') ? (base + api + '?' + $.param(JSON.parse(params))) : (base + api);

        // 显示链接
        $('#full-url').attr('href', href).html(href);

        // 获取数据
        $.post(
            'api-curl.php',
            {
                url: base + api,
                params: params,
                method: method
            },
            function(result) {
                try {
                    var json = JSON.parse(result);
                    editor.set(json);
                } catch(e) {
                    editor.set({RETURN_INVALID_JSON_STRING: result});
                }
            }
        );
    });
</script>

</body>
</html>


