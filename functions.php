<?php

use Firebase\JWT\JWT;

/**
 * Get app info
 * @param $apps
 * @return bool
 */
function getApp($apps) {
    $appId = isset($_GET['app_id']) ? $_GET['app_id'] : false;
    return $appId && isset($apps[$appId]) ? $apps[$appId] : false;
}

/**
 * Redirect to app
 * @param $apps
 * @param $payload
 */
function redirectToApp($apps, $payload) {
    $appId = isset($_GET['app_id']) ? $_GET['app_id'] : false;

    if ($app = getApp($apps)) {
        $payload['aud'] = $appId;
        // Phat hanh ma tieng cho app
        $jwtForApp = JWT::encode($payload, $app['secret']);
        // Chuyen huong ve app kem token
        header(sprintf('location:%s?token=%s', $app['url'], $jwtForApp));
        exit;
    }
}

/**
 * Check login
 * @return bool|object
 */
function authenticated() {
    if (!isset($_COOKIE[COOKIE_NAME])) {
        return false;
    }
    
    try {
        return JWT::decode($_COOKIE[COOKIE_NAME], SECRET, array('HS256'));
    } catch (\Throwable $exception) {
        // Token het han
        print_r($exception);
        return false;
    }
}