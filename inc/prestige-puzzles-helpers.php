<?php

function get_menu_items()
{
    $menu_links = [
        [
            'post_slug' => 'homepage',
            'post_url' => '/',
            'text' => 'Home'
        ],
        [
            'post_slug' => 'about',
            'post_url' => '/about',
            'text' => 'About'
        ],
        [
            'post_slug' => 'ship-to-us',
            'post_url' => '/ship-to-us',
            'text' => 'How to ship to us'
        ],
        [
            'post_slug' => 'contact',
            'post_url' => '/contact',
            'text' => 'Contact'
        ],
        [
            'post_slug' => 'puzzle',
            'post_url' => '/shop/puzzle',
            'text' => 'Plaque my puzzle',
            'classes' => 'frame',
        ],
    ];
    return $menu_links;
}