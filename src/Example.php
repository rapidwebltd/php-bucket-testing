<?php

require_once __DIR__.'/../vendor/autoload.php';

use \RapidWeb\BucketTesting\BucketManager;
use \RapidWeb\BucketTesting\Bucket;

// Create a new bucket manager
$bucketManager = new BucketManager;

// Add buckets, with URLs and optional weights
$bucketManager->add(new Bucket('https://google.co.uk/'))->withWeight(25);
$bucketManager->add(new Bucket('https://php.net/'))->withWeight(75);

// Redirect to a randomly selected URL
$bucketManager->redirect();

// Or, if you wish, get a random bucket and manually handle the redirection
$bucket = $bucketManager->getRandomBucket();
header('location: '.$bucket->url);