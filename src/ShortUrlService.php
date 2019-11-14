<?php

namespace ShortUrl;

use think\Service;

class ShortUrlService extends Service
{
    public function register()
    {
        $this->app->bind('short-url', ShortUrl::class);
    }
}
