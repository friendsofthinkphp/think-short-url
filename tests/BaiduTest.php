<?php

namespace ShortUrl\Test;

use GuzzleHttp\Exception\ClientException;
use Mockery as m;
use ShortUrl\Exception\TokenInvalidException;
use ShortUrl\ShortUrl;
use think\Config;

class BaiduTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    public function testNotToken()
    {
        $name = 'baidu';
        $shortUrl = new ShortUrl($this->app);

        $config = m::mock(Config::class);
        $config->shouldReceive('get')->with("short_url.{$name}", [])->andReturn([]);

        $this->app->shouldReceive('get')->with('config')->andReturn($config);
        $handle = $shortUrl->make($name);

        $this->expectException(TokenInvalidException::class);
        $handle->create('http://www.baidu.com');
    }

    public function testCreate()
    {
        $name = 'baidu';
        $shortUrl = new ShortUrl($this->app);

        $config = m::mock(Config::class);
        $config->shouldReceive('get')->with("short_url.{$name}", [])->andReturn([
            'token' => 'xxx',
        ]);

        $this->app->shouldReceive('get')->with('config')->andReturn($config);
        $handle = $shortUrl->make($name);
        $this->expectException(ClientException::class);
        $handle->create('http://www.baidu.com');
    }

    public function testQuery()
    {
        $name = 'baidu';
        $shortUrl = new ShortUrl($this->app);

        $config = m::mock(Config::class);
        $config->shouldReceive('get')->with("short_url.{$name}", [])->andReturn([
            'token' => 'xxx',
        ]);

        $this->app->shouldReceive('get')->with('config')->andReturn($config);
        $handle = $shortUrl->make($name);
        $this->expectException(ClientException::class);
        $handle->query('http://www.baidu.com');
    }

    public function testDelete()
    {
        $name = 'baidu';
        $shortUrl = new ShortUrl($this->app);

        $config = m::mock(Config::class);
        $config->shouldReceive('get')->with("short_url.{$name}", [])->andReturn([
            'token' => 'xxx',
        ]);

        $this->app->shouldReceive('get')->with('config')->andReturn($config);
        $handle = $shortUrl->make($name);
        $this->expectException(ClientException::class);
        $handle->delete('xxx');
    }

    public function testGetToken()
    {
        $temp = [
            'token' => 'xxx',
        ];

        $name = 'baidu';
        $shortUrl = new ShortUrl($this->app);

        $config = m::mock(Config::class);
        $config->shouldReceive('get')->with("short_url.{$name}", [])->andReturn($temp);

        $this->app->shouldReceive('get')->with('config')->andReturn($config);
        $handle = $shortUrl->make($name);
        $this->assertSame($temp, $handle->getConfig());
    }
}
