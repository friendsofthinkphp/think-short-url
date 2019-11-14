<?php

namespace ShortUrl\Handle;

use ShortUrl\Contract\ShortUrlInterface;
use ShortUrl\Exception\TokenInvalidException;

class Baidu extends Handle implements ShortUrlInterface
{
    private $config = [];

    protected $host = 'https://dwz.cn';

    const ContentType = 'application/json';

    public function __construct($options = [])
    {
        $this->config = $options;

        parent::__construct();
    }

    /**
     * 创建短链接.
     *
     * @param [type] $url
     * @param string $options
     */
    public function create($url, $options = '')
    {
        // "long-term"：长期，默认值 "1-year"：1年
        $termOfValidity = !empty($options) && $options === false ? false : true;

        return $this->send('POST', '/admin/v2/create', [
            'headers' => [
                'Token' => $this->getToken(), 'Content-Type' => self::ContentType,
            ],

            'body' => json_encode([
                'Url'            => $url,
                'TermOfValidity' => $termOfValidity ? 'long-term' : '1-year',
            ]),
        ]);
    }

    /**
     * 还原链接.
     *
     * @param [type] $shortUrl
     */
    public function query($shortUrl)
    {
        return $this->send('POST', '/admin/v2/query', [
            'headers' => [
                'Token' => $this->getToken(), 'Content-Type' => self::ContentType,
            ],

            'body' => json_encode([
                'shortUrl' => $shortUrl,
            ]),
        ]);
    }

    /**
     * 删除短链接.
     *
     * @param [type] $url
     * @param mixed  $shortUrl
     */
    public function delete($shortUrl)
    {
        return $this->send('DELETE', '/api/v3/short-urls/'.$shortUrl, [
            'headers' => [
                ['Dwz-Token' => $this->getToken()],
            ],
        ]);
    }

    protected function getToken()
    {
        if (empty($this->config['token'])) {
            throw new TokenInvalidException('Token 未配置');
        }

        return $this->config['token'];
    }

    public function getConfig()
    {
        return $this->config;
    }
}
