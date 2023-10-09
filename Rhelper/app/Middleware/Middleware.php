<?php

namespace app\Middleware;

class Middleware
{
    public const MAP = [
        'guest' => Guest::class,
        'member' => Member::class,
        'owner' => Owner::class,
        'admin' => Admin::class
    ];

    public static function resolve($key)
    {
        if (!$key) return;
        $middleware = static::MAP[$key];
        (new $middleware)->handle();
    }
}
