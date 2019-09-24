<?php
function config($key = '')
{
    $config = [
        'name' => 'URL Analyzer',
        'site_url' => '',
        'pretty_uri' => true,
        'version' => 'v1.0',
    ];

    return isset($config[$key]) ? $config[$key] : null;
}
