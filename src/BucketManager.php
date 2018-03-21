<?php

namespace RapidWeb\BucketTesting;

use Exception;

class BucketManager
{
    private $weightedBuckets = [];

    public function add(Bucket $bucket)
    {
        $this->weightedBuckets[] = new WeightedBucket($bucket);

        return $this;
    }

    public function withWeight($weight)
    {
        $weightedBucket = $this->getMostRecentlyAddedWeightedBucket();

        $weightedBucket->setWeight($weight);

        return $this;
    }

    private function getMostRecentlyAddedWeightedBucket()
    {
        $weightedBucket = end($this->weightedBuckets);

        if (!$weightedBucket) {
            throw new Exception('Unable to retrieve most recently added weight bucket. You must add a bucket first!');
        }

        return $weightedBucket;
    }

    private function getRandomWeightedBucket()
    {
        $weightedBucketSelector = new WeightedBucketSelector($this->weightedBuckets);

        return $weightedBucketSelector->getRandomBucket();
    }

    public function getRandomBucket()
    {
        return $this->getRandomWeightedBucket()->bucket;
    }

    public function redirect()
    {
        $bucket = $this->getRandomBucket();

        header('location: '.$bucket->url);
        die;
    }
}
