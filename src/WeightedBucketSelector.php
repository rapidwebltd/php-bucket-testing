<?php

namespace RapidWeb\BucketTesting;

use Exception;

class WeightedBucketSelector
{
    private $weightedBuckets;

    public function __construct(array $weightedBuckets)
    {
        $this->weightedBuckets = $weightedBuckets;
    }

    public function getRandomBucket()
    {
        if (!$this->weightedBuckets) {
            throw new Exception('There are not weighted buckets available. You must add a bucket first!');
        }

        $index = $this->getRandomWeightedIndex();

        return $this->weightedBuckets[$index];
    }

    private function getRandomWeightedIndex()
    {
        $indexToWeightArray = $this->getIndexToWeightArray();

        $rand = mt_rand(1, (int) array_sum($indexToWeightArray));

        foreach ($indexToWeightArray as $index => $value) {
            $rand -= $value;
            if ($rand <= 0) {
                return $index;
            }
        }

        throw new Exception('Error retrieving random weighted index during bucket selection process.');
    }

    private function getIndexToWeightArray()
    {
        $indexToWeightArray = [];

        foreach ($this->weightedBuckets as $index => $weightedBucket) {
            $indexToWeightArray[$index] = $weightedBucket->weight;
        }

        return $indexToWeightArray;
    }
}
