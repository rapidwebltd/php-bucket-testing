<?php

use PHPUnit\Framework\TestCase;
use RapidWeb\BucketTesting\Bucket;
use RapidWeb\BucketTesting\BucketManager;

final class WeightsTest extends TestCase
{
    public function testWeights()
    {
        // Create a new bucket manager
        $bucketManager = new BucketManager();

        // Add buckets, with URLs and optional weights
        $bucketManager->add(new Bucket('https://google.co.uk/'))->withWeight(25);
        $bucketManager->add(new Bucket('https://php.net/'))->withWeight(75);

        // For testing, get thousands of random buckets and count how often the URLs appear
        $urlCount = [];

        for ($i = 0; $i < 100000; $i++) {
            $bucket = $bucketManager->getRandomBucket();

            if (!isset($urlCount[$bucket->url])) {
                $urlCount[$bucket->url] = 0;
            }

            $urlCount[$bucket->url]++;
        }

        // Test counts are in acceptable ranges
        $this->assertGreaterThan(24500, $urlCount['https://google.co.uk/']);
        $this->assertLessThan(25500, $urlCount['https://google.co.uk/']);
        $this->assertGreaterThan(74500, $urlCount['https://php.net/']);
        $this->assertLessThan(75500, $urlCount['https://php.net/']);
    }
}
