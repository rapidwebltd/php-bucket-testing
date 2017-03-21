<?php

namespace RapidWeb\BucketTesting;

class Bucket
{
    public $url;

    public function __construct($url) 
    {
        $this->url = $url;
    }
}