<?php

require_once __DIR__.'/../vendor/autoload.php';

use \RapidWeb\BucketTesting\BucketManager;
use \RapidWeb\BucketTesting\Bucket;

// Create a new bucket manager
$bucketManager = new BucketManager;

// Add buckets, with URLs and optional weights
$bucketManager->add(new Bucket('https://google.co.uk/'))->withWeight(25);
$bucketManager->add(new Bucket('https://php.net/'))->withWeight(75);

// For testing, get thousands of random buckets and count how often the URLs appear
$urlCount = [];

for ($i=0; $i < 100000; $i++) { 
    $bucket = $bucketManager->getRandomBucket();

    if (!isset($urlCount[$bucket->url])) {
        $urlCount[$bucket->url] = 0;
    }

    $urlCount[$bucket->url]++;
}

// Output the URL counts, so we can ensure they approximately make the expect weights
var_dump($urlCount);
