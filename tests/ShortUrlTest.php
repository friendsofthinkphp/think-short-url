<?php

namespace ShortUrl\Test;

use \InvalidArgumentException;
use Mockery as m;
use ShortUrl\Contract\ShortUrlInterface;
use ShortUrl\ShortUrl;
use think\Config;

class ShortUrlTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    public function testMake()
    {
        $name = 'baidu';
        $shortUrl = new ShortUrl($this->app);

        $config = m::mock(Config::class);
        $config->shouldReceive('get')->with("short_url.{$name}", [])->andReturn([
            'token' => 'xxx',
        ]);

        $this->app->shouldReceive('get')->with('config')->andReturn($config);
        $handle = $shortUrl->make($name);
        $flag = $handle instanceof ShortUrlInterface;
        $this->assertEquals(true, $flag);
    }

    public function testNotMake()
    {
        $name = 'xxx';

        $shortUrl = new ShortUrl($this->app);

        $this->expectException(InvalidArgumentException::class);
        $shortUrl->make($name);
    }
}
