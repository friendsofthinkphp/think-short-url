<?php

/**
 * 生成百度短链接.
 *
 * @param [type] $url
 * @param array  $options
 */
function shorturl_baidu($url, $options = [])
{
    return app('short-url')->make('baidu', $options)->create($url);
}

/**
 * 生成新浪短链接.
 *
 * @param [type] $url
 * @param array  $options
 */
function shorturl_sina($url, $options = [])
{
    return app('short-url')->make('sina', $options)->create($url);
}
