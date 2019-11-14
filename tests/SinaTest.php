<?php

namespace ShortUrl\Test;

use Mockery as m;
use Psr\Http\Message\ResponseInterface;
use ShortUrl\ShortUrl;
use think\Config;

class SinaTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    public function testCreate()
    {
        $temp = [
            'ShortUrl' => 'https://url.cn/54R8NCd',
            'LongUrl'  => 'http://www.baidu.com',
            'Code'     => 0,
        ];

        $name = 'sina';
        $shortUrl = new ShortUrl($this->app);

        $config = m::mock(Config::class);
        $config->shouldReceive('get')->with("short_url.{$name}", [])->andReturn($temp);

        $this->app->shouldReceive('get')->with('config')->andReturn($config);
        $handle = $shortUrl->make($name);
        $result = $handle->create('http://www.baidu.com');

        $this->assertSame($temp, $result);
        $this->assertTrue($handle->getResponse() instanceof ResponseInterface);
        $this->assertEquals(200, $handle->getResponse()->getStatusCode());
    }
}
