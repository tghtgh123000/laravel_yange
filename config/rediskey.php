<?php
$prefix = env('REDIS_PREFIX') ?: 'laravel_redis';

return [
    //频率限制-短信验证码
    'rfl_smscode_pre'      => "$prefix:rfl:" . 'smscode',

    //短信验证码
    'smscode_register_pre' => "$prefix:smscode:" . 'register',
    'smscode_login_pre'    => "$prefix:smscode:" . 'login',
    'smscode_forget_pre'   => "$prefix:smscode:" . 'forget',

    //fruit 刷新
    'fruit_refresh' => "$prefix:fruit_refresh",
];
