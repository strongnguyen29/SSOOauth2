<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

include 'vendor/autoload.php';

use \Firebase\JWT\JWT;

define('SECRET', '123456');
define('COOKIE_NAME', '_token');
define('BASE_PATH', __DIR__);

// Thong tin cac ung dung
$apps = [
    'app1' => [
        'id' => 'app1',
        'secret' => 'abcd',
        'url' => 'http://ssoapp1.test'
    ],
    'app2' => [
        'id' => 'app2',
        'secret' => 'eftg',
        'url' => 'http://ssoapp2.test'
    ]
];

// Jwt payload data
$payload = array(
    "iss" => "http://ssooauth.test",
    "aud" => "app",
    "exp" => time() + 24*60*60,
    "iat" => time(),
    "uid" => 123,
    "role" => "admin"
);

include_once 'functions.php';

if (isset($_GET['page']) && $_GET['page'] = 'embed') {
    // Iframe nhung trong app
    include_once 'app/embed.php';

} elseif ($jwtObj = authenticated()) {
    
    redirectToApp($apps, $payload);

    echo 'Xac thuc thanh cong<br/>';
    print_r($jwtObj);

} else {
    include 'app/login.php';
}
