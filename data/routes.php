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
];
