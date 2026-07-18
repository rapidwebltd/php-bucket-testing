<?php

use PHPUnit\Framework\TestCase;
use RapidWeb\BucketTesting\Bucket;
use RapidWeb\BucketTesting\BucketManager;
use RapidWeb\BucketTesting\WeightedBucket;

final class ExceptionsTest extends TestCase
{
    private function expectExceptionCompatible($class)
    {
        if (method_exists($this, 'expectException')) {
            $this->expectException($class);

            return;
        }

        $this->setExpectedException($class);
    }

    public function testGetRandomBucketWhenNoBucketsAreAdded()
    {
        $this->expectExceptionCompatible('Exception');
        (new BucketManager())->getRandomBucket();
    }

    public function testGetMostRecentlyAddedWeightedBucketWhenNoBucketsAreAdded()
    {
        $method = new ReflectionMethod('RapidWeb\\BucketTesting\\BucketManager', 'getMostRecentlyAddedWeightedBucket');
        $method->setAccessible(true);

        $this->expectExceptionCompatible('Exception');
        $method->invoke(new BucketManager());
    }

    public function testRedirectWhenNoBucketsAreAdded()
    {
        $this->expectExceptionCompatible('Exception');
        (new BucketManager())->redirect();
    }

    public function testCreatingWeightedBucketWithStringWeight()
    {
        $this->expectExceptionCompatible('Exception');
        (new WeightedBucket(new Bucket('https://php.net/')))->setWeight('not a number!');
    }

    public function testCreatingWeightedBucketWithFloatWeight()
    {
        $this->expectExceptionCompatible('Exception');
        (new WeightedBucket(new Bucket('https://php.net/')))->setWeight(2.75);
    }

    public function testCreatingWeightedBucketWithNegativeWeight()
    {
        $this->expectExceptionCompatible('Exception');
        (new WeightedBucket(new Bucket('https://php.net/')))->setWeight(-1);
    }

    public function testCreatingWeightedBucketWithZeroWeight()
    {
        $this->expectExceptionCompatible('Exception');
        (new WeightedBucket(new Bucket('https://php.net/')))->setWeight(0);
    }
}
