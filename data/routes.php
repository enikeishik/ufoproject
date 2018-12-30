<?php
return [
    '/' => [
        'title' => 'Main page', 
        'module' => [
            'id' => -1, 
            'name' => 'Mainpage', 
            'dbless' => true, 
        ], 
    ], 
    '/stub' => [
        'title' => 'My stub', 
        'module' => [
            'id' => 1, 
            'name' => 'Stub', 
            'callback' => '\App\MyStubController', 
            'dbless' => true, 
        ], 
    ], 
    '/blog' => [
        'title' => 'My blog', 
        'module' => [
            'id' => 1, 
            'name' => 'Blog', 
            'callback' => '\App\MyBlogController', 
            'dbless' => true, 
        ], 
    ], 
    '/callback' => [
        'title' => 'My callback', 
        'module' => [
            'id' => 1, 
            'name' => 'Blog', 
            'callback' => function($container) {
                return ['content' => 'Callback content'];
            }, 
            'dbless' => true, 
        ], 
    ], 
    '/redirect' => [
        'title' => 'My redirect', 
        'module' => [
            'id' => 1, 
            'name' => 'Redirect', 
            'callback' => '\App\MyRedirectController', 
            'dbless' => true, 
        ], 
    ], 
    '/forbidden' => [
        'title' => 'My forbidden', 
        'module' => [
            'id' => 1, 
            'name' => 'Forbidden', 
            'callback' => function($container) {
                return $container->get('app')->getError(403, 'Forbidden');
            }, 
            'dbless' => true, 
        ], 
    ], 
];
