<?php

return [
    'name' => 'Pages',
    'layout' => 'layouts.app',  //Das Layout für die Seiten der Komponente

    //default config
    'default_layout' => 'layouts.app',
    'default_category' => 'main',
    'default_group' => 'article',
    'default_robots' => 'all',

    //Sitemap default config
    'sitemap_default_show' => true,
    'sitemap_default_priority' => 0.6,
    'sitemap_default_changefreq' => 'monthly',

    //Manage Pages Route
    'route_manage_pages_prefix' => 'pages',
    'route_manage_pages_middleware' => ['web', 'auth'],

    //Show Pages
    'route_show_pages_prefix' => '',
    'route_show_pages_middleware' => 'web',

    'layouts' => [                 //Das Layout für die Pages
        'layouts.app'
    ],

    'categories' => [
        'main',
        'law',
        'access',
        'excel'
    ],

    'groups' => [
        'article'
    ],

    'sitemap_changefreqs' => [
        'always',
        'hourly',
        'daily',
        'monthly',
        'yearly',
        'never'
    ],

    'robots' => [
        'all',
        'index, follow',
        'none',
        'noindex, nofollow'
    ]


];
