<?php

namespace ShortUrl\Handle;

use ShortUrl\contract\ShortUrlInterface;
use Symfony\Component\DomCrawler\Crawler;

class Sina extends Handle implements ShortUrlInterface
{
    const ContentType = 'application/x-www-form-urlencoded';

    // 可用的第三方
    protected $host = 'http://tool.chinaz.com';

    public function __construct($options = [])
    {
        parent::__construct();
    }

    /**
     * 创建短链接.
     *
     * @param [type] $url
     */
    public function create($url)
    {
        $response = $this->send('POST', '/tools/dwz.aspx', [
            'headers' > [
                'Content-Type' => self::ContentType,
            ],
            'form_params' => [
                'longurl' => $url,
            ],
        ]);

        $crawler = new Crawler((string) $response);
        $short_url = $crawler->filter('.DuanLinks')->filter('#shorturl')->text();
        $long_url = $crawler->filter('.DuanLinks .clearfix')->last()->filter('.col-blue02')->text();

        return ['ShortUrl' => $short_url, 'LongUrl' => $long_url, 'Code' => 0];
    }
}
