<?php
return [
    '/' => [
        'title' => 'Main page', 
        'module' => [
            'vendor' => 'Ufo', 
            'name' => 'Mainpage', 
            'dbless' => true, 
        ], 
    ], 
    '/stub' => [
        'title' => 'My stub', 
        'module' => [
            'vendor' => 'Ufo', 
            'name' => 'Stub', 
            'callback' => '\App\MyStubController', 
            'dbless' => true, 
        ], 
    ], 
    '/blog' => [
        'title' => 'My blog', 
        'module' => [
            'vendor' => 'Ufo', 
            'name' => 'Blog', 
            'callback' => '\App\MyBlogController', 
            'dbless' => true, 
        ], 
    ], 
    '/callback' => [
        'title' => 'My callback', 
        'module' => [
            'vendor' => 'Ufo', 
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
            'vendor' => 'Ufo', 
            'name' => 'Redirect', 
            'callback' => '\App\MyRedirectController', 
            'dbless' => true, 
        ], 
    ], 
    '/forbidden' => [
        'title' => 'My forbidden', 
        'module' => [
            'vendor' => 'Ufo', 
            'name' => 'Forbidden', 
            'callback' => function($container) {
                return $container->get('app')->getError(403, 'Forbidden');
            }, 
            'dbless' => true, 
        ], 
    ], 
    '/modstub' => [
        'title' => 'My stub module', 
        'module' => [
            'vendor' => 'Enikeishik', 
            'name' => 'Ufmstub', 
            'dbless' => true, 
        ], 
    ], 
    '/modexample' => [
        'title' => 'My example module', 
        'module' => [
            'vendor' => 'Enikeishik', 
            'name' => 'Ufmexample', 
        ], 
    ], 
];
