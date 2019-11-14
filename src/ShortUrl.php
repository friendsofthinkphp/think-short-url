<?php

namespace ShortUrl;

use \InvalidArgumentException;
use ReflectionClass;
use ShortUrl\Contract\ShortUrlInterface;
use ShortUrl\exception\Exception;
use think\App;
use think\helper\Str;

class ShortUrl
{
    protected $app = null;

    protected $namespace = '\\ShortUrl\\Handle\\';

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    protected function getConfig($name)
    {
        return $this->app->config->get("short_url.{$name}", []);
    }

    public function make($name, $options = [])
    {
        $className = false !== strpos($name, '\\') ? $name : $this->namespace . Str::studly($name);

        if (!class_exists($className)) {
            throw new InvalidArgumentException('Class Not Found');
        }

        $config = array_merge($this->getConfig($name), $options);

        $class = new ReflectionClass($className);
        $handle = $class->newInstance($config);

        if (false === $handle instanceof ShortUrlInterface) {
            throw new Exception('not implement ShortUrlInterface');
        }

        return $handle;
    }
}
