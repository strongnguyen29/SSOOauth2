<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Oauth Server</title>
</head>
<body>
<?php
    $userInfo = authenticated();
    $app = getApp($apps);
    $url = $app ? $app['url'] : '';

    if ($url):
?>
    <script type="text/javascript">
        var isLogined = <?php echo ($userInfo ? 1 : 0)  ?>;
        var originUrl = '<?php echo $url  ?>';
        window.onload = function(){
            console.log('send mes login: ' + isLogined);
            parent.postMessage({login: isLogined}, originUrl);
        };
    </script>
<?php endif; ?>
</body>
</html>