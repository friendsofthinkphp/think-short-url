<?php

namespace ShortUrl\Contract;

interface ShortUrlInterface
{
    public function __construct($options = []);

    public function create($arguments);
}
