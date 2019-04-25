<?php

return [
    'session_lifetime' => env("SESSION_LIFETIME", 5),
    'session_expire_time' => env("SESSION_EXPIRE_TIME", 5),
    'session_skip_time' => env("SESSION_SKIP_TIME", 30),
    'texts' => [
        "main_message" => "Session will logout in " . env("SESSION_EXPIRE_TIME", 5) . " minutes. Do you need more time?",
        'cancel_button' => "Log Out",
        "submit_button" => "More time, please"
    ],
    "icon" => [
        'available' => true,
        'assert' => true,
        'path' => "assets/portal/img/portal/default.jpg"
    ],
    'logout_path' => "/auth/logout",
    'cookie_name' => "session_timer_ideal"
];
