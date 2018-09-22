<?php

namespace Xolens\PgLaratraining\Test;

use Xolens\PgLarautil\Test\TestCase;
use Xolens\PgLarautil\Test\RepositoryTrait\ReadableRepositoryTestTrait;
use Xolens\PgLarautil\Test\RepositoryTrait\WritableRepositoryTestTrait;

abstract class TestPgLaraTrainingBase extends TestCase
{
    // use ReadableRepositoryTestTrait, WritableRepositoryTestTrait;
    
    protected $repo;

    public function repository(){
        return $this->repo;
    }

    protected function getPackageProviders($app): array{
        return [
            'Xolens\PgLaratraining\PgLaratrainingServiceProvider'
        ];
    }

    public function generateSingleItem(){
        return $this->generateItems(1)[0];
    }

    abstract public function generateItems($toGenerateCount);
}