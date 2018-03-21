<?php

namespace RapidWeb\BucketTesting;

use Exception;

class WeightedBucket
{
    public $weight = 1;
    public $bucket;

    public function __construct(Bucket $bucket)
    {
        $this->bucket = $bucket;
    }

    public function setWeight($weight)
    {
        if (!is_int($weight) || $weight < 1) {
            throw new Exception('Weight must be specified as a positive integer.');
        }

        $this->weight = $weight;
    }
}
